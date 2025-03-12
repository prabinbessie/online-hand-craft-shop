<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/like_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop</title>

   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/style.css">

   <style>
   .products .box-container {
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
   gap: 1.5rem;
   justify-items: center;
   align-items: flex-start;
}

.products .box-container .box {
   position: relative;
   background-color: #fff;
   box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
   border-radius: 10px;
   overflow: hidden;
   transition: transform 0.3s ease-in-out;
   height: 100%;
}

.products .box-container .box:hover {
   transform: translateY(-5px);
}

.products .box-container .box img {
   height: 200px;
   width: 100%;
   object-fit: contain;
   border-radius: 10px 10px 0 0;
}

.products .box-container .box .content {
   padding: 1.5rem;
}

.products .box-container .box .name {
   font-size: 1.8rem;
   color: #333;
   margin-bottom: 1rem;
   text-align: center;
}

.products .box-container .box .price {
   font-size: 1.6rem;
   color: #e74c3c;
   font-weight: bold;
   text-align: center;
   margin-bottom: 1rem;
}

.products .box-container .box .qty-container {
   display: flex;
   justify-content: center;
   align-items: center;
   margin-bottom: 1rem;
}

.products .box-container .box .qty-container .qty-label {
   font-size: 1.4rem;
   color: #555;
   margin-right: 0.5rem;
}

.products .box-container .box .qty-container .qty {
   width: 5rem;
   padding: 0.5rem;
   border: 1px solid #ccc;
   border-radius: 5px;
   font-size: 1.4rem;
   text-align: center;
}

.products .box-container .box .btn {
   display: block;
   width: 100%;
   padding: 1rem;
   background-color: #3498db; 
   color: #fff;
   text-align: center;
   text-decoration: none;
   font-weight: bold;
   border-radius: 5px;
   transition: background-color 0.3s ease-in-out;
}

.products .box-container .box .btn:hover {
   background-color: #2980b9; 
}

.products .box-container .box .fa-heart,
   .products .box-container .box .fa-eye {
      position: absolute;
      top: 1rem;
      height: 3rem; 
      width: 3rem;  
      line-height: 3rem; 
      font-size: 1.5rem; 
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 50%;
      text-align: center;
      color: #555;
      cursor: pointer;
      transition: 0.2s linear;
   }

   .products .box-container .box .fa-heart {
      right: 1rem;
   }

   .products .box-container .box .fa-eye {
      left: 1rem;
   }

   .products .box-container .box:hover .fa-heart,
   .products .box-container .box:hover .fa-eye {
      background-color: #3498db;
      color: #fff;
   }

   .products .box-container .box .btn {
      display: block;
      width: 100%;
      padding: 0.8rem; 
      background-color: #3498db;
      color: #fff;
      text-align: center;
      text-decoration: none;
      font-weight: bold;
      border-radius: 5px;
      transition: background-color 0.3s ease-in-out;
      font-size: 1.4rem; 
   }

   .products .box-container .box .btn:hover {
      background-color: #2980b9;
   }

</style>

</head>
<body>
   <?php include 'components/user_header.php'; ?>

   
   <section class="products">
      <h1 class="heading"></h1>

      <div class="box-container">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `products`"); 
            $select_products->execute();
            if($select_products->rowCount() > 0){
               while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
         ?>
         <form action="" method="post" class="box">
            <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
            <button class="fas fa-heart" type="submit" name="add_to_like"></button>
            <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
            <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
            <div class="content">
               <div class="name"><?= $fetch_product['name']; ?></div>
               <div class="price">₨<?= $fetch_product['price']; ?>/-</div>
               <div class="qty-container">
                  <label class="qty-label" for="qty">Qty:</label>
                  <input type="number" name="qty" class="qty" min="1" max="5" value="1">

               </div>
               <button type="submit" class="btn" name="add_to_cart">ADD TO
   <span class="fas fa-shopping-cart"></span> 
</button>
            </div>
         </form>
         <?php
            }
         }else{
            echo '<p class="empty">No products found!</p>';
         }
         ?>
      </div>
   </section>



   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>
</body>
</html>
