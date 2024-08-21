<?php
$user = user();

if (!$user) {
    exit(api(['status' => -100, 'msg' => 'Vui lòng đăng nhập để xử dụng tính năng này']));
}
