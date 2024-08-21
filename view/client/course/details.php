<div class="rbt-page-banner-wrapper">
    <!-- Start Banner BG Image  -->
    <div class="rbt-banner-image"></div>
    <!-- End Banner BG Image  -->
    <div class="rbt-banner-content">
        <!-- Start Banner Content Top  -->
        <div class="rbt-banner-content-top rbt-breadcrumb-style-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="content text-center">

                            <div class="d-flex align-items-center flex-wrap justify-content-center mb--15 rbt-course-details-feature">
                                <div class="feature-sin best-seller-badge">
                                    <span class="rbt-badge-2">
                                        <span class="image"><img src="/public/assets/images/icons/card-icon-1.png" alt="Best Seller Icon"></span> Bestseller
                                    </span>
                                </div>
                                <!-- <div class="feature-sin rating">
                                    <a href="#">4.8</a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                </div>
                                <div class="feature-sin total-rating">
                                    <a class="rbt-badge-4" href="#">215,475 rating</a>
                                </div> -->
                                <div class="feature-sin total-student">
                                    <?= (new Enrollment)->where('instructor_id', '=', $course['user_id'])->count() ?> học viên
                                </div>
                            </div>
                            <h2 class="title theme-gradient"><?= $course['name'] ?></h2>

                            <div class="rbt-author-meta mb--20 justify-content-center">
                                <!-- <div class="rbt-avater">
                                    <a href="#">
                                        <img src="/public/assets/images/client/avatar-02.png" alt="Sophia Jaymes">
                                    </a>
                                </div> -->
                                <div class="rbt-author-info">
                                    By <a href="profile.html"><?= (new User)->where('id', '=', $course['user_id'])->first()['name']; ?></a>
                                    <!-- In <a href="#">Development</a> -->
                                </div>
                            </div>

                            <ul class="rbt-meta">
                                <li><i class="feather-calendar"></i>Cập nhật lần cuối <?= $course['updated_at'] ? $course['updated_at'] : $course['created_at'] ?></li>
                                <li><i class="feather-award"></i>Chứng chỉ khoá học</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner Content Top  -->
    </div>
</div>

<div class="rbt-section-overlayping-top rbt-section-gapBottom">
    <div class="inner">
        <div class="container">
            <div class="col-lg-12">
                <!-- Start Viedo Wrapper  -->
                <a class="video-popup-with-text video-popup-wrapper text-center popup-video mb--15" href="<?= $course['video_preview'] ?>">
                    <div class="video-content">
                        <?php
                        $thumbnails = extractVideoId($course['video_preview']);
                        $thumbnails = $thumbnails ? $thumbnails : $course['thumbnails'];
                        ?>
                        <img class="w-100 rbt-radius" src="<?= $thumbnails ?>" alt="Video Images">
                        <div class="position-to-top">
                            <span class="rbt-btn rounded-player-2 with-animation">
                                <span class="play-icon"></span>
                            </span>
                        </div>
                        <span class="play-view-text d-block color-white"><i class="feather-eye"></i> xem trước khoá học</span>
                    </div>
                </a>
                <!-- End Viedo Wrapper  -->

                <div class="row row--30 gy-5 pt--60">

                    <div class="col-lg-8">
                        <!-- Start Course Details  -->
                        <div class="course-details-content">
                            <div class="rbt-inner-onepage-navigation sticky-top" style="top: 100px">
                                <nav class="mainmenu-nav onepagenav">
                                    <ul class="mainmenu">
                                        <li class="current">
                                            <a href="#overview">Tổng quan</a>
                                        </li>
                                        <li>
                                            <a href="#coursecontent">Nội dung khoá học</a>
                                        </li>
                                        <!-- <li>
                                            <a href="#details">Chi tiết</a>
                                        </li> -->
                                        <li>
                                            <a href="#intructor">Giảng viên</a>
                                        </li>
                                        <!-- <li>
                                            <a href="#review">Đánh giá</a>
                                        </li> -->
                                    </ul>
                                </nav>
                            </div>

                            <!-- Start Course Feature Box  -->
                            <div class="rbt-course-feature-box overview-wrapper rbt-shadow-box mt--30 has-show-more" id="overview">
                                <div class="rbt-course-feature-inner has-show-more-inner-content">
                                    <div class="section-title">
                                        <h4 class="rbt-title-style-3">Bạn sẽ học được gì trong khoá học này?</h4>
                                    </div>
                                    <div>
                                        <?= $course['description'] ?>
                                    </div>
                                </div>
                                <div class="rbt-show-more-btn">Xem thêm</div>
                            </div>
                            <!-- End Course Feature Box  -->

                            <!-- Start Course Content  -->
                            <div class="course-content rbt-shadow-box coursecontent-wrapper mt--30" id="coursecontent">
                                <div class="rbt-course-feature-inner">
                                    <div class="section-title">
                                        <h4 class="rbt-title-style-3">Nội dung khoá học</h4>
                                    </div>
                                    <div class="rbt-accordion-style rbt-accordion-02 accordion">
                                        <div class="accordion" id="accordionExampleb2">

                                            <?php
                                            $chapters = (new Chapter)->where('course_id', '=', $course['id'])->getArray();
                                            ?>
                                            <?php if ($chapters) : ?>
                                                <?php foreach ($chapters as $chapter) : ?>
                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header card-header" id="headingTwo1">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?= toSlug($chapter['name']) ?>" aria-expanded="true" aria-controls="collapseTwo1">
                                                                <?= $chapter['name'] ?> <span class="rbt-badge-5 ml--10"><?= timeConvert((new Lesson)->where('course_id', '=', $course['id'])->where('chapter_id', '=', $chapter['id'])->sum('time')) ?></span>
                                                            </button>
                                                        </h2>
                                                        <div id="<?= toSlug($chapter['name']) ?>" class="accordion-collapse collapse show" aria-labelledby="headingTwo1" data-bs-parent="#accordionExampleb2">
                                                            <div class="accordion-body card-body pr--0">
                                                                <ul class="rbt-course-main-content liststyle">

                                                                    <?php
                                                                    $lessons = (new Lesson)->where('course_id', '=', $course['id'])->where('chapter_id', '=', $chapter['id'])->getArray();
                                                                    ?>
                                                                    <?php if ($lessons) : ?>
                                                                        <?php foreach ($lessons as $lesson) : ?>
                                                                            <li>
                                                                                <a href="<?= $lesson['preview'] ? "/course/" . $course['slug'] . "/lesson?id=" . $lesson['id'] : "#" ?>">
                                                                                    <div class="course-content-left">
                                                                                        <i class="feather-play-circle"></i> <span class="text"><?= $lesson['name'] ?> </span>
                                                                                    </div>
                                                                                    <div class="course-content-right">
                                                                                        <span class="min-lable"><?= timeConvert($lesson['time']) ?></span>

                                                                                        <?php if ($lesson['preview']) : ?>
                                                                                            <span class="rbt-badge variation-03 bg-primary-opacity"><i class="feather-eye"></i> Xem trước</span>
                                                                                        <?php else : ?>
                                                                                            <span class="course-lock"><i class="feather-lock"></i></span>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </a>
                                                                            </li>

                                                                        <?php endforeach; ?>
                                                                    <?php else : ?>
                                                                        <li>
                                                                            <a href="lesson.html">
                                                                                <div class="course-content-left">
                                                                                    <span class="text">Chưa có bài học nào. </span>
                                                                                </div>
                                                                            </a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <div>Chưa có bài học nào</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Course Content  -->

                            <!-- Start Course Feature Box  -->
                            <!-- <div class="rbt-course-feature-box rbt-shadow-box details-wrapper mt--30" id="details">
                                <div class="row g-5">
                                    <div class="col-lg-6">
                                        <div class="section-title">
                                            <h4 class="rbt-title-style-3 mb--20">Requirements</h4>
                                        </div>
                                        <ul class="rbt-list-style-1">
                                            <li><i class="feather-check"></i>Become an advanced, confident, and modern
                                                JavaScript developer from scratch.</li>
                                            <li><i class="feather-check"></i>Have an intermediate skill level of Python
                                                programming.</li>
                                            <li><i class="feather-check"></i>Have a portfolio of various data analysis
                                                projects.</li>
                                            <li><i class="feather-check"></i>Use the numpy library to create and manipulate
                                                arrays.</li>
                                        </ul>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="section-title">
                                            <h4 class="rbt-title-style-3 mb--20">Description</h4>
                                        </div>
                                        <ul class="rbt-list-style-1">
                                            <li><i class="feather-check"></i>Use the Jupyter Notebook Environment.
                                                JavaScript developer from scratch.</li>
                                            <li><i class="feather-check"></i>Use the pandas module with Python to create and
                                                structure data.</li>
                                            <li><i class="feather-check"></i>Have a portfolio of various data analysis
                                                projects.</li>
                                            <li><i class="feather-check"></i>Create data visualizations using matplotlib and
                                                the seaborn.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                            <!-- End Course Feature Box  -->

                            <!-- Start Intructor Area  -->
                            <div class="rbt-instructor rbt-shadow-box intructor-wrapper mt--30" id="intructor">
                                <div class="about-author border-0 pb--0 pt--0">
                                    <div class="section-title mb--30">
                                        <h4 class="rbt-title-style-3">Giảng viên</h4>
                                    </div>
                                    <?php $instructor = (new User)->where('id', '=', $course['user_id'])->first(); ?>

                                    <div class="media align-items-center">
                                        <div class="thumbnail">
                                            <a href="#">
                                                <img src="<?= $instructor['avatar_url'] ? $instructor['avatar_url'] : '/public/assets/images/user/default.png' ?>" alt="Author Images">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <div class="author-info">
                                                <h5 class="title">
                                                    <a class="hover-flip-item-wrapper" href="/profile/<?= $instructor['id'] ?>"><?= $instructor['name'] ?></a>
                                                </h5>
                                                <!-- <span class="b3 subtitle">Advanced Educator</span> -->
                                                <ul class="rbt-meta mb--20 mt--10">
                                                    <!-- <li><i class="fa fa-star color-warning"></i>75,237 Reviews <span class="rbt-badge-5 ml--5">4.4 Rating</span></li> -->
                                                    <li><i class="feather-users"></i><?= (new Enrollment)->where('instructor_id', '=', $course['user_id'])->count() ?> Học viên</li>
                                                    <li><a href="#"><i class="feather-video"></i><?= (new Course)->where("status", "=", 0)->where('user_id', '=', $course['user_id'])->count() ?> khoá học</a></li>
                                                </ul>
                                            </div>
                                            <div class="content">
                                                <!-- <p class="description">John is a brilliant educator, whose life was spent
                                                    for computer science and love of nature.</p> -->

                                                <ul class="social-icon social-default icon-naked justify-content-start">
                                                    <li><a target="_blank" href="https://www.facebook.com/">
                                                            <i class="feather-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li><a target="_blank" href="https://www.twitter.com">
                                                            <i class="feather-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li><a target="_blank" href="https://www.instagram.com/">
                                                            <i class="feather-instagram"></i>
                                                        </a>
                                                    </li>
                                                    <li><a target="_blank" href="https://www.linkdin.com/">
                                                            <i class="feather-linkedin"></i>
                                                        </a>
                                                    </li>
                                                </ul>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Intructor Area  -->

                            <!-- Start Edu Review List  -->
                            <?php if ($review['data']) : ?>
                                <div class="rbt-review-wrapper rbt-shadow-box review-wrapper mt--30" id="review">
                                    <div class="course-content">
                                        <div class="section-title">
                                            <h4 class="rbt-title-style-3">TỔNG ĐÁNH GIÁ</h4>

                                        </div>
                                        <div class="row g-5 align-items-center">
                                            <div class="col-lg-3">
                                                <div class="rating-box">
                                                    <?php
                                                    $total = (new Review)->where('course_id', '=', $course['id'])->count();
                                                    $avg = (new Review)->where('course_id', '=', $course['id'])->avg('rating');
                                                    ?>
                                                    <div class="rating-number"><?= round($avg, 2) ?></div>
                                                    <div class="rating">
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
                                                    <span class="sub-title">Xếp hạng khoá học</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="review-wrapper">
                                                    <?php foreach (range(5, 1) as $stars) : ?>
                                                        <?php
                                                        $count = (new Review)->where('course_id', '=', $course['id'])->where('rating', '=', $stars)->count();
                                                        $count = $count ? $count : 0;

                                                        $percent = round(($count / $total) * 100, 0);
                                                        ?>
                                                        <div class="single-progress-bar">
                                                            <div class="rating-text">
                                                                <?php foreach (range(1, 5) as $s) : ?>
                                                                    <?php if ($s <= $stars) : ?>
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

                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: <?= $percent ?>%" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <span class="value-text"><?= $percent ?>%</span>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- End Edu Review List  -->

                            <div class="about-author-list rbt-shadow-box featured-wrapper mt--30 has-show-more">
                                <div class="section-title">
                                    <h4 class="rbt-title-style-3">
                                        <div class="row">
                                            <div class="col-lg-6">ĐÁNH GIÁ</div>
                                            <div class="col-lg-6">
                                                <div class="float-end">
                                                    <button class="rbt-btn btn-md btn-gradient hover-icon-reverse" type="button" data-bs-toggle="modal" data-bs-target="#post-review">
                                                        <span class="icon-reverse-wrapper">
                                                            <span class="btn-text">THÊM ĐÁNH GIÁ</span>
                                                            <span class="btn-icon"><i class="feather-plus-circle"></i></span>
                                                            <span class="btn-icon"><i class="feather-plus-circle"></i></span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </h4>
                                </div>
                                <div class="has-show-more-inner-content rbt-featured-review-list-wrapper">
                                    <?php if ($review['data']) : ?>
                                        <?php foreach ($review['data'] as $rv) : ?>
                                            <?php $user_review = (new User)->where('id', '=', $rv['user_id'])->first() ?>
                                            <div class="rbt-course-review about-author">
                                                <div class="media">
                                                    <div class="thumbnail">
                                                        <a href="javascript:;">
                                                            <img src="<?= $user_review['avatar_url'] ? $user_review['avatar_url'] : '/public/assets/images/user/default.png' ?>" alt="Author Images">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="author-info">
                                                            <h5 class="title">
                                                                <div class="hover-flip-item-wrapper">
                                                                    <?= $user_review['name'] ?>
                                                                </div>
                                                            </h5>
                                                            <div class="rating">
                                                                <?php foreach (range(1, $rv['rating']) as $star) : ?>
                                                                    <a href="javascript:;"><i class="fa fa-star"></i></a>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        </div>
                                                        <div class="content">
                                                            <p class="description"><?= $rv['content'] ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <?php if (count($review['data']) >= 5) : ?>
                                            <div class="rbt-show-more-btn">Show More</div>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <div>Chưa có đánh giá nào</div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                        <!-- End Course Details  -->

                        <!-- Start Related Course  -->
                        <?php $related_course = (new Course)->where("status", "=", 0)->where('user_id', '=', $instructor['id'])->where('id', '!=', $course['id'])->limit(2)->getArray(); ?>
                        <?php if ($related_course) : ?>
                            <div class="related-course mt--60">
                                <div class="row g-5 align-items-end mb--40">
                                    <div class="col-lg-8 col-md-8 col-12">
                                        <div class="section-title">
                                            <span class="subtitle bg-pink-opacity">Top Course</span>
                                            <h4 class="title">Khoá học khác của <strong class="color-primary"><?= $instructor['name'] ?></strong></h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="read-more-btn text-start text-md-end">
                                            <a class="rbt-btn rbt-switch-btn btn-border btn-sm" href="/search?instructor=<?= $instructor['id'] ?>">
                                                <span data-text="Xem tất cả">Xem tất cả</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-5">


                                    <!-- Start Single Card  -->
                                    <?php foreach ($related_course_by_instructor as $related_course) : ?>
                                        <!-- Start Single Course  -->
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                            <div class="rbt-card variation-01 rbt-hover">
                                                <div class="rbt-card-img">
                                                    <a href="/course/<?= $related_course['slug'] ?>/details">
                                                        <img src="<?= $related_course['thumbnails'] ?>" alt="Card image">
                                                        <!-- <div class="rbt-badge-3 bg-white">
                                                        <span>-40%</span>
                                                        <span>Off</span>
                                                    </div> -->
                                                    </a>
                                                </div>
                                                <div class="rbt-card-body">
                                                    <!-- <div class="rbt-card-top">
                                                        <div class="rbt-review">
                                                            <div class="rating">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>
                                                            <span class="rating-count"> (15 Reviews)</span>
                                                        </div>
                                                        <div class="rbt-bookmark-btn">
                                                            <a class="rbt-round-btn" title="Bookmark" href="#"><i class="feather-bookmark"></i></a>
                                                        </div>
                                                    </div> -->

                                                    <h4 style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;" class="rbt-card-title"><a href="/course/<?= $related_course['slug'] ?>/details"><?= $related_course['name'] ?></a>
                                                    </h4>

                                                    <ul class="rbt-meta">
                                                        <li><i class="feather-book"></i><?= (new Lesson)->where('course_id', '=', $related_course['id'])->count() ?> bài học </li>
                                                        <li><i class="feather-users"></i><?= (new Enrollment)->where('course_id', '=', $related_course['id'])->count() ?> học viên</li>
                                                    </ul>

                                                    <p style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;" class="rbt-card-text"><?= $related_course['short_description'] ?></p>
                                                    <div class="rbt-author-meta mb--10">
                                                        <div class="rbt-avater">
                                                            <a href="#">
                                                                <?php $user = (new User)->where('id', '=', $related_course['user_id'])->first();  ?>
                                                                <img src="<?= $user['avatar_url'] ? $user['avatar_url'] : '/public/assets/images/user/default.png' ?>" alt="Sophia Jaymes">
                                                            </a>
                                                        </div>
                                                        <div class="rbt-author-info">
                                                            bởi <a href="/profile/<?= $user['id'] ?>"><?= $user['name'] ?></a>
                                                        </div>
                                                    </div>
                                                    <div class="rbt-card-bottom">
                                                        <div class="rbt-price">
                                                            <?php if ($related_course['price'] == 0) : ?>
                                                                <span class="current-price">Miễn phí</span>
                                                            <?php else : ?>
                                                                <span class="current-price"><?= number_format($related_course['price']) ?>đ</span>
                                                            <?php endif; ?>
                                                            <?php if ($related_course['discounted_price']) : ?>
                                                                <span class="off-price"><?= number_format($related_course['discounted_price']) ?>đ</span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <a class="rbt-btn-link" href="/course/<?= $related_course['slug'] ?>/details">Xem thêm<i class="feather-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Course  -->
                                    <?php endforeach; ?>
                                    <!-- End Single Card  -->


                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- End Related Course  -->
                    </div>

                    <div class="col-lg-4">
                        <div class="course-sidebar sticky-top rbt-shadow-box rbt-gradient-border" style="top: 100px">
                            <div class="inner">
                                <div class="content-item-content">
                                    <div class="rbt-price-wrapper d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="rbt-price">
                                            <?php if ($course['price'] == 0) : ?>
                                                <span class="current-price">Miễn phí</span>
                                            <?php else : ?>
                                                <span class="current-price"><?= number_format($course['price']) ?>đ</span>
                                            <?php endif; ?>
                                            <?php if ($course['discounted_price']) : ?>
                                                <span class="off-price"><?= number_format($course['discounted_price']) ?>đ</span>
                                            <?php endif; ?>
                                        </div>
                                        <!-- <div class="discount-time">
                                            <span class="rbt-badge color-danger bg-color-danger-opacity"><i class="feather-clock"></i> 3 days left!</span>
                                        </div> -->
                                    </div>

                                    <div class="add-to-card-button mt--15">
                                        <div class="rbt-btn btn-gradient icon-hover w-100 d-block text-center" onclick="add_cart(<?= $course['id'] ?>)">
                                            <span class="btn-text">Thêm vào giỏ hàng</span>
                                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                        </div>
                                    </div>

                                    <div class="buy-now-btn mt--15 mb--10">
                                        <div class="rbt-btn btn-border icon-hover w-100 d-block text-center" onclick="add_cart(<?= $course['id'] ?>, 1)">
                                            <span class="btn-text">Mua ngay</span>
                                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                        </div>
                                    </div>


                                    <div class="rbt-widget-details has-show-more">
                                        <ul class="has-show-more-inner-content rbt-course-details-list-wrapper">
                                            <li><span>Tổng thời lượng</span><span class="rbt-feature-value rbt-badge-5"><?= timeConvert((new Lesson)->where('course_id', '=', $course['id'])->sum('time')) ?></span>
                                            </li>
                                            <li><span>Học viên</span><span class="rbt-feature-value rbt-badge-5"><?= (new Enrollment)->where('course_id', '=', $course['id'])->count() ?></span></li>
                                            <li><span>Bài học</span><span class="rbt-feature-value rbt-badge-5"><?= (new Lesson)->where('course_id', '=', $course['id'])->count() ?></span></li>
                                        </ul>
                                        <div class="rbt-show-more-btn">Xem thêm</div>
                                    </div>

                                    <div class="social-share-wrapper mt--30 text-center">
                                        <div class="rbt-post-share d-flex align-items-center justify-content-center">
                                            <ul class="social-icon social-default transparent-with-border justify-content-center">
                                                <li><a target="_blank" href="https://www.facebook.com/">
                                                        <i class="feather-facebook"></i>
                                                    </a>
                                                </li>
                                                <li><a target="_blank" href="https://www.twitter.com">
                                                        <i class="feather-twitter"></i>
                                                    </a>
                                                </li>
                                                <li><a target="_blank" href="https://www.instagram.com/">
                                                        <i class="feather-instagram"></i>
                                                    </a>
                                                </li>
                                                <li><a target="_blank" href="https://www.linkdin.com/">
                                                        <i class="feather-linkedin"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <hr class="mt--20">
                                        <div class="contact-with-us text-center">
                                            <p>Cần được tư vấn trực tiếp?</p>
                                            <p class="rbt-badge-2 mt--10 justify-content-center w-100"><i class="feather-phone mr--5"></i> Liên hệ: <a href="#"><strong>+1900 1155</strong></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Start Modal Area  -->
<div class="rbt-default-modal modal fade" id="post-review" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="rbt-round-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="feather-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="inner rbt-default-form">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="modal-title mb--20" id="exampleModalLabel">ĐĂNG ĐÁNH GIÁ</h5>
                            <div class="course-field mb--20">
                                <label for="modal-field-2">Điểm số</label>
                                <!-- Inspired by: https://codepen.io/jamesbarnett/pen/vlpkh -->
                                <div class="star-rating">
                                    <input type="radio" id="5-stars" name="review-rating" value="5" />
                                    <label for="5-stars" class="star">&#9733;</label>
                                    <input type="radio" id="4-stars" name="review-rating" value="4" />
                                    <label for="4-stars" class="star">&#9733;</label>
                                    <input type="radio" id="3-stars" name="review-rating" value="3" />
                                    <label for="3-stars" class="star">&#9733;</label>
                                    <input type="radio" id="2-stars" name="review-rating" value="2" />
                                    <label for="2-stars" class="star">&#9733;</label>
                                    <input type="radio" id="1-star" name="review-rating" value="1" />
                                    <label for="1-star" class="star">&#9733;</label>
                                </div>
                            </div>
                            <div class="course-field mb--20">
                                <label for="modal-field-2">Nội dung</label>
                                <textarea id="review_content" placeholder="Thêm đánh giá của bạn"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="top-circle-shape"></div>
            <div class="modal-footer pt--30">
                <button class="rbt-btn btn-md btn-gradient hover-icon-reverse" onclick="on_review()">
                    <span class="icon-reverse-wrapper">
                        <span class="btn-text">ĐÁNH GIÁ</span>
                        <span class="btn-icon"><i class="feather-plus-circle"></i></span>
                        <span class="btn-icon"><i class="feather-plus-circle"></i></span>
                    </span>
                </button>
                <button type="button" class="rbt-btn btn-border btn-md radius-round-10" data-bs-dismiss="modal">HUỶ</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Area  -->

<div class="rbt-separator-mid">
    <div class="container">
        <hr class="rbt-separator m-0">
    </div>
</div>

<script>
    function on_review() {
        $.ajax({
            method: "POST",
            url: "/api/course/review/submit",
            data: {
                rate: $('input[name="review-rating"]:checked').val(),
                content: $('#review_content').val(),
                courses_id: <?= $course['id'] ?>
            },
        }).done(function(data) {
            if (data.status == 200) {
                // window.location.reload();
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

<style>
    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        font-size: 1.5em;
        justify-content: space-around;
        /* padding: 0 .2em; */
        text-align: center;
        width: 5em;
    }

    .star-rating input {
        display: none;
    }

    .star-rating label {
        color: #ccc;
        cursor: pointer;
    }

    .star-rating :checked~label {
        color: #f90;
    }

    .star-rating label:hover,
    .star-rating label:hover~label {
        color: #fc0;
    }

    .star-rating .star::before {
        display: none;
    }
</style>