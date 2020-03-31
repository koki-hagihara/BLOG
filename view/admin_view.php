<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>管理ページ</title>
        <link rel = "stylesheet" href = "<?php print STYLESHEET_PATH.'html5reset-1.6.1.css';?>">
        <link rel = "stylesheet" href = "<?php print STYLESHEET_PATH.'admin.css';?>">
    </head>
    <body>
        <a href = "logout.php">ログアウト</a>
        <h1>管理ページ</h1>

        <h2>記事カテゴリー編集</h2>

<?php include VIEW_PATH . 'templates/messages.php'; ?>

        <p>追加したいカテゴリーを入力してください</p>
        <form method = "post" action = "add_category.php">
            <input type = "text" name = "category">
            <input type = "submit" name = "add_category" value = "追加する">
        </form>

        <p>削除したいカテゴリーを選んでください</p>
        <form method = "post" action = "delete_category.php">
<?php foreach ($category_list as $category) { ?>
            <input type = "checkbox" name = "category_id[]" value = "<?php print $category['category_id'] ;?>"><?php print entity_str($category['category']) ;?>
<?php } ?>
            <input type = "submit" name = "category_delete" value = "削除する">
        </form>

        <a href = "write_article_page.php">記事作成へ</a>
    </body>

</html>