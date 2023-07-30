<div class="card-group justify-content-center">
    <form method="post">
        <h3>Add A Test</h3>
        <?php if (count($errors) > 0) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Errors:</strong>
                <?php foreach ($errors as $error) : ?>
                    <br><?= $error ?>
                <?php endforeach; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <input autofocus class="form-control" value="<?= get_var('test'); ?>" type=" " text" name="test" placeholder="Text title"><br>
        <textarea name="description" class="form-control" placeholder="Add a description for this text"><?= get_var('description'); ?></textarea><br>
        <input class="btn btn-primary" type="submit" value="Create">
        <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>/?tab=tests">
            <input class="btn btn-danger text-white" type="button" value="Cancel">
        </a>
    </form>

</div>