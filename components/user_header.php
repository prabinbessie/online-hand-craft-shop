<?php
   if(isset($message) && is_array($message)){
      foreach($message as $msg){
         echo '
         <div class="message">
            <span>'.$msg.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>header </title>
   <style>
      .small-header {
   background-color: #ffd700; /* Yellow background color */
   text-align: center;
   padding: 5px 0;
   font-size: 14px;
   color: #333; /* Dark text color */
}

.small-header p {
   margin: 0;
}
.extra-header {
   background-color: #f7f7f7;
   padding: 20px;
   text-align: center;
}

.extra-header-content {
   max-width: 800px;
   margin: 0 auto;
}

.extra-header h2 {
   font-size: 24px;
   margin-bottom: 10px;
}

.extra-header p {
   font-size: 16px;
   margin-bottom: 20px;
}

.extra-header .btn {
   display: inline-block;
   padding: 10px 20px;
   background-color: #3498db;
   color: #fff;
   text-decoration: none;
   border-radius: 5px;
   transition: background-color 0.3s ease;
}

.extra-header .btn:hover {
   background-color: #2980b9;
}
      </style>
</head>

<body>
   


<header class="header">

   <!-- New small extra header -->
   <div class="small-header">
      <p>Free Shipping on Orders Over Rs 5000</p>
   </div>

   <!-- Existing header content -->





   <section class="flex">

      <a href="home.php" class="logo"><b>Local<span>Shop</b></span></a>

      <nav class="navbar">
         <a href="home.php"><b>Home</b></a>
         <!--<a href="about.php"></a>-->
         <a href="shop.php"><b>Shop</b></a>
         <a href="blog.php"><b>Blog</b></a>
         <a href="contact.php"><b>Contact Us</b></a>
         <a href="orders.php"><b>History</b></a>
      </nav>

      <div class="icons">
         <?php
            $count_like_items = $conn->prepare("SELECT * FROM `like` WHERE user_id = ?");
            $count_like_items->execute([$user_id]);
            $total_like_counts = $count_like_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php"><i class="fas fa-search"></i></a>
         <a href="like.php"><i class="fas fa-heart" style="color: red;"></i><span>(<?= $total_like_counts; ?>)</span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="update_user.php" class="btn">Edit</a>
         <!--<div class="flex-btn">
             <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div> -->
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
         <?php
            }else{
         ?>
         <p>You need to login or register first!</p>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>
</header>

</body>
</html>