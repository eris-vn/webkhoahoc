<?php

require_once 'model/course.php';
require_once 'model/enrollment.php';

class CartController
{
    function show()
    {

        return view('client.cart', 'default');
    }
    function add()
    {
        validate_api($_POST, [
            'id' => ['required:tham số'],
        ]);

        $user = user();
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        if (count($cart)) {
            $check = array_search($_POST['id'], $cart);
            if ($check !== false) {
                return api(['status' => -100, 'msg' => 'Khoá học đã tồn tại trong giỏ hàng.']);
            }
        }

        $course = (new Course)->where("status", "=", 0)->where('id', '=', $_POST['id'])->first();
        if (!$course) {
            return api(['status' => -101, 'msg' => 'Khoá học đã xoá hoặc không tồn tại.']);
        }

        $enrolled = (new Enrollment)->where('user_id', '=', $user['id'])->where('course_id', '=', $course['id'])->first();
        if ($enrolled) {
            return api(['status' => -102, 'msg' => 'Bạn đã tham khoá học này rồi.']);
        }

        $cart[] = $_POST['id'];
        $_SESSION['cart'] = $cart;

        return api(['status' => 200, 'msg' => 'Thêm khoá học vào giỏ thành công.', 'data' => $this->convert_id($cart)]);
    }
    function convert_id($data)
    {
        $result = [];

        foreach ($data as $item) {
            $course = (new Course)->where("status", "=", 0)->where('id', '=', $item)->first();

            if ($course) {
                $result[] = [
                    'id' => $course['id'],
                    'name' => $course['name'],
                    'thumbnails' => $course['thumbnails'],
                    'price' => $course['price'],
                ];
            }
        }

        return $result;
    }
    function delete()
    {
        validate_api($_POST, [
            'id' => ['required:tham số'],
        ]);

        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        $check = array_search($_POST['id'], $cart);

        if ($check !== false) {
            unset($cart[$check]);
            $_SESSION['cart'] = array_values($cart);
            return api([
                'status' => 200,
                'msg' => 'Xoá khoá học khỏi giỏ thành công.',
                'data' => $this->convert_id($cart)
            ]);
        }

        return api(['status' => -200, 'msg' => 'Khoá học không tồn tại trong giỏ hàng.']);
    }
}
