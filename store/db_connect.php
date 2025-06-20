<?php

$dsn="mysql:host=localhost;charset=utf8;dbname=school_t";


$pdo=new PDO($dsn, 'root', '');

$sql="select * from students where id<=10"; //為閱讀方便 才用此變數

// $rows=$pdo->query("select * from students where id<=10") //="$rows=$pdo->query($sql)"

// $rows=$pdo->query($sql)->fetch(); //是一個1維陣列 fetch()只能撈一筆資料
// $rows=$pdo->query($sql)->fetchAll(); //是一個二維陣列 有重複資料
// $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_NUM); //是一個二維陣列 index=0,1,2,3...
$rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC); //是一個二維陣列 index=key值=欄位名稱

/*echo "<pre>";
print_r($rows[1]['name']); //="尹彗如"
echo "</pre>";
*/
/*echo "<pre>";
print_r($rows);
echo "</pre>";
*/
?>

<style>
    table{
        width: 50%;
        border-collapse: collapse;
        margin: auto;
    }
    th, td{
        border: 1px solid black;
        text-align: center;
    }
</style>

<table>
    <tr>
        <th>id</th>
        <th>學號</th>
        <th>姓名</th>
        <th>生日</th>
        <th>電話</th>
    </tr>
    <?php
    foreach($rows as $row){
    ?>
    <tr>
        <td><?=$row['id'];?></td>
        <td><?=$row['school_num'];?></td>
        <td><?=$row['name'];?></td>
        <td><?=$row['birthday'];?></td>
        <td><?=$row['tel'];?></td>
    </tr>
    <?php
    }
    ?>
</table>


<!-- 老師還做了一個div放資料的code示範/我就不自己打了 直接複製他的吧... -->
<style>
    .card{
        width: 300px;
        margin: 10px auto;
        padding: 10px;
        border-radius: 10px;
        border: 1px solid #ccc;
        display:inline-block;
    }
    h3.head{
        margin: 0;
        padding:0;
        font-size: 1.2em;
        padding-bottom: 5px;
        margin-bottom: 5px;
        border-bottom: 1px solid #ccc;

    }
    .card div:hover{
        background-color: #f0f0f0;
    }
</style>

<?php 
foreach($rows as $row){
?>
    <div class='card'>
        <h3 class='head'><?=$row['name'];?></h3>
        <div class='id'><?=$row['id'];?></div>
        <div class='birthday'><?=$row['birthday'];?></div>
        <div class='tel'><?=$row['tel'];?></div>
        <div class='num'><?=$row['school_num'];?></div>
    </div>
<?php 
}
?>