<!-- 老師code -->

<?php 

//判斷是否登入成功
$dsn='mysql:host=localhost;dbname=foodie;charset=utf8';
$pdo=new PDO($dsn,'root','');
/* echo "<pre>";
print_r($_POST);
echo "</pre>"; */
// $sql="SELECT * FROM `members` WHERE `acc`='{$_POST['acc']}' && `pw`='".md5($_POST['pw'])."'"; //改成下方

// $sql="SELECT `id` FROM `members` WHERE `acc`='{$_POST['acc']}' && `pw`='".md5($_POST['pw'])."'";
$sql="SELECT count(*) FROM `members` WHERE `acc`='{$_POST['acc']}' && `pw`='".md5($_POST['pw'])."'";//上一行也行(?)
//echo $sql;
// $mem=$pdo->query($sql)->fetch(); //改成下方
$mem=$pdo->query($sql)->fetchColumn();


// if($mem['acc']==$_POST['acc'] && $mem['pw']==md5($_POST['pw'])){ //改成下方
if($mem){
    //登入成功
    session_start();
    // $_SESSION['mem']=$mem; //改成下方
    $_SESSION['mem']=$_POST['acc'];
   header("location:../member_center.php");

}else{
    //登入失敗
   header("location:../login.php?err=1");
}
?>