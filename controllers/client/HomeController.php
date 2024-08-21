<?php

require_once 'constants/card.php';
require_once 'model/user.php';
require_once 'constants/user.php';
require_once 'model/course.php';
require_once 'model/lesson.php';
require_once 'model/enrollment.php';

class HomeController
{
    function homepage()
    {
        $courses = (new Course)->where("status", "=", 0)->limit(3)->getArray();
        $popular_course = (new Course)->where("status", "=", 0)->limit(6)->getArray();
        $count_instructor = (new User)->where('role', '=', UserCode::INSTRUCTOR)->count();
        $count_course = (new Course)->where("status", "=", 0)->count();
        $count_lesson = (new Lesson)->count();
        $count_enrolled = (new Enrollment)->count();

        return view('client.home', compact('courses', 'popular_course', 'count_instructor', 'count_course', 'count_lesson', 'count_enrolled'), 'default');
    }

    function page_not_found()
    {
        return page_not_found();
    }

    function show_contact()
    {
        return view('client.contact', 'default');
    }
    function show_about()
    {
        return view('client.about', 'default');
    }
}
