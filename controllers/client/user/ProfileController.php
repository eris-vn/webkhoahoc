<?php

class ProfileController
{
    function show_page()
    {
        $user = user();
        return view('client.user.profile', compact('user'), 'user');
    }
}
