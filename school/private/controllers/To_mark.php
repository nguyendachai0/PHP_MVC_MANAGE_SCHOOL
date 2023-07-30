<?php

/**
 * to-mark controller
 */
class To_mark extends Controller
{
    function index()
    {
        if (!Auth::access('lecturer')) {
            $this->redirect('access-denied');
        }
        $test = new Tests_model();
        $school_id = Auth::getSchool_id();
        if (Auth::access('admin')) {
            $query = "select * from answered_tests where test_id in(select test_id from tests where school_id = :school_id) && submitted = 1 && marked = 0 && year(date) = :school_year order by id desc";

            $arr['school_id'] = $school_id;
            $arr['school_year'] = !empty($_SESSION['SCHOOL_YEAR']->year) ? ($_SESSION['SCHOOL_YEAR'])->year : date("Y", time());

            if (isset($_GET['find'])) {
                $find = '%' . trim($_GET['find']) . '%';
                $query = "select * from tests where school_id = :school_id && (test like :find) order by id desc";
                $arr['find']  = $find;
            }
            $to_mark = $test->query($query, $arr);
        } else {

            $mytable = "class_lecturers";
            $arr['user_id'] = Auth::getUser_id();
            $arr['school_year'] = !empty($_SESSION['SCHOOL_YEAR']->year) ? ($_SESSION['SCHOOL_YEAR'])->year : date("Y", time());

            $query = "select * from answered_tests where test_id in(select test_id from tests where class_id in (SELECT class_id from `class_lecturers` where user_id = :user_id)) && submitted = 1 && marked = 0 && year(date) = :school_year  order by id desc";

            $to_mark = $test->query($query, $arr);

            /*
            
            if (isset($_GET['find'])) {
                $find = '%' . trim($_GET['find']) . '%';
                $query = "select tests.test, {$mytable}.* from $mytable join tests on tests.test_id = {$mytable}.test_id where {$mytable}.user_id = :user_id && disabled = 0 && tests.test like :find";
                $arr['find']  = $find;
            }
            */
        }
        if ($to_mark) {
            //get tests row data
            foreach ($to_mark as $key => $value) {
                $a = $test->first('test_id', $value->test_id);
                if ($a) {
                    $to_mark[$key]->test_details = $a;
                }
            }
        }

        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['To Mark', 'to-mark'];
        echo $this->view('to-mark', [
            'test_rows' => $to_mark,
            'crumbs' => $crumbs
        ]);
    }
}
