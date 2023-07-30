<div class="card-group justify-content-center">
    <div class="table-responsive container-fluid p-0">
        <table class="table table-striped">
            <tr>
                <th></th>
                <th>Test Name</th>
                <th>Created by</th>
                <th>Active</th>
                <th>Date</th>
                <th>
                    Answered
                </th>
                <th></th>

            </tr>
            <?php if (isset($test_rows) && $test_rows) : ?>
                <?php foreach ($test_rows as $test_row) : ?>
                    <tr style="<?= (in_array($test_row->test_id, $unsubmitted)) ? 'background-color: aquamarine' : '' ?>">
                        <td style="<?= (in_array($test_row->test_id, $unsubmitted)) ? 'background-color: aquamarine' : '' ?>">
                            <?php if (Auth::access('lecturer')) : ?>
                                <a href=" <?= ROOT ?>/single_test/<?= $test_row->test_id ?>">
                                    <button class="btn btn-sm btn-primary"><i class="fa fa-chevron-right"></i></button>
                                </a>
                            <?php endif; ?>
                        </td>
                        <?php $active = $test_row->disabled ? "No" : "Yes"; ?>
                        <td style="<?= (in_array($test_row->test_id, $unsubmitted)) ? 'background-color: aquamarine' : '' ?>"><?= $test_row->test ?></td>


                        <td style="<?= (in_array($test_row->test_id, $unsubmitted)) ? 'background-color: aquamarine' : '' ?>"><?= $test_row->user->firstname ?> <?= $test_row->user->lastname ?></td>
                        <td style="<?= (in_array($test_row->test_id, $unsubmitted)) ? 'background-color: aquamarine' : '' ?>"><?= $active ?></td>
                        <td style="<?= (in_array($test_row->test_id, $unsubmitted)) ? 'background-color: aquamarine' : '' ?>"><?= get_date($test_row->date) ?></td>
                        <td style="<?= (in_array($test_row->test_id, $unsubmitted)) ? 'background-color: aquamarine' : '' ?>">
                            <?php
                            $myid = get_class($this) == "Profile" ? $row->user_id : Auth::getUser_id();
                            $percentage = get_answer_percentage($test_row->test_id, $myid);
                            ?>
                            <?= $percentage ?>%
                        </td>
                        <td style="<?= (in_array($test_row->test_id, $unsubmitted)) ? 'background-color: aquamarine' : '' ?>">
                            <?php if (can_take_test($test_row->test_id)) : ?>
                                <a href="<?= ROOT ?>/take_test/<?= $test_row->test_id ?>">
                                    <button class="btn btn-sm btn-primary">Take this test</button>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>

                <?php endforeach ?>
            <?php else : ?>

                <tr class="text-center">
                    <td colspan="10">No tests were found at this time

                    </td>
                </tr>

            <?php endif; ?>
        </table>
    </div>
</div>