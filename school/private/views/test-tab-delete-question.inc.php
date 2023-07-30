<?php
$quest_type = "Subjective";
if (isset($_GET['type']) && $_GET['type'] == 'objective') {
    $quest_type = 'Objective';
} else 
if (isset($_GET['type']) && $_GET['type'] == 'multiple') {
    $quest_type = 'Multiple Choice';
}
?>
<?php if (is_object($question)) : ?>
    <center>
        <h5>Delete <?= $quest_type ?> Question</h5>
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
        <textarea readonly class="form-control" name="question" placeholder="Type your question here"> <?= get_var('question', $question->question) ?></textarea>
        <br>
        <div class=" input-group mb-3 pt-4">
            <label class="input-group-text" for="inputGroupFile01">Comment(optional)</label>
            <input readonly name="comment" value="<?= get_var('comment', $question->comment) ?>" type="text" class="form-control" id="" placeholder="Comment">
        </div>

        <div>
            <?php if (file_exists($question->image)) : ?>
                <img src="<?= ROOT . '/' . $question->image ?>" class="d-block mx-auto w-50">
            <?php endif; ?>
        </div>


        <button class="btn btn-danger">Delete</button>
        <a href="<?= ROOT ?>/single_test/<?= $row->test_id ?>">
            <button type="button" class="btn btn-primary"><i class="fa fa-chevron-left"></i>Back</button>
        </a>
    </form>
<?php else : ?>
    Sorry that question was not found!<a href="<?= ROOT ?>/single_test/<?= $row->test_id ?>">
        <button type="button" class="btn btn-primary"><i class="fa fa-chevron-left"></i>Back</button>
    </a>
<?php endif; ?>