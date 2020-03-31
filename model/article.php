<?php
require_once '../conf/const.php';
require_once MODEL_PATH.'db.php';
require_once MODEL_PATH.'function.php';

function insert_article($dbh, $user_id, $title, $category, $img_filename, $article) {
    try {
        $sql = '
                INSERT INTO article
                (user_id, title, category_id, img, article, create_datetime, update_datetime)
                VALUES
                (?, ?, ?, ?, ?, now(), now())
                ';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
        $stmt->bindValue(2, $title, PDO::PARAM_STR);
        $stmt->bindValue(3, $category, PDO::PARAM_INT);
        $stmt->bindValue(4, $img_filename, PDO::PARAM_STR);
        $stmt->bindValue(5, $article, PDO::PARAM_STR);
        $stmt->execute();
        set_message('投稿が完了しました');
    } catch (PDOException $e) {
        set_error('接続エラー。理由：'.$e->getMessage());
    }
}