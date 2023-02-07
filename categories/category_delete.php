<?php include_once "../models/categories.php";
$category=new categories;
$pdo=$category->connect();
$delete=$category->delete($pdo,$_GET['id']);
if($delete){
    header("location:category_index.php?remove=1");
}else{
    header("location:category_index.php?remove=0");
}
?>