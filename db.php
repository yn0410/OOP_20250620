<?php
function dd($array){ //dd=direct dump
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function q($sql){
    global $pdo;
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
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
                $tmp=$this->arr2sql($array);
                $sql=$sql ." WHERE ".join(" AND ", $tmp);
            }else{
                $sql .=$array;
            }
            $sql .=$str;
        

        // echo $sql;
        $rows=$this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    function find($id){
        if(is_array($id)){
            $tmp=$this->arr2sql($id);
            $sql="SELECT * FROM $this->table WHERE ".join(" AND ", $tmp);
        }else{
            $sql="SELECT * FROM $this->table WHERE id='$id'";
        }
        // echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function update($data){
        $tmp=$this->arr2sql($data);

        $sql="UPDATE $this->table SET ".join(" , ", $tmp)." WHERE id='{$data['id']}'";
        // echo $sql;
        return $this->pdo->exec($sql); //會去資料庫執行它
    }

    function insert($data){
        $keys=array_keys($data);

        $sql="INSERT INTO $this->table (`".join("`,`", $keys)."`) values('".join("','", $data)."');";
        // echo $sql;
        return $this->pdo->exec($sql);
    }

    function save($data){
        if(isset($data['id'])){
            $this->update($this->table, $data);
        }else{
            $this->insert($this->table, $data);
        }
    }

    function del($id){
        $sql="DELETE FROM $this->table WHERE ";

        if(is_array($id)){
            $tmp=$this->arr2sql($id);
            $sql.=join(" AND ", $tmp);
        }else{
            $sql.= "id='$id'";
        }
        // echo $sql;
        return $this->pdo->exec($sql);
    }

    private function arr2sql($array){ //function 名稱"array to sql"
        $tmp=[];
        foreach($array as $key=>$value){
            $tmp[]="`$key`='$value'";
        }
        return $tmp;
    }

}

$Item = new DB('items');
$Sales = new DB('sales');

dd($Item->find(['id'=>4]));

?>