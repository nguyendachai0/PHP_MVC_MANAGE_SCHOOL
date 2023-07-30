<nav class="navbar bg-body-tertiary">
    <form class="form-inline">
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
            <input type="text" class="form-control" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1">
        </div>
    </form>
    <div>
        <?php if (Auth::access('lecturer')) : ?>

            <a href="<?= ROOT ?>/single_class/studentadd/<?= $row->class_id ?>?select=true">
                <button class="btn btn-primary"><i class="fa fa-plus"></i>Add new</button>
            </a>
            <a href="<?= ROOT ?>/single_class/studentremove/<?= $row->class_id ?>?select=true">
                <button class="btn btn-primary"><i class="fa fa-minus"></i>Remove</button>
            </a>
        <?php endif; ?>
    </div>
</nav>
<div class="card-group justify-content-center">
    <?php if (is_array($students)) : ?>
        <?php foreach ($students as $student) : ?>
            <?php
            $row = $student->user;
            include(views_path('users'))
            ?>

        <?php endforeach; ?>
    <?php else : ?>
        <center>
            <h4>No students was found in this class</h4>
        </center>
    <?php endif; ?>
</div>
<?php $pager->display() ?>