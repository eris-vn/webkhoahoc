<?php
class SettingController
{
    function show_page()
    {
        $user = user();
        return view('client.user.setting', compact('user'), 'user');
    }
    function edit()
    {

        validate_api($_POST, [
            'name' => ['required:họ tên'],
            'phone_number' => ['required:số điện thoại'],
            'bio' => ['required:giới thiệu']
        ]);

        $user = user();

        (new User)->where('id', '=', $user['id'])->update(['name' => htmlspecialchars($_POST['name']), 'phone_number' => $_POST['phone_number'], 'bio' => $_POST['bio']]);
        return api(['status' => 200, 'msg' => 'Lưu thành công']);
    }
    function change_pass()
    {
        validate_api($_POST, [
            'current' => ['required:mật khẩu cũ'],
            'new_pass' => ['required:mật khẩu mới'],
            're_pass' => ['required:xác nhận mật khẩu mới']
        ]);

        $user = user();

        if ($_POST['new_pass'] != $_POST['re_pass']) {
            return api(['status' => -100, 'msg' => 'Mật khẩu mới và xác nhận phải giống nhau']);
        }

        if ($user['password'] != md5($_POST['current'])) {
            return api(['status' => -101, 'msg' => 'Mật khẩu hiện tại không chính xác']);
        }

        (new User)->where('id', '=', $user['id'])->update(['password' => md5($_POST['new_pass'])]);
        return api(['status' => 200, 'msg' => 'Đổi mật khẩu thành công']);
    }
}
