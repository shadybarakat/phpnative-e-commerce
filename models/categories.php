<?php
include_once "database.php";

class categories extends database{

    public function add($pdo,$name,$image){
        $add=$pdo->prepare("INSERT INTO categories (cat_name,image) VALUES(:name,:image)");
        $data=$add->execute(['name'=>$name ,'image'=>$image]);
        return $data;
    }

    public function get_categories($pdo){
        $my_array=array();
        $sql="SELECT* FROM categories";
        $get=$pdo->query($sql);
        $result=$get->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $value) {
    $sql="SELECT* FROM categories AS c,products AS p 
    WHERE c.id=p.cat_id AND cat_id=:cat_id"; 
     $cat_products=$pdo->prepare($sql);
     $data=$cat_products->execute(['cat_id'=>$value['id']]);
     $products=$cat_products->fetchAll(PDO::FETCH_ASSOC);
     $value['count']=count($products); 
     $my_array[]=$value;
}
// var_dump($my_array);
// die();
        return $my_array;
    }

    public function get_once($pdo,$id){
        $get=$pdo->prepare("SELECT* FROM categories WHERE id=:id");
        $data=$get->execute(['id'=>$id]);
        $result=$get->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update($pdo,$name,$image,$id){

        $update=$pdo->prepare("UPDATE categories set cat_name=:name , image=:image WHERE id=:id ");
        $apply=$update->execute(['name'=>$name,
                                 'image'=>$image,
                                 'id'=>$id]);

        return $apply;
    }

    public function delete($pdo,$id){
        $image=$pdo->prepare("SELECT image FROM categories WHERE id=:id");
        $exe=$image->execute(['id'=>$id]);
        $path=$image->fetchAll(PDO::FETCH_ASSOC);
        unlink($path[0]['image']);

        $stmt=$pdo->prepare("DELETE FROM categories WHERE id=:id");
        $remove=$stmt->execute(['id'=>$id]);
        return $remove;
    }



    public function sizes($pdo){
        $sql="SELECT* FROM sizes";
        $stmt=$pdo->query($sql);
        $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function colors($pdo){
        $sql="SELECT* FROM colors";
        $stmt=$pdo->query($sql);
        $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}