<?php
require_once 'constants/user.php';

$user = user();

if (!$user || $user['role'] != UserCode::ADMIN) {

    exit(api(['status' => -100, 'msg' => 'Bạn không có quyền thực hiện']));
}
