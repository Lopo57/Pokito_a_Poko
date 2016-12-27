<?php
session_start();

$_SESSION['username'] = $_POST['username'];

if(empty($_SESSION['username'])){
        header('Location: reference.php');
        exit();
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<center>
<h1>検索結果</h1>

        <table border="1">
            <tr><td>計算した日時</td><td>ユーザーID</td><td>スポーク位置</td><td>計算結果</td> <td>有効リム経</td> 
            <td>ハブスポーク穴</td><td>ロックナット-フランジ間距離</td><td>車輪スポーク数</td><td>スポーク交差数</td></tr>
        <?php


        try {
 	        $pdo = new PDO('mysql:host=localhost;dbname=SpokeData;charset=utf8','root','root');
        }catch(PDOException $e){
 	        exit('データベースに接続できませんでした'.$e->getMessage());
        }
    
        $stmt = $pdo->prepare("SELECT * FROM RootSpokeDetail WHERE username = :username ORDER BY time DESC LIMIT 5;"); 
        $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
        $stmt->execute();
        foreach($stmt as $row){
            ?>
            <tr>
            <td>
            <?php
            echo $row['time'];
            ?>
            </td><td>
            <?php
            echo $row['username']." ";
            ?>
            </td><td>
            <?php
            echo $row['spoke'];
            ?>
            </td><td>
            <?php
            echo $row['length']." ";
            ?>
            </td><td>
            <?php
            echo $row['rim_diameter']." ";
            ?>
            </td>
            <td>
            <?php
            echo $row['hub_spoke_hole']." ";
            ?>
            </td><td>
            <?php
            echo $row['locknat_furange_distance']." ";
            ?>
            </td><td>
            <?php
            echo $row['wheel_spoke_count']." ";
            ?>
            </td><td>
            <?php
            echo $row['spoke_intersection_count']." ";
            echo "<br>";
        }
        ?>
            </td>
            </tr>
            <tr><td colspan="9"><p><center>備考</center></p></td></tr>
            <tr><td colspan="9"><?php $stmt1 = $pdo->prepare("SELECT remarks FROM RootSpokeDetail WHERE username = :username ORDER BY time DESC LIMIT 1;");
                          $stmt1->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
                          $stmt1->execute();
                          $remarks = $stmt1->fetch(PDO::FETCH_ASSOC);
                          echo $remarks['remarks'];
                    ?>
            </td></tr>
    </table>
    <a href="reference.php">戻る</a> 
</center>
</body>
</html>
