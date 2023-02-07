<?php include_once '../models/carts.php';
session_start();
if (!isset($_SESSION['name_session'])) {
  header('location:login.php');
}
$order=new carts();
$pdo=$order->connect();
// var_dump($_POST);
// die();
$inserted=$order->order($pdo,$_POST['product_id'],$_POST['user_id'],$_POST['color'],$_POST['size'],$_POST['quantity']);

if ($inserted) {
header('location:cart.php?order=1');
}else{
  header('location:detail.php?id='.$_POST['product_id']);
}