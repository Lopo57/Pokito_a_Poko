<?php
session_start();

if (isset($_SESSION["USERID"])) {
    $errorMessage = "ログアウトしました。";
} else {
    $errorMessage = "セッションがタイムアウトしました。";
}

// セッションの変数のクリア
$_SESSION = array();

// セッションクリア
@session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ログアウトページ</title>
</head>
<body>
    <h1>ログアウト画面</h1>
    <div><?php echo $errorMessage; ?></div>
    <ul>
        <li><a href=$errorMessage; ?></div>
    </ul>
</body>
</html>

