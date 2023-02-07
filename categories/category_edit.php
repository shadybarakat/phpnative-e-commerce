<?php
include_once "../models/categories.php";


$category=new categories;
$pdo=$category->connect();

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {

    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

// Check file size
if ($_FILES["image"]["size"] > 500000) {

    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {

  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

if (!$uploadOk) {

   echo "file not uploaded" ;

}else{

    if(isset($_POST['name']) && isset($_POST['id']) && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){

    $update=$category->update($pdo,$_POST['name'],$target_file,$_POST['id']);

    }
}

if ($update) {
    header("location:category_index.php?data=1");
}else{
    header("location:category_index.php?data=0");
}