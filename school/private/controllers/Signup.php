<?php

/**
 * Sign up controller
 */
class Signup extends Controller
{
    //code


    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $mode = isset($_GET['mode']) ? $_GET['mode'] : 'users';

        //code..
        $errors = array();
        if (count($_POST) > 0) {
            $user = new User();
            if ($user->validate($_POST)) {

                $_POST['date'] = date("Y-m-d H:i:s");
                if (Auth::access('reception')) {
                    if ($_POST['rank'] == 'super_admin' && $_SESSION['USER']->rank != 'super_admin') {
                        $_POST['rank'] = 'admin';
                    }
                    $user->insert($_POST);
                }
                $redirect = $mode == 'students' ? 'students' : 'users';
                $this->redirect($redirect);
            } else {
                //errors
                $errors = $user->errors;
            }
        }
        if (Auth::access('reception')) {
            $this->view('signup', [
                'errors' => $errors,
                'mode' => $mode,
            ]);
        } else {
            $this->view('access-denied');
        }
    }
}
