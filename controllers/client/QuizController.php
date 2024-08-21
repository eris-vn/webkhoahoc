<?php

require_once 'model/course.php';
require_once 'model/chapter.php';
require_once 'model/lesson.php';
require_once 'model/enrollment.php';
require_once 'model/user_lesson.php';
require_once 'model/question.php';
require_once 'model/answer.php';
require_once 'model/history_quiz.php';

class QuizController
{
    function view()
    {
        $user = user();
        $course = (new Course)->where("status", "=", 0)->where('slug', '=', $_GET['course_slug'])->first();

        if (!$course) {
            return view('client.404', 'default');
        }

        $is_enrolled = (new Enrollment)->where('course_id', '=', $course['id'])->where('user_id', '=', $user['id'])->first();
        if (!$is_enrolled) {
            return redirect('/course/' . $course['slug'] . '/details');
        }


        $chapter_id = isset($_GET['chapter']) ? $_GET['chapter'] : 0;
        $chapter = (new Chapter)->where('id', '=', $chapter_id)->first();
        if (!$chapter) {
            return redirect('/course/' . $course['slug'] . '/details');
        }

        $questions = (new Question)->where('chapter_id', '=', $chapter_id)->getArray();

        $lesson_info = null;
        return view('client.course.lesson', compact('course', 'is_enrolled', 'questions', 'lesson_info'), 'lesson');
    }
    function submit()
    {
        validate_api($_POST, [
            'chapter' => ['required:tham số'],
            'answers' => ['required:tham số']
        ]);

        $user = user();
        $chapter = (new Chapter)->where('id', '=', $_POST['chapter'])->first();
        if (!$chapter) {
            return api(['status' => -100, 'msg' => 'Không tìm thấy chương']);
        }

        $total_question = (int)(new Question)->where('chapter_id', '=', $chapter['id'])->count();
        $correct_answer = 0;

        foreach ($_POST['answers'] as $answer) {

            $answer_check = (new Answer)->where('question_id', '=', $answer['question_id'])->where('id', '=', $answer['answer'])->where('correct', '=', 1)->first();

            if ($answer_check) {
                $correct_answer++;
            }
        }

        (new HistoryQuiz)->insert(['user_id' => $user['id'], 'course_id' => $chapter['course_id'], 'chapter_id' => $chapter['id'], 'total_question' => $total_question, 'incorrect' => $total_question - $correct_answer]);
        return api(['status' => 200, 'msg' => 'Gửi thành công']);
    }
}
