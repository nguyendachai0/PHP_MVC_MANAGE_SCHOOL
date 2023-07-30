<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width:1000px">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>
    <nav class="navbar bg-body-tertiary">
        <form class="form-inline">
            <div class="input-group">
                <button class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
                <input value="<?= isset($_GET['find']) ? $_GET['find'] : ''; ?>" name="find" type="text" class="form-control" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1">
            </div>
        </form>
        <a href="<?= ROOT ?>/signup">
            <button class="btn btn-primary"><i class="fa fa-plus"></i>Add new</button>
        </a>
    </nav>

    <div class="card-group justify-content-center">
        <?php if ($rows) : ?>
            <?php foreach ($rows as $row) : ?>
                <?php include(views_path('users'));
                ?>
            <?php endforeach ?>
        <?php else : ?>
            <h4>No staff member were found at this time</h4>
        <?php endif; ?>

    </div>
    <?php $pager->display() ?>
</div>
<?php

?>
<?php $this->view('includes/footer') ?>