<?php


require_once 'model/course.php';
require_once 'model/enrollment.php';
require_once 'model/lesson.php';

class ProfileController
{
    function show_page()
    {
        $user_id = isset($_GET['user_id']) ?  $_GET['user_id'] : 0;
        $profile = (new User)->where('id', '=', $user_id)->first();

        if (!$profile) {
            return redirect('/');
        }

        $courses = (new Course)->where("status", "=", 0)->where('user_id', '=', $profile['id'])->paginate(6);

        return view('client.profile', compact('profile', 'courses'), 'default');
    }
}
