<div class="rbt-dashboard-content bg-color-white rbt-shadow-box">
    <div class="content">
        <div class="section-title">
            <h4 class="rbt-title-style-3">Lịch Sử Thanh Toán</h4>
        </div>

        <div class="rbt-dashboard-table table-responsive mobile-table-750">
            <table class="rbt-table table table-borderless">
                <thead>
                    <tr>
                        <th>Mã đơn</th>
                        <th>Ngày tạo</th>
                        <th>Giá</th>
                        <th>Trang thái</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (isset($history_payment['data'])) : ?>
                        <?php foreach ($history_payment['data'] as $history) : ?>
                            <tr>
                                <th>Hoá đơn #<?= $history['id'] ?></th>
                                <td><?= $history['created_at'] ?></td>
                                <td><?= number_format($history['price']) ?> vnđ</td>
                                <td>
                                    <?php if ($history['status'] == InvoiceCode::PENDING) : ?>
                                        <span class="rbt-badge-5 bg-primary-opacity">Đang xử lý</span>
                                    <?php elseif ($history['status'] == InvoiceCode::SUCCESS) : ?>
                                        <span class="rbt-badge-5 bg-color-success-opacity color-success">Thành công</span>
                                    <?php elseif ($history['status'] == InvoiceCode::TIMEOUT) : ?>
                                        <span class="rbt-badge-5 bg-color-danger-opacity color-danger">Đã huỷ/quá hạn</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <th colspan="5">Chưa có đơn nào</th>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>

        <div class="mt--10"> <?= (new Invoice)->renderHtml($history_payment) ?></div>


    </div>
</div>