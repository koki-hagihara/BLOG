<?php
require_once '../conf/const.php';
require_once MODEL_PATH.'function.php';


session_start();

$session_name = session_name();

$_SESSION = array();

session_destroy_client_side($session_name);

session_destroy();

header('Location:login.php');
exit;