<?php
session_start();
include_once '../models/users.php';
$user = new users();
$pdo = $user->connect();
$result=$user->login($pdo,$_POST['email'],md5($_POST['password']));
// var_dump($result);
// die();

  if (count($result) > 0) {
            $_SESSION['id_session']= $result[0]['id'];
            $_SESSION['name_session']=$result[0]['name'];
            $_SESSION['role_session']=$result[0]['role'];
        // var_dump($_SESSION);
        // die();
    header('location:index.php?login=1');
  }else{
    header('location:index.php?login=0');
    }