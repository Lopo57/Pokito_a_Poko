<?php
session_start();

if(!isset($_SESSION['join'])){
        header('Location: new_user.php');
        exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
        header('Location: insert.php');
        exit();
}

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>新規登録確認</title>
</head>
<body>
    <form action="" method="post">
    <dl>
        <dt>ユーザ名</dt>
        <dd>
            <?php echo htmlspecialchars($_SESSION['join']['username'], ENT_QUOTES, 'UTF-8'); ?>
        </dd>
        <dt>メールアドレス</dt>
        <dd>
            <?php echo htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES, 'UTF-8'); ?>
        </dd>
        <dt>パスワード</dt>
        <dd>
            [表示されません]
        </dd>
    </dl>
    <div><a href="new_user.php?action=rewrite">&laquo;&nbsp;書き直す</a>
    <input type="submit" value="登録する"></div>
    </form>
</body>
</html>

