<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width:1000px">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>
    <?php if ($row) : ?>
        <div class="card-group justify-content-center">

            <form method="post">
                <h3>Edit Class</h3>

                <?php if (count($errors) > 0) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Errors:</strong>
                        <?php foreach ($errors as $error) : ?>
                            <br><?= $error ?>
                        <?php endforeach; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <input autofocus class="form-control" value="<?= get_var('class', $row[0]->class); ?>" type=" " text" name="class" placeholder="Class Name"><br><br>
                <input class="btn btn-primary" type="submit" value="Save">
                <a href="<?= ROOT ?>/classes">
                    <input class="btn btn-danger text-white" type="button" value="Cancel">
                </a>
            </form>

        </div>
    <?php else : ?>
        <div class="text-center">
            <h3>That class was not found!</h3>
            <a href="<?= ROOT ?>/classes">
                <input class="btn btn-danger text-white" type="button" value="Cancel">
            </a>
        </div>
    <?php endif; ?>
</div>
</div>
<?php

?>
<?php $this->view('includes/footer') ?>