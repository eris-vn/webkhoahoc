<?php

require_once 'model/course.php';
require_once 'model/question.php';
require_once 'model/answer.php';
require_once 'model/chapter.php';
require_once 'model/model.php';
require_once 'model/history_quiz.php';

class QuestionController
{
    function show_page()
    {
        $user = user();
        $history_quiz = (new HistoryQuiz)->where('user_id', '=', $user['id'])->paginate(10);
        return view('client.user.quiz-history', compact('history_quiz'), 'user');
    }
    function create()
    {
        validate_api($_POST, [
            'name' => ['required:tên câu hỏi'],
            'chapter_id' => ['required:tham số']
        ]);

        $user = user();

        $chapter = (new Chapter)->where('id', '=', $_POST['chapter_id'])->first();
        if (!$chapter) {
            return ['status' => -102, 'msg' => 'Không tìm thấy mục đã chọn'];
        }

        $answers = $_POST['answers'];
        if (count($answers) < 2) {
            return api(['status' => -100, 'msg' => 'Phải có ít nhất 2 câu trả lời']);
        }

        (new Question)->insert(['user_id' => $user['id'], 'course_id' => $chapter['course_id'], 'chapter_id' => $_POST['chapter_id'], 'title' => $_POST['name']]);
        $question = (new Question)->where('user_id', '=', $user['id'])->latest()->first();

        foreach ($_POST['answers'] as $answer) {
            (new Answer)->insert(['question_id' => $question['id'], 'content' => $answer['content'], 'correct' => $answer['is_correct']]);
        }

        return api(['status' => 200, 'msg' => 'Thêm câu hỏi thành công']);
    }
    function info()
    {
        validate_api($_POST, [
            'question_id' => ['required:tham số'],
        ]);

        $user = user();

        $question = (new Question)->where('user_id', '=', $user['id'])->where('id', '=', $_POST['question_id'])->first();
        if (!$question) {
            return ['status' => -101, 'msg' => 'Không tìm thấy câu hỏi'];
        }

        $answers = (new Answer)->where('question_id', '=', $question['id'])->getArray();

        return api(['status' => 200, 'data' => [
            'id' => $question['id'],
            'title' => $question['title'],
            'chapter_id' => $question['chapter_id'],
            'answers' => $answers
        ]]);
    }
    function edit()
    {
        validate_api($_POST, [
            'name' => ['required:tên câu hỏi'],
            'question_id' => ['required:tham số'],
            'chapter_id' => ['required:tham số']
        ]);

        $user = user();

        $question = (new Question)->where('user_id', '=', $user['id'])->where('id', '=', $_POST['question_id'])->first();
        if (!$question) {
            return ['status' => -101, 'msg' => 'Không tìm thấy câu hỏi'];
        }

        $answers = $_POST['answers'];
        if (count($answers) < 2) {
            return api(['status' => -100, 'msg' => 'Phải có ít nhất 2 câu trả lời']);
        }

        (new Question)->where('id', '=', $question['id'])->update(['title' => $_POST['name'], 'chapter_id' => $_POST['chapter_id']]);
        (new Answer)->where('question_id', '=', $question['id'])->delete();

        foreach ($_POST['answers'] as $answer) {
            (new Answer)->insert(['question_id' => $question['id'], 'content' => $answer['content'], 'correct' => $answer['is_correct']]);
        }

        return api(['status' => 200, 'msg' => 'Cập nhật câu hỏi thành công']);
    }
    function delete()
    {
        validate_api($_POST, [
            'question_id' => ['required:tham số'],
        ]);

        $user = user();
        $question = (new Question)->where('user_id', '=', $user['id'])->where('id', '=', $_POST['question_id'])->first();

        if (!$question) {
            return api(['status' => -101, 'msg' => 'Không tìm thấy câu hỏi']);
        }

        (new Answer)->where('question_id', '=', $question['id'])->delete();
        (new Question)->where('id', '=', $_POST['question_id'])->delete();

        return api(['status' => 200, 'msg' => 'Xoá thành công']);
    }
}
