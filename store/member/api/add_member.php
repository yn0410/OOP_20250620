<?php

$dsn="mysql:host=localhost;charset=utf8;dbname=foodie";
$pdo=new PDO($dsn, 'root', '');

// 密碼編碼
$pw=md5($_POST['pw']);

$sql="INSERT INTO `members`(`name`, `acc`, `pw`, `birthday`, `email`)
            VALUE ('{$_POST['name']}',
                    '{$_POST['acc']}',
                    '{$pw}',
                    '{$_POST['birthday']}',
                    '{$_POST['email']}')";

$pdo->exec($sql);
header("location:../index.php");

?>