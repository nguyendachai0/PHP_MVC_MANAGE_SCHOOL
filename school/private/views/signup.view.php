<?php $this->view('includes/header') ?>

<div class="container-fluid">
    <form method="post">
        <div class="form-group row">

            <div class="p-4 mx-auto mt-4 mr-4 shadow rounded" style="width:100%;max-width:310px;">
                <h2 class="text-center">My School</h2>
                <img src="<?= ROOT ?>/assets/logo.png" class="border border-primary d-block mx-auto rounded-circle" style="width:70px">
                <h3>Add User</h3>

                <?php if (count($errors) > 0) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Errors:</strong>
                        <?php foreach ($errors as $error) : ?>
                            <br><?= $error ?>
                        <?php endforeach; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <input class="my-3 form-control" value="<?= get_var('firstname') ?>" type="text" name="firstname" placeholder="First Name" autofocus>
                <input class="my-3 form-control" value="<?= get_var('lastname') ?>" type="text" name="lastname" placeholder="Last Name" autofocus>
                <input class="my-3 form-control" value="<?= get_var('email') ?>" type="email" name="email" placeholder="Email" autofocus>

                <select class="my-2 form-control" name="gender">
                    <option <?= get_select('gender', '') ?> value="">--Select a Gender--</option>
                    <option <?= get_select('gender', 'male') ?> value="male">Male</option>
                    <option <?= get_select('gender', 'female') ?> value="female">Female</option>

                </select>
                <?php if ($mode == 'students') : ?>
                    <input type="hidden" value="student" name="rank">
                <?php else : ?>
                    <select class="my-2 form-control" name="rank">
                        <option <?= get_select('rank', '') ?> value="">--Select a Rank--</option>
                        <option <?= get_select('rank', 'student') ?> value="student">Student</option>
                        <option <?= get_select('rank', 'reception') ?> value="reception">Reception</option>
                        <option <?= get_select('rank', 'lecturer') ?> value="lecturer">Lecturer</option>
                        <option <?= get_select('rank', 'admin') ?> value="admin">Admin</option>
                        <?php if (Auth::getRank() == 'super_admin') : ?>
                            <option <?= get_select('rank', 'super_admin') ?> value="super_admin">Super Admin</option>
                        <?php endif; ?>
                    </select>
                <?php endif; ?>

                <input class="my-3 form-control" type="password" name="password" placeholder="Password">
                <input class="my-3 form-control" type="password" name="password2" placeholder="Retype Password">

                <button class="btn btn-primary">Add user</button>
                <?php if ($mode == 'students') : ?>
                    <a href="<?= ROOT ?>/students">
                        <button type="button" class="btn btn-danger">Cancel</button>
                    </a>
                <?php else : ?>

                    <a href="<?= ROOT ?>/users">
                        <button type="button" class="btn btn-danger">Cancel</button>
                    </a>
                <?php endif; ?>
            </div>

        </div>
        <form method="post">
</div>
<?php $this->view('includes/footer') ?>