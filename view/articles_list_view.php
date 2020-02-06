<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>TOPページ</title>
        <link rel = "stylesheet" href = "<?php print STYLESHEET_PATH.'html5reset-1.6.1.css';?>">
        <link rel = "stylesheet" href = "<?php print STYLESHEET_PATH.'articles_list.css';?>">
    </head>
    <body>
        <header>
<?php if ($user_id !== '') { ?>
    <a href = "logout.php">ログアウト</a>
<?php } else { ?>
    <a href = "login.php">ログイン</a>
<?php } ?>

<?php if ($user[0]['user_type'] === 0) { ?>
    <a href = "admin.php">管理</a>
<?php } ?>
        </header>
        
        <h1>BLOG</h1>
    </body>
</html>