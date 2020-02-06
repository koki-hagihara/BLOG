<?php 
require_once '../conf/const.php';
require_once MODEL_PATH.'function.php';
require_once MODEL_PATH.'db.php';
require_once MODEL_PATH.'user.php';

$err_msg = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = get_post('user_name');
    $password = get_post('password');

    $dbh = get_db_connect();
    check_user_name($user_name);
    check_password($password);
    check_duplicate_user($dbh, $user_name, $password);

    if (count($err_msg) === 0) {
        insert_new_user($dbh, $user_name, $password);
        header('Location:./sign_up_result.php');
        exit;
    }
}

include_once VIEW_PATH.'sign_up_view.php';