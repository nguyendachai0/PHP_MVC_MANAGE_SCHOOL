<?php $percentage =   get_answer_percentage($row->test_id, $user_id) ?>
<?php $marked_percentage =   get_mark_percentage($row->test_id, $user_id) ?>



<div class="container-fluid text-center">
    <div class="text-danger"><?= $percentage ?>% Answered</div>
    <div class="bg-primary" style="width : <?= $percentage ?>%;height: 5px" ;></div>
    <div class="text-danger"><?= $marked_percentage ?>% Marked</div>
    <div class="bg-primary" style="width : <?= $marked_percentage ?>%;height: 5px" ;></div>
    <?php if ($answered_test_row) : ?>
        <?php if ($answered_test_row->submitted  && !$marked) : ?>
            <div class="text-success">This test has been submitted</div>
            <a onclick="unsubmit_test(event)" href="<?= ROOT ?>/mark_test/<?= $row->test_id ?>/<?= $answered_test_row->user_id ?>?unsubmit=true">
                <button class="btn btn-danger"> Unsubmit Test</button>
            </a>
            <a onclick="set_test_as_marked(event)" href="<?= ROOT ?>/mark_test/<?= $row->test_id ?>/<?= $answered_test_row->user_id ?>?set_marked=true">
                <button class="btn btn-secondary text-white"> Set Test as Marked</button>
            </a>
            <a onclick="auto_mark(event)" href="<?= ROOT ?>/mark_test/<?= $row->test_id ?>/<?= $answered_test_row->user_id ?>?auto_mark=true">
                <button class="btn btn-warning"> Auto mark</button>
            </a>
        <?php endif; ?>
    <?php endif; ?>
</div>
<center>
    <?php $score_percentage  = get_score_percentage($row->test_id, $user_id) ?>
    <small style="font-size:50px;"> Test Score:</small> <br>
    <span style="font-size: 60px;"><?= $score_percentage ?>%</span>

</center>
<nav class="navbar">
    <center>
        <h5>Test Question</h5>
        <p><b>Total Questions: </b><?= $total_questions ?></p>
    </center>


    <!-- Example single danger button -->
    <!-- Example single danger button -->

</nav>
<hr>
<?php if (isset($questions) && is_array($questions)) : ?>
    <?php $num = $pager->offset; ?>
    <?php foreach ($questions as $question) : $num++ ?>

        <?php
        $myanswer = get_answer($saved_answers, $question->id);
        $mymark = get_answer_mark($saved_answers, $question->id);
        ?>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <span class="bg-secondary p-1 rounded text-white d-block"> Questions #<?= $num ?></span>
                <span class="badge bg-primary text-white d-block rounded p-2"> <?= date("F jS, Y H:i:s a", strtotime($question->date)) ?></span>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= esc($question->question) ?></h5>
                <?php if (file_exists($question->image)) : ?>


                    <img src="<?= ROOT . '/' . $question->image ?>" style="width:50%">
                <?php endif; ?>
                <p class="card-text"><?= esc($question->comment) ?></p>
                <?php
                $type = '';
                ?>
                <?php if ($question->question_type == "objective") :
                    $type = "?type=objective";
                ?>
                <?php endif; ?>

                <?php if ($question->question_type == "multiple") :
                    $type = "?type=multiple";
                ?>

                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            Select your answer
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php $choices = json_decode($question->choices);
                            ?>

                            <?php foreach ($choices as $letter => $answer) : ?>
                                <li class="list-group-item"><?= $letter ?> : <?= $answer ?>


                                    <?php if ($myanswer == $letter) : ?>
                                        <i class="fa fa-check float-end"></i>
                                    <?php endif; ?>

                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <br>
                    <hr>
                    Teacher's mark:

                    <div style="font-size: 45px;">
                        <?= ($mymark == 1) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' ?>
                    </div>
                <?php endif; ?>
                <?php if ($question->question_type != "multiple") : ?>

                    <div><b>Answer: </b><?= $myanswer ?></div>

                    Teacher's mark:

                    <div style="font-size: 45px;">
                        <?= ($mymark == 1) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' ?>
                    </div>

                <?php endif; ?>


            </div>

        </div>
    <?php endforeach; ?>




<?php endif; ?>
<?php $pager->display() ?>