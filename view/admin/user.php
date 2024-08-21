<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h6 class="page-title">Quản lý người dùng</h6>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item"><a href="#">User</a></li>
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
                            <div><input id="id" name="id" type="number" class="form-control" placeholder="Lọc theo mã số hoá đơn" value="<?= $id ?>"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div role="group" class="form-group mb-3" id="__BVID__124">
                            <label for="id" class="d-block" id="id">Email</label>
                            <div><input id="id" name="email" type="string" class="form-control" placeholder="Lọc theo email" value="<?= $email ?>"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div role="group" class="form-group mb-3" id="__BVID__126">
                            <label for="validationCustom01" class="form-label">Vai trò</label>
                            <select class="form-select" id="role" name="role">
                                <option value="" <?= ($role == '') ? 'selected' : '' ?>>Chưa chọn</option>
                                <option value="<?= UserCode::CLIENT ?>" <?= ($role == UserCode::CLIENT) ? 'selected' : '' ?>>Khách/học viên</option>
                                <option value="<?= UserCode::INSTRUCTOR ?>" <?= ($role == UserCode::INSTRUCTOR) ? 'selected' : '' ?>>Giảng viên</option>
                                <option value="<?= UserCode::ADMIN ?>" <?= ($role == UserCode::ADMIN) ? 'selected' : '' ?>>Quản trị</option>
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
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Vai trò</th>
                                <th>Ngày tham gia</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($members['data'] as $member) : ?>
                                <tr>
                                    <th scope="row"><?= $member['id'] ?></th>
                                    <td><?= $member['name'] ?></td>
                                    <td><?= $member['email'] ?></td>
                                    <td><?= $member['phone_number'] ? $member['phone_number'] : 'Chưa liên kết' ?></td>
                                    <td><?= $member['role'] == UserCode::INSTRUCTOR
                                            ? 'Giảng viên'
                                            : ($member['role'] == UserCode::CLIENT
                                                ? 'Người dùng'
                                                : ($member['role'] == UserCode::ADMIN
                                                    ? 'Quản trị'
                                                    : 'Không xác định'
                                                )
                                            ); ?></td>
                                    <td><?= $member['created_at'] ?></td>
                                    <td>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript:void(0);" onclick="on_edit(<?= $member['id'] ?>)" title="Edit" class="px-1 text-warning"><i class="fas fa-pen font-size-18"></i></a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= (new Model)->renderAdminPaginate($members, '?page=%d&id=' . $id . '&role=' . $role . '&email=' . $email) ?>
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
                $('#member_role').val(parseInt(data.data.role));
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
                role: $('#member_role').val()
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
                    <select class="form-select" id="member_role">
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