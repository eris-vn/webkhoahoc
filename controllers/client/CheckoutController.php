<?php

require_once 'model/course.php';
require_once 'model/invoice.php';
require_once 'constants/invoice.php';
require_once 'model/enrollment.php';
require_once 'model/invoice_details.php';


class CheckoutController
{
    function show()
    {
        return view('client.checkout', 'default');
    }
    function payment()
    {
        validate_api($_POST, [
            'payment_method' => ['required:phương thức thanh toán'],
            'accept_terms' => ['required:điều khoản sử dụng']
        ]);

        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        if (!count($cart)) {
            return api(['status' => -100, 'msg' => 'Không tìm thấy sản phẩm để thanh toán.']);
        }

        $user = user();
        $courses = (new Course)->where("status", "=", 0)->whereIn('id', $cart)->getArray();
        $total_price = (new Course)->where("status", "=", 0)->whereIn('id', $cart)->sum('price');

        if ($total_price == 0) {
            (new Invoice)->insert(['user_id' => $user['id'], 'name' => 'Thanh toán qua VNPAY', 'price' => $total_price, 'status' => InvoiceCode::SUCCESS]);
            $invoice = (new Invoice)->where('user_id', '=', $user['id'])->where('status', '=', InvoiceCode::SUCCESS)->orderBy('id', 'desc')->first();

            foreach ($courses as $course) {
                (new Enrollment)->insert(['user_id' => $user['id'], 'course_id' => $course['id'], 'instructor_id' => $course['user_id']]);
                (new InvoiceDetail)->insert(['invoice_id' => $invoice['id'], 'course_id' => $course['id']]);
            }
            $_SESSION['cart'] = [];
            return api(['status' => 200, 'msg' => 'Thanh toán thành công']);
        } else {
            // (new Invoice)->insert(['user_id' => $user['id'], 'name' => $course['name'], 'price' => $course['price'], 'status' => InvoiceCode::SUCCESS]);

            if ($_POST['payment_method'] == "vnpay") {
                (new Invoice)->insert(['user_id' => $user['id'], 'name' => 'Thanh toán qua VNPAY', 'price' => $total_price, 'status' => InvoiceCode::PENDING]);
                $invoice = (new Invoice)->where('user_id', '=', $user['id'])->where('status', '=', 0)->orderBy('id', 'desc')->first();

                foreach ($courses as $course) {
                    (new InvoiceDetail)->insert(['invoice_id' => $invoice['id'], 'course_id' => $course['id']]);
                }

                $create_url = $this->vnpay_create($invoice['id'], $total_price);
                $_SESSION['cart'] = [];

                return api(['status' => 201, 'url' => $create_url]);
            } else {
                return api(['status' => -101, 'msg' => 'Phương thức thanh toán chưa hỗ trợ.']);
            }
        }

        // return api(['status' => 200, 'test' => $total_price]);
    }
    function vnpay_create($TxnRef, $amount)
    {
        $vnp_TmnCode = "AZDEPITD"; //Mã định danh merchant kết nối (Terminal Id)
        $vnp_HashSecret = "IGTIPAQLZXOYKUCKKWJXOLUUCHWPXPIG"; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/callback/vnpay";

        //Config input format
        //Expire
        $startTime = date("YmdHis");
        $expireTime = strtotime('+15 minutes', strtotime($startTime));
        $expire = date('YmdHis', $expireTime);

        $vnp_TxnRef = $TxnRef; //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $amount; // Số tiền thanh toán
        $vnp_Locale = "vn"; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = ""; //Mã phương thức thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }
}
