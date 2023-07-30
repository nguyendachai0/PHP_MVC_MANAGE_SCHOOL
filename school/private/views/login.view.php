<?php $this->view('includes/header') ?>
<div class="container-fluid">
    <form method="post">
        <div class="form-group row">
            <div class="p-4 mx-auto mt-4 mr-4 shadow rounded" style="width:100%;max-width:310px;">
                <h2 class="text-center">My School</h2>
                <img src="https://th.bing.com/th/id/OIP.iR-L3h8p33r7B8Dn80Lh3AHaHa?pid=ImgDet&rs=1" class="border border-primary d-block mx-auto rounded-circle" style="width:30px">
                <h3>Login</h3>
                <?php if (count($errors) > 0) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Errors:</strong>
                        <?php foreach ($errors as $error) : ?>
                            <br><?= $error ?>
                        <?php endforeach; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <input class="form-control" <?= get_var('email') ?> type="email" name="email" placeholder="Email" autofocus>
                <br>
                <input class="form-control" <?= get_var('password') ?> type="password" name="password" placeholder="Password">
                <br>
                <button class="btn btn-primary">Login</button>
            </div>
        </div>
    </form>
</div>
<?php $this->view('includes/footer') ?>