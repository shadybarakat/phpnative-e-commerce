<?php include_once "../models/products.php";
$product=new products;
$pdo=$product->connect();
$result=$product->get_products($pdo,$_GET['id']);

include_once("../models/categories.php");
$category=new categories;
$pdo=$category->connect();
$data=$category->get_categories($pdo);
$sizes=$category->sizes($pdo);    
$colors=$category->colors($pdo);  
// var_dump($result['description']);
// die();
// foreach ($data as $value) { 
//     var_dump($value);
//     die();}
?>

<form action="product_edit.php" method="POST" enctype="multipart/form-data">
<div class="col-lg-12">
        <input required type="text" name="name" placeholder="name" value="<?=$result['name']?>">
        <label for="category">category:</label>
            <select name="category" >
                <?php foreach ($data as $value) { 
                    ?>
                    
                    <?php if ($result['cat_name']==$value['cat_name']) {?>
                     <option value="<?= $value['id'] ?>" selected><?= $value['cat_name']?></option>
                    <?php }else{ ?>
                     <option value="<?= $value['id'] ?>"><?= $value['cat_name']?></option>
                <?php }?>
                <?php }?>
    </select>
</div>





<div class="col-lg-12">
                <label for="size">avalable sizes</label>
                <?php 
                      foreach ($sizes as $value) {
                        $found=0; 
                      foreach ($result['sizes'] as $size) {
                        if ($size['name']==$value['name']) {?>
                    <input type="checkbox" name="size_id[]" value="<?= $value['id'] ?>" multiple checked><?= $value['name']?>
                            <?php 
                            $found=1;
                            break; } ?>
                      <?php } if ($found==0) { ?>
                        <input type="checkbox" name="size_id[]" value="<?= $value['id'] ?>" multiple ><?= $value['name']?>
                           <?php }else {
                            continue;
                           }
                            } ?>
</div>
<div class="col-lg-12">
                <label for="size">avalable colors</label>
                <?php 
                      foreach ($colors as $value) {
                        $found=0; 
                      foreach ($result['colors'] as $color) {
                        if ($color['name']==$value['name']) {?>
                    <input type="checkbox" name="color_id[]" value="<?= $value['id'] ?>" multiple checked><span style="color: <?= $value['name'] ?>"> <?= $value['name'] ?> </span>
                            <?php 
                            $found=1;
                            break; } ?>
                      <?php } if ($found==0) { ?>
                        <input type="checkbox" name="color_id[]" value="<?= $value['id'] ?>" multiple ><span style="color: <?= $value['name'] ?>"> <?= $value['name'] ?> </span>
                           <?php }else {
                            continue;
                           }
                            } ?>
</div>


      <input type="text" value=<?=$result['description']?> name="description" placeholder="description">

<div class="col-lg-12">
    <input required type="number" value="<?=$result['price_before']?>" name="price_before" placeholder="price before">
    <input required type="number" value="<?=$result['price_after']?>" name="price_after" placeholder="price after">
</div>

<div class="col-lg-12">
    <input required type="file" name="image[]" multiple>
    <input type="submit" placeholder="add product">
</div>

<?php
if (isset($_GET['data'])) {
    echo $_GET['data'];
}
?>

</form>