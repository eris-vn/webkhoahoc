<?php

require_once 'libraries/PHPMailer/src/SMTP.php';
require_once 'libraries/PHPMailer/src/PHPMailer.php';
require_once 'libraries/PHPMailer/src/Exception.php';
require_once 'model/verification_code.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class AuthController
{
    function loginpage()
    {
        return view('client.auth.login', 'default');
    }
    function on_login()
    {
        validate_api($_POST, [
            'email' =>  ['required', 'email'],
            'password' => ['required']
        ]);

        $user = (new User)->where('email', '=', $_POST['email'])->where('password', '=', md5($_POST['password']))->first();

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
        } else {
            return api(['status' => -100, 'msg' => 'Tài khoản hoặc mật khẩu không chính xác.']);
        }
        return api(['status' => 200, 'msg' => 'Đăng nhập thành công.']);
    }
    function on_regist()
    {
        validate_api($_POST, [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            're_password' => ['required']
        ]);

        $user = (new User)->where('email', '=', $_POST['email'])->first();

        if ($user) {
            return api(['status' => -101, 'msg' => 'Email đã tồn tại trong hệ thống.']);
        }

        if ($_POST['password'] != $_POST['re_password']) {
            return api(['status' => -102, 'msg' => 'Xác nhận mật khẩu không đúng.']);
        }

        (new User)->insert(['name' => htmlspecialchars($_POST['name']), 'email' => $_POST['email'], 'password' => md5($_POST['password'])]);

        $user = (new User)->where('email', '=', $_POST['email'])->where('password', '=', md5($_POST['password']))->first();
        $_SESSION['user_id'] = $user['id'];

        return api(['status' => 200, 'msg' => 'Đăng ký tài khoản thành công.']);
    }
    function on_logout()
    {
        $user = user();

        if ($user) {
            $_SESSION['user_id'] = null;
        }

        return redirect('/');
    }
    function forgotpage()
    {
        return view('client.auth.reset', 'default');
    }
    function send_code()
    {
        validate_api($_POST, [
            'email' => ['required']
        ]);

        $mail = new PHPMailer(true);
        $user = (new User)->where('email', '=', $_POST['email'])->first();
        if (!$user) {
            return api(['status' => -100, 'msg' => "Email sai hoặc không tồn tại trong hệ thống."]);
        }

        $code = mt_rand(100000, 999999);
        $expiresAt = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        $check = (new VerificationCode)->where('email', '=', $user['email'])->where('user_id', '=', $user['id'])->latest()->first();
        if ($check) {
            $latestCreatedAt = strtotime($check['created_at']);

            $currentTime = time();

            if ($currentTime - $latestCreatedAt > 5 * 60) {
                return api(['status' => -100, 'msg' => 'Vui lòng chờ 5p sau, và thử lại.', $currentTime - $latestCreatedAt]);
            }
        }

        try {
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = 'mail49.vietnix.vn';
            $mail->SMTPAuth = true;
            $mail->Username = 'noreply@mail.shoperis.net';
            $mail->Password = '';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->CharSet = 'UTF-8';

            // Recipients
            $mail->setFrom('noreply@mail.shoperis.net', 'ErisVN');
            $mail->addAddress($_POST['email']);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Mã xác nhận tài khoản của bạn là: ' . $code;
            $mail->Body = 'Chào ' . $user['name'] . ', mã xác nhận của bạn là <bold>' . $code . '</bold> <br> Vui lòng hoàn thành xác thực trong 15p.';

            $mail->send();

            (new VerificationCode)->insert(['user_id' => $user['id'], 'code' => md5($code), 'email' => $user['email'], 'expires_at' => $expiresAt]);
            return api(['status' => 200, 'msg' => 'Gửi mã thành công']);
        } catch (Exception $e) {
            return api(['status' => -100, 'msg' => 'Gửi mail thất bại', 'error' => $mail->ErrorInfo]);
        }
    }
    function on_reset()
    {
        validate_api($_POST, [
            'email' => ['required'],
            'code' => ['required:mã xác nhận'],
            'password' => ['required:mật khẩu'],
            're_password' => ['required:xác nhận mật khẩu']
        ]);

        if ($_POST['password'] != $_POST['re_password']) {
            return api(['status' => -100, 'msg' => 'Xác thực mật khẩu thất bại']);
        }

        $user = (new User)->where('email', '=', $_POST['email'])->first();
        if (!$user) {
            return api(['status' => -100, 'msg' => "Email sai hoặc không tồn tại trong hệ thống."]);
        }

        if (!$this->verify_code($_POST['code'], $_POST['email'])) {
            return api(['status' => -100, 'msg' => 'Xác thực mã thất bại']);
        }

        (new User)->where('id', '=', $user['id'])->update(['password' => md5($_POST['password'])]);
        return api(['status' => 200, 'msg' => 'Đặt lại mật khẩu thành công']);
    }
    function verify_code($code, $email)
    {
        $verify = (new VerificationCode)->where('code', '=', md5($code))->where('email', '=', $email)->first();

        if ($verify) {
            $expiresAt = strtotime($verify['expires_at']);
            $currentTime = time();

            if ($currentTime > $expiresAt) {
                return false;
            }

            (new VerificationCode)->where('id', '=', $verify['id'])->delete();
            return true;
        }

        return false;
    }
}
