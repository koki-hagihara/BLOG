<?php

function add_category($dbh, $category) {
    global $err_msg;
    global $message;
    try {
        $sql = '
                INSERT INTO 
                categories
                (category, create_date, update_date)
                VALUES
                (?, now(), now())
                ';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $category, PDO::PARAM_STR);
        $stmt->execute();
        $message[] = 'カテゴリーの追加が完了しました';
    } catch (PDOException $e) {
        $err_msg[] = 'カテゴリー追加できませんでした。理由：'.$e->getMessage();
    }
}