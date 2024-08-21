<?php

require_once 'constants/user.php';

class UserController
{
    function show()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $email = isset($_GET['email']) ? $_GET['email'] : null;
        $role = isset($_GET['role']) ? $_GET['role'] : null;

        $members = (new User)->latest()->when($id, function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->when($email, function ($query) use ($email) {
            $query->where('email', 'like', '%' . $email . '%');
        })->when($role != null, function ($query) use ($role) {
            $query->where('role', '=',  $role);
        })->paginate(10);


        return view('admin.user', compact('members', 'id', 'email', 'role'), 'admin');
    }
    function info()
    {
        validate_api($_POST, [
            'id' => ['required:tham số']
        ]);

        $user = (new User)->where('id', '=', $_POST['id'])->select(['id', 'name', 'email', 'phone_number', 'role'])->first();
        if (!$user) {
            return api(['status' => -100, 'msg' => 'Không tìm thấy user']);
        }

        return api(['status' => 200, 'data' => $user]);
    }
    function save()
    {
        validate_api($_POST, [
            'id' => ['required:tham số'],
            'name' => ['required:name'],
            'role' => ['requied:vai trò']
        ]);

        (new User)->where('id', '=', $_POST['id'])->update(['name' => $_POST['name'], 'role' => $_POST['role']]);
        return api(['status' => 200, 'msg' => 'Lưu thành công']);
    }
}
