<div class="rbt-dashboard-content bg-color-white rbt-shadow-box">
    <div class="content">

        <div class="section-title">
            <h4 class="rbt-title-style-3">Cài đặt</h4>
        </div>

        <div class="advance-tab-button mb--30">
            <ul class="nav nav-tabs tab-button-style-2 justify-content-start" id="settinsTab-4" role="tablist">
                <li role="presentation">
                    <a href="#" class="tab-button active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" role="tab" aria-controls="profile" aria-selected="true">
                        <span class="title">Hồ sơ</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#" class="tab-button" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" role="tab" aria-controls="password" aria-selected="false">
                        <span class="title">Mật khẩu</span>
                    </a>
                </li>
                <!-- <li role="presentation">
                    <a href="#" class="tab-button" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" role="tab" aria-controls="social" aria-selected="false">
                        <span class="title">Social Share</span>
                    </a>
                </li> -->
            </ul>
        </div>

        <div class="tab-content">
            <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="rbt-dashboard-content-wrapper">
                    <div class="tutor-bg-photo bg_image bg_image--23 height-245"></div>
                    <!-- Start Tutor Information  -->
                    <div class="rbt-tutor-information">
                        <div class="rbt-tutor-information-left">
                            <div class="thumbnail rbt-avatars size-lg position-relative">
                                <img src="<?= $user['avatar_url'] ? $user['avatar_url'] : '/public/assets/images/user/default.png' ?>" alt="Avatar">
                                <div class="rbt-edit-photo-inner">
                                    <button class="rbt-edit-photo" title="Upload Photo">
                                        <i class="feather-camera"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="rbt-tutor-information-right">
                            <div class="tutor-btn">
                                <a class="rbt-btn btn-sm btn-border color-white radius-round-10" href="#">Chỉnh ảnh bìa</a>
                            </div>
                        </div>
                    </div>
                    <!-- End Tutor Information  -->
                </div>
                <!-- Start Profile Row  -->
                <div class="rbt-profile-row rbt-default-form row row--15">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="rbt-form-group">
                            <label for="name">Họ và tên</label>
                            <input id="name" type="text" value="<?= $user['name'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="rbt-form-group">
                            <label for="phonenumber">Số điện thoại</label>
                            <input id="phonenumber" type="number" value="<?= $user['phone_number'] ?>" placeholder="Nhập số điện thoại">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="rbt-form-group">
                            <label for="bio">Bio</label>
                            <textarea id="bio" cols="20" rows="5" placeholder="Nhập giới thiệu"><?= $user['bio'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-12 mt--20">
                        <div class="rbt-form-group">
                            <div class="rbt-btn btn-gradient" onclick="on_save_profile()">CẬP NHẬT</div>
                        </div>
                    </div>
                </div>
                <!-- End Profile Row  -->
            </div>

            <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                <!-- Start Profile Row  -->
                <div class="rbt-profile-row rbt-default-form row row--15" data-bitwarden-watching="1">
                    <div class="col-12">
                        <div class="rbt-form-group">
                            <label for="currentpassword">Mật khẩu hiện tại</label>
                            <input id="currentpassword" type="password" placeholder="Nhập mật khẩu hiện tại">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="rbt-form-group">
                            <label for="newpassword">Mật khẩu mới</label>
                            <input id="newpassword" type="password" placeholder="Nhập mật khẩu mới">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="rbt-form-group">
                            <label for="retypenewpassword">Nhập lại mật khẩu mới</label>
                            <input id="retypenewpassword" type="password" placeholder="Nhập lại mật khẩu mới">
                        </div>
                    </div>
                    <div class="col-12 mt--10">
                        <div class="rbt-form-group">
                            <div class="rbt-btn btn-gradient" onclick="on_change_pass()">Cập nhật mật khẩu</div>
                        </div>
                    </div>
                </div>
                <!-- End Profile Row  -->
            </div>

            <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                <!-- Start Profile Row  -->
                <div action="#" class="rbt-profile-row rbt-default-form row row--15">
                    <div class="col-12">
                        <div class="rbt-form-group">
                            <label for="facebook"><i class="feather-facebook"></i> Facebook</label>
                            <input id="facebook" type="text" placeholder="https://facebook.com/">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="rbt-form-group">
                            <label for="twitter"><i class="feather-twitter"></i> Twitter</label>
                            <input id="twitter" type="text" placeholder="https://twitter.com/">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="rbt-form-group">
                            <label for="linkedin"><i class="feather-linkedin"></i> Linkedin</label>
                            <input id="linkedin" type="text" placeholder="https://linkedin.com/">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="rbt-form-group">
                            <label for="website"><i class="feather-globe"></i> Website</label>
                            <input id="website" type="text" placeholder="https://website.com/">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="rbt-form-group">
                            <label for="github"><i class="feather-github"></i> Github</label>
                            <input id="github" type="text" placeholder="https://github.com/">
                        </div>
                    </div>
                    <div class="col-12 mt--10">
                        <div class="rbt-form-group">
                            <div class="rbt-btn btn-gradient">Update Profile</div>
                        </div>
                    </div>
                </div>
                <!-- End Profile Row  -->
            </div>
        </div>
    </div>
</div>

<script>
    function on_save_profile() {
        $.ajax({
                method: "POST",
                url: "/api/user/setting/edit",
                data: {
                    name: $('#name').val(),
                    phone_number: $('#phonenumber').val(),
                    bio: $('#bio').val(),
                },
            })
            .done(function(data) {
                if (data.status == 200) {
                    Toastify({
                        text: data.msg,
                        duration: 3000,
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                        },
                    }).showToast();
                    window.location.reload();
                } else {
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

    function on_change_pass() {
        $.ajax({
                method: "POST",
                url: "/api/user/setting/change_pass",
                data: {
                    current: $('#currentpassword').val(),
                    new_pass: $('#newpassword').val(),
                    re_pass: $('#retypenewpassword').val(),
                },
            })
            .done(function(data) {
                if (data.status == 200) {
                    Toastify({
                        text: data.msg,
                        duration: 3000,
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                        },
                    }).showToast();
                    window.location.reload();
                } else {
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