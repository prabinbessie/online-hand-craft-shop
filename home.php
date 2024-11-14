<?php
include 'components/connect.php';

session_start();
if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}

// 
$current_page = basename($_SERVER['PHP_SELF']);
$login_page = 'user_login.php'; // 


include 'components/like_cart.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>
   <!-- Swiper Library -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!--  CSS -->
   <link rel="stylesheet" href="css/style.css">
   <style>
.home-bg .home .slide {
   display: flex;
   align-items: center;
   flex-wrap: wrap;
   gap: 1.5rem;
   padding-bottom: 6rem;
   padding-top: 2rem;
   user-select: none;
}

.home-bg .home .slide .image {
   flex: 1 1 30rem;
}

.home-bg .home .slide .image img {
   height: 40rem;
   width: 100%;
   object-fit: contain;
}

.home-bg .home .slide .content {
   flex: 1 1 30rem;
}

.home-bg .home .slide .content span {
   font-size: 2rem;
   color: var(--white);
}

.home-bg .home .slide .content h3 {
   margin-top: 1rem;
   font-size: 4rem;
   color: var(--white);
   text-transform: uppercase;
}

.home-bg .home .slide .content .btn {
   display: inline-block;
   width: auto;
}
/* cato css  yo */
.category {
   text-align: center;
   margin-bottom: 20px;
 }
 
 .heading {
   font-size: 24px;
   margin-bottom: 10px;
 }
 
 .category-slider {
   display: flex;
   justify-content: center;
   align-items: center;
   flex-wrap: wrap;
   max-width: 900px;
   margin: 0 auto;
 }
 
 .category-item {
   flex: 0 0 calc(33.33% - 20px);
   display: flex;
   flex-direction: column;
   align-items: center;
   justify-content: center;
   margin: 10px;
   padding: 20px;
   text-align: center;
   background-color: #f2f2f2;
   border-radius: 10px;
   transition: background-color 0.3s ease;
 }
 
 .category-item:hover {
   background-color: #e0e0e0;
   transform: translateY(-5px);
   box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
 }
 
 .category-item img {
   width: 80px;
   height: 80px;
   margin-bottom: 10px;
 }
 
 .category-item h3 {
   font-size: 16px;
   font-weight: bold;
 }
 .category-item h3 {
   color: #3a6cf4;
   font-size: 16px;
   font-weight: bold;
   margin-top: 10px;
 }
 
 .category-item h3:hover {
   color: #ff5500;
 }
 
 
 @media (max-width: 768px) {
   .category-item {
     flex-basis: calc(50% - 20px);
   }
 }
 
 @media (max-width: 480px) {
   .category-item {
     flex-basis: calc(100% - 20px);
   }
 }
 .home-products {
   padding: 2rem;
}

.home-products .heading {
   font-size: 2.5rem;
   color: #333;
   text-align: center;
   margin-bottom: 2rem;
}

.home-products .products-container {
   display: flex;
   flex-wrap: wrap;
   justify-content: flex-start;
   align-items: flex-start;
   margin: -1.5rem; /*  */
}

.home-products .product {
   flex: 0 0 calc(33.33% - 3rem); /*  */
   margin: 1.5rem; /*  */
}




.home-products .product {
   position: relative;
   background-color: #fff;
   box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
   border-radius: 10px;
   overflow: hidden;
   height: 100%;
   padding: 1.5rem;
   display: flex;
   flex-direction: column;
   align-items: center;
   
}

.home-products .product img {
   max-width: 100%;
   max-height: 200px;
   object-fit: contain;
   border-radius: 10px 10px 0 0;
}

.home-products .product .name {
   font-size: 1.8rem;
   color: #333;
   margin: 1rem 0;
   text-align: center;
}

.home-products .product .flex {
   display: flex;
   justify-content: space-between;
   align-items: center;
   width: 100%;
}

.home-products .product .price {
   font-size: 1.6rem;
   color: #e74c3c;
   font-weight: bold;
   margin-right: 0.5rem;
}

.home-products .product .price span {
   font-size: 1.4rem;
   color: #555;
}

.home-products .product .qty {
   width: 5rem;
   padding: 0.5rem;
   border: 1px solid #ccc;
   border-radius: 5px;
   font-size: 1.4rem;
   text-align: center;
}

.home-products .product .btn {
   width: 100%;
   padding: 1rem;
   background-color: #3498db; 
   color: #fff;
   text-align: center;
   text-decoration: none;
   font-weight: bold;
   border-radius: 5px;
   transition: background-color 0.3s ease-in-out;
   margin-top: 1rem;
}

.home-products .product .btn-shop {
   width: 100%;
   padding: 1rem;
   background-color: #e74c3c; /* Red button background color */
   color: #fff;
   text-align: center;
   text-decoration: none;
   font-weight: bold;
   border-radius: 5px;
   transition: background-color 0.3s ease-in-out;
   margin-top: 1rem;
}

.home-products .product .btn:hover {
   background-color: #2980b9; 
}

.home-products .product .btn-shop:hover {
   background-color: #c0392b; 
}

.home-products .product .fa-heart,
.home-products .product .fa-eye {
   position: absolute;
   top: 1rem;
   height: 4.5rem;
   width: 4.5rem;
   line-height: 4.2rem;
   font-size: 2rem;
   background-color: #fff;
   border: 1px solid #ccc;
   border-radius: 50%; 
   text-align: center;
   color: #555; 
   cursor: pointer;
   transition: 0.2s linear;
}

.home-products .product .fa-heart {
   right: 1rem;
}

.home-products .product .fa-eye {
   left: 1rem;
}

.home-products .product:hover .fa-heart,
.home-products .product:hover .fa-eye {
   background-color: #3498db; 
   color: #fff;
}


    </style>

</head>

<body>
   <?php include 'components/user_header.php'; ?>

   <div class="home-bg">
      <section class="home">
      <div class="swiper home-slider">
   <div class="swiper-wrapper">
      <div class="swiper-slide">
         <div class="s slide">
            <div class="image">
               <img src="images/22copy.png" alt="">
            </div>
            <div class="content">
               <h3 style="color:blue;">Hemp Bags</h3>
               <span style="color:white">Discover the charm of Nepal with
                our Hemp Bags – a fusion of style and sustainability. Handcrafted with love, 
                these bags are your eco-friendly companion for any adventure.
                Make a difference in style. Choose Nepali Hemp Bags today. 🌿👜 #SustainableFashion #NepaliCraftsmanship</span><br>
               <a href="shop.php" class="btn btn-shop">Shop Now</a>
            </div>
         </div>
      </div>
      <div class="swiper-slide">
         <div class="s slide">
            <div class="image">
               <img src="images/333.png" alt="">
            </div>
            <div class="content">
               <h3 style="color:blue;">Tibetan Singing bowls</h3>
               <span style="color:white">Unearth timeless harmony with our Tibetan Singing Bowls.
                🕊️ Immerse yourself in the ancient resonance, handcrafted in the heart of tradition. 
                Elevate your meditation and bring home the essence of Tibet. 
                🏔️ #TibetanSingingBowls #TimelessHarmony</span><br>
               <a href="shop.php" class="btn btn-shop">Shop Now</a>
         </div>
      </div>
      
   </div>
   <div class="swiper-slide">
         <div class="s slide">
            <div class="image">
               <img src="images/111.png" alt="">
            </div>
            <div class="content">
               <h3 style="color:blue;">Mahakal Mask</h3>
               <span style="color:white">"Experience the enchanting allure of Nepal's handcrafted Makhakal masks. 
                  Shop now and adorn your space with these captivating wooden masterpieces. 
                  Embrace the rich cultural heritage of Nepal and bring home a piece of traditional artistry. 
                  Explore our collection and immerse yourself in the beauty of Nepali craftsmanship. Buy your authentic Makhakal mask today!"</span><br>
               <a href="shop.php" class="btn btn-shop">Shop Now</a>
         </div>
      </div>
      
   </div>
   <div class="swiper-pagination"></div>
   <div class="swiper-button-next"></div>
   <div class="swiper-button-prev"></div>
</div>
      </section>
   </div>

   <!-- Category section -->
   <section class="category">
      <h1 class="heading">Our Category</h1>
      <div class="category-slider">
         <a href="category.php?category=singing-bowl" class="category-item">
            <img src="images/icon-1.png" alt="">
            <h3>Singing Bowl</h3>
         </a>
         <a href="category.php?category=incense" class="category-item">
            <img src="images/icon-2.png" alt="">
            <h3>Incense</h3>
         </a>
         <a href="category.php?category=wood" class="category-item">
            <img src="images/icon-3.png" alt="">
            <h3>Wood Carving</h3>
         </a>
         <a href="category.php?category=hemp" class="category-item">
            <img src="images/icon-4.png" alt="">
            <h3>Hemp Products</h3>
         </a>
         <a href="category.php?category=mala" class="category-item">
            <img src="images/icon-5.png" alt="">
            <h3>Jewelry</h3>
         </a>
      </div>
   </section>

  <!-- Featured products section -->
<section class="home-products">
   <h1 class="heading">Featured Products</h1>
   <div class="products-container">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
      ?>
               <form action="" method="post" class="product">
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
         } else {
            echo '<p class="empty">No products added yet!</p>';
         }
      ?>
   </div>
</section>

<script>
   document.addEventListener('DOMContentLoaded', function () {
      var homeSlider = new Swiper('.home-slider', {
         slidesPerView: 1,
         spaceBetween: 10,
         loop: true, // Enables loop
         autoplay: {
            delay: 5000, // Adjust the delay b
            disableOnInteraction: false, // Enable interactio
         },
         pagination: {
            el: '.swiper-pagination',
            clickable: true,
         },
         navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
         },
      });
   });
</script>
<script>
    window.onpopstate = function () {
        if (window.location.pathname.endsWith("user_login.php")) {
            var confirmLogout = confirm("Do you want to log out?");
            if (confirmLogout) {
                window.location.href = "logout.php";
            }
        }
    };
</script>



   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>
