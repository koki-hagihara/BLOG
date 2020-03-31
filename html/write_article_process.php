<?php
require_once '../conf/const.php';
require_once MODEL_PATH.'function.php';
require_once MODEL_PATH.'db.php';
require_once MODEL_PATH.'user.php'; 
require_once MODEL_PATH.'article.php';


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

$_SESSION['__errors'] = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = get_post('category');
    $title = get_post('title');
    $article = get_post('article');
    $img_filename = upload_img('new_img');

    check_post_category($category);
    check_post_title($title);
    check_post_article($article);

    if (count($_SESSION['__errors']) === 0) {
        insert_article($dbh, $user_id, $title, $category, $img_filename, $article);
    }
    header('Location:write_article_page.php');
    exit;
}