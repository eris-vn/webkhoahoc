<?php
$user = user();

if (!$user) {
    redirect('/login');
}
