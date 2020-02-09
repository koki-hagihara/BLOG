<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>新規登録</title>
        <link rel = "stylesheet" href = "<?php print STYLESHEET_PATH.'html5reset-1.6.1.css';?>">
        <link rel = "stylesheet" href = "<?php print STYLESHEET_PATH.'sign_up.css';?>">
    </head>
    <body>

<?php include VIEW_PATH . 'templates/messages.php'; ?>

        <h1>新規メンバー登録</h1>
        <form method = "post" action = "./sign_up_process.php">
            <div>
                <label for = "user_name">ユーザー名：<label>
                <input type = "text" name = "user_name" placeholder = "ユーザー名" id = "user_name">
            </div>
            <div>
                <label for = "password">パスワード：</label>
                <input type = "password" name = "password" placeholder = "6文字以上の半角英数字"　id = "password">
            </div>
            <div>
                <input type = "submit" value = "新規登録する">
            </div>
        </form>
        <div>
            <a href = "login.php">ログイン画面へ戻る</a>
        </div>
    </body>
</html>