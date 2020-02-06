<?php
require_once '../conf/const.php';
require_once MODEL_PATH.'function.php';
require_once MODEL_PATH.'db.php';
require_once MODEL_PATH.'user.php';

session_start();

$dbh = get_db_connect();

if (is_logined() === true) {
    $user_id = get_session('user_id');
    $user = get_logined_user($dbh, $user_id);
} else {
    $user_id = '';
    $user = array();
}



include_once VIEW_PATH.'articles_list_view.php';