<?php
require_once '../conf/const.php';
require_once MODEL_PATH.'db.php';

function check_duplicate_user($dbh, $user_name, $password) {
    $duplicate = select_duplicate_user($dbh, $user_name, $password);
    return get_duplicate_msg($duplicate, $user_name, $password);
}

function select_duplicate_user($dbh, $user_name, $password) {
    try {
        $sql = '
                SELECT
                user_name, password
                FROM
                users
                WHERE
                user_name = ? OR password = ?
                ';
        $user = bindValue_user_information($dbh, $sql, $user_name, $password);
    } catch (PDOException $e) {
        set_error('接続エラー。理由：'.$e->getMessage());
    }
    return $user;
}

function select_registered_user($dbh, $user_name, $password) {
    try {
        $sql = '
                SELECT
                user_id, user_name, password
                FROM
                users
                WHERE
                user_name = ? AND password = ?
                ';
        $user = bindValue_user_information($dbh, $sql, $user_name, $password);
    } catch (PDOException $e) {
        set_error('接続エラー。理由：'.$e->getMessage());
    }
    return $user;
}

function bindValue_user_information($dbh, $sql, $user_name, $password) {
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $user_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $password, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $user;
}

function insert_new_user($dbh, $user_name, $password) {
    try {
        $sql = '
                INSERT INTO users
                (user_name, password, create_date, update_date)
                VALUES
                (?, ?, now(), now())
                ';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $user_name, PDO::PARAM_STR);
        $stmt->bindValue(2, $password, PDO::PARAM_STR);
        $stmt->execute();
        set_message('ユーザー登録が完了しました');
    } catch (PDOException $e) {
        set_error('接続エラー。理由：'.$e->getMessage());
    }
}

function get_logined_user($dbh, $user_id) {
   try {
        $sql = '
                SELECT
                user_id, user_name, user_type
                FROM
                users
                WHERE
                user_id = ?
                ';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        set_error('接続エラー。理由：'.$e->getMessage());
    }
    return $user;
}

function checked_user_type($user_type) {
    if ($user_type !== 0) {
        header('Location:logout.php');
        exit;
    }
}