<?php if ($row->disabled) : ?>

    <nav class="navbar">
        <center>
            <h5>Test Question</h5>
            <p><b>Total Questions: </b><?= $total_questions ?></p>
        </center>


        <!-- Example single danger button -->
        <!-- Example single danger button -->
        <div class="btn-group">
            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Action
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="<?= ROOT ?>/single_test/addquestion/<?= $row->test_id ?>?type=multiple">Add Multiple choice Question</a></li>
                <li><a class="dropdown-item" href="<?= ROOT ?>/single_test/addquestion/<?= $row->test_id ?>?type=objective">Add Object Question </a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= ROOT ?>/single_test/addquestion/<?= $row->test_id ?>">Add Subjective Question</a></li>
            </ul>
        </div>
    </nav>
    <hr>
<?php endif; ?>

<?php if (isset($questions) && is_array($questions)) : ?>
    <?php $num = $total_questions + 1 ?>
    <?php foreach ($questions as $question) : $num-- ?>

        <div class="card mb-4 shadow">
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
                <?php if (!($question->question_type == "multiple")) : ?>

                    <p class="card-text"><b>Answer: </b><?= esc($question->correct_answer) ?></p>

                <?php endif; ?>
                <?php
                $type = '';
                ?>
                <?php if ($question->question_type == "objective") :
                    $type = "?type=objective";
                ?>

                    <p class="card-text"><b>Answer: </b><?= esc($question->correct_answer) ?></p>

                <?php endif; ?>
                <?php if ($question->question_type == "multiple") :
                    $type = "?type=multiple";
                ?>
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            Multiple choice
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php $choices = json_decode($question->choices); ?>
                            <?php foreach ($choices as $letter => $answer) : ?>
                                <li class="list-group-item"><?= $letter ?> : <?= $answer ?>
                                    <?php if (trim($letter) == trim($question->correct_answer)) : ?>
                                        <i class="fa fa-check float-end"></i>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <br>
                    <p class="card-text"><b>Answer: </b><?= esc($question->correct_answer) ?></p>

                <?php endif; ?>

                <div class="d-flex justify-content-end">
                    <?php if ($row->editable) : ?>
                        <a class="text-white" href="<?= ROOT ?>/single_test/editquestion/<?= $row->test_id ?>/<?= $question->id ?><?= $type ?>">
                            <button class="btn btn-sm btn-info text-white pe-1"><i class="fa fa-edit"></i>
                        </a>
                        <a class="text-white" href="<?= ROOT ?>/single_test/deletequestion/<?= $row->test_id ?>/<?= $question->id ?><?= $type ?>">
                            <button class=" btn btn-sm btn-danger text-white pe-1"><i class="fa fa-trash"></i>

                        </a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    <?php endforeach; ?>
<?php endif; ?>