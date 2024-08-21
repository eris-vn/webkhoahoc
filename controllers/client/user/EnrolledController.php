<?php

require_once 'model/course.php';
require_once 'model/enrollment.php';
require_once 'model/lesson.php';
require_once 'model/user_lesson.php';


class EnrolledController
{
    function show()
    {
        $user = user();
        $enrolled = (new Enrollment)->where('user_id', '=', $user['id'])->paginate(6);
        return view('client.user.enrolled', compact('enrolled'), 'user');
    }
}
