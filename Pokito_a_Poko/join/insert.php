<?php

session_start();

if(!isset($_SESSION['join'])){
        header('Location: new_user.php');
        exit(); 
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
        header('Location: ../home.html');
        exit();
}
                                                                                                                             
try {
        $pdo = new PDO('mysql:host=localhost;dbname=User;charset=utf8', 'root', 'root');
} catch (PDOException $e) {
        exit("データベースに接続できませんでした");
}

$stmt = $pdo->prepare("INSERT INTO UserInfo(userid, username, pass, email) VALUES(:userid, :username, :pass, :email)");
$stmt->bindParam(':userid', $_SESSION['join']['userid'], PDO::PARAM_STR);
$stmt->bindParam(':username', $_SESSION['join']['username'], PDO::PARAM_STR);
$stmt->bindParam(':pass', sha1($_SESSION['join']['pass']) ,PDO::PARAM_STR);
$stmt->bindParam(':email', $_SESSION['join']['email'] ,PDO::PARAM_STR);
$stmt->execute();

unset($_SESSIOIN['join']);

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>登録完了</title>
</head>
<body>
    <p>登録完了しました！</p>
    <form action="" method="POST">
    <input type="submit" value="ホームへ戻る"></a>
    </form>
</body>
</html>
