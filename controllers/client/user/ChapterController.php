<?php

require_once 'model/course.php';
require_once 'model/chapter.php';

class ChapterController
{
    function get_list()
    {
    }
    function create()
    {
        validate_api($_POST, [
            'course_id' => ['required:tham số'],
            'name' => ['required:tên']
        ]);

        $user = user();
        $course = (new Course)->where("status", "=", 0)->where('id', '=', $_POST['course_id'])->where('user_id', '=', $user['id'])->first();

        if (!$course) {
            return ['status' => -101, 'msg' => 'Không tìm thấy khoá học'];
        }

        (new Chapter)->insert(['name' => $_POST['name'], 'course_id' => $course['id']]);
        return api(['status' => 200, 'msg' => 'Thêm danh mục khoá học thành công']);
    }
}
