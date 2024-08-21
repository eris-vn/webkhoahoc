<?php
require_once 'constants/card.php';
require_once 'model/user.php';
require_once 'constants/user.php';
require_once 'model/course.php';
require_once 'model/lesson.php';
require_once 'model/enrollment.php';

class SearchController
{
    function searchpage()
    {
        $instructors = (new User)->where('role', '=', UserCode::INSTRUCTOR)->get();
        $search_course = (new Course)->where("status", "=", 0)->limit(6)->paginate(6);
        return view('client.search', compact('search_course', 'instructors'), 'default');
    }
    function search()
    {
        // validate_api($_POST, [
        //     'keyword' => ['required:từ khóa']
        // ]);
        $sb_author = isset($_POST['sb_author']) ? $_POST['sb_author'] : null;
        $sb_offer = isset($_POST['sb_offer']) ? $_POST['sb_offer'] : null;

        $course = (new Course)->where("status", "=", 0)->where('name', 'like', '%' . $_POST['keyword'] . '%')->when($_POST['sort_by'], function ($query) {
            // $query->orderBy('price', $_POST['sort_by']);
        })->when($sb_author, function ($query) {
            $query->whereIn('user_id', $_POST['sb_author']);
        })->when($sb_offer == "0" || $sb_offer == "1", function ($query) {
            if ($_POST['sb_offer'] == '0') {
                $query->where('price', '=', 0);
            } else {
                $query->where('price', '!=', 0);
            }
        })->limit(6)->getArray();

        return api(['status' => 200, 'data' => $this->convert($course)]);
    }
    function convert($data)
    {
        $results = [];

        foreach ($data as $item) {
            $user = (new User)->where('id', '=', $item['user_id'])->first();
            $results[] = [
                'id' => $item['id'],
                'slug' => $item['slug'],
                'thumbnails' => $item['thumbnails'],
                'name' => $item['name'],
                'short_description' => $item['short_description'],
                'price' => $item['price'],
                'discounted_price' => $item['discounted_price'],
                'user' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'avatar' => $user['avatar_url']
                ],
                'lesson' => (new Lesson)->where('course_id', '=', $item['id'])->count(),
                'enrollment' => (new Enrollment)->where('course_id', '=', $item['id'])->count()
            ];
        }
        return $results;
    }
}
