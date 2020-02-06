<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>ログイン</title>
        <link rel = "stylesheet" href = "<?php print STYLESHEET_PATH.'html5reset-1.6.1.css';?>">
        <link rel = "stylesheet" href = "<?php print STYLESHEET_PATH.'login.css';?>">
    </head>
    <body>
<?php if (count($err_msg) > 0) {
    foreach ($err_msg as $msg) { ?>
        <p><?php print $msg;?></p>
    <?php }
} ?>
        <h1>メンバーログイン</h1>
        <form method = "post" action = "login.php">
            <div>
                <label for = "user_name">ユーザー名</label>
                <input type = "text" name = "user_name" placeholder = "ユーザー名" id = "user_name">
            </div>
            <div>
                <label for = "password">パスワード</label>
                <input type = "password" name = "password" placeholder = "6文字以上の半角英数字" id = "password">
            </div>
            <div>
                <input type = "submit" value = "ログイン">
            </div>
        </form>
        <div>
            <a href = "sign_up.php">新規登録はこちら</a>
        </div>
    </body>
</html>