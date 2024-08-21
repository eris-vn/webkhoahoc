<div style="padding-top: 50px;"></div>
<div class="rbt-breadcrumb-default ptb--100 ptb_md--50 ptb_sm--30 bg-gradient-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner text-center">
                    <h2 class="title">Đặt lại mật khẩu</h2>
                    <ul class="page-list">
                        <li class="rbt-breadcrumb-item"><a href="index.html">Home</a></li>
                        <li>
                            <div class="icon-right"><i class="feather-chevron-right"></i></div>
                        </li>
                        <li class="rbt-breadcrumb-item active">Login &amp; Register</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="rbt-elements-area bg-color-white rbt-section-gap">
    <div class="container">
        <div class="row justify-content-center gy-5 row--30">

            <div class="col-lg-5">
                <div class="rbt-contact-form contact-form-style-1 max-width-auto">
                    <h3 class="title text-center">Đặt lại mật khẩu</h3>
                    <form id="login" class="max-width-auto">
                        <div class=" d-flex gap-3">
                            <div class="form-group col-lg-8">
                                <input id="email" type="email">
                                <label>Email *</label>
                                <span class="focus-border"></span>
                            </div>
                            <button type="button" class="rbt-btn btn-sm w-100" onclick="send_code()">
                                <span class="btn-text">Lấy mã</span>
                                </span>
                            </button>
                        </div>
                        <div class="form-group">
                            <input id="code" type="password">
                            <label>Mã xác nhận *</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="form-group">
                            <input id="password" type="password">
                            <label>Mật khẩu mới *</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="form-group">
                            <input id="re_password" type="password">
                            <label>Xác nhận mật khẩu mới *</label>
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-submit-group">
                            <button type="submit" class="rbt-btn btn-md btn-gradient hover-icon-reverse w-100">
                                <span class="icon-reverse-wrapper">
                                    <span class="btn-text">ĐỔI MẬT KHẨU</span>
                                    <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                    <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>


<script>
    function send_code() {
        Swal.fire({
            icon: 'info',
            title: 'Đang xử lý...',
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            method: "POST",
            url: "/api/auth/forgot/create",
            data: {
                email: $('#email').val(),
            }
        }).done(function(data) {
            Swal.hideLoading();

            if (data.status == 200) {
                Swal.fire({
                    title: "THÀNH CÔNG",
                    text: data.msg,
                    icon: "success"
                }).then((result) => {
                    // window.location.href = '/';
                });
            } else {
                Swal.fire({
                    title: "THẤT BẠI",
                    text: data.msg,
                    icon: "error"
                });
            }
        });
    }

    $("#login").on("submit", function(event) {
        event.preventDefault();

        $.ajax({
                method: "POST",
                url: "/api/auth/forgot/verify",
                data: {
                    email: $('#email').val(),
                    code: $('#code').val(),
                    password: $('#password').val(),
                    re_password: $('#re_password').val(),
                }
            })
            .done(function(data) {
                if (data.status == 200) {
                    Swal.fire({
                        title: "THÀNH CÔNG",
                        text: data.msg,
                        icon: "success"
                    }).then((result) => {
                        window.location.href = '/login';
                    });
                } else {
                    Swal.fire({
                        title: "THẤT BẠI",
                        text: data.msg,
                        icon: "error"
                    });
                }
            });
    });
</script>