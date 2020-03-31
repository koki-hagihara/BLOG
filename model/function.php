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

function upload_img($name) {
    $img_filename = '';
    if (is_uploaded_file($_FILES[$name]['tmp_name']) === TRUE) {
        $extension = pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);
        if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png') {
            $img_filename = sha1(uniqid(mt_rand(), true)).'.'.$extension;
            if (is_file(IMAGE_DIR.$img_filename) !== TRUE) {
                if (move_uploaded_file($_FILES[$name]['tmp_name'], IMAGE_DIR.$img_filename) !== TRUE) {
                    set_error('ファイルのアップロードに失敗しました');
                }
            } else {
                set_error('ファイルアップロードに失敗しました。再度お試しください');
            }
        } else {
            set_error('ファイル形式が異なります。画像ファイルはJPEGまたはPNGのみ利用可能です');
        }
    } else {
        return $img_filename;
    }
    return $img_filename;
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
    $user_name_regex = '/^[a-zA-Z0-9]{1,50}$/';
    if ($user_name === '') {
        set_error('ユーザー名を入力してください');
        return false;
    } else if (preg_match($user_name_regex, $user_name) !== 1) {
        set_error('ユーザー名は半角英数字で入力してください');
        return false;
    }
    return true;
}

function check_password($password) {
    $password_regex = '/^[a-zA-Z0-9]{6,50}$/';
    if ($password === '') {
        set_error('パスワードを入力してください');
        return false;
    } else if (preg_match($password_regex, $password) !== 1) {
        set_error('パスワードは6文字以上の半角英数字で入力してください');
        return false;
    }
    return true;
}

function check_add_category($category) {
    if ($category === '') {
        set_error('追加したいカテゴリーを入力してください');
    }
}

function check_delete_category($category_id) {
    $number_regex = '/^[0-9]+$/';
    if (count($category_id) === 0) {
        set_error('削除するカテゴリーを選択してください');
    } else if (count($category_id) > 0) {
        foreach ($category_id as $id) {
            if (preg_match($number_regex, $id) !== 1) {
                set_error('不正な選択です');
            }
        }
    }
}

function check_post_category($category) {
    $number_regex = '/^[0-9]+$/';
    if ($category === '') {
        set_error('カテゴリーが選択されていません');
    } else if (preg_match($number_regex, $category) !== 1) {
        set_error('カテゴリー選択が不正です');
    }
}

function check_post_title($title) {
    if ($title === '') {
        set_error('記事タイトルを入力してください');
    } else if (mb_strlen($title) > 30) {
        set_error('タイトルは30文字以内で入力してください');
    }
}

function check_post_article($article) {
    if ($article === '') {
        set_error('記事を入力してください');
    } else if (mb_strlen($article) > 2000) {
        set_error('記事は2000字以内で入力してください');
    }
}

function checked_user_type($user_type) {
    if ($user_type !== 0) {
        header('Location:logout.php');
        exit;
    }
}

function get_duplicate_msg($duplicate, $user_name, $password) {
    if ($duplicate[0]['user_name'] === $user_name) {
        set_error('このユーザー名はすでに使用されています');
        return false;
    }
    if ($duplicate[0]['password'] === $password) {
        set_error('このパスワードはすでに登録があります');
        return false;
    }
    return true;
}

function set_login_session($user_id) {
    if (isset($user_id)) {
        $_SESSION['user_id'] = $user_id;
        header('Location:articles_list.php');
        exit;
    } else {
        set_error('ユーザー名かパスワードが違います');
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