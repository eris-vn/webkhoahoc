<?php

require_once 'model/invoice.php';
require_once 'constants/invoice.php';
require_once 'model/enrollment.php';
require_once 'model/lesson.php';

class InvoiceController
{
    function show_page()
    {
        $user = user();
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $history_payment = (new Invoice)->where('user_id', '=', $user['id'])->paginate(10, $current_page);
        return view('client.user.payment-history', compact('history_payment'), 'user');
    }
}
