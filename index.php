<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>物件導向(OOP)</title>
</head>

<body>
    <?php
    // class=類別
    class Person {
        // 成員，屬性
        /* public 
         * protected
         * private
         */
        protected $name;
        protected $age;

        // 方法，行為，建構函式 &__construct=建構子
        public function __construct($name, $age){
            $this->name = $name; //$this = Person (?)
            $this->age = $age;
        }

        // 方法
        public function greet(){
            echo "Hello, my name is {$this->name} and I am {$this->age} years old.<br>";
        }
        public function getName(){
            return $this->name;
        }
        public function getAge(){
            return $this->age;
        }
        public function setName($name){
            $this->name = $name;
        }
        public function setAge($age){
            $this->age = $age;
        }
        
    }

    $jason = new Person('jason', 18); //$jason是個物件(?)
    // echo $jason->name;
    echo $jason->getName();
    echo "<br>";
    // echo $jason->age;
    echo $jason->getAge();
    echo "<br>";
    $jason->greet();

    echo "<hr>";
    // $jason->name = "Mary";
    $jason->setName("Mary");
    echo $jason->getName();
    echo "<br>";
    echo $jason->getAge();
    echo "<br>";
    $jason->greet();

    ?>
</body>

</html>