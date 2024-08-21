<?php

require_once 'constants/invoice.php';
require_once 'constants/user.php';
require_once 'model/invoice.php';
require_once 'model/invoice_details.php';

class InvoiceController
{
    function show()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $status = isset($_GET['status']) ? $_GET['status'] : null;

        $invoices = (new Invoice)->when($id, function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->when($status != null, function ($query) use ($status) {
            $query->where('status', '=', $status);
        })->latest()->paginate(5);
        return view('admin.invoice.index', compact('invoices'), 'admin');
    }
    function details()
    {
        $invoice = (new Invoice)->where('invoice.id', '=', $_GET['invoice_id'])->select(['invoice.*', 'users.name as user_name', 'users.email as user_email'])->join('users', 'user_id', '=', 'id')->first();

        if (!$invoice) {
            return redirect('/admin/invoice');
        }

        $details = (new InvoiceDetail)->where('invoice_id', '=', $invoice['id'])->join('courses', 'course_id', '=', 'id')->getArray();

        return view('admin.invoice.details', compact('invoice', 'details'), 'admin');
    }
}
