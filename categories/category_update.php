<?php include_once "../models/categories.php";
if (isset($_GET['id'])) {
    $category=new categories;
    $pdo=$category->connect();
    $result=$category->get_once($pdo,$_GET['id']);

}

?>

<form action="category_edit.php" method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="name" value= "<?php echo $result[0]['cat_name']; ?>" >
    <input type="file" name="image">
    <input type="hidden" name="id" value="<?php echo $result[0]['id']; ?>">
    <input type="submit" name="submit">
</form>