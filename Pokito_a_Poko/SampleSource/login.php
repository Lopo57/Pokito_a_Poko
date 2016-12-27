<?php
require 'passoword.php';
// セッション開始
session_start();

$db['host'] = "localhost";           //DBサーバーのURL
$db['user'] = "hogeUser";            //ユーザー名
$db['pass'] = "hogehoge";            //ユーザ名のパスワード
$db['dbname'] = "loginManagement";   //データベース名

// エラーメッセージの初期化
$errorMessage="";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
        // 1. ユーザIDの入力チェック
        if (empty($_POST["userid"])) {
                $errorMessage = 'ユーザーIDが未入力です。';
        } else if (empty($_POST["password"])) {
                $errorMessage = 'パスワードが未入力です。';
        }

        if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
                //入力したユーザIDを格納
                $userid = $_POST["userid"];

                // 2. ユーザIDパスワードが入力されていたら認証する
                $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

                // 3. エラー処理
                try {
                    $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

                    $stmt = $pdo->prepare('SELECT * FROM userData WHERE id = ?');
                    $stmt->execute(array(userid));

                    $password = $_POST["password"];

                    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        if (password_verify($password, $row['password'])) {
                            session_regenerate_id(true);

                            //入力したIDのユーザ名を取得
                            $sql = "SELECT * FROM userData WHERE id = $userid";     //入力した$useridのユーザ名を取得
                            $stmt = $pdo->query($sql);
                            foreach ($stmt as $row) {
                                $row['name'];   //ユーザ名
                            }
                            $_SESSION["USERID"] = row['name'];
                            header("Location: home.html");      //メイン画面へ遷移
                            exit();     // 処理終了
                        } else {
                                //認証失敗
                                $errorMessage = 'ユーザIDあるいはパスワードに誤りがあります。';
                        }
                    } else {
                            // 4. 認証成功なら、セッションIDを新規に発行する
                            // 該当データなし
                            $errorMessage = 'ユーザIDあるいはパスワードに誤りがあります。';
                    }
                } catch (PDOException $e) {
                    $errorMessage = 'データベースエラー';
                    //$errorMessage = $sql;
                    //$e->getMessage()でエラー内容を参照可能 (デバック時のみ表示)
                    //echo $e->getMessage();
                }
        }
}
?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h2>ログイン画面</h2>
    <!-- $_SERVER['PHP_SELF']はXSSの危険性がある為、actionを空にしておく_-->
    <form id="loginForm" name="loginForm" action="" method="POST">
        <fieldset>
            <legend>ログインホーム</legend>
            <div><font color="red"><?php echo $errorMessage ?></font></div>
                <label for="userid">ユーザID</label>
                <input type="text" id="userid" name="userid" placeholder="ユーザIDを入力" value="<?php if(!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>">
                <br>
                <label for="password">パスワード</label><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
                <br>
                <input type="submit" id="login" name="login" value="ログイン">
        </fieldset>
    </form>
    <br>
    <form action="SignUp.php">
        <fieldset>
            <legend>新規登録フォーム</legend>
            <input type="submit" value="新規登録">
        </fieldset>
    </form>        
</body>
</html>
