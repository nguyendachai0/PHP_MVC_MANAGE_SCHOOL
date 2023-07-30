<form method="post" class="form mx-auto" style="width:100%;max-width:400px;">
    <h4>Add Student</h4>
    <?php if (count($errors) > 0) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Errors:</strong>
            <?php foreach ($errors as $error) : ?>
                <br><?= $error ?>
            <?php endforeach; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <input value="<?= get_var('name') ?>" autofocus class=" form-control" type="text" name="name" placeholder="Student name">
    <br><button class="btn btn-primary" name="search">Search</button>
    <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=students">
        <button type="button" class="btn btn-danger">Cancel</button>
    </a>
    <div class="clearfix"></div>
</form>
<form method="post">
    <div class="card-group justify-content-center">


        <?php if (isset(($results))  && $results) : ?>


            <?php foreach ($results as $row) : ?>

                <?php include(views_path('users')) ?>
            <?php endforeach ?>

        <?php else : ?>
            <?php if (count($_POST) > 0) : ?>
                <center>
                    <hr>
                    <h4>No result were found</h4>
                </center>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</form>