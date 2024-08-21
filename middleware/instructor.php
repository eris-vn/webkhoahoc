<?php

if (!is_instructor()) {
    return redirect('/');
} else {
    require_once 'middleware/auth.php';
}
