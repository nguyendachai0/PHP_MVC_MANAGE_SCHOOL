<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>
<style>
    h1 {
        font-size: 80px;
        color: lightblue;
    }

    a {
        text-decoration: none;
    }

    .card-header {
        font-weight: bold;
    }

    .card {
        min-width: 250px;
    }
</style>
<div class="container-fluid p-4 shadow mx-auto" style="max-width:1000px;">
    <div class="row justify-content-center">
        <?php if (Auth::access('admin')) :  ?>
            <div class="card col-3 shadow rounded m-4 p-0">

                <a href="<?= ROOT ?>/schools">
                    <div class="card-header bg-info bg-gradient">SCHOOLS</div>
                    <h1 class="text-center"><i class="fa fa-graduation-cap"></i></h1>
                    <div class="card-footer bg-info bg-gradient">View all schools</div>
                </a>
            </div>
        <?php endif;  ?>
        <?php if (Auth::access('super_admin')) :  ?>
            <div class="card col-3 shadow rounded m-4 p-0">
                <a href="<?= ROOT ?>/users">
                    <div class="card-header bg-info bg-gradient">STAFF</div>
                    <h1 class="text-center"><i class="fa fa-chalkboard-teacher"></i></h1>
                    <div class="card-footer bg-info bg-gradient">View all staff member</div>
                </a>
            </div>
        <?php endif; ?>
        <?php if (Auth::access('reception')) :  ?>
            <div class="card col-3 shadow rounded m-4 p-0">
                <a href="<?= ROOT ?>/students">
                    <div class="card-header bg-info bg-gradient">STUDENTS</div>
                    <h1 class="text-center"><i class="fa fa-user-graduate"></i></h1>
                    <div class="card-footer bg-info bg-gradient">View all students</div>
                </a>
            </div>
        <?php endif; ?>
        <div class="card col-3 shadow rounded m-4 p-0">
            <a href="<?= ROOT ?>/classes">
                <div class="card-header bg-info bg-gradient">CLASSES</div>
                <h1 class="text-center"><i class="fa fa-university"></i></h1>
                <div class="card-footer bg-info bg-gradient">View all classes</div>
            </a>
        </div>
        <div class="card col-3 shadow rounded m-4 p-0">
            <a href="<?= ROOT ?>/tests">
                <div class="card-header bg-info bg-gradient">TESTS</div>
                <h1 class="text-center"><i class="fa fa-file-signature"></i></h1>
                <div class="card-footer bg-info bg-gradient">View all tests</div>
            </a>
        </div>
        <?php if (Auth::access('admin')) :  ?>
            <div class="card col-3 shadow rounded m-4 p-0">
                <a href="<?= ROOT ?>/statistics">
                    <div class="card-header bg-info bg-gradient">STATISTICS</div>
                    <h1 class="text-center"><i class="fa fa-chart-pie"></i></h1>
                    <div class="card-footer bg-info bg-gradient">View student statistics</div>
                </a>
            </div>
        <?php endif; ?>
        <?php if (Auth::access('admin')) :  ?>
            <div class="card col-3 shadow rounded m-4 p-0">
                <a href="<?= ROOT ?>/settings">
                    <div class="card-header bg-info bg-gradient">SETTING</div>
                    <h1 class="text-center"><i class="fa fa-cogs"></i></h1>
                    <div class="card-footer bg-info bg-gradient">View APP SETTING</div>
                </a>
            </div>
        <?php endif; ?>
        <div class="card col-3 shadow rounded m-4 p-0">
            <a href="<?= ROOT ?>/profile">
                <div class="card-header bg-info bg-gradient">PROFILE</div>
                <h1 class="text-center"><i class="fa fa-id-card"></i></h1>
                <div class="card-footer bg-info bg-gradient">View all profile</div>
            </a>
        </div>
        <div class="card col-3 shadow rounded m-4 p-0">
            <a href="<?= ROOT ?>/logout">
                <div class="card-header bg-info bg-gradient">LOGOUT</div>
                <h1 class="text-center"><i class="fa fa-sign-out-alt"></i></h1>
                <div class="card-footer bg-info bg-gradient">View all classes</div>
            </a>
        </div>

    </div>
</div>

<?php $this->view('includes/footer') ?>