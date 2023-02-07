<?php

include_once 'database.php';
class users extends database{

public function add($pdo,$name,$email,$password,$role){
        $sql="insert into users (name,email,password,role) values(:name,:email,:password,:role)";
        $add_user=$pdo->prepare($sql);
        $apply=$add_user->execute([
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
            'role'=>$role
        ]);

       return  $apply;
    }

public function login($pdo,$email,$password){

    $sql = 'select * from  users WHERE email=:email AND password =:password ';
    $get_user=$pdo->prepare($sql);
    $apply=$get_user->execute([
        'email'=>$email,
        'password'=>$password,
    ]);
    $data=$get_user->fetchAll(PDO::FETCH_ASSOC);

    return $data;
}

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

    return $my_array;
}
}