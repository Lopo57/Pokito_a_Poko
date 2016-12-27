<?php
session_start();

if (!isset($_SESSION["USERID"])) {
        header("Location: Logout.php");
        exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>メインページ</title>
</head>
<body>
    <h1>メイン画面</h1>
    <!-- ユーザIDにHTMLタグが含まれてもいいようにエスケープする -->
    <p>ようこそ<u><?php echo htmlspecialchars($_SESSION["USERID"], ENT_QUOTES); ?></u>さん</p> <!-- ユーザ名をechoで表示 -->
    <ul>
        <li><a href="Logout.php">ログアウト</a></li>
    </ul>
</body>
</html>



        
