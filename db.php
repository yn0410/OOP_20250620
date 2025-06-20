<?php
$dsn="mysql:host=localhost;dbname=files;charset=utf8";
$pdo=new PDO($dsn,'root','');

/* all()-給定資料表名後，會回傳整個資料表的資料
find()-會回傳資料表指定id的資料
update()-給定資料表的條件後，會去更新相應的資料。
insert()-給定資料內容後，會去新增資料到資料表
del()-給定條件後，會去刪除指定的資料 */

function all($table, $array=null, $str=null){
    global $pdo;
    $sql="SELECT * FROM $table ";

    
        if(is_array($array)){
            $tmp=arr2sql($array);
            $sql=$sql ." WHERE ".join(" AND ", $tmp);
        }else{
            $sql .=$array;
        }
        $sql .=$str;
    

    // echo $sql;
    $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function dd($array){ //dd=direct dump
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function q($sql){
    global $pdo;
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function find($table, $id){
    global $pdo;

    if(is_array($id)){
       $tmp=arr2sql($id);
        $sql="SELECT * FROM $table WHERE ".join(" AND ", $tmp);
    }else{
        $sql="SELECT * FROM $table WHERE id='$id'";
    }
    // echo $sql;
    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

function update($table, $data){
    global $pdo;
    $tmp=arr2sql($data);

    $sql="UPDATE $table SET ".join(" , ", $tmp)." WHERE id='{$data['id']}'";
    // echo $sql;
    return $pdo->exec($sql); //會去資料庫執行它
}

function insert($table, $data){
    global $pdo;
    $keys=array_keys($data);

    $sql="INSERT INTO $table (`".join("`,`", $keys)."`) values('".join("','", $data)."');";
    // echo $sql;
    return $pdo->exec($sql);
}

// 合併update() & insert()
// 如果$data 有id欄位且不為空，執行update，否則執行 insert
function save($table, $data){
    if(isset($data['id'])){
        update($table, $data);
    }else{
        insert($table, $data);
    }
}

function arr2sql($array){ //function 名稱"array to sql"
    $tmp=[];
    foreach($array as $key=>$value){
            $tmp[]="`$key`='$value'";
    }
    return $tmp;
}

function del($table, $id){
    global $pdo;
    $sql="DELETE FROM $table WHERE ";

    if(is_array($id)){
        $tmp=arr2sql($id);
        $sql.=join(" AND ", $tmp);
    }else{
        $sql.= "id='$id'";
    }
    // echo $sql;
    return $pdo->exec($sql);
}

class DB{
    private $pdo;
    private $dsn="mysql:host=localhost;dbname=store;charset=utf8";
    private $table;
    public function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn, 'root', '');        
    }


    /* 之前老師讓AI寫的註解
    all($table, $array = null, $str = null)
    $table: 資料表名稱 (string)
    $array: 條件陣列 (array|null)，可選，若為陣列則產生 WHERE 條件
    $str: 其他SQL語法 (string|null)，可選，附加在SQL語句後
    回傳: 查詢結果的關聯式陣列
    */
    function all($array=null, $str=null){
        $sql="SELECT * FROM $this->table ";

        
            if(is_array($array)){
                $tmp=arr2sql($array);
                $sql=$sql ." WHERE ".join(" AND ", $tmp);
            }else{
                $sql .=$array;
            }
            $sql .=$str;
        

        // echo $sql;
        $rows=$this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

}

$Item = new DB('items');

dd($Item->all());

?>