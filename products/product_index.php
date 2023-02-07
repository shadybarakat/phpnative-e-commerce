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
<style>
  tr:nth-child(even) {
  background-color: #D6EEEE;
}
.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
}

.pagination a.active {
  background-color: dodgerblue;
  color: white;
}

.pagination a:hover:not(.active) {background-color: #ddd;}
</style>
</head>

<body>
<?php include_once "../models/products.php" ;
$all_products=new products;
$pdo=$all_products->connect();
$data=$all_products->get_products($pdo);
?>

<div class="pagination">
  <a href="#">&laquo;</a>
  <a href="#">1</a>
  <a class="active" href="#">2</a>
  <a href="#">3</a>
  <a href="#">4</a>
  <a href="#">5</a>
  <a href="#">6</a>
  <a href="#">&raquo;</a>
</div>

<div class="table-responsive">
  <table class="table" style="width:100%">

<tr>
    <td>id</td>
    <td>name</td>
    <td>description</td>
    <td>price_before</td>
    <td>pricr_after</td>
    <td>category</td>
    <td>image</td>
    <th>actions</th>
</tr>
<?php foreach ($data as $value) { ?>
<tr>
    <td><?= $value['id'] ?></td>
    <td><?= $value['name'] ?></td>
    <td style="width:20%"><?= $value['description'] ?></td>
    <td><?= $value['price_before'] ?></td>
    <td><?= $value['price_after'] ?></td>
    <td><?= $value['cat_name'] ?></td>
<td style="width:15%"><img class="img-fluid" src="<?php echo $value['images'][0]['image'];  ?>" alt="" style='width: 50%;height: 50%;'></td>


    <td style="width:20%">
   <a href="product_update.php?id=<?php echo $value['id']; ?>"> <button type="button" class="btn btn-success">update</button></a>
   <a href="product_delete.php?id=<?php echo $value['id']; ?>"><button type="button" class="btn btn-danger">delete</button></a>
   <a href="product_show.php?id=<?php echo $value['id']; ?>"><button type="button" class="btn btn-info">show</button></a>
    </td>
</tr>
<?php } ?>

<tr>
    <td colSpan="2" style="text-align:center"> <?php echo "num of products:\t\t" . count($data); ?> </td>
    <td colSpan="2" style="text-align:center"> <a href="product_add.php"><button type="button" class="btn btn-success">add product</button> </td></a>
</tr>

</table>
</div>
</body>

</html>