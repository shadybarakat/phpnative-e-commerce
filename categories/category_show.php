<?php include_once "../models/categories.php";
$category=new categories;
$pdo=$category->connect();
$result=$category->get_once($pdo,$_GET['id']);

// var_dump($result);
// die();



echo "<div><h3> ".$result[0]['name']."</h3>
<img src='".$result[0]['image']."'>
</div>";