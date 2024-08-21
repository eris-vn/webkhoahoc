<main class="rbt-main-wrapper">

    <div class="rbt-create-course-area bg-color-white rbt-section-gap">
        <div class="container">
            <div class="row g-5">

                <div class="col-lg-8">
                    <div class="rbt-accordion-style rbt-accordion-01 rbt-accordion-06 accordion">
                        <div class="accordion" id="tutionaccordionExamplea1">
                            <div class="accordion-item card">
                                <h2 class="accordion-header card-header" id="accOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accCollapseOne" aria-expanded="true" aria-controls="accCollapseOne">Thông tin khoá học
                                    </button>
                                </h2>
                                <div id="accCollapseOne" class="accordion-collapse collapse show" aria-labelledby="accOne" data-bs-parent="#tutionaccordionExamplea1">
                                    <div class="accordion-body card-body">
                                        <!-- Start Course Field Wrapper  -->
                                        <div class="rbt-course-field-wrapper rbt-default-form">
                                            <div class="course-field mb--15">
                                                <label for="field-1">Tên khoá học</label>
                                                <input id="name" type="text" placeholder="New Course">
                                                <small class="d-block mt_dec--5"><i class="feather-info"></i>Tiêu đề ít nhất 30 ký tự.</small>
                                            </div>
                                            <div class="course-field mb--15">
                                                <label for="field-2">Đường dẫn khoá học</label>
                                                <input id="slug" type="text" placeholder="new-course">
                                                <small class="d-block mt_dec--5"><i class="feather-info"></i> Ví dụ: <a href="https://yourdomain.com/new-course">https://yourdomain.com/new-course</a></small>
                                            </div>

                                            <div class="course-field mb--15">
                                                <label for="field-1">Mô tả ngắn</label>
                                                <textarea id="short-description" placeholder="Đặt mô tả ngắn ngọn" rows="5"></textarea>
                                            </div>

                                            <div class="course-field mb--15">
                                                <label for="aboutCourse">Mô tả khoá học</label>
                                                <!-- Place the first <script> tag in your HTML's <head> -->
                                                <script src="https://cdn.tiny.cloud/1/zie5rxa4n7x4228dguy35hjc0niw6txfpql0bo7mtinw5bp1/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

                                                <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
                                                <script>
                                                    tinymce.init({
                                                        selector: '#aboutCourse',
                                                        plugins: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                                                        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                                                        tinycomments_mode: 'embedded',
                                                        tinycomments_author: 'Author name',
                                                        mergetags_list: [{
                                                                value: 'First.Name',
                                                                title: 'First Name'
                                                            },
                                                            {
                                                                value: 'Email',
                                                                title: 'Email'
                                                            },
                                                        ],
                                                        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
                                                    });
                                                </script>
                                                <textarea id="aboutCourse" rows="10"></textarea>
                                            </div>

                                            <div class="course-field mb--15 edu-bg-gray">
                                                <h6>Giá Khoá Học</h6>
                                                <div class="rbt-course-settings-content">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="advance-tab-button advance-tab-button-1">
                                                                <ul class="rbt-default-tab-button nav nav-tabs" id="coursePrice" role="tablist">
                                                                    <li class="nav-item w-100" role="presentation">
                                                                        <a href="#" class="active" id="paid-tab" data-bs-toggle="tab" data-bs-target="#paid" role="tab" aria-controls="paid" aria-selected="true">
                                                                            <span>Trả phí</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item w-100" role="presentation">
                                                                        <a href="#" id="free-tab" data-bs-toggle="tab" data-bs-target="#free" role="tab" aria-controls="free" aria-selected="false">
                                                                            <span>Miễn phí</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="tab-content">

                                                                <div class="tab-pane fade advance-tab-content-1 active show" id="paid" role="tabpanel" aria-labelledby="paid-tab">

                                                                    <div class="course-field mb--15">
                                                                        <label for="price">Giá thường (vnđ)</label>
                                                                        <input id="price" type="number" placeholder="Điền giá khoá học">
                                                                    </div>

                                                                    <div class="course-field mb--15">
                                                                        <label for="discounted_price">Giá giảm giá (vnđ)</label>
                                                                        <input id="discounted_price" type="number" placeholder="Điền giá khoá học đang giảm">
                                                                    </div>

                                                                </div>


                                                                <div class="tab-pane fade advance-tab-content-1" id="free" role="tabpanel" aria-labelledby="free-tab">
                                                                    <div class="course-field">
                                                                        <p class="b3">Khoá này học miễn phí cho mọi người</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="course-field mb--20">
                                                <h6>Chọn danh mục</h6>
                                                <div class="rbt-modern-select bg-transparent height-45 w-100 mb--10">
                                                    <select class="w-100" data-live-search="true" title="Search Course Category. ex. Design, Development, Business" multiple="" data-size="7" data-actions-box="true" data-selected-text-format="count > 2">
                                                        <option>Web Developer</option>
                                                        <option>App Developer</option>
                                                        <option>Javascript</option>
                                                        <option>React</option>
                                                        <option>WordPress</option>
                                                        <option>jQuery</option>
                                                        <option>Vue Js</option>
                                                        <option>Angular</option>
                                                    </select>
                                                </div>
                                            </div> -->

                                            <div class="course-field mb--20">
                                                <h6>Ảnh bìa</h6>
                                                <div class="rbt-create-course-thumbnail upload-area">
                                                    <div class="upload-area">
                                                        <div class="brows-file-wrapper" data-black-overlay="9">
                                                            <!-- actual upload which is hidden -->
                                                            <input accept=".jpg, .jpeg, .png, .gif, .webp" name="createinputfile" id="createinputfile" type="file" class="inputfile">
                                                            <img id="createfileImage" src="/public/assets/images/others/thumbnail-placeholder.svg" alt="file image">
                                                            <!-- our custom upload button -->
                                                            <label class="d-flex" for="createinputfile" title="No File Choosen">
                                                                <i class="feather-upload"></i>
                                                                <span class="text-center">Chọn file</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <small><i class="feather-info"></i> <b>Kích thước:</b> 700x430 pixels, <b>File
                                                        hỗ trợ:</b> JPG, JPEG, PNG, GIF, WEBP</small>
                                            </div>

                                            <div class="course-field mb--15">
                                                <label for="videoUrl">Điền link youtube video</label>
                                                <input id="video_preview" type="text" placeholder="Điền link youtube video ở đây.">
                                                <small class="d-block mt_dec--5">Example: <a target="_blank" href="https://www.youtube.com/watch?v=yourvideoid">https://www.youtube.com/watch?v=yourvideoid</a></small>
                                            </div>

                                        </div>
                                        <!-- End Course Field Wrapper  -->
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="accordion-item card">
                                <h2 class="accordion-header card-header" id="accThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accCollapseThree" aria-expanded="false" aria-controls="accCollapseThree">
                                        Xây dựng khoá học
                                    </button>
                                </h2>
                                <div id="accCollapseThree" class="accordion-collapse collapse" aria-labelledby="accThree" data-bs-parent="#tutionaccordionExamplea1">
                                    <div class="accordion-body card-body">
                                        <button class="rbt-btn btn-md btn-gradient hover-icon-reverse" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <span class="icon-reverse-wrapper">
                                                <span class="btn-text">Add New Topic</span>
                                                <span class="btn-icon"><i class="feather-plus-circle"></i></span>
                                                <span class="btn-icon"><i class="feather-plus-circle"></i></span>
                                            </span>
                                        </button>

                                        <div class="rbt-accordion-style rbt-accordion-02 for-right-content accordion">


                                            <div class="accordion" id="accordionExampleb2">

                                                <div class="accordion-item card">
                                                    <h2 class="accordion-header card-header" id="headingTwo1">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#collapseTwo1" aria-controls="collapseTwo1">
                                                            Welcome Histudy <span class="rbt-badge-5 ml--10">1/2</span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo1" class="accordion-collapse collapse" aria-labelledby="headingTwo1">
                                                        <div class="accordion-body card-body">
                                                            <ul class="rbt-course-main-content liststyle">

                                                                <li>
                                                                    <a href="lesson.html">
                                                                        <div class="course-content-left">
                                                                            <i class="feather-play-circle"></i> <span class="text">Course
                                                                                Intro</span>
                                                                        </div>
                                                                        <div class="course-content-right">
                                                                            <span class="min-lable">30 min</span>
                                                                            <span class="rbt-check"><i class="feather-check"></i></span>
                                                                        </div>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="lesson-intro.html">
                                                                        <div class="course-content-left">
                                                                            <i class="feather-file-text"></i> <span class="text">Introduction</span>
                                                                        </div>
                                                                        <div class="course-content-right">
                                                                            <span class="rbt-check"><i class="feather-check"></i></span>
                                                                        </div>
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item card">
                                                    <h2 class="accordion-header card-header" id="headingTwo4">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#collapseTwo4" aria-controls="collapseTwo4">
                                                            Welcome Lessons <span class="rbt-badge-5 ml--10">1/3</span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo4" class="accordion-collapse collapse" aria-labelledby="headingTwo4">
                                                        <div class="accordion-body card-body">
                                                            <ul class="rbt-course-main-content liststyle">

                                                                <li>
                                                                    <a href="lesson.html">
                                                                        <div class="course-content-left">
                                                                            <i class="feather-play-circle"></i> <span class="text">Hello World!
                                                                            </span>
                                                                        </div>
                                                                        <div class="course-content-right">
                                                                            <span class="min-lable">0.37</span>
                                                                            <span class="rbt-check"><i class="feather-check"></i></span>
                                                                        </div>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="#">
                                                                        <div class="course-content-left">
                                                                            <i class="feather-play-circle"></i> <span class="text">Values and Variables</span>
                                                                        </div>
                                                                        <div class="course-content-right">
                                                                            <span class="min-lable">20 min</span>
                                                                            <span class="rbt-check unread"><i class="feather-circle"></i></span>
                                                                        </div>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="#">
                                                                        <div class="course-content-left">
                                                                            <i class="feather-play-circle"></i> <span class="text">Basic Operators
                                                                            </span>
                                                                        </div>
                                                                        <div class="course-content-right">
                                                                            <span class="min-lable">15 min</span>
                                                                            <span class="rbt-check unread"><i class="feather-circle"></i></span>
                                                                        </div>
                                                                    </a>
                                                                </li>


                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item card">
                                                    <h2 class="accordion-header card-header" id="headingTwo2">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#collapseTwo2" aria-controls="collapseTwo2">
                                                            Histudy Quiz <span class="rbt-badge-5 ml--10">1/2</span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo2" class="accordion-collapse collapse show" aria-labelledby="headingTwo2">
                                                        <div class="accordion-body card-body">
                                                            <ul class="rbt-course-main-content liststyle">
                                                                <li>
                                                                    <a href="lesson-quiz.html" class="active">
                                                                        <div class="course-content-left">
                                                                            <i class="feather-help-circle"></i> <span class="text">Histudy Quiz Start</span>
                                                                        </div>
                                                                        <div class="course-content-right">
                                                                            <span class="rbt-check unread"><i class="feather-circle"></i></span>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="lesson-quiz-result.html">
                                                                        <div class="course-content-left">
                                                                            <i class="feather-help-circle"></i> <span class="text">Histudy Quiz Result</span>
                                                                        </div>
                                                                        <div class="course-content-right">
                                                                            <span class="rbt-check unread"><i class="feather-circle"></i></span>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion-item card">
                                                    <h2 class="accordion-header card-header" id="headingTwo3">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#collapseTwo3" aria-controls="collapseTwo3">
                                                            Histudy Assignments <span class="rbt-badge-5 ml--10">1/2</span>
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo3" class="accordion-collapse collapse" aria-labelledby="headingTwo3">
                                                        <div class="accordion-body card-body">
                                                            <ul class="rbt-course-main-content liststyle">
                                                                <li>
                                                                    <a href="lesson-assignments.html">
                                                                        <div class="course-content-left">
                                                                            <i class="feather-file-text"></i> <span class="text">Histudy Assignments</span>
                                                                        </div>
                                                                        <div class="course-content-right">
                                                                            <span class="rbt-check unread"><i class="feather-circle"></i></span>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="lesson-assignments-submit.html">
                                                                        <div class="course-content-left">
                                                                            <i class="feather-file-text"></i> <span class="text">Histudy Assignments Submit</span>
                                                                        </div>
                                                                        <div class="course-content-right">
                                                                            <span class="rbt-check unread"><i class="feather-circle"></i></span>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div> -->

                        </div>
                    </div>

                    <div class="mt--10 row g-5">
                        <div class="col-lg-12">
                            <div class="rbt-btn btn-gradient hover-icon-reverse w-100 text-center">
                                <span class="icon-reverse-wrapper" onclick="on_create()">
                                    <span class="btn-text">TẠO KHOÁ HỌC</span>
                                    <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                    <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="rbt-create-course-sidebar course-sidebar sticky-top rbt-shadow-box rbt-gradient-border">
                        <div class="inner">
                            <div class="section-title mb--30">
                                <h4 class="title">Mẹo đăng khoá học</h4>
                            </div>
                            <div class="rbt-course-upload-tips">
                                <ul class="rbt-list-style-1">
                                    <li><i class="feather-check"></i> Ảnh bìa kháo học nên ở kích thước 700x430.</li>
                                    <li><i class="feather-check"></i> Thêm video giới thiệu để thu hút khách hàng.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Start Modal Area  -->
    <div class="rbt-default-modal modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <h5 class="modal-title mb--20" id="exampleModalLabel">Add Topic</h5>
                                <div class="course-field mb--20">
                                    <label for="modal-field-1">Topic Name</label>
                                    <input id="modal-field-1" type="text">
                                    <small><i class="feather-info"></i> Topic titles are displayed publicly wherever required. Each topic may contain one or more lessons, quiz and assignments.</small>
                                </div>
                                <div class="course-field mb--20">
                                    <label for="modal-field-2">Topic Summary</label>
                                    <textarea id="modal-field-2"></textarea>
                                    <small><i class="feather-info"></i> Add a summary of short text to prepare students for the activities for the topic. The text is shown on the course page beside the tooltip beside the topic name.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top-circle-shape"></div>
                <div class="modal-footer pt--30">
                    <button type="button" class="rbt-btn btn-border btn-md radius-round-10" data-bs-dismiss="modal">Cancel</button>
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
    <div class="footer-style-2 ptb--60 bg-color-white">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12">
                    <div class="inner text-center">

                        <div class="logo">
                            <a href="index.html">
                                <img src="/public/assets/images/logo/logo.png" alt="Logo images">
                            </a>
                        </div>
                        <!-- Social icone Area -->
                        <ul class="social-icon social-default">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                        <!-- End -->
                        <div class="text mt--20">
                            <p>© 2023 <a target="_blank" href="https://themeforest.net/user/rbt-themes/portfolio">Rainbow-Themes</a>. All
                                Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="rbt-progress-parent">
    <svg class="rbt-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
    </svg>
</div>

<script>
    $(function() {
        setTimeout(() => {
            $('#accCollapseOne').addClass('show');
        }, 100);
    });

    function on_create() {

        var aboutCourseContent = tinymce.get("aboutCourse").getContent();

        // Xây dựng đối tượng FormData
        var formData = new FormData();
        formData.append('name', $('#name').val());
        formData.append('slug', $('#slug').val());
        formData.append('description', aboutCourseContent);
        formData.append('price', $('#paid-tab').attr("aria-selected") == "true" ? $('#price').val() : 0);
        formData.append('discounted_price', $('#discounted_price').val());
        formData.append('video_preview', $('#video_preview').val());
        // formData.append('requirements', $('#requirements').val());
        // formData.append('line_desc', $('#line_desc').val());
        formData.append('short-description', $('#short-description').val());
        formData.append('minutes', $('#minutes').val());

        // Lấy file từ input type file (nếu có)
        var imageInput = document.getElementById('createinputfile');
        if (imageInput.files.length > 0) {
            formData.append('thumbnails', imageInput.files[0]);
        }


        $.ajax({
                method: "POST",
                url: "/api/user/course/create",
                data: formData,
                processData: false,
                contentType: false,
            })
            .done(function(data) {
                if (data.status == 200) {
                    Swal.fire({
                        title: "THÀNH CÔNG",
                        text: data.msg,
                        icon: "success"
                    }).then(() => {
                        window.location.href = `/user/course/build-lesson/${data.data.id}`
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
</script>

<style>
    .tox-tinymce {
        margin-bottom: 15px;
    }
</style>