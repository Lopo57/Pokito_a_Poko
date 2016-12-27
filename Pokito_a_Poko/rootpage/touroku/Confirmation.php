<?php
session_start();

$username = $_SESSION['username'];
$spoke = $_GET['spoke'];
$rim_diameter =	$_GET['rim_diameter'];
$hub_spoke_hole = $_GET['hub_spoke_hole'];
$locknat_furange_distance = $_GET['locknat_furange_distance'];
$wheel_spoke_count = $_GET['wheel_spoke_count'];
$spoke_intersection_count = $_GET['spoke_intersection_count'];
$spoke_distance = $_GET['spoke_distance'];
$remarks = $_GET['remarks'];

if(empty($username)){
        header('Location: Registration.php');
        exit();
}

try {
 	$pdo = new PDO('mysql:host=localhost;dbname=SpokeData;charset=utf8','root','root');
}catch(PDOException $e){
 	exit('データベースに接続できませんでした'.$e->getMessage());
}

$a = $rim_diameter;
$b = $hub_spoke_hole;
$c = $locknat_furange_distance;
$L = (($a ** 2) + ($b ** 2) + ($c ** 2) - (2 * $a * $b) * (cos(deg2rad(360 * $spoke_intersection_count / $wheel_spoke_count)))) ** 0.5;

$stmt = $pdo->prepare("INSERT INTO RootSpokeDetail VALUES(:username, :length, :rim_diameter, :hub_spoke_hole, :locknat_furange_distance, :wheel_spoke_count, :spoke_intersection_count, :time, :spoke, :remarks)");

$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':length', (int)$L, PDO::PARAM_INT);
$stmt->bindValue(':rim_diameter', $rim_diameter, PDO::PARAM_INT);
$stmt->bindValue(':hub_spoke_hole', $hub_spoke_hole, PDO::PARAM_INT);
$stmt->bindValue(':locknat_furange_distance', $locknat_furange_distance, PDO::PARAM_INT);
$stmt->bindValue(':wheel_spoke_count', $wheel_spoke_count, PDO::PARAM_INT);
$stmt->bindValue(':spoke_intersection_count', $spoke_intersection_count, PDO::PARAM_INT);
$time = (9 * 3600) + time();
$stmt->bindParam(':time', gmdate("Y-m-d-H-i-s", $time), PDO::PARAM_STR);
$stmt->bindParam(':spoke', $spoke, PDO::PARAM_STR);
$stmt->bindParam(':remarks', $remarks, PDO::PARAM_STR);

$stmt->execute();
?>

<!DOCTYPE html>
<head>

</head>
<body>
    <table>
		<tbody>
        <form action="Registration.php" method="GET">
			<tr><h1>登録しました</h1></tr>
            <tr><td>名前</td><td><?php echo $username ?></td></tr>
            <tr><td>スポーク選択</td><td><?php echo $spoke ?></td></tr>
			<tr><td>有効リム径</td><td><?php echo $rim_diameter ?></td></tr>
			<tr><td>ハブスポーク穴</td><td><?php echo $hub_spoke_hole ?></td></tr>
			<tr><td>ロックナット-フランジ間距離</td><td><?php echo $locknat_furange_distance ?></td></tr>
			<tr><td>車輪スポーク数</td><td><?php echo $wheel_spoke_count ?></td></tr>
			<tr><td>スポーク交差数</td><td><?php echo $spoke_intersection_count ?></td></tr>
            <tr><td>計算結果</td><td><?php echo (int)$L ?></td></tr>
            <tr><td>備考</td><td><?php echo $remarks ?></td></tr>
            <tr><td><input type="submit" name="username" value="<?php echo $_SESSION['username'] ?>"></td></tr><br>
            <tr><td><a href="./insertname.php">他の顧客を登録</a></td></tr>
        </form>
		</tbody>
	</table>
    </body>
</html>

