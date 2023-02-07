<?php
class database{
public $dsn="mysql:host=localhost; dbname=market";
public $user="root";
public $password="";

public function connect(){
    $pdo=new PDO($this->dsn,$this->user,$this->password);
     
    if ($pdo) {
        return $pdo;
    }else{
        echo "connection failed";
    }

}
}