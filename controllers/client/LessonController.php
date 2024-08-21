<?php

require_once 'model/course.php';
require_once 'model/chapter.php';
require_once 'model/lesson.php';
require_once 'model/enrollment.php';
require_once 'model/user_lesson.php';
require_once 'model/question.php';
require_once 'model/answer.php';

class LessonController
{
    function view()
    {
        $user = user();
        $course = (new Course)->where("status", "=", 0)->where('slug', '=', $_GET['course_slug'])->first();

        if (!$course) {
            return view('client.404', 'default');
        }

        $is_enrolled = (new Enrollment)->where('course_id', '=', $course['id'])->where('user_id', '=', $user['id'])->first();
        $lesson_info = (new Lesson)->where('course_id', '=', $course['id'])->where('id', '=', isset($_GET['id']) ? $_GET['id'] : 0)->first();

        if (!$lesson_info || (!$is_enrolled && $lesson_info['preview'] == 0)) {
            return redirect('/course/' . $course['slug'] . '/details');
        }

        $finish_check = (new UserLesson)->where('user_id', '=', $user['id'])->where('lesson_id', '=', $lesson_info['id'])->first();

        if (!$finish_check) {
            (new UserLesson)->insert(['user_id' => $user['id'], 'lesson_id' => $lesson_info['id'], 'course_id' => $lesson_info['course_id'], 'completed' => 0]);
        }


        $previous = (new Lesson)->where('id', '<', $lesson_info['id'])->where('course_id', '=', $course['id'])->orderBy('id', 'desc')->first();
        $next = (new Lesson)->where('id', '>', $lesson_info['id'])->where('course_id', '=', $course['id'])->orderBy('id', 'asc')->first();

        return view('client.course.lesson', compact('course', 'is_enrolled', 'lesson_info', 'previous', 'next', 'finish_check'), 'lesson');
    }
    function mark_completed()
    {
        validate_api($_POST, [
            'id' => ['required:tham số']
        ]);

        $user = user();
        $lesson = (new Lesson)->where('id', '=', $_POST['id'])->first();

        if (!$lesson) {
            return api(['status' => -100, 'msg' => 'Không tìm thấy bài học.']);
        }

        $finish_check = (new UserLesson)->where('user_id', '=', $user['id'])->where('lesson_id', '=', $lesson['id'])->first();

        if (!$finish_check) {
            return api(['status' => -101, 'msg' => 'Vui lòng tải lại trang và thử lại.']);
        }

        (new UserLesson)->where('id', '=', $finish_check['id'])->update(['completed' => 1, 'completed_at' => date("Y/m/d h:i:s")]);
        return api(['status' => 200, 'msg' => 'Dánh dấu thành công']);
    }
}
