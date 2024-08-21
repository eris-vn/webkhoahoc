<!-- start page title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h6 class="page-title">Thống kê</h6>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item active">Welcome to Veltrix Dashboard</li>
            </ol>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-start mini-stat-img me-4">
                        <img src="/public/admin/assets/images/services-icon/01.png" alt="">
                    </div>
                    <h5 class="font-size-16 text-uppercase text-white-50">Giảng viên</h5>
                    <h4 class="fw-medium font-size-24"><?= $count_instructor ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-start mini-stat-img me-4">
                        <img src="/public/admin/assets/images/services-icon/02.png" alt="">
                    </div>
                    <h5 class="font-size-16 text-uppercase text-white-50">Khoá học</h5>
                    <h4 class="fw-medium font-size-24"><?= $count_course ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-start mini-stat-img me-4">
                        <img src="/public/admin/assets/images/services-icon/03.png" alt="">
                    </div>
                    <h5 class="font-size-16 text-uppercase text-white-50">Bài giảng</h5>
                    <h4 class="fw-medium font-size-24"><?= $count_lesson ?></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-start mini-stat-img me-4">
                        <img src="/public/admin/assets/images/services-icon/04.png" alt="">
                    </div>
                    <h5 class="font-size-16 text-uppercase text-white-50">Học viên</h5>
                    <h4 class="fw-medium font-size-24"><?= $count_enrolled ?> </h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->