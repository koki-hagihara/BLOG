<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset = "UTF-8">
        <title>記事作成</title>
        <link rel = "stylesheet" href = "<?php print STYLESHEET_PATH.'html5reset-1.6.1.css';?>">
        <link rel = "stylesheet" href = "<?php print STYLESHEET_PATH.'write_article.css';?>">
    </head>
    <body>
<?php include VIEW_PATH . 'templates/messages.php'; ?>
        <h1>記事投稿</h1>
        <form method = "post" action = "write_article_process.php" enctype = "multipart/form-data">
            <div>
                カテゴリー：
<?php foreach ($category_list as $category) { ?>
                <input type = "radio" name = "category" value = "<?php print $category['category_id'] ;?>"><?php print entity_str($category['category']);?>
<?php } ?> 
            </div>
            <div>画像：<input type = "file" name = "new_img"></div>
            <div>タイトル：<input type = "text" name = "title"></div>
            <div>記事：<input type = "textarea" name = "article">
            <div><input type = "submit" value = "記事を登録する">
        </form>

        <a href = "admin.php">管理ページへ</a>
    </body>
</html>