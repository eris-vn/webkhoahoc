<?php

require_once 'constants/user.php';
require_once 'model/course.php';
require_once 'model/lesson.php';
require_once 'model/enrollment.php';

class DashboardController
{
    function show()
    {
        $count_instructor = (new User)->where('role', '=', UserCode::INSTRUCTOR)->count();
        $count_course = (new Course)->where("status", "=", 0)->count();
        $count_lesson = (new Lesson)->count();
        $count_enrolled = (new Enrollment)->count();

        return view('admin.dashboard', compact('count_instructor', 'count_course', 'count_lesson', 'count_enrolled'), 'admin');
    }
}
