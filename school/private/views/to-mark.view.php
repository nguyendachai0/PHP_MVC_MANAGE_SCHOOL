<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width:1000px">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>
    <h5>Tests to mark</h5>
    <nav class="navbar bg-body-tertiary">
        <form class="form-inline">
            <div class="input-group">
                <button class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
                <input value="<?= isset($_GET['find']) ? $_GET['find'] : ''; ?>" name="find" type="text" class="form-control" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1">
            </div>
        </form>

    </nav>
    <?php include(views_path('to-mark')) ?>
</div>
<?php

?>
<?php $this->view('includes/footer') ?>