<?php
session_start();
if(!isset($_SESSION['userid'])){                                                                                              
    header('Location: ../Login/login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang = "ja">
<head>
	<meta charset = "UTF-8">
	</style>
</head>
<body>
	<form action = "./sample.php" method = "get">
		<table>
			<tbody>
			
			<tr>スポーク長計算機</tr>
			<tr><td><input type = "radio" name = "spoke" value="Left" checked>左スポーク</td>
				<td><span style = "text-align: center"> <input type = "radio" name = "spoke" value="Right">右スポーク</td>
			</tr>

			<tr><td>有効リム径(ERD)</td>
				<td><input type = "number" name = "rim_diameter" value = 267>mm</td>
			</tr>

			<tr><td>ハブスポーク穴PCD</td>
				<td><input type = "number" name = "hub_spoke_hole" value = 23.5>mm</td>
			</tr>

			<!-- <tr><td>ロックナット間距離(OLD)</td>
				<td><input type = "number" name = "locknat_distance" value = 0>mm</td>
			</tr> -->

			<tr><td>ロックナット-フランジ間距離</td>
				<td><input type = "number" name = "locknat_furange_distance" value = 22>mm</td>
			</tr>

			<!-- <tr><td>リム穴オフセット</td>
				<td><input type = "number" name = "rim_hole" value = 0>mm</td>
			</tr> -->

			<!-- <tr><td>ハブスポーク穴径</td>
				<td><input type = "number" name = "hub_spoke_hole_diameter" value = 0>mm</td>
			</tr> -->

			<tr><td>車輪のスポーク数</td>
				<td><input type = "number" name = "wheel_spoke_count" value = 32>mm</td>
			</tr>

			<tr><td>スポーク交差数</td>
				<td><input type = "number" name = "spoke_intersection_count" value = 6>mm</td>
			</tr>

			<!-- <tr><td>スポーク長</td>
				<td><input type = "number" name = "spoke_distance" value = 0>mm</td>
			</tr> -->

			</tbody>
		</table>
		<p><input type = "submit" value = "計算">	<input type = "reset" value = "リセット"></p>
	</form>
</body>
</html>

