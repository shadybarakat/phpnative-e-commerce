<?php include_once "database.php";

class products extends database{

    public function get_products($pdo,$id=0,$cat_id=0){
        $my_array=array();
        if (isset($cat_id) && $cat_id!=0) {
            $sql="SELECT* FROM categories AS c,products AS p 
            WHERE c.id=p.cat_id AND cat_id=:cat_id"; 
             $cat_products=$pdo->prepare($sql);
             $data=$cat_products->execute(['cat_id'=>$cat_id]);
             $result=$cat_products->fetchAll(PDO::FETCH_ASSOC);

        }else{
            $sql="SELECT* FROM categories AS c,products AS p 
            WHERE c.id=p.cat_id";
            $get=$pdo->query($sql);
            $result=$get->fetchAll(PDO::FETCH_ASSOC);
        }


        foreach ($result as $value) {
            //append images
            $stm=$pdo->prepare("SELECT image FROM product_image WHERE product_id=:id");
            $stmt=$stm->execute(['id'=>$value['id']]);
            $images=$stm->fetchAll(PDO::FETCH_ASSOC);
            $value['images']=$images;
            //append sizes
            $get_sizes=$pdo->prepare("SELECT s.id,s.name FROM sizes s join product_size Z join products p
            on s.id=z.size_id AND p.id=z.product_id AND p.id=:id");
            $p_id=$get_sizes->execute(['id'=>$value['id']]);
            $sizes=$get_sizes->fetchAll(PDO::FETCH_ASSOC);
            $value['sizes']=$sizes;
            //append colors
            $get_colors=$pdo->prepare("SELECT C.id,C.name FROM colors C join product_color O join products p
            on C.id=O.color_id AND p.id=O.product_id AND p.id=:id");
            $p_id=$get_colors->execute(['id'=>$value['id']]);
            $colors=$get_colors->fetchAll(PDO::FETCH_ASSOC);
            $value['colors']=$colors;
            if ($value['id']==$id && $id!=0) {

                return $value;
            }
            $my_array[]=$value;
        }
        // var_dump($my_array);
        // die();
        return $my_array;
    }

    public function add($pdo,$name,$category_id,$price_before,$price_after,$images,$description,$size_id='',$color_id=''){
            $sql="INSERT INTO products (name,cat_id,description,price_before,price_after) VALUES(:name,:cat_id,:description,:price_before,:price_after)";
            $data=['name'=>$name,'cat_id'=>$category_id,'description'=>$description,
            'price_before'=>$price_before,'price_after'=>$price_after];
            $add=$pdo->prepare($sql);
            $create=$add->execute($data);
            $id=$pdo->lastInsertId();
//insert images
            for ($i=0; $i <count($images) ; $i++) { 
                $sql="INSERT INTO product_image (product_id,image) Values (:product_id,:image)";
                $stmt=$pdo->prepare($sql);
                $source=$stmt->execute(['product_id'=>$id,'image'=>$images[$i]]);
            }
//insert sizes
if (isset($size_id) && !empty($size_id)) {
    for ($i=0; $i <count($size_id) ; $i++) { 
        $sql="INSERT INTO product_size (product_id,size_id) Values (:product_id,:size_id)";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(['product_id'=>$id,'size_id'=>$size_id[$i]]);
    }
    
}

//insert colors
if (isset($color_id) && !empty($color_id)) {
    for ($i=0; $i <count($color_id) ; $i++) { 
        $sql="INSERT INTO product_color (product_id,color_id) Values (:product_id,:color_id)";
        $stmt=$pdo->prepare($sql);
        $stmt->execute(['product_id'=>$id,'color_id'=>$color_id[$i]]);
    }
}

return $create;

    }
}