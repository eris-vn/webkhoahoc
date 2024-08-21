<?php

require_once 'model/enrollment.php';
require_once 'model/certificate.php';
require_once 'model/course.php';
require_once 'model/lesson.php';
require_once 'model/review.php';

class DashboardController
{
    function show_page()
    {
        $user = user();
        $reviews = (new Review)->join('courses', 'course_id', '=', 'id')->where('review.user_id', '=', $user['id'])->paginate(10);

        return view('client.user.dashboard', compact('user', 'reviews'), 'user');
    }
}
