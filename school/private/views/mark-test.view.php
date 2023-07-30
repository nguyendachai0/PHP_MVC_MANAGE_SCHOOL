<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>
<div class="container-fluid p-4 shadow mx-auto" style="max-width:1000px">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>
    <?php if ($row && $answered_test_row && $answered_test_row->submitted && !($row->disabled && Auth::access(('student')))) : ?>

        <div class="row">
            <center>
                <h4><?= esc(ucwords($row->test)) ?></h4>
            </center>
            <center class="row">

                <h5 class="col"> Class: <?= esc(ucwords($row->class->class)) ?></h5>
                <h5 class="col"> Student: <?= $student_row->firstname ?> <?= $student_row->lastname ?></h5>
            </center>
            <table class="table table-hover table-striped table-bordered">
                <tr>

                    <th>Create By:</th>
                    <td><?= esc($row->user->firstname) ?> <?= esc($row->user->lastname) ?></td>

                    <th>Date Created:</th>
                    <td><?= get_date($row->date) ?></td>

                </tr>
                <tr>
                    <?php $active = $row->disabled ? "No" : "Yes"; ?>

                    <td>Class: <?= $row->class->class ?></td ?>
                    </td>

                    <td colspan="5"><strong>Test Description:</strong><br> <?= esc($row->description) ?></td>
                </tr>
            </table>

        </div>
        <hr>


        <?php

        switch ($page_tab) {
            case "view":
                //code..
                include(views_path('mark-test-tab-view'));
                break;
            default:
                //code..
                break;
        }
        ?>
    <?php else : ?>
        <center>
            <h4>That Test was not found!</h4>
        </center>
    <?php endif; ?>
</div>
<?php $this->view('includes/footer') ?>