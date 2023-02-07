<?php include_once "../models/carts.php";
$remove=new carts();
$pdo=$remove->connect();
$delete=$remove->delete_order($pdo,$_GET['id']);

if ($delete) {
    header('location:cart.php?delet=1');
    }else{
      header('location:cart.php?delete=0');
    }