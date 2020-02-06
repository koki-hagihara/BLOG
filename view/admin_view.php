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

        <p>追加したいカテゴリーを入力してください</p>
        <form method = "post" action = "admin.php">
            <input type = "text" name = "category">
            <input type = "submit" name = "add_category" value = "追加する">
        </form>
<?php if (count($err_msg) > 0) {
    foreach ($err_msg as $msg) { ?>
        <p><?php print $msg ;?>
    <?php }
} else if (count($message) > 0) {
    foreach ($message as $str) { ?>
        <p><?php print $str ;?>
    <?php }
} ?>

    </body>
</html>