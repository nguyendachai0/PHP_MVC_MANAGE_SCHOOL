<h3>Test</h3>
<nav class="navbar bg-body-tertiary">
    <form class="container-fluid">
        <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
            <input value="<?= !empty($_GET['find']) ? $_GET['find'] : '' ?>" name="find" type="text" class="form-control" placeholder="Search" aria-label="Username" aria-describedby="basic-addon1">
            <input type="hidden" name="tab" value="tests">
        </div>
    </form>
</nav>
<?php if ($row->rank == 'student') : ?>
    <?php include(views_path('marked')) ?>
<?php else : ?>
    <?php include(views_path('tests')) ?>

<?php endif; ?>