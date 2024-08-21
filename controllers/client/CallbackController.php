<?php

require_once 'constants/invoice.php';
require_once 'model/invoice.php';
require_once 'model/invoice_details.php';
require_once 'model/course.php';
require_once 'model/enrollment.php';

class CallbackController
{
    function vnpay()
    {
        $vnp_HashSecret = "IGTIPAQLZXOYKUCKKWJXOLUUCHWPXPIG";
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash != $vnp_SecureHash) {
            return redirect('/');
        }

        $orderId = $inputData['vnp_TxnRef'];

        $invoice = (new Invoice)->where('id', '=', $orderId)->where('status', '=', InvoiceCode::PENDING)->first();

        if (!$invoice) {
            return redirect('/');
        }

        (new Invoice)->where('id', '=', $orderId)->update(['status' => InvoiceCode::SUCCESS]);
        $details = (new InvoiceDetail)->where('invoice_id', '=', $orderId)->get();

        foreach ($details as $item) {
            $instructor = (new Course)->where("status", "=", 0)->where('id', '=', $item['course_id'])->first();
            (new Enrollment)->insert(['user_id' => $invoice['user_id'], 'course_id' => $item['course_id'], 'instructor_id' => $instructor['user_id']]);
        }

        return redirect('/user/enrolled-courses');
    }
}
