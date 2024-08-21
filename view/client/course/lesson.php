<div class="rbt-lesson-area bg-color-white">
    <div class="rbt-lesson-content-wrapper">
        <div class="rbt-lesson-leftsidebar">
            <div class="rbt-course-feature-inner rbt-search-activation">
                <div class="section-title">
                    <h4 class="rbt-title-style-3">Nội dung bài học</h4>
                </div>

                <div class="lesson-search-wrapper">
                    <form action="#" class="rbt-search-style-1">
                        <input class="rbt-search-active" type="text" placeholder="Tìm kiếm khoá học">
                        <button class="search-btn disabled"><i class="feather-search"></i></button>
                    </form>
                </div>

                <hr class="mt--10">

                <div class="rbt-accordion-style rbt-accordion-02 for-right-content accordion">


                    <div class="accordion" id="accordionExampleb2">

                        <?php
                        $chapters = (new Chapter)->where('course_id', '=', $course['id'])->getArray();
                        ?>

                        <?php foreach ($chapters as $chapter) : ?>
                            <div class="accordion-item card">
                                <h2 class="accordion-header card-header" id="headingTwo1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" id="<?= toSlug($chapter['name']) ?>-title" aria-expanded="true" data-bs-target="#<?= toSlug($chapter['name']) ?>" aria-controls="collapseTwo1">
                                        <?= $chapter['name'] ?> <!-- <span class="rbt-badge-5 ml--10">1/2</span> -->
                                    </button>
                                </h2>
                                <div id="<?= toSlug($chapter['name']) ?>" class="accordion-collapse collapse show" aria-labelledby="headingTwo1">
                                    <div class="accordion-body card-body">
                                        <ul class="rbt-course-main-content liststyle">

                                            <?php
                                            $lessons = (new Lesson)->where('course_id', '=', $course['id'])->where('chapter_id', '=', $chapter['id'])->getArray();
                                            $questions_check = (new Question)->where('chapter_id', '=', $chapter['id'])->count();
                                            ?>
                                            <?php if ($lessons) : ?>
                                                <?php foreach ($lessons as $lesson) : ?>
                                                    <li>
                                                        <?php
                                                        $lesson_id = isset($_GET['id']) ? $_GET['id'] : null;
                                                        $user_lesson = (new UserLesson)->where('lesson_id', '=', $lesson['id'])->where('user_id', '=', $user['id'])->first();
                                                        ?>
                                                        <a href="<?= (!$is_enrolled && $lesson['preview'] == 0) ? '#' : "/course/" . $course['slug'] . "/lesson?id=" . $lesson['id'] ?>" <?= $lesson_id == $lesson['id'] ? 'class="active"' : '' ?>>
                                                            <?php if ($lesson_id == $lesson['id']) : ?>
                                                                <script>
                                                                    $(function() {
                                                                        $('#<?= toSlug($chapter['name']) ?>').addClass('show');
                                                                        $('#<?= toSlug($chapter['name']) ?>-title').removeClass('collapsed');
                                                                    });
                                                                </script>
                                                            <?php endif; ?>
                                                            <div class="course-content-left">
                                                                <i class="feather-play-circle"></i> <span class="text"><?= $lesson['name'] ?></span>
                                                            </div>
                                                            <?php if (!$is_enrolled && $lesson['preview'] == 0) : ?>
                                                                <div class="course-content-right">
                                                                    <span class="course-lock"><i class="feather-lock"></i></span>
                                                                </div>
                                                            <?php else : ?>
                                                                <div class="course-content-right">
                                                                    <span class="min-lable"><?= timeConvert($lesson['time']) ?></span>
                                                                    <?php if ($user_lesson && $user_lesson['completed'] == 1) : ?>
                                                                        <span class="rbt-check"><i class="feather-check"></i></span>
                                                                    <?php else : ?>
                                                                        <span class="rbt-check unread"><i class="feather-circle"></i></span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <li>
                                                    <a href="#">
                                                        Chưa có bài học nào.
                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if ($questions_check) : ?>
                                                <li>
                                                    <a href="<?= (!$is_enrolled) ? '#' : "/course/" . $course['slug'] . "/quiz?chapter=" . $chapter['id'] ?>" <?= isset($_GET['chapter']) && $_GET['chapter'] == $chapter['id'] ? 'class="active"' : '' ?>>
                                                        <?php if (isset($_GET['chapter']) && $_GET['chapter'] == $chapter['id']) : ?>
                                                            <script>
                                                                $(function() {
                                                                    $('#<?= toSlug($chapter['name']) ?>').addClass('show');
                                                                    $('#<?= toSlug($chapter['name']) ?>-title').removeClass('collapsed');
                                                                });
                                                            </script>
                                                        <?php endif; ?>
                                                        <div class="course-content-left">
                                                            <i class="feather-help-circle"></i> <span class="text">Làm quiz</span>
                                                        </div>
                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>


                    </div>


                </div>
            </div>
        </div>
        <?php if ($lesson_info) : ?>
            <div class="rbt-lesson-rightsidebar overflow-hidden lesson-video">
                <div class="lesson-top-bar">
                    <div class="lesson-top-left">
                        <div class="rbt-lesson-toggle">
                            <button class="lesson-toggle-active btn-round-white-opacity" title="Toggle Sidebar"><i class="feather-arrow-left"></i></button>
                        </div>
                        <h5><?= $course['name'] ?></h5>
                    </div>
                    <div class="lesson-top-right">
                        <div class="rbt-btn-close">
                            <a href="/course/<?= $course['slug'] ?>/details" title="Trở lại khoá học" class="rbt-round-btn"><i class="feather-x"></i></a>
                        </div>
                    </div>
                </div>
                <div class="inner">
                    <div class="plyr__video-embed rbtplayer">
                        <iframe src="<?= $lesson_info['video_url'] ?>" allowfullscreen="" allow="autoplay"></iframe>
                    </div>
                    <div class="content">
                        <div class="section-title">
                            <h4><?= $lesson_info['name'] ?></h4>
                            <p><?= $lesson_info['description'] ?></p>
                        </div>
                    </div>
                </div>

                <div class="bg-color-extra2 ptb--15 overflow-hidden">
                    <div class="rbt-button-group">

                        <?php if ($previous) : ?>
                            <a class="rbt-btn icon-hover icon-hover-left btn-md bg-primary-opacity" href="/course/<?= $course['slug'] ?>/lesson?id=<?= $previous['id'] ?>">
                                <span class="btn-icon"><i class="feather-arrow-left"></i></span>
                                <span class="btn-text">Trước đó</span>
                            </a>
                        <?php endif; ?>

                        <?php if ($next) : ?>
                            <a class="rbt-btn icon-hover btn-md" href="/course/<?= $course['slug'] ?>/lesson?id=<?= $next['id'] ?>">
                                <span class="btn-text">Tiếp theo</span>
                                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                            </a>
                        <?php endif; ?>

                        <?php if (!$finish_check || $finish_check['completed'] == 0) : ?>
                            <div class="rbt-btn icon-hover btn-md" onclick="on_mark(<?= $lesson_info['id'] ?>)">
                                <span class="btn-text">Đánh dấu hoàn tất</span>
                                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        <?php elseif ($questions) : ?>
            <div class="rbt-lesson-rightsidebar overflow-hidden">
                <div class="lesson-top-bar">
                    <div class="lesson-top-left">
                        <div class="rbt-lesson-toggle">
                            <button class="lesson-toggle-active btn-round-white-opacity" title="Toggle Sidebar"><i class="feather-arrow-left"></i></button>
                        </div>
                        <h5><?= $course['name'] ?></h5>
                    </div>
                    <div class="lesson-top-right">
                        <div class="rbt-btn-close">
                            <a href="/course/<?= $course['slug'] ?>/details" title="Trở lại khoá học" class="rbt-round-btn"><i class="feather-x"></i></a>
                        </div>
                    </div>
                </div>
                <div class="inner">
                    <div class="content">
                        <form id="quiz-form" class="quiz-form-wrapper">

                            <?php foreach ($questions as $question) : ?>
                                <?php
                                $index = array_search($question, $questions) + 1;
                                $answers = (new Answer)->where('question_id', '=', $question['id'])->getArray();
                                ?>
                                <!-- Start Single Quiz  -->
                                <div id="question-<?= $index ?>" class="question">
                                    <div class="quize-top-meta">
                                        <div class="quize-top-left">
                                            <span>Số câu hỏi: <strong><?= $index ?>/<?= count($questions) ?></strong></span>
                                        </div>
                                        <div class="quize-top-right">
                                            <span>Thời gian: <strong>Không giới hạn</strong></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="rbt-single-quiz">
                                        <input class="d-none" id="question-id" value="<?= $question['id'] ?>">
                                        <h4><?= $index ?>. <?= $question['title'] ?></h4>
                                        <div class="row g-3 mt--10">
                                            <?php foreach ($answers as $answer) : ?>
                                                <div class="col-lg-6">
                                                    <div class="rbt-form-check">
                                                        <input class="form-check-input" type="radio" name="question-<?= $question['id'] ?>" id="answer-<?= $answer['id'] ?>" value="<?= $answer['id'] ?>">
                                                        <label class="form-check-label" for="answer-<?= $answer['id'] ?>"> <?= $answer['content'] ?></label>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Quiz  -->

                            <?php endforeach; ?>


                            <div class="rbt-quiz-btn-wrapper mt--30">
                                <button class="rbt-btn bg-primary-opacity btn-sm" id="prev-btn" type="button" disabled="">Quay lại</button>
                                <button class="rbt-btn bg-primary-opacity btn-sm" id="next-btn" type="button">Tiếp theo</button>
                                <div class="rbt-btn btn-gradient btn-sm" id="submit-btn" style="display: none;" onclick="on_submit()">Nộp Bài</div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        <?php endif; ?>

    </div>
</div>


<div class="rbt-progress-parent">
    <svg class="rbt-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
    </svg>
</div>

<script>
    function on_mark(lesson_id) {

        Swal.fire({
            title: "THÔNG BÁO",
            text: "Bạn có chắc muốn đánh dấu bài này đã học?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "VÂNG",
            cancelButtonText: 'THÔI'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: "/api/course/lesson/mark",
                    data: {
                        id: lesson_id
                    },
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
        });

    }

    function on_submit() {
        var dataArray = [];
        $('.question').each(function() {
            var questionId = $(this).find('#question-id').val();
            var answer = $('input[name="question-' + questionId + '"]:checked').val();

            // Push question and answer into the dataArray
            dataArray.push({
                "question_id": questionId,
                "answer": answer ? answer : null
            });
        });

        $.ajax({
            method: "POST",
            url: "/api/course/quiz/submit",
            data: {
                chapter: <?= isset($_GET['chapter']) ? $_GET['chapter'] : "''" ?>,
                answers: dataArray
            },
        }).done(function(data) {
            if (data.status == 200) {
                window.location.href = '/user/quiz-history';
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