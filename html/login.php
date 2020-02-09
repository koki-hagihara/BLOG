<?php
require_once '../conf/const.php';
require_once MODEL_PATH.'function.php';
require_once MODEL_PATH.'db.php';
require_once MODEL_PATH.'user.php';

session_start();

if (is_logined() === true) {
    header('Location:articles_list.php');
    exit;
}

$err_msg = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = get_post('user_name');
    $password = get_post('password');

    check_user_name($user_name);
    check_password($password);

    if (count($err_msg) === 0) {
        $dbh = get_db_connect();
        $user = select_registered_user($dbh, $user_name, $password);

        set_login_session($user[0]['user_id']);
    }
}

include_once VIEW_PATH.'login_view.php';