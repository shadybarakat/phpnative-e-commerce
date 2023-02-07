<?php
// var_dump($_POST);
// die();
    include_once "../models/products.php";

    $product=new products;
    $pdo=$product->connect();
for ($i=0; $i <count($_FILES['image']['name']) ; $i++) { 


    $target_dir = "../uploads/";
    $target_file [$i]= $target_dir . basename($_FILES["image"]["name"][$i]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file[$i],PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    
      $check = getimagesize($_FILES["image"]["tmp_name"][$i]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
    
    // Check if file already exists
    if (file_exists($target_file[$i])) {
    
        echo "Sorry, file already exists.";
        $uploadOk = 0;
      }
    
    // Check file size
    if ($_FILES["image"]["size"][$i] > 500000) {
    
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
    
       $erorr="file not uploaded select valid files" ;
       header("location:product_add.php?data=".$erorr);
    
    }else{
        move_uploaded_file($_FILES["image"]["tmp_name"][$i],$target_file[$i]);
    }
}

if($target_file ){
    if (isset($_POST['size_id']) && isset($_POST['color_id'])) {
      $add=$product->add($pdo,$_POST['name'],$_POST['category'],$_POST['price_before'],$_POST['price_after'],$target_file,$_POST['description'],$_POST['size_id'],$_POST['color_id']);
    }else {
      $add=$product->add($pdo,$_POST['name'],$_POST['category'],$_POST['price_before'],$_POST['price_after'],$target_file,$_POST['description']);

    }
    }

if ($add) {
  header("location:product_index.php?data=1");
}else{
    $data="enter valid data";
    header("location:product_add.php?data=0");
}

