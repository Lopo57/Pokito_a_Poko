<?php
session_start();

try {
 	$pdo = new PDO('mysql:host=localhost;dbname=SpokeData;charset=utf8','root','root');
}catch(PDOException $e){
 	exit('データベースに接続できませんでした'.$e->getMessage());
}

?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>顧客名前入力</title>
</head>
<body>
<center>
    <h1>登録顧客名前</h1>
    <form action="Registration.php" method="GET">
        <input type="text" name="username"><br>
        <input type="submit" value="登録画面へ">
    </form>
</center>
</body>
</html>
