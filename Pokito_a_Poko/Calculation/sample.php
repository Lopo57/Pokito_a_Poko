<?php
session_start();

$spoke = $_GET['spoke'];
$rim_diameter =	$_GET['rim_diameter'];
$hub_spoke_hole = $_GET['hub_spoke_hole'];
$locknat_distance = $_GET['locknat_distance'];
$locknat_furange_distance = $_GET['locknat_furange_distance'];
$rim_hole = $_GET['rim_hole'];
$hub_spoke_hole_diameter = $_GET['hub_spoke_hole_diameter'];
$wheel_spoke_count = $_GET['wheel_spoke_count'];
$spoke_intersection_count = $_GET['spoke_intersection_count'];
$spoke_distance = $_GET['spoke_distance'];

if(!isset($_SESSION['userid'])){
        header('../Login/login.php');
        exit();
}

try {
 	$pdo = new PDO('mysql:host=localhost;dbname=SpokeData;charset=utf8','root','root');
}catch(PDOException $e){
 	exit('データベースに接続できませんでした'.$e->getMessage());
}

//受け取った値を計算用の変数に格納
$a = $rim_diameter;
$b = $hub_spoke_hole;
$c = $locknat_furange_distance;
$L = (($a ** 2) + ($b ** 2) + ($c ** 2) - (2 * $a * $b) * (cos(deg2rad(360 * $spoke_intersection_count / $wheel_spoke_count)))) ** 0.5;

$stmt = $pdo->prepare("INSERT INTO SpokeDetail VALUES(:userid, :length, :rim_diameter, :hub_spoke_hole, :locknat_furange_distance, :wheel_spoke_count, :spoke_intersection_count, :time, :spoke)");
$stmt->bindParam(':userid', $_SESSION['userid'], PDO::PARAM_STR);
$stmt->bindValue(':length', (int)$L, PDO::PARAM_INT);
$stmt->bindValue(':rim_diameter', $rim_diameter, PDO::PARAM_INT);
$stmt->bindValue(':hub_spoke_hole', $hub_spoke_hole, PDO::PARAM_INT);
$stmt->bindValue(':locknat_furange_distance', $locknat_furange_distance, PDO::PARAM_INT);
$stmt->bindValue(':wheel_spoke_count', $wheel_spoke_count, PDO::PARAM_INT);
$stmt->bindValue(':spoke_intersection_count', $spoke_intersection_count, PDO::PARAM_INT);
$time = time() + 9*3600;
$stmt->bindParam(':time', gmdate("Y-m-d-H-i-s", $time), PDO::PARAM_STR);
$stmt->bindParam(':spoke', $spoke, PDO::PARAM_STR);

if(!empty($_GET)){
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang = "ja">
<head>
	<meta charset = "UTF-8">
</head>
<body>
	<table>
		<tbody>
			<tr><h1>受取った値</h1></tr>
			<tr><td>有効リム径</td><td><?php echo $rim_diameter ?></td></tr>
			<tr><td>ハブスポーク穴</td><td><?php echo $hub_spoke_hole ?></td></tr>
			<!-- <tr><td>ロックナット間距離</td><td><?php echo $locknat_distance ?></td></tr> -->
			<tr><td>ロックナット-フランジ間距離</td><td><?php echo $locknat_furange_distance ?></td></tr>
			<!-- <tr><td>リム穴オフセット</td><td><?php echo $rim_hole ?></td></tr> -->
			<!-- <tr><td>ハブスポーク穴径</td><td><?php echo $hub_spoke_hole_diameter ?></td></tr> -->
			<tr><td>車輪スポーク数</td><td><?php echo $wheel_spoke_count ?></td></tr>
			<tr><td>スポーク交差数</td><td><?php echo $spoke_intersection_count ?></td></tr>
			<!-- <tr><td>スポーク長</td><td><?php echo $spoke_distance ?></td></tr> -->
		</tbody>
	</table>
	<p>計算の結果は<?php echo (int)$L ?>です</p>
    <p>過去5回分のデータ
    <br>
    <table border="1">
        <tr>
            <td>計算した日時</td><td>ユーザーID</td><td>スポーク位置</td><td>計算結果</td> <td>有効リム経</td><td>ハブスポーク穴</td><td>ロックナット-フランジ間距離</td><td>車輪スポーク数</td><td>スポーク交差数</td>
        </tr>
        <?php
    
        $stmt = $pdo->query("SELECT * FROM SpokeDetail WHERE userid = '".$_SESSION['userid']."' ORDER BY time DESC LIMIT 5;"); 
    
        foreach($stmt as $row){
            ?>
            <tr>
            <td>
            <?php
            echo $row['time'];
            ?>
            </td><td>
            <?php
            echo $row['userid']." ";
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
            </td><td>
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
    </table>
    <a href="spoke.php">もう一度計算する</a>
    <br>
</body>
</html>

