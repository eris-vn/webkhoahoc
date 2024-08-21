<div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--60">
    <div class="content">
        <div class="section-title">
            <h4 class="rbt-title-style-3">Thông kê</h4>
        </div>
        <div class="row g-5">

            <!-- Start Single Card  -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="rbt-counterup variation-01 rbt-hover-03 rbt-border-dashed bg-primary-opacity">
                    <div class="inner">
                        <div class="rbt-round-icon bg-primary-opacity">
                            <i class="feather-book-open"></i>
                        </div>
                        <div class="content">
                            <?php $enrolled = (new Enrollment)->where('user_id', '=', $user['id'])->count(); ?>
                            <h3 class="counter without-icon color-primary"><span class="odometer" data-count="<?= $enrolled ?>">0</span>
                            </h3>
                            <span class="rbt-title-style-2 d-block">Khoá học đã tham gia</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Card  -->

            <!-- Start Single Card  -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="rbt-counterup variation-01 rbt-hover-03 rbt-border-dashed bg-violet-opacity">
                    <div class="inner">
                        <div class="rbt-round-icon bg-violet-opacity">
                            <i class="feather-award"></i>
                        </div>
                        <div class="content">
                            <h3 class="counter without-icon color-violet"><span class="odometer" data-count="<?= (new Certificate)->where('user_id', '=', $user['id'])->count() ?>">0</span>
                            </h3>
                            <span class="rbt-title-style-2 d-block">CHỨNG CHỈ ĐÃ NHẬN</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Card  -->

            <?php if (is_instructor()) : ?>

                <!-- Start Single Card  -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="rbt-counterup variation-01 rbt-hover-03 rbt-border-dashed bg-pink-opacity">
                        <div class="inner">
                            <div class="rbt-round-icon bg-pink-opacity">
                                <i class="feather-users"></i>
                            </div>
                            <div class="content">
                                <h3 class="counter without-icon color-pink"><span class="odometer" data-count="<?= (new Enrollment)->where('instructor_id', '=', $user['id'])->count() ?>">00</span>
                                </h3>
                                <span class="rbt-title-style-2 d-block">TỔNG HỌC VIÊN</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Card  -->

                <!-- Start Single Card  -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="rbt-counterup variation-01 rbt-hover-03 rbt-border-dashed bg-coral-opacity">
                        <div class="inner">
                            <div class="rbt-round-icon bg-coral-opacity">
                                <i class="feather-gift"></i>
                            </div>
                            <div class="content">
                                <h3 class="counter without-icon color-coral"><span class="odometer" data-count="<?= (new Course)->where("status", "=", 0)->where('user_id', '=', $user['id'])->count() ?>">0</span>
                                </h3>
                                <span class="rbt-title-style-2 d-block">TỔNG KHOÁ HỌC</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Card  -->

                <!-- Start Single Card  -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="rbt-counterup variation-01 rbt-hover-03 rbt-border-dashed bg-warning-opacity">
                        <div class="inner">
                            <div class="rbt-round-icon bg-warning-opacity">
                                <i class="feather-dollar-sign"></i>
                            </div>
                            <div class="content">
                                <?php
                                $courses_id = (new Course)->where("status", "=", 0)->where('user_id', '=', $user['id'])->select(['id'])->getArray();
                                $courses_id = $courses_id ? array_map(function ($item) {
                                    return $item['id'];
                                }, $courses_id) : [];

                                $total_lesson = $courses_id ? (new Lesson)->whereIn('course_id', $courses_id)->count() : 0;
                                ?>
                                <h3 class="counter without-icon color-warning"><span class="odometer" data-count="<?= $total_lesson ?>">0</span>
                                </h3>
                                <span class="rbt-title-style-2 d-block">TỔNG BÀI HỌC</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Card  -->

            <?php endif; ?>

        </div>
    </div>
</div>
<div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--60">
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h4 class="rbt-title-style-3">Đánh giá của tôi</h4>
                </div>
            </div>
        </div>
        <div class="row gy-5">
            <div class="col-lg-12">
                <div class="rbt-dashboard-table table-responsive">
                    <table class="rbt-table table table-borderless">
                        <thead>
                            <tr>
                                <th>Khoá học</th>
                                <th>Đánh giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reviews['data'] as $review) : ?>
                                <tr>
                                    <th><?= $review['name'] ?></th>
                                    <td>
                                        <?php
                                        $avg = (new Review)->where('course_id', '=', $review['course_id'])->avg('rating');
                                        ?>
                                        <div class="rating-text top-0">
                                            <?php foreach (range(1, 5) as $s) : ?>
                                                <?php if ($s <= $avg) : ?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                                    </svg>
                                                <?php else : ?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"></path>
                                                    </svg>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <?= (new Model)->renderHtml($reviews) ?>
            </div>
        </div>

    </div>
</div>