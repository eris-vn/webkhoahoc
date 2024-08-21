<div class="rbt-dashboard-content bg-color-white rbt-shadow-box">
    <div class="content">
        <div class="section-title">
            <h4 class="rbt-title-style-3">Hồ sơ của tôi</h4>
        </div>
        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Ngày tham gia</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2"><?= $user['created_at'] ?></div>
            </div>
        </div>
        <!-- End Profile Row  -->

        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 mt--15">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Họ tên</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2"><?= $user['name'] ?></div>
            </div>
        </div>
        <!-- End Profile Row  -->

        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 mt--15">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Email</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2"><?= $user['email'] ?></div>
            </div>
        </div>
        <!-- End Profile Row  -->

        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 mt--15">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Phone Number</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2">+84<?= $user['phone_number'] ?></div>
            </div>
        </div>
        <!-- End Profile Row  -->

        <!-- Start Profile Row  -->
        <div class="rbt-profile-row row row--15 mt--15">
            <div class="col-lg-4 col-md-4">
                <div class="rbt-profile-content b2">Giới thiệu</div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="rbt-profile-content b2"><?= $user['bio'] ?></div>
            </div>
        </div>
        <!-- End Profile Row  -->
    </div>
</div>