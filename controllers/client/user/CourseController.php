<?php

use PSpell\Config;

require_once 'model/course.php';
require_once 'model/chapter.php';
require_once 'model/lesson.php';
require_once 'model/enrollment.php';
require_once 'model/question.php';
require_once 'model/answer.php';
require_once 'model/history_quiz.php';
require_once 'model/user_lesson.php';
require_once 'model/review.php';
require_once 'model/certificate.php';
require_once 'libraries/tfpdf/tfpdf.php';


class CourseController
{
    function show_page()
    {
        $user = user();
        $courses = (new Course)->where("status", "=", 0)->where('user_id', '=', $user['id'])->paginate(6);
        return view('client.user.my-course', compact('courses'), 'user');
    }
    function show_create()
    {
        return view('client.user.course.create',  'default');
    }
    function create()
    {
        $user = user();
        validate_api($_POST, [
            'name' => ['required'],
            'slug' => ['required'],
            'short-description' => ['required'],
            'description' => ['required'],
            'price' => ['required'],
            'video_preview' => ['required:video giới thiệu'],
        ]);

        // xử lý ảnh bìa
        $image = '';
        if (!array_key_exists('thumbnails', $_FILES)) {
            return api(['status' => -100, 'msg' => 'Không bỏ trống ảnh bìa']);
        } else {
            $temp_name = $_FILES['thumbnails']['tmp_name'];
            $file_name = $_FILES['thumbnails']['name'];
            $image = "uploads/img/" . $file_name;

            move_uploaded_file($temp_name, $image);
        }

        $check = (new Course)->where("status", "=", 0)->where('slug', '=', $_POST['slug'])->first();
        if ($check) {
            return api(['status' => -101, 'msg' => 'Đường dẫn đã tồn tại, vui lòng nhập đường dẫn khác.']);
        }

        $discounted_price = isset($_POST['discounted_price']) && $_POST['discounted_price'] != "" ? $_POST['discounted_price'] : 0;

        (new Course)->where("status", "=", 0)->insert(['user_id' => $user['id'], 'name' => $_POST['name'], 'slug' => $_POST['slug'], 'description' => $_POST['description'], 'short_description' => $_POST['short-description'], 'price' => $_POST['price'], 'discounted_price' => $discounted_price, 'thumbnails' => '/' . $image, 'video_preview' => $_POST['video_preview']]);
        $course = (new Course)->where("status", "=", 0)->where('user_id', '=', $user['id'])->orderBy('id', 'desc')->first();
        return api(['status' => 200, 'data' => ['id' => $course['id']], 'msg' => 'Tạo khoá học thành công']);
    }
    function show_edit()
    {
        $user = user();
        $course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : null;
        $course = (new Course)->where("status", "=", 0)->where('id', '=', $course_id)->where('user_id', '=', $user['id'])->first();

        if (!$course) {
            return redirect('/user/my-course');
        }

        return view('client.user.course.edit', compact('course'),  'default');
    }
    function edit()
    {
        $user = user();
        validate_api($_POST, [
            'id' => ['requid:tham số'],
            'name' => ['required'],
            'slug' => ['required'],
            'short-description' => ['required'],
            'description' => ['required'],
            'price' => ['required'],
            'video_preview' => ['required:video giới thiệu'],
        ]);

        // xử lý ảnh bìa
        $image = '';
        if (!array_key_exists('thumbnails', $_FILES)) {
            return api(['status' => -100, 'msg' => 'Không bỏ trống ảnh bìa']);
        } else {
            $temp_name = $_FILES['thumbnails']['tmp_name'];
            $file_name = $_FILES['thumbnails']['name'];
            $image = "uploads/img/" . $file_name;

            move_uploaded_file($temp_name, $image);
        }

        $course = (new Course)->where("status", "=", 0)->where('id', '=', $_POST['id'])->where('user_id', '=', $user['id'])->first();
        if (!$course) {
            return api(['status' => -101, 'msg' => 'Không tìm thấy khoá học']);
        }

        if ($course['slug'] != $_POST['slug']) {
            $check = (new Course)->where("status", "=", 0)->where('slug', '=', $_POST['slug'])->first();
            if ($check) {
                return api(['status' => -101, 'msg' => 'Đường dẫn đã tồn tại, vui lòng nhập đường dẫn khác.']);
            }
        }

        $discounted_price = isset($_POST['discounted_price']) && $_POST['discounted_price'] != "" ? $_POST['discounted_price'] : 0;

        (new Course)->where("status", "=", 0)->where('id', '=', $_POST['id'])->update(['user_id' => $user['id'], 'name' => $_POST['name'], 'slug' => $_POST['slug'], 'description' => $_POST['description'], 'short_description' => $_POST['short-description'], 'price' => $_POST['price'], 'discounted_price' => $discounted_price, 'thumbnails' => '/' . $image, 'video_preview' => $_POST['video_preview']]);
        $course = (new Course)->where("status", "=", 0)->where('user_id', '=', $user['id'])->first();
        return api(['status' => 200, 'data' => ['id' => $course['id']], 'msg' => 'Chỉnh khoá học thành công']);
    }
    function delete()
    {
        $user = user();
        validate_api($_POST, [
            'id' => ['requid:tham số'],
        ]);

        $course = (new Course)->where("status", "=", 0)->where('id', '=', $_POST['id'])->where('user_id', '=', $user['id'])->first();
        if (!$course) {
            return api(['status' => -101, 'msg' => 'Không tìm thấy khoá học']);
        }

        (new Course)->where('id', '=', $_POST['id'])->update(['status' => 1]);
        return api(['status' => 200, 'msg' => 'Xoá khoá học thành công']);
    }
    function show_build_lesson()
    {
        $user = user();
        $course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : null;
        $course = (new Course)->where("status", "=", 0)->where('id', '=', $course_id)->where('user_id', '=', $user['id'])->first();

        if (!$course) {
            return redirect('/user/my-course');
        }

        $chapters = (new Chapter)->where('course_id', '=', $course_id)->getArray();

        return view('client.user.course.build-lesson', compact('course_id', 'course', 'chapters'), 'default');
    }
    function show_manage()
    {
        $user = user();
        $course = (new Course)->where("status", "=", 0)->where('id', '=', $_GET['course_id'])->where('user_id', '=', $user['id'])->first();

        if (!$course) {
            return redirect('/');
        }

        $reviews = (new Review)->where('course_id', '=', $_GET['course_id'])->paginate(10);
        $students = (new Enrollment)->where('instructor_id', '=', $course['user_id'])->where('course_id', '=', $course['id'])->paginate(10);
        $quizs = (new HistoryQuiz)->where('course_id', '=', $course['id'])->paginate(10);

        return view('client.user.course.manage', compact('course', 'students', 'reviews', 'quizs'), 'default');
    }
    function get_certificate()
    {
        $user = user();
        $course = (new Course)->where("status", "=", 0)->where('id', '=', $_POST['id'])->first();
        if (!$course) {
            return api(['status' => -101, 'msg' => 'Không tìm thấy khoá học']);
        }

        $total = (new Lesson)->where('course_id', '=', $course['id'])->count();
        $learnt = (new UserLesson)->where('course_id', '=', $course['id'])->where('user_id', '=', $user['id'])->where('completed', '=', 1)->count();

        if ($total != 0) {
            $percent = floor(($learnt / $total) * 100);
        } else {
            $percent = 0;
        }

        if ($percent < 100 || $percent != 100) {
            return api(['status' => -100, 'msg' => 'Bạn chưa hoàn thành khoá học']);
        }

        $check = (new Certificate)->where('course_id', '=', $course['id'])->first();
        if (!$check) {
            (new Certificate)->insert(['user_id' => $user['id'], 'course_id' => $course['id']]);
        }

        return api(['status' => 200, 'data' => ['redirect' => '/user/course/certificate/' . $course['id']]]);
    }
    function certificate_info()
    {
        $user = user();
        $course = (new Course)->where("status", "=", 0)->where('id', '=', $_GET['course_id'])->first();

        if (!$course) {
            return redirect('/');
        }

        $pdf = new tFPDF();
        $pdf->AddPage();
        $pdf->AddFont('DejaVu', '', 'DejaVuSerif.ttf', 'libraries/tfpdf/font/unifont');
        $pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', 'libraries/tfpdf/font/unifont');
        $pdf->SetFont('DejaVu', '', 16);

        // Add certificate content
        $pdf->Ln(30);
        $pdf->SetFont('DejaVu', 'B', 23);
        $pdf->Cell(0, 10, 'GIẤY CHỨNG NHẬN', 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('DejaVu', '', 12);
        $pdf->Cell(0, 10, 'Chúc mừng, ' . $user['name'] . ' đã hoàn thành khoá học', 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('DejaVu', 'B', 14);
        $pdf->Cell(0, 10, $course['name'], 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetLineWidth(1); // Set the line width for the rectangle
        $pdf->Rect(10, 10, 190, 105); // Draw a rectangle around the content

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="certificate.pdf"');
        echo $pdf->Output('certificate.pdf', 'i');
    }
}
