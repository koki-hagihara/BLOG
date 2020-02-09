<?php
require_once '../conf/const.php';
require_once MODEL_PATH.'function.php';
require_once MODEL_PATH.'db.php';
require_once MODEL_PATH.'user.php';
require_once MODEL_PATH.'category.php';

session_start();

if (is_logined() === false) {
    header('Location:login.php');
    exit;
}

$dbh = get_db_connect();
$user_id = get_session('user_id');
$user = get_logined_user($dbh, $user_id);
checked_user_type($user[0]['user_type']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['category_delete'])) {
        $category_id = get_post_array('category_id');

        check_delete_category($category_id);

        if (count($_SESSION['__errors']) === 0) {
            delete_category($dbh, $category_id);
        }
    }
}

header('Location:admin.php');
exit;
