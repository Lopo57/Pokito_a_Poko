<?php
session_start();
$_SESSION['username'] = $_GET['username'];

if(empty($_SESSION['username'])){
        header('Location: insertname.php');
        exit();
}

try {
 	$pdo = new PDO('mysql:host=localhost;dbname=SpokeData;charset=utf8','root','root');
}catch(PDOException $e){
 	exit('データベースに接続できませんでした'.$e->getMessage());
}

$stmt = $pdo->prepare("SELECT remarks FROM RootSpokeDetail WHERE username=':username'");
$stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
$stmt->execute();
$remarks = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <form action="./Confirmation.php" method="GET">
    <h1><legend>登録するデータ</legend></h1>
    <h3><legend><?php echo $_SESSION['username'] ?></legend></h3>
        <table>
            
			<tr><td><input type = "radio" name = "spoke" value="Left" checked>左スポーク</td>
				<td><span style = "text-align: center"> <input type = "radio" name = "spoke" value="Right">右スポーク</td>
			</tr>

			<tr><td>有効リム径(ERD)</td>
				<td><input type = "number" name = "rim_diameter" value = 267>mm</td>
			</tr>

			<tr><td>ハブスポーク穴PCD</td>
				<td><input type = "number" name = "hub_spoke_hole" value = 23.5>mm</td>
			</tr>

			<tr><td>ロックナット-フランジ間距離</td>
				<td><input type = "number" name = "locknat_furange_distance" value = 22>mm</td>
			</tr>

			<tr><td>車輪のスポーク数</td>
				<td><input type = "number" name = "wheel_spoke_count" value = 32>mm</td>
			</tr>

			<tr><td>スポーク交差数</td>
				<td><input type = "number" name = "spoke_intersection_count" value = 6>mm</td>
			</tr>

            <tr><td>備考</td>
            <td><textarea style="width:600px; height:500px" name="remarks" maxlength="300"><?php echo $remarks['remarks'] ?></textarea></td>
            </tr>

            <tr><td><input type="submit" value="登録"></td></tr>

        </table>
    </form>
</body>
</html>

