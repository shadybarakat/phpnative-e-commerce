<?php include_once "../models/products.php";
$product=new products;
$pdo=$product->connect();
$result=$product->get_products($pdo,$_GET['id']);

?>
<img src="<?=$result['images'][0]['image']?>" alt="" style='width: 50%; height: 50%;'>
<h4>product name: <?= $result['name'] ?></h4>
<h4>price before : <?= $result['price_before']?></h4>
 <h4>price after :<?= $result['price_after']?></h4>

<h3>available sizes :</h3>

<ul>
<?php foreach ($result['sizes'] as $value) {  ?>
  <li><h4><?= $value['name'] ?></h4></li> 
<?php } ?>
</ul>

<h3>available colors :</h3>

<ul>
<?php foreach ($result['colors'] as $value) {?>
  <li><h4 style="color: <?= $value['name'] ?>"><?= $value['name'] ?></h4></li> 
<?php } ?>
</ul>

