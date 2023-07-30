<?php

/**
 * Tests controller
 */
class Tests extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $tests = new Tests_model();
        $school_id = Auth::getSchool_id();
        if (Auth::access('admin')) {
            $query = "select * from tests where school_id = :school_id && year(date) = :school_year order by id desc";
            $arr['school_id'] = $school_id;
            $arr['school_year'] = !empty($_SESSION['SCHOOL_YEAR']->year) ? ($_SESSION['SCHOOL_YEAR'])->year : date("Y", time());

            if (isset($_GET['find'])) {
                $find = '%' . trim($_GET['find']) . '%';
                $query = "select * from tests where school_id = :school_id && (test like :find) && year(date) = :school_year order by id desc";
                $arr['find']  = $find;
            }
            $data = $tests->query($query, $arr);
        } else {
            $disabled = "disabled = 0 &&";
            $mytable = "class_students";
            if (Auth::getRank() == "lecturer") {
                $mytable = "class_lecturers";
                $disabled = "";
            }

            $query = "select * from tests where $disabled class_id in (select class_id from $mytable where user_id = :user_id && disabled = 0) && year(date) = :school_year order by id desc";

            $arr['user_id'] = Auth::getUser_id();
            $arr['school_year'] = !empty($_SESSION['SCHOOL_YEAR']->year) ? ($_SESSION['SCHOOL_YEAR'])->year : date("Y", time());

            if (isset($_GET['find'])) {
                $find = '%' . trim($_GET['find']) . '%';
                $query = "select * from tests where $disabled class_id in (select class_id from $mytable where user_id = :user_id && disabled = 0) && test like :find && year(date) = :school_year order by id desc";
                $arr['find']  = $find;
            }
            $data = $tests->query($query, $arr);
        }

        $crumbs[] = ['Dashboard', '/'];
        $crumbs[] = ['Tests', 'tests'];
        echo $this->view('tests', [
            'test_rows' => $data,
            'crumbs' => $crumbs,
            'unsubmitted' => get_unsubmitted_test_row(),
        ]);
    }
}
//     function add()
//     {
//         if (!Auth::logged_in()) {
//             $this->redirect('login');
//         }
//         $errors = array();
//         if (count($_POST) > 0) {
//             $tests = new Tests_model();
//             if ($tests->validate($_POST)) {

//                 $_POST['date'] = date("Y-m-d H:i:s");
//                 $tests->insert($_POST);
//                 $this->redirect('tests');
//             } else {
//                 //errors
//                 $errors = $tests->errors;
//             }
//         }
//         $tests = new Tests_model();
//         $data = $tests->findAll();
//         $crumbs[] = ['Dashboard', '/'];
//         $crumbs[] = ['Tests', 'tests'];
//         $crumbs[] = ['Add', 'tests/add'];
//         echo $this->view('tests.add', [
//             'crumbs' => $crumbs,
//             'errors' => $errors
//         ]);
//     }
//     public function edit($id = null)
//     {
//         if (!Auth::logged_in()) {
//             $this->redirect('login');
//         }
//         $errors = array();
//         $tests = new Tests_model();

//         if (count($_POST) > 0 && Auth::access('lecturer') && Auth::i_own_content($row)) {
//             if ($tests->validate($_POST)) {

//                 $tests->update($id, $_POST);
//                 $this->redirect('tests');
//             } else {
//                 //errors
//                 $errors = $tests->errors;
//             }
//         }
//         $row = $tests->where('id', $id);
//         $crumbs[] = ['Dashboard', '/'];
//         $crumbs[] = ['Tests', 'tests'];
//         $crumbs[] = ['Edit', 'tests/edit'];

//         if (Auth::access('lecturer') && Auth::i_own_content($row)) {
//             $this->view('tests.edit', [
//                 'row' => $row,
//                 'errors' => $errors,
//                 'crumbs' => $crumbs
//             ]);
//         } else {
//             $this->view('access-denied');
//         }
//     }
//     public function delete($id = null)
//     {
//         if (!Auth::logged_in()) {
//             $this->redirect('login');
//         }


//         $tests = new Tests_model();
//         $errors = array();
//         if (count($_POST) > 0 && Auth::access('lecturer') && Auth::i_own_content($row)) {

//             $tests->delete($id, $_POST);
//             $this->redirect('Tests');
//         }

//         $row = $tests->where('id', $id);
//         $crumbs[] = ['Dashboard', '/'];
//         $crumbs[] = ['Tests', 'tests'];
//         $crumbs[] = ['Delete', 'tests/delete'];
//         if (Auth::access('lecturer') && Auth::i_own_content($row)) {
//             $this->view('tests.delete', [
//                 'crumbs' => $crumbs,
//                 'row' => $row,

//             ]);
//         } else {
//             $this->view('access-denied');
//         }
//     }
// }
