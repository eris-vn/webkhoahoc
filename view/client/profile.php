<div class="rbt-page-banner-wrapper">
    <!-- Start Banner BG Image  -->
    <div class="rbt-banner-image"></div>
    <!-- End Banner BG Image  -->
</div>

<div class="rbt-dashboard-area rbt-section-overlayping-top rbt-section-gapBottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Start Dashboard Top  -->
                <div class="rbt-dashboard-content-wrapper">
                    <div class="tutor-bg-photo bg_image bg_image--22 height-350">
                        <!-- <img src="assets/images/bg/bg-image-22.jpg" alt=""> -->
                    </div>
                    <!-- Start Tutor Information  -->
                    <div class="rbt-tutor-information">
                        <div class="rbt-tutor-information-left">
                            <div class="thumbnail rbt-avatars size-lg">
                                <img src="<?= $profile['avatar_url'] ? $profile['avatar_url'] : '/public/assets/images/user/default.png' ?>" alt="Instructor">
                            </div>
                            <div class="tutor-content">
                                <h5 class="title"><?= $profile['name'] ?></h5>
                                <!-- <div class="rbt-review">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="rating-count"> (15 Reviews)</span>
                                </div> -->
                                <ul class="rbt-meta rbt-meta-white mt--5">
                                    <li><i class="feather-book"></i><?= (new Course)->where("status", "=", 0)->where('user_id', '=', $profile['id'])->count() ?> khoá học</li>
                                    <li><i class="feather-users"></i><?= (new Enrollment)->where('instructor_id', '=', $profile['id'])->count() ?> học viên</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Tutor Information  -->
                </div>
                <!-- End Dashboard Top  -->
            </div>
            <div class="col-lg-12 mt--30">
                <div class="profile-content rbt-shadow-box">
                    <h4 class="rbt-title-style-3">Giới thiệu</h4>
                    <div class="row g-5">
                        <div class="col-lg-8">
                            <p class="mt--10 mb--20"><?= $profile['bio'] ?></p>
                            <ul class="social-icon social-default justify-content-start">
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
                                <li>
                                    <a target="_blank" href="https://www.linkdin.com/">
                                        <i class="feather-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="rbt-information-list mt--15">
                                <li>
                                    <a href="#"><i class="feather-phone"></i>+84<?= $profile['phone_number'] ?></a>
                                </li>
                                <li>
                                    <a href="mailto:hello@example.com"><i class="feather-mail"></i><?= $profile['email'] ?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-2 offset-lg-2">
                            <div class="feature-sin best-seller-badge text-end h-100">
                                <span class="rbt-badge-2 w-100 text-center badge-full-height">
                                    <span class="image"><img src="/public/assets/images/icons/card-icon-1.png" alt="Best Seller Icon"></span> Bestseller
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start Card Area -->
        <div class="rbt-profile-course-area mt--60">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sction-title">
                        <h2 class="rbt-title-style-3">Các khoá học</h2>
                    </div>
                </div>
            </div>
            <div class="row g-5 mt--5">

                <?php if ($courses['data']) : ?>
                    <?php foreach ($courses['data'] as $course) : ?>
                        <!-- Start Single Course  -->
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12 sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                            <div class="rbt-card variation-01 rbt-hover">
                                <div class="rbt-card-img">
                                    <a href="course-details.html">
                                        <img src="<?= $course['thumbnails'] ?>" alt="Card image">
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

                                    <h4 class="rbt-card-title"><a href="/course/<?= $course['slug'] ?>/details"><?= $course['name'] ?></a>
                                    </h4>

                                    <ul class="rbt-meta">
                                        <li><i class="feather-book"></i><?= (new Lesson)->where('course_id', '=', $course['id'])->count() ?> bài học </li>
                                        <li><i class="feather-users"></i><?= (new Enrollment)->where('course_id', '=', $course['id'])->count() ?> học viên</li>
                                    </ul>

                                    <p class="rbt-card-text"><?= $course['short_description'] ?></p>
                                    <div class="rbt-author-meta mb--10">
                                        <div class="rbt-avater">
                                            <a href="#">
                                                <img src="/public/assets/images/client/avatar-02.png" alt="Sophia Jaymes">
                                            </a>
                                        </div>
                                        <div class="rbt-author-info">
                                            bởi <a href="#"><?= (new User)->where('id', '=', $course['user_id'])->first()['name'] ?></a>
                                        </div>
                                    </div>
                                    <div class="rbt-card-bottom">
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
                                        <a class="rbt-btn-link" href="/course/<?= $course['slug'] ?>/details">Xem thêm<i class="feather-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Course  -->
                    <?php endforeach; ?>
                <?php else : ?>
                    <div>Chưa có khoá hoc nào</div>
                <?php endif; ?>
            </div>
        </div>
        <!-- End Card Area -->

        <div class="row">
            <div class="col-lg-12 mt--60">
                <?= (new Model)->renderHtml($courses); ?>
            </div>
        </div>
    </div>
</div>