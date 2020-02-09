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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = get_post('user_name');
    $password = get_post('password');

    $check_user_name = check_user_name($user_name);
    $check_password = check_password($password);

    if ($check_user_name === true && $check_password === true) {
        $dbh = get_db_connect();
        $user = select_registered_user($dbh, $user_name, $password);

        set_login_session($user[0]['user_id']);
    }
}
header('Location:login.php');
exit;