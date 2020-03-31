<?php
require_once '../conf/const.php';
require_once MODEL_PATH.'function.php';
require_once MODEL_PATH.'user.php';
require_once MODEL_PATH.'db.php';
require_once MODEL_PATH.'category.php';

session_start();

if (is_logined() === false) {
    header('Location:login.php');
    exit;
} else {
    $user_id = get_session('user_id');
}

$dbh = get_db_connect();
$user = get_logined_user($dbh, $user_id);
checked_user_type($user[0]['user_type']);

$category_list = select_category_list($dbh);

include_once VIEW_PATH.'write_article_page_view.php';