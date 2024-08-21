<?php
require_once 'constants/user.php';

$user = user();

if (!$user || $user['role'] != UserCode::ADMIN) {

    return redirect('/');
}
