<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>category index</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
<?php include_once "../models/categories.php" ;
$all_category=new categories;
$pdo=$all_category->connect();

$data=$all_category->get_categories($pdo);

?>

<div class="table-responsive">
  <table class="table">

<tr>
    <td>id</td>
    <td>name</td>
    <td>image</td>
    <td>actions</td>
</tr>
<?php foreach ($data as $value) { ?>
<tr>

    <td><?= $value['id'] ?></td>
    <td><?= $value['cat_name'] ?></td>
    <td > <img src="<?php echo $value['image']; ?>"  style='width: 10%;height: 10%;'> </td>
    <td>
   <a href="category_update.php?id=<?php echo $value['id']; ?>"> <button type="button" class="btn btn-success">update</button></a>
   <a href="category_delete.php?id=<?php echo $value['id']; ?>"><button type="button" class="btn btn-danger">delete</button></a>
   <a href="category_show.php?id=<?php echo $value['id']; ?>"><button type="button" class="btn btn-info">show</button></a>
    </td>
</tr>
<?php } ?>

<tr>
    <td colSpan="2" style="text-align:center"> <?php echo "num of categories:\t\t" . count($data); ?> </td>
    <td colSpan="2" style="text-align:center"> <a href="category_add.php"><button type="button" class="btn btn-success">add category</button> </td></a>
</tr>

</table>
</div>
</body>

</html>