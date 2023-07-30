<?php
$quest_type = "Subjective";
if (isset($_GET['type']) && $_GET['type'] == 'objective') {
    $quest_type = 'Objective';
} else 
if (isset($_GET['type']) && $_GET['type'] == 'multiple') {
    $quest_type = 'Multiple Choice';
}
?>
<center>
    <h5>Add <?= $quest_type ?> Question</h5>
</center>
<label>Question: </label>
<form method="post" enctype="multipart/form-data">
    <?php if (count($errors) > 0) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Errors:</strong>
            <?php foreach ($errors as $error) : ?>
                <br><?= $error ?>
            <?php endforeach; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <textarea value="<?= get_var("question") ?>" class="form-control" name="question" placeholder="Type your question here"></textarea>
    <br>
    <div class=" input-group mb-3 pt-4">
        <label class="input-group-text" for="inputGroupFile01">Comment(optional)</label>
        <input name="comment" value="<?= get_var("comment") ?>" type="text" class="form-control" id="" placeholder="Comment">
    </div>
    <div class=" input-group mb-3 pt-4">

        <label class="input-group-text" for="inputGroupFile01"><i class="fa fa-image"></i>image(optional)</label>
        <input name="image" type="file" class="form-control" id="inputGroupFile01">
    </div>
    <?php if (isset($_GET['type']) && $_GET['type'] == 'objective') : ?>
        <div class=" input-group mb-3 pt-4">

            <label class="input-group-text" for="inputGroupFile01">Answer</label>
            <input name="correct_answer" value="<?= get_var("correct_answer") ?>" type="text" class="form-control" id="inputGroupFile011" placeholder="Enter the correct answer here">
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['type']) && $_GET['type'] == 'multiple') : ?>
        <div class="card">
            <div class="card-header bg-secondary text-white d-flex justify-content-between">
                <p> Multiple choice Answers</p>
                <button onclick="add_choice()" type="button" class="btn btn-warning text-white bun-sm">Add answer <i class="fa fa-plus"></i></button>
            </div>
            <ul class="list-group list-group-flush choice-list">
                <?php if (isset($_POST['choice0'])) : ?>
                    <?php  //check for multiple choice answers
                    $num = 0;
                    $letters = ['A', 'B', 'C', 'D', 'F', 'G', 'H', 'I', 'J'];

                    foreach ($_POST as $key => $value) {

                        if (strstr($key, 'choice')) {

                    ?>
                            <li class="list-group-item"><?= $letters[$num] ?> :
                                <input type="text" class="form-control" value="<?= $value ?>" name="<?= $key ?>" placeholder="Type your answer">
                                <label style="cursor: pointer;"> <input type="radio" <?= $letters[$num] == $_POST['correct_answer'] ? 'checked' : ''; ?> value="<?= $letters[$num] ?>" name="correct_answer">Correct answer</label>
                            </li>
                    <?php

                            $num++;
                        }
                    }
                    ?>
                <?php else : ?>
                    <li class="list-group-item">A:
                        <input type="text" class="form-control" name="choice0" placeholder="Type your answer">
                        <label style="cursor: pointer;"> <input type="radio" value="A" name="correct_answer">Correct answer</label>
                    </li>
                    <li class="list-group-item">B:
                        <input type="text" class="form-control" name="choice1" placeholder="Type your answer">
                        <label style="cursor: pointer;"> <input type="radio" value="B" name="correct_answer">Correct answer</label>
                    </li>


                <?php endif; ?>

            </ul>
        </div><br>
    <?php endif; ?>
    <button class="btn btn-danger">Save Question</button>
    <a href="<?= ROOT ?>/single_test/<?= $row->test_id ?>">
        <button type="button" class="btn btn-primary"><i class="fa fa-chevron-left"></i>Back</button>
    </a>
</form>
<script>
    var letters = ['A', 'B', 'C', 'D', 'F', 'G', 'H', 'I', 'J'];

    function add_choice() {

        var choices = document.querySelector(".choice-list");
        if (choices.children.length < letters.length) {
            choices.innerHTML += `      <li class="list-group-item"> ${letters[choices.children.length]} :
                    <input type="text" class="form-control" name="choice${choices.children.length}" placeholder="Type your answer">
                    <label style="cursor: pointer;">   <input type="radio" value="${letters[choices.children.length]}" name="correct_answer">Correct answer </label>
                </li>`;
        }
    }
</script>