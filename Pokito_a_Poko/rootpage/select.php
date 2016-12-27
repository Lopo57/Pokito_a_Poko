<?php
session_start();
unset($_SESSION['username']);
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>権限者用ページです</title>
</head>
<body>
    <a href="./touroku/Registration.php"><input type="button" value="登録"></a>
    <a href="./kensaku/reference.php"><input type="button" value="顧客情報参照">   
</body>
</html>
