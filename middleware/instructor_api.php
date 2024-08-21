<?php

if (!is_instructor()) {
    return api(['status' => 100, 'msg' => 'Bạn không có quyền làm điều này']);
} else {
    require_once 'middleware/auth.php';
}
