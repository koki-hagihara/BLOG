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

include_once VIEW_PATH.'sign_up_view.php';