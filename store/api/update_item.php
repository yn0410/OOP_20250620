<?php
// 全是老師的code
// 跟"api/add_item.php"差不多


/* echo "<pre>";
print_r($_POST);
echo "</pre>";
 */
$dsn="mysql:host=localhost;dbname=store;charset=utf8";
$pdo=new PDO($dsn, 'root', '');
$sql="UPDATE `items`
         SET `name`='{$_POST['name']}',
             `price`='{$_POST['price']}',
             `cost`='{$_POST['cost']}',
             `stock`='{$_POST['stock']}'
         WHERE `id`='{$_POST['id']}'";
$pdo->exec($sql);   

header("Location: ../index.php");
?>