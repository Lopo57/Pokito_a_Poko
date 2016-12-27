<?php
 
try { 
        $pdo = new PDO('mysql:host=localhost;dbname=User;charset=utf8', 'root', 'root'); 
} catch (PDOException $e) { 
        exit("データベースに接続できませんでした"); 
}

?>
