<?php

use LDAP\Result;

require_once 'model/course.php';
require_once 'model/lesson.php';
require_once 'model/chapter.php';
require_once 'model/enrollment.php';
require_once 'model/review.php';

class CourseController
{
    function view_details()
    {
        $course = (new Course)->where("status", "=", 0)->where('slug', '=', $_GET['course_slug'])->first();
        $review = (new Review)->where('course_id', '=', $course['id'])->paginate(10);
        $statistic = [
            'total_review' => 0,
            'ratings' => []
        ];

        if (!$course) {
            return redirect('/404');
        }

        $related_course_by_instructor = (new Course)->where("status", "=", 0)->where('user_id', '=', $course['user_id'])->whereNotIn('id', [$course['id']])->limit(2)->get();

        return view('client.course.details', compact('course', 'review', 'related_course_by_instructor'), 'default');
    }
    function post_review()
    {
        validate_api($_POST, [
            'courses_id' => ['required:tham số'],
            'rate' => ['required:điểm số'],
            'content' => ['required:nội dung đánh giá']
        ]);

        $course = (new Course)->where("status", "=", 0)->where('id', '=', $_POST['courses_id'])->first();

        if (!$course) {
            return api(['status' => -101, 'msg' => 'Không tìm thấy khoá học']);
        }

        $user = user();
        $is_enroll = (new Enrollment)->where('user_id', '=', $user['id'])->where('course_id', '=', $course['id'])->first();
        if (!$is_enroll) {
            return api(['status' => -102, 'msg' => 'Bạn chưa tham gia khoá học này']);
        }

        $is_rated = (new Review)->where('user_id', '=', $user['id'])->where('course_id', '=', $course['id'])->first();
        if ($is_rated) {
            return api(['status' => -103, 'msg' => 'Bạn đã đánh giá khoá học này rồi']);
        }

        (new Review)->insert(['user_id' => $user['id'], 'course_id' => $course['id'], 'content' => htmlspecialchars($_POST['content']), 'rating' => $_POST['rate']]);
        return api(['status' => 200, 'msg' => 'Đăng đánh giá thành công']);
    }
}
