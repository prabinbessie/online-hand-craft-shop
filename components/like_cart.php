<?php

if(isset($_POST['add_to_like'])){

   if($user_id == ''){
      header('location:user_login.php');
   }else{


      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $check_like_numbers = $conn->prepare("SELECT * FROM `like` WHERE name = ? AND user_id = ?");
      $check_like_numbers->execute([$name, $user_id]);

      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);

      if($check_like_numbers->rowCount() > 0){
         $message[] = 'already added to favorite!';
      }elseif($check_cart_numbers->rowCount() > 0){
         $message[] = 'already added to cart!';
      }else{
         $insert_like = $conn->prepare("INSERT INTO `like`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
         $insert_like->execute([$user_id, $pid, $name, $price, $image]);
         $message[] = 'added to favorite!';
      }

   }

}
if (isset($_POST['add_to_cart'])) {

   if($user_id == ''){
      header('location:user_login.php');
   }else{

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $qty = $_POST['qty'];
      $qty = filter_var($qty, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);

      if($check_cart_numbers->rowCount() > 0){
         $message[] = 'already added to cart!';
      }else{

         $check_like_numbers = $conn->prepare("SELECT * FROM `like` WHERE name = ? AND user_id = ?");
         $check_like_numbers->execute([$name, $user_id]);

         if($check_like_numbers->rowCount() > 0){
            $delete_like = $conn->prepare("DELETE FROM `like` WHERE name = ? AND user_id = ?");
            $delete_like->execute([$name, $user_id]);
         }

         $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
         $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
         $message[] = 'added to cart!';
         
      }

   }

}

?>
