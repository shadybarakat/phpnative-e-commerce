<?php
include_once "database.php";

class carts extends database{
    public function order($pdo,$product_id,$user_id,$color,$size,$quantity){

        $sql="INSERT INTO `cart`( `product_id`, `user_id`, `size`, `color`, `quantity`) VALUES (:product_id,:user_id,:size,:color,:quantity)";
        $add_to_cart=$pdo->prepare($sql); 
        $exe=$add_to_cart->execute(['product_id'=>$product_id
                                    ,'user_id'=>$user_id
                                    ,'size'=>$size
                                    ,'color'=>$color
                                    ,'quantity'=>$quantity
                                    ]);
    
         return $exe;
    }
    
    public function get_cart($pdo,$user_id){
        $my_array=array();
        $sql = 'select p.name,p.price_after,c.* from  cart c join products p  on c.product_id=p.id and c.user_id=:id';
        $get_cart=$pdo->prepare($sql);
        $exe=$get_cart->execute(['id'=>$user_id]);
        $result=$get_cart->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $value) {
            $sql='select* from product_image where product_id=:id';
            $get_image=$pdo->prepare($sql);
            $ex=$get_image->execute(['id'=>$value['product_id']]);
            $images=$get_image->fetchAll(PDO::FETCH_ASSOC);
            $value['images']=$images;
            $my_array[]=$value;
        }
        // var_dump($my_array);
        // die();
        return $my_array;
    }

    public function delete_order($pdo,$id){

        $sql="DELETE FROM `cart` WHERE id=:id";
        $delete=$pdo->prepare($sql);
        $exe=$delete->execute(['id'=>$id]);
        return $exe;
    }
    }
