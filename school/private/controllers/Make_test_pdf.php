<?php

/**
 * make test pdf controller
 */
class Make_test_pdf extends Controller
{
    function index($id = '', $user_id = '')
    {



        $tests = new Tests_model();
        $row = $tests->first('test_id', $id);
        $answers = new Answers_model();
        $query = "select question_id, answer,answer_mark from answers where user_id = :user_id && test_id = :test_id";


        $saved_answers = $answers->query($query, [
            'user_id' => $user_id,
            'test_id' => $id

        ]);



        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['classes', 'classes'];

        if ($row) {
            $crumbs[] = [$row->test, ''];
        }
        $page_tab = 'view';
        $db = new database();


        $limit = 100;
        $pager = new Pager($limit);
        $offset = $pager->offset;
        $results = false;
        $quest = new Questions_model();
        $questions = $quest->where("test_id", $id, 'asc', $limit, $offset);
        $all_questions = $quest->query("select * from test_questions where test_id = :test_id", ['test_id' => $id]);


        $total_questions = is_array($all_questions) ? count($all_questions) : 0;



        $data['answered_test_row']    = $tests->get_answered_test($id, $user_id);
        $data['submitted'] = false;
        //set submitted variable
        if (isset($data['answered_test_row']->submitted) && $data['answered_test_row']->submitted == 1) {
            $data['submitted'] = true;
        }
        //set marked variable
        $data['marked'] = false;
        if (isset($data['answered_test_row']->marked) && $data['answered_test_row']->marked == 1) {
            $data['marked'] = true;
        }
        //get student information
        if ($data['answered_test_row']) {
            $user = new User();
            $data['student_row'] = $user->first('user_id', $data['answered_test_row']->user_id);
        }
        extract($data);
?>
        <?php if ($row && $answered_test_row && $answered_test_row->submitted) : ?>

            <style>
                table {
                    width: 100%;
                    background-color: rgba(255, 255, 255, 0.8);
                    color: #0f54c4;
                    font-family: roboto;
                }

                table,
                th,
                td {
                    border: 1px solid #999;
                    border-collapse: collapse;
                }

                th,
                td {
                    padding: 5px;
                }

                td a {
                    text-decoration: none;
                    color: #000;
                }

                th {
                    color: #d1d1d1;
                    background-color: #434a54;
                }
            </style>
            <br>
            <div style="font-family:roboto; font-size:18px;max-width:1000px;margin:auto;">
                <table>
                    <tr>
                        <td colspan="4" style="font-size:20px;text-align:center;">Test: <?= esc(ucwords($row->test)) ?></td>
                    </tr>
                    <tr>
                        <th> Class:</th>
                        <td>
                            <?= esc(ucwords($row->class->class)) ?>
                        </td>
                        <th>
                            Student:
                        </th>
                        <td>
                            <?= $student_row->firstname ?> <?= $student_row->lastname ?>

                        </td>
                    </tr>


                    <tr>

                        <th>Create By:</th>
                        <td>

                            <?= esc($row->user->firstname) ?> <?= esc($row->user->lastname) ?>
                        </td>
                        <th>Date Created:</th>
                        <td><?= get_date($row->date) ?></td>
                    </tr>
                    <tr>
                        <?php $active = $row->disabled ? "No" : "Yes"; ?>



                        <td colspan="4" style="text-align:center;"><strong>Test Description:</strong><br> <?= esc($row->description) ?></td>
                    </tr>
                </table>
                <br>

                <?php $percentage =   get_answer_percentage($row->test_id, $user_id) ?>
                <?php $marked_percentage =   get_mark_percentage($row->test_id, $user_id) ?>



                <div>
                    <span class="text-danger"><?= $percentage ?>% Answered |
                        <?= $marked_percentage ?>% Marked</span>

                </div>
                <?php if ($marked) : ?>
                    <center>
                        <?php $score_percentage  = get_score_percentage($row->test_id, $user_id) ?>
                        <small style="font-size:50px;"> Test Score:</small> <br>
                        <span style="font-size: 60px;"><?= $score_percentage ?>%</span>

                    </center>
                <?php endif; ?>
                <nav class="navbar">
                    <center>
                        <h5>Test Question</h5>
                        <p><b>Total Questions: </b><?= $total_questions ?></p>
                    </center>



                </nav>
                <hr>
                <?php if (isset($questions) && is_array($questions)) : ?>
                    <?php $num = $pager->offset; ?>
                    <?php foreach ($questions as $question) : $num++ ?>

                        <?php
                        $myanswer = get_answer($saved_answers, $question->id);
                        $mymark = get_answer_mark($saved_answers, $question->id);
                        ?>
                        <div style="">
                            <div>
                                <span> Questions #<?= $num ?></span>
                            </div>

                            <div>
                                <h5><?= esc($question->question) ?></h5>
                                <?php if (file_exists($question->image)) : ?>


                                    <img src="<?= ROOT . '/' . $question->image ?>" style="width:50%">
                                <?php endif; ?>
                                <p><?= esc($question->comment) ?></p>
                                <?php
                                $type = '';
                                ?>
                                <div style="background-color: #eee;padding:10px">
                                    <?php if ($question->question_type == "objective") :
                                        $type = "?type=objective";
                                    ?>
                                    <?php endif; ?>

                                    <?php if ($question->question_type == "multiple") :
                                        $type = "?type=multiple";
                                    ?>


                                        <br>
                                        <hr>
                                        Teacher's mark:

                                        <div style="font-size: 20px; float:right;">
                                            <?= ($mymark == 1) ? 'Correct' : 'Wrong' ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($question->question_type != "multiple") : ?>

                                        <div><b>Student's answer: </b><?= $myanswer ?></div>

                                        <b>Teacher's mark:</b>

                                        <div style="font-size: 20px; float:right;">
                                            <?= ($mymark == 1) ? 'Correct' : 'Wrong' ?>
                                        </div>

                                    <?php endif; ?>

                                </div>
                            </div>

                        </div>
                        <hr>
                    <?php endforeach; ?>




                <?php endif; ?>
            </div>
        <?php endif; ?>
<?php
    }
}
