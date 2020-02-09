<?php
require_once '../conf/const.php';

function get_post($name) {
    $str = '';
    if (isset($_POST[$name])) {
        $str = trim($_POST[$name]);
    }
    return $str;
}

function get_post_array($name) {
    $array = array();
    if (isset($_POST[$name]) && is_array($_POST[$name])) {
        $array = $_POST[$name];
    }
    return $array;
}

function set_error($error){
    $_SESSION['__errors'][] = $error;
  }

function set_message($message){
    $_SESSION['__messages'][] = $message;
  }

function get_errors(){
    $errors = get_session('__errors');
    if($errors === ''){
        return array();
    }
    set_session('__errors',  array());
    return $errors;
}

function get_messages(){
    $messages = get_session('__messages');
    if($messages === ''){
      return array();
    }
    set_session('__messages',  array());
    return $messages;
  }

function set_session($name, $value){
    $_SESSION[$name] = $value;
  }

function check_user_name($user_name){
    global $err_msg;
    $user_name_regex = '/^[a-zA-Z0-9]{1,50}$/';
    if ($user_name === '') {
        $err_msg[] = 'ユーザー名を入力してください';
    } else if (preg_match($user_name_regex, $user_name) !== 1) {
        $err_msg[] = 'ユーザー名は半角英数字で入力してください';
    }
}

function check_password($password) {
    global $err_msg;
    $password_regex = '/^[a-zA-Z0-9]{6,50}$/';
    if ($password === '') {
        $err_msg[] = 'パスワードを入力してください';
    } else if (preg_match($password_regex, $password) !== 1) {
        $err_msg[] = 'パスワードは6文字以上の半角英数字で入力してください';
    }
}

function check_add_category($category) {
    if ($category === '') {
        set_error('追加したいカテゴリーを入力してください');
    }
}

function check_delete_category($category_id) {
    $number_regex = '/^[0-9]+$/';
    if (count($category_id) === 0) {
        set_error('削除したいカテゴリーを選択してください');
    } else if (count($category_id) > 0) {
        foreach ($category_id as $id) {
            if (preg_match($number_regex, $id) !== 1) {
                set_error('不正な選択です');
            }
        }
    }
}

function get_duplicate_msg($duplicate, $user_name, $password) {
    global $err_msg;
    if ($duplicate[0]['user_name'] === $user_name) {
        $err_msg[] = 'このユーザー名はすでに使用されています';
    }
    if ($duplicate[0]['password'] === $password) {
        $err_msg[] = 'このパスワードはすでに登録があります';
    }
}

function set_login_session($user_id) {
    global $err_msg;
    if (isset($user_id)) {
        $_SESSION['user_id'] = $user_id;
        header('Location:articles_list.php');
        exit;
    } else {
        $err_msg[] = 'ユーザー名かパスワードが違います';
    }
}

function is_logined() {
    return get_session('user_id') !== '';
}

function get_session($name) {
    if (isset($_SESSION[$name]) === true) {
        return $_SESSION[$name];
    }
    return '';
}

function session_destroy_client_side($session_name) {
    if (isset($_COOKIE[$session_name])) {
        setcookie($session_name, '', time()-10);
    }
}

function entity_str($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}