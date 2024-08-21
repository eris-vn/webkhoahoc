<div style="padding-top: 50px;"></div>
<div class="rbt-breadcrumb-default ptb--100 ptb_md--50 ptb_sm--30 bg-gradient-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner text-center">
                    <h2 class="title">Login &amp; Register</h2>
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
        <div class="row gy-5 row--30">

            <div class="col-lg-6">
                <div class="rbt-contact-form contact-form-style-1 max-width-auto">
                    <h3 class="title">Đăng nhập</h3>
                    <form id="login" class="max-width-auto">
                        <div class="form-group">
                            <input id="login_email" type="email">
                            <label>Email *</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="form-group">
                            <input id="login_password" type="password">
                            <label>Mật khẩu *</label>
                            <span class="focus-border"></span>
                        </div>

                        <div class="row mb--30">
                            <div class="col-lg-6">
                                <div class="rbt-checkbox">
                                    <input type="checkbox" id="rememberme" name="rememberme">
                                    <label for="rememberme">lưu mật khẩu</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="rbt-lost-password text-end">
                                    <a class="rbt-btn-link" href="/forgot">Quên mật khẩu?</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-submit-group">
                            <button type="submit" class="rbt-btn btn-md btn-gradient hover-icon-reverse w-100">
                                <span class="icon-reverse-wrapper">
                                    <span class="btn-text">Đăng nhâp</span>
                                    <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                    <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="rbt-contact-form contact-form-style-1 max-width-auto">
                    <h3 class="title">Đăng Ký</h3>
                    <form id="register" class="max-width-auto" data-bitwarden-watching="1">

                        <div class="form-group">
                            <input id="register_user" type="text">
                            <label>Họ tên *</label>
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group">
                            <input id="register_email" type="text">
                            <label>Email *</label>
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group">
                            <input id="register_password" type="password">
                            <label>Mật khẩu *</label>
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group">
                            <input id="register_conpassword" type="password">
                            <label>Nhập lại mật khẩu *</label>
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-submit-group">
                            <button type="submit" class="rbt-btn btn-md btn-gradient hover-icon-reverse w-100">
                                <span class="icon-reverse-wrapper">
                                    <span class="btn-text">Đăng ký ngay</span>
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
<script src="https://static.geetest.com/v4/gt4.js"></script>


<script>
    $("#register").on("submit", function(event) {
        event.preventDefault();

        $.ajax({
                method: "POST",
                url: "/auth/register",
                data: {
                    name: $('#register_user').val(),
                    email: $('#register_email').val(),
                    password: $('#register_password').val(),
                    re_password: $('#register_conpassword').val()
                }
            })
            .done(function(data) {
                if (data.status == 200) {
                    Swal.fire({
                        title: "THÀNH CÔNG",
                        text: data.msg,
                        icon: "success"
                    }).then((result) => {
                        window.location.href = '/';
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

    $("#login").on("submit", function(event) {
        event.preventDefault();

        $.ajax({
                method: "POST",
                url: "/auth/login",
                data: {
                    captcha: captcha_result,
                    email: $('#login_email').val(),
                    password: $('#login_password').val(),
                }
            })
            .done(function(data) {
                if (data.status == 200) {
                    Swal.fire({
                        title: "THÀNH CÔNG",
                        text: data.msg,
                        icon: "success"
                    }).then((result) => {
                        window.location.href = '/';
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