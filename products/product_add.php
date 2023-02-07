
<?php include_once("../models/categories.php");

$category=new categories;
$pdo=$category->connect();
$data=$category->get_categories($pdo);
$sizes=$category->sizes($pdo);    
$colors=$category->colors($pdo);  
?>

<form action="product_insert.php" method="POST" enctype="multipart/form-data">
<div class="col-lg-12">
        <input required type="text" name="name" placeholder="name">
        <label for="category">category:</label>
            <select name="category" >
                <?php foreach ($data as $value) { ?>
                <option value="<?= $value['id'] ?>"><?= $value['cat_name']?></option>
                <?php }?>

    </select>
</div>




<div class="col-lg-12">
                <label for="size">avalable sizes</label>
                <?php foreach ($sizes as $value) { ?>
                    <input type="checkbox" name="size_id[]" value="<?= $value['id'] ?>" multiple><?= $value['name']?>

                <?php }?>
</div>

<div class="col-lg-12">
                <label for="size">avalable colors</label>
                <?php foreach ($colors as $value) { ?>
                    <input type="checkbox" name="color_id[]" value="<?= $value['id'] ?>" multiple> <span style="color: <?= $value['name'] ?>"> <?= $value['name'] ?> </span>
                <?php }?>
</div>

      <input type="text" name="description" placeholder="description">

<div class="col-lg-12">
    <input required type="number" name="price_before" placeholder="price before">
    <input required type="number" name="price_after" placeholder="price after">
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

