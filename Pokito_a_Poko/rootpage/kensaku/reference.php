<?php
session_start();

?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <center>
    <h1>顧客参照</h1>
    <form action="result.php" method="POST">
        <input type="text" name="username"><br>
        <input type="submit" value="検索">
    </form>
    <a href="../select.php">戻る</a>
    </center>
</body>
</html>
