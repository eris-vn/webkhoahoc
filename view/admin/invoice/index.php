<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h6 class="page-title">Quản lý hoá đơn</h6>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item"><a href="#">Invoice</a></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <form method="GET" class="row">
                    <div class="col-md-3">
                        <div role="group" class="form-group mb-3" id="__BVID__124">
                            <label for="id" class="d-block" id="id">Mã số</label>
                            <div><input id="id" name="id" type="number" class="form-control" placeholder="Lọc theo mã số hoá đơn"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div role="group" class="form-group mb-3" id="__BVID__126">
                            <label for="validationCustom01" class="form-label">Vai trò</label>
                            <select class="form-select" id="role" name="status">
                                <option selected="" value="" class="d-none">Chưa chọn</option>
                                <option value="<?= InvoiceCode::PENDING ?>">Chờ thanh toán</option>
                                <option value="<?= InvoiceCode::SUCCESS ?>">Thành công</option>
                                <option value="<?= InvoiceCode::TIMEOUT ?>">Quá hạn</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div role="group" class="form-group mb-3" id="__BVID__128"><label for="username" class="d-block" id="__BVID__128__BV_label_">Thao tác</label>
                            <div><button type="submit" class="btn btn-primary">
                                    LỌC
                                </button></div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered mb-3">
                        <thead>
                            <tr>
                                <th>MS</th>
                                <th>Tên</th>
                                <th>Giá</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($invoices['data'] as $invoice) : ?>
                                <tr>
                                    <th scope="row"><?= $invoice['id'] ?></th>
                                    <td><?= $invoice['name'] ?></td>
                                    <td><?= number_format($invoice['price']) ?>đ</td>
                                    <td><?= $invoice['created_at'] ?></td>
                                    <td><?= $invoice['status'] == InvoiceCode::PENDING
                                            ? '<div class="badge badge-pill font-size-12 bg-info">
                                            chờ xử lý
                                          </div>'
                                            : ($invoice['status'] == InvoiceCode::SUCCESS
                                                ? '<div class="badge badge-pill font-size-12 bg-success">
                                                thành công
                                              </div>'
                                                : ($invoice['status'] == InvoiceCode::TIMEOUT
                                                    ? '<div class="badge badge-pill font-size-12 bg-warning">
                                                    hết hạn
                                                  </div>'
                                                    : 'Không xác định'
                                                )
                                            ); ?></td>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="/admin/invoice/<?= $invoice['id'] ?>" title="Chi tiết" class="px-1 text-warning"><i class="fas fa-eye font-size-18"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= (new Model)->renderAdminPaginate($invoices, '?page=%d&id=' . (isset($_GET['id']) ? $_GET['id'] : '') . '&role=' . (isset($_GET['role']) ? $_GET['role'] : '')) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function on_edit(id) {
        $.ajax({
            method: "POST",
            url: "/api/admin/user/info",
            data: {
                id
            }
        }).done(function(data) {
            if (data.status == 200) {
                $('#id').val(data.data.id);
                $('#name').val(data.data.name);
                $('#role').val(parseInt(data.data.role));
                $('#member').modal('show');
            } else {
                Swal.close();
                Toastify({
                    text: data.msg,
                    duration: 3000,
                    style: {
                        background: "linear-gradient(to right, #F64C18, #EE9539)",
                    },
                }).showToast();
            }
        });
    }

    function on_submit() {
        $.ajax({
            method: "POST",
            url: "/api/admin/user/save",
            data: {
                id: $('#id').val(),
                name: $('#name').val(),
                role: $('#role').val()
            }
        }).done(function(data) {
            if (data.status == 200) {
                window.location.reload();
            } else {
                Swal.close();
                Toastify({
                    text: data.msg,
                    duration: 3000,
                    style: {
                        background: "linear-gradient(to right, #F64C18, #EE9539)",
                    },
                }).showToast();
            }
        });
    }
</script>


<div id="member" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Quản lý người dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control d-none" id="id" placeholder="Nhập họ tên" required="">
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01" class="form-label">Họ tên</label>
                    <input type="text" class="form-control" id="name" placeholder="Nhập họ tên" required="">
                </div>
                <div class="col-md-12">
                    <label for="validationCustom01" class="form-label">Vai trò</label>
                    <select class="form-select" id="role">
                        <option selected="" class="d-none">Chưa chọn</option>
                        <option value="0">Khách hàng</option>
                        <option value="1">Giảng viên</option>
                        <option value="2">Quản trị viên</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="on_submit()">Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>