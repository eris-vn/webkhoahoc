<div class="rbt-breadcrumb-default ptb--100 ptb_md--50 ptb_sm--30 bg-gradient-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner text-center">
                    <h2 class="title"><?= $course['name'] ?></h2>
                    <!-- <ul class="page-list">
                        <li class="rbt-breadcrumb-item"><a href="index.html">Home</a></li>
                        <li>
                            <div class="icon-right"><i class="feather-chevron-right"></i></div>
                        </li>
                        <li class="rbt-breadcrumb-item active">My Account</li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-account-section bg-color-white rbt-section-gap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row g-5">
                    <!-- My Account Tab Menu Start -->
                    <div class="col-lg-3 col-12">
                        <div class="rbt-my-account-tab-button nav" role="tablist">
                            <a href="#dashboad" class="active" data-bs-toggle="tab">Học viên</a>
                            <a href="#reviews" data-bs-toggle="tab" class="">Đánh giá</a>
                            <a href="#orders" data-bs-toggle="tab" class="">Thống kê quiz</a>
                        </div>
                    </div>
                    <!-- My Account Tab Menu End -->

                    <!-- My Account Tab Content Start -->
                    <div class="col-lg-9 col-12">
                        <div class="tab-content" id="myaccountContent">
                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade active show" id="dashboad" role="tabpanel">
                                <div class="rbt-my-account-inner">
                                    <h3>Học viên</h3>

                                    <div class="rbt-my-account-table table-responsive text-center">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>MSSV</th>
                                                    <th>Tên</th>
                                                    <th>Tham gia ngày</th>
                                                    <th>Tiến độ</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php if ($students['data']) : ?>

                                                    <?php foreach ($students['data'] as $student) : ?>
                                                        <?php
                                                        $user = (new User)->where('id', '=', $student['user_id'])->first();
                                                        $total = (new Lesson)->where('course_id', '=', $student['course_id'])->count();
                                                        $learnt = (new UserLesson)->where('course_id', '=', $student['course_id'])->count();

                                                        ?>
                                                        <tr>
                                                            <td><?= $user['id'] ?></td>
                                                            <td><?= $user['name'] ?></td>
                                                            <td><?= $student['enrolled_at'] ?></td>
                                                            <td><?= floor(($learnt / $total) * 100) ?>%</td>
                                                        </tr>
                                                    <?php endforeach; ?>

                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <?= (new Model)->renderHtml($students) ?>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade active" id="reviews" role="tabpanel">
                                <div class="rbt-my-account-inner">
                                    <h3>Đánh giá</h3>

                                    <div class="rbt-my-account-table table-responsive text-center">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>MSSV</th>
                                                    <th>Tên</th>
                                                    <th>Đánh giá</th>
                                                    <th>Nội dung</th>
                                                    <th>Ngày đăng</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php if ($reviews['data']) : ?>

                                                    <?php foreach ($reviews['data'] as $review) : ?>
                                                        <?php
                                                        $user = (new User)->where('id', '=', $review['user_id'])->first();
                                                        ?>
                                                        <tr>
                                                            <td><?= $user['id'] ?></td>
                                                            <td><?= $user['name'] ?></td>
                                                            <td><?= $review['content'] ?></td>
                                                            <td><?= $review['rating'] ?>/5</td>
                                                            <td><?= $review['created_at'] ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>

                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <?= (new Model)->renderHtml($students) ?>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                            <!-- Single Tab Content Start -->
                            <div class="tab-pane fade" id="orders" role="tabpanel">
                                <div class="rbt-my-account-inner">
                                    <h3>Thống kê quiz</h3>

                                    <div class="rbt-my-account-table table-responsive text-center">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>MSSV</th>
                                                    <th>Người làm</th>
                                                    <th>Chương</th>
                                                    <th>Ngày làm</th>
                                                    <th>Điểm</th>
                                                    <th>Kết quả</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php foreach ($quizs['data'] as $quiz) : ?>
                                                    <?php
                                                    $user = (new User)->where('id', '=', $quiz['user_id'])->first();
                                                    $chapter = (new Chapter)->where('id', '=', $quiz['chapter_id'])->first();
                                                    $score = round((($quiz['total_question'] - $quiz['incorrect']) / $quiz['total_question']) * 10, 1);
                                                    ?>
                                                    <tr>
                                                        <td>1</td>
                                                        <td><?= $user['name'] ?></td>
                                                        <td><?= $chapter['name'] ?></td>
                                                        <td><?= $quiz['created_at'] ?></td>
                                                        <td><?= $score ?></td>
                                                        <td>
                                                            <?php if ($score >= 5) :  ?>
                                                                <span class="rbt-badge-5 bg-color-success-opacity color-success">Đạt</span>
                                                            <?php else : ?>
                                                                <span class="rbt-badge-5 bg-color-danger-opacity color-danger">Không đạt</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <a class="rbt-btn btn-gradient btn-sm" href="#">Xem chi tiết</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <?= (new Model)->renderHtml($quizs) ?>
                                </div>
                            </div>
                            <!-- Single Tab Content End -->

                        </div>
                    </div>
                    <!-- My Account Tab Content End -->
                </div>

            </div>

        </div>
    </div>
</div>