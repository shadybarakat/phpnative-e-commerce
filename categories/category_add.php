
<?php 
$erorr="";
if (isset($_GET['data'])) { 
    if ($_GET['data']==0) {
        $erorr="enter name";
    }
}
    ?>

<form action="category_insert.php" method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="name"> <?php echo $erorr; ?>
    <input type="file" name="image">
    <input type="submit" name="submit">
</form>