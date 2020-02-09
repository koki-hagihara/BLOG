<?php

function select_category_list($dbh) {
    try {
        $sql = '
                SELECT
                category_id, category
                FROM
                categories
                ';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $category_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        set_error('データ取得失敗。理由：'.$e->getMessage());
    }
    return $category_list;
}

function add_category($dbh, $category) {
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
        set_message('カテゴリーの追加が完了しました');
    } catch (PDOException $e) {
        set_error('カテゴリー追加できませんでした。理由：'.$e->getMessage());
    }
}

function delete_category($dbh, $category_id) {
    try {
        foreach ($category_id as $id) {
            $sql = '
                    DELETE
                    FROM
                    categories
                    WHERE
                    category_id = ?
                    ';
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        set_message('カテゴリーの削除ができました');
    } catch (PDOException $e) {
        set_error('カテゴリー削除に失敗しました。理由：'.$e->getMessage());
    }
}