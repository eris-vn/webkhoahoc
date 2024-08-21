<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h6 class="page-title">Chi tiết hoá đơn</h6>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item"><a href="#">Invoice</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-12">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-16"><strong>Hoá đơn# <?= $invoice['id'] ?></strong></h4>
                            <h3>
                                <img src="/public/admin/assets/images/logo-sm.png" alt="logo" height="24">
                            </h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6 mt-4">
                                <address>
                                    <strong>Phương thức thanh toán:</strong> VNPAY<br>
                                    <strong>Người đặt:</strong> <?= $invoice['user_name'] ?><br>
                                    <strong>Email:</strong> <?= $invoice['user_email'] ?><br>
                                </address>
                            </div>
                            <div class="col-6 mt-4 text-end">
                                <address>
                                    <strong>Ngày tạo:</strong><br>
                                    <?= $invoice['created_at'] ?><br><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div>
                            <div class="p-2">
                                <h3 class="font-size-16"><strong>Tóm tắt hoá đơn</strong></h3>
                            </div>
                            <div class="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td><strong>Tên</strong></td>
                                                <td class="text-end"><strong>Giá</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                            <?php
                                            $total = 0;
                                            foreach ($details as $detail) : ?>
                                                <tr>
                                                    <td><?= $detail['name'] ?></td>
                                                    <td class="text-end"><?= number_format($detail['price']) ?>đ</td>
                                                    <?php $total += $detail['price'] ?>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td class="no-line">
                                                    <strong>Tổng cộng</strong>
                                                </td>
                                                <td class="no-line text-end">
                                                    <h4 class="m-0"><?= number_format($total) ?>đ</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-print-none">
                                    <div class="float-end">
                                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> <!-- end row -->

            </div>
        </div>
    </div> <!-- end col -->
</div>