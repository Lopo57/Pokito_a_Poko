<?php

try {                                                                                                                         
        $pdo = new PDO('mysql:host=localhost;dbname=User;charset=utf8', 'root', 'root');
} catch (PDOException $e) {
        exit("データベースに接続できませんでした");
}

session_start();

if(!empty($_POST)){
        //ログイン処理
        if($_POST['userid'] != '' && $_POST['pass'] != ''){
            $stmt = $pdo->prepare('SELECT * FROM UserInfo WHERE userid=:userid AND pass=:pass;');
            $stmt->bindParam(':userid', $_POST['userid'], PDO::PARAM_STR);
            $stmt->bindParam(':pass', sha1($_POST['pass']), PDO::PARAM_STR);
            
            $pass = sha1($_POST['pass']);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            echo $result;

            if($result){
                    //ログイン成功
                    $_SESSION['userid'] = $_POST['userid'];
                    header('Location: ../');
                    exit();
            }else{
                    $error['login'] = 'failed';
            }
        }else{
                $error['login'] = 'blank';
        }
}

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
</head>
<body>
    <p>ユーザIDとパスワードを入力してログインしてください</p>
    <p>&raquo;<a href="../join/new_user.php">ユーザ登録がまだの方はこちらにどうぞ</a></p>
    <form action="" method="POST">
        <dl>
            <dt>ユーザID</dt>
            <dd>
                <input type="text" name="userid" size="30"
                    value="<?php echo htmlspecialchars($_POST['userid']); ?>">
                <?php if(!empty($error['login']) && $error['login'] == 'blank'):?>
                    <p><font color="red">ユーザIDとパスワードを入力してください</p>
                <?php endif; ?>
                <?php if(!empty($error['login']) && $error['login'] == 'failed'):?>
                    <p><font color="red">ログインに失敗しました。正しいユーザIDとパスワードを入力してください</p>
                <?php endif; ?>
            </dd>

            <dt>パスワード</dt>
            <dd>
                <input type="password" name="pass" size="50"
                    value="<?php echo htmlspecialchars($_POST['pass']); ?>">
            </dd>
        </dl>
        <input type="submit" value="ログインする">
    </form>
</body>
</html>
