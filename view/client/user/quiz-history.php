<div class="rbt-dashboard-content bg-color-white rbt-shadow-box">
    <div class="content">
        <div class="section-title">
            <h4 class="rbt-title-style-3">Kết quả quiz của tôi
            </h4>
        </div>

        <div class="rbt-dashboard-table table-responsive mobile-table-750 mt--30">
            <table class="rbt-table table table-borderless">
                <thead>
                    <tr style="white-space: nowrap;">
                        <th>Câu hỏi</th>
                        <th>Số câu hỏi</th>
                        <th>Đúng</th>
                        <th>Sai</th>
                        <th>Điểm</th>
                        <th>Kết quả</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if ($history_quiz['data']) : ?>

                        <?php foreach ($history_quiz['data'] as $history) : ?>
                            <?php
                            $chapter = (new Chapter)->where('id', '=', $history['chapter_id'])->first();
                            $course = (new Course)->where("status", "=", 0)->where('id', '=', $chapter['course_id'])->first();
                            $score = round((($history['total_question'] - $history['incorrect']) / $history['total_question']) * 10, 1);
                            ?>
                            <tr>
                                <th>
                                    <p class="b3 mb--0">Khoá:<span class="h6 mb--5"><?= $course['name'] ?></span></p>
                                    <p class="b3">Chương:<a href="#"><?= $chapter['name'] ?></a></p>
                                </th>
                                <td>
                                    <p class="b3"><?= $history['total_question'] ?></p>
                                </td>
                                <td>
                                    <p class="b3"><?= $history['total_question'] - $history['incorrect'] ?></p>
                                </td>
                                <td>
                                    <p class="b3"><?= $history['incorrect'] ?></p>
                                </td>
                                <td>
                                    <p class="b3"><?= $score ?></p>
                                </td>
                                <td>
                                    <?php if ($score >= 5) :  ?>
                                        <span class="rbt-badge-5 bg-color-success-opacity color-success">Đạt</span>
                                    <?php else : ?>
                                        <span class="rbt-badge-5 bg-color-danger-opacity color-danger">Không đạt</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <p class="b3 mb--5"><?= $history['created_at'] ?></p>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center">Chưa có lịch sử</td>
                        </tr>
                    <?php endif; ?>


                </tbody>

            </table>
        </div>
        <div class="mt--10"> <?= (new Model)->renderHtml($history_quiz) ?></div>

    </div>
</div>