<?php
session_start();

//$userid = $_POST['userid'];
//$username = $_POST['username'];
//$email = $_POST['email'];
//$pass = $_POST['pass']; //$ hash_hmac('sha256', $_POST['pass'], False);

if(!empty($_POST)){
        if($_POST['userid'] == ''){
                $error['userid'] = 'blank';
        }   
        if($_POST['username'] == ''){
                $error['username'] = 'blank';
        }
        if(strlen($_POST['pass']) < 6){
                $error['pass'] = 'length';
        }
        if($_POST['pass'] == ''){
                $error['pass'] = 'blank';
        }
        if($_POST['email'] == ''){
                $error['email'] = 'blank';
        }

        if(empty($error)){
            $_SESSION['join'] = $_POST;
            header('Location: check.php');
            exit();
        }
}


try {
        $pdo = new PDO('mysql:host=localhost;dbname=User;charset=utf8', 'root', 'root');
} catch (PDOException $e) {
        exit("データベースに接続できませんでした");
}

//$stmt = $pdo->prepare("INSERT INTO UserInfo(userid, username, pass, email) VALUES(:userid, :username, :pass, :email)");
//$stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
//$stmt->bindParam(':username', $username, PDO::PARAM_STR);
//$stmt->bindParam(':pass', $pass ,PDO::PARAM_STR);
//$stmt->bindParam(':email', $email ,PDO::PARAM_STR);
//$stmt->execute();

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>新規ユーザ登録</title>
</head>
<body>
    <h2>新規ユーザー登録</h2>
    <!-- $_SERVER['PHP_SELF']はXSSの危険性がある為、actionを空にしておく_-->
    <form id="loginForm" name="loginForm" action="" method="POST">
        <fieldset>
            <legend>下記項目を入力してください</legend>

                <p>ユーザID</p>
                <input type="text" name="userid" placeholder="ユーザIDを入力" maxlength="20" 
                    value="<?php echo htmlspecialchars($_POST['userid'], ENT_QUOTES, 'UTF-8'); ?>">
                <?php if(!empty($error['userid']) && $error['userid'] == 'blank'): ?>
                <p><font color="red">ユーザIDを入力してください</font></p>
                <?php endif; ?>

                <p>氏名</p>
                <input type="text" name="username" maxlength="10" 
                    value="<?php echo htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8'); ?>">
                <?php if(!empty($error['username']) && $error['username'] == 'blank'): ?>
                <p><font color="red">氏名を入力してください</font></p>
                <?php endif; ?>

                <p>メールアドレス</p>
                <input type="text" name="email" maxlength="30" 
                    value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'); ?>">
                <?php if(!empty($error['email']) && $error['email'] == 'blank'): ?>
                <p><font color="red">メールアドレスを入力してください</font></p>
                <?php endif ?>

                <p>パスワード</p> 
                <input type="password" name="pass" maxlength="50" 
                    value="<?php echo htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8'); ?>">
                <?php if(!empty($error['pass']) && $error['pass'] == 'blank' || $error['pass'] == 'length' ): ?>
                <p><font color="red">パスワードを6文字以上で入力してください</font></p>
                <?php endif; ?>

                <br>
                <div><a href="check.php?action=rewrite"><input type="submit" value="登録">
</fieldset>
    </form>
</body>
</html>
