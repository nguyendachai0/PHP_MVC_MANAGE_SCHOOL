<style>
    ul li a {
        width: 110px;
        text-align: center;
        border-left: solid thin #eee;
        border-right: solid this #fff;
    }

    nav ul li a:hover {
        background-color: grey;
        color: white !important;
    }

    .active-nav {
        background-color: #548860;
        color: white !important;
    }
</style>

<nav class="main-nav navbar navbar-expand-lg navbar-light bg-light p-2 mt-2">
    <a class="navbar-brand" href="<?= ROOT ?>">
        <img src="<?= ROOT ?>/assets/logo.png" class="" style="width:50px;">
        <?= Auth::getSchool_name() ?>
    </a>


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?= ($this->controller_name() == 'Home') ? ' active-nav ' : '' ?> " href="<?= ROOT ?>">DASHBOARD</a>
            </li>
            <?php if (Auth::access('super_admin')) :  ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($this->controller_name() == 'Schools') ? ' active-nav ' : '' ?> " href="<?= ROOT ?>/schools">SCHOOL</a>
                </li>
            <?php endif; ?>
            <?php if (Auth::access('admin')) :  ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($this->controller_name() == 'Users') ? ' active-nav ' : '' ?> " href="<?= ROOT ?>/users">STAFF</a>
                </li>
            <?php endif; ?>
            <?php if (Auth::access('reception')) :  ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($this->controller_name() == 'Students') ? ' active-nav ' : '' ?> " href="<?= ROOT ?>/students">STUDENTS</a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link <?= ($this->controller_name() == 'Classes') ? ' active-nav ' : '' ?> " href="<?= ROOT ?>/classes">CLASSES</a>
            </li>
            <li class="nav-item position-relative">
                <a class="nav-link <?= ($this->controller_name() == 'Tests') ? ' active-nav ' : '' ?> " href="<?= ROOT ?>/tests">TESTS</a>
                <?php
                $unsubmitted_count = get_unsubmitted_tests();

                ?>

                <?php if ($unsubmitted_count) : ?>
                    <span class="badge bg-danger text-white" style="position:absolute; top: 0; right:0;"><?= $unsubmitted_count ?></span>
                <?php endif; ?>
            </li>
            <?php if (Auth::access('lecturer')) :  ?>

                <li class="nav-item" style="position:relative;">
                    <a class="nav-link <?= ($this->controller_name() == 'To_mark') ? ' active-nav ' : '' ?> " href="<?= ROOT ?>/to_mark">TO MARK
                        <?php
                        $to_mark_count = (new Tests_model())->get_to_mark_count();
                        ?>
                        <?php if ($to_mark_count) : ?>
                            <span class="badge bg-danger text-white" style="position:absolute; top: 0; right:0;"><?= $to_mark_count ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($this->controller_name() == 'Marked') ? ' active-nav ' : '' ?> " href="<?= ROOT ?>/marked">MARKED</a>
                </li>
            <?php endif; ?>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= Auth::getFirstname() ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="<?= ROOT ?>/profile">Profile</a>
                    <a class="dropdown-item" href="" <?= ROOT ?>>Dashboard</a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item" href="<?= ROOT ?>/logout">Logout</a>
                </div>
            </li>

        </ul>
        <form class="form-inline">

            <div class="input-group">
                <?php $years = get_year() ?>
                <select name="school_year" class="form-select" style="max-width:100px;">
                    <option><?= get_var('school_year', !empty($_SESSION['SCHOOL_YEAR']->year) ? ($_SESSION['SCHOOL_YEAR'])->year : date("Y", time()), "get") ?></option>
                    <?php foreach ($years as $year) : ?>
                        <option><?= $year ?></option>
                    <?php endforeach; ?>
                </select>

                <?= add_get_vars(); ?>
                <button class="input-group-text" id="basic-addon1"><i class="fa fa-chevron-right"></i></button>
            </div>
        </form>
    </div>
</nav>