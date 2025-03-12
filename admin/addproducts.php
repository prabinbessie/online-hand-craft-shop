<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit;
}

if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $brand = $_POST['brand'];
    $brand = filter_var($brand, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $details = $_POST['details'];
    $details = filter_var($details, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $image_01 = $_FILES['image_01']['name'];
    $image_01 = filter_var($image_01, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $image_size_01 = $_FILES['image_01']['size'];
    $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
    $image_folder_01 = '../uploaded_img/' . $image_01;

   
   

    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
    $select_products->execute([$name]);

    if ($select_products->rowCount() > 0) {
        $message[] = 'Product name already exists!';
    } else {
        $insert_products = $conn->prepare("INSERT INTO `products`(name, brand, details, price, image_01) VALUES(?,?,?,?,?)");
        $insert_products->execute([$name, $brand, $details, $price, $image_01]);

        if ($insert_products) {
            if ($image_size_01 > 2000000) {
                $message[] = 'Image size is too large!';
            } else {
                move_uploaded_file($image_tmp_name_01, $image_folder_01);
              
                $message[] = 'New product added!';
            }
        }
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
    unlink('../uploaded_img/' . $fetch_delete_image['image_01']);
    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_product->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
    $delete_cart->execute([$delete_id]);
    $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
    $delete_wishlist->execute([$delete_id]);
    header('location:products.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
      /* ...  CSS ...

      .add-products {
   padding: 50px 0;
   background-color: #f8f9fa;  
} */

.add-products-heading {
   font-size: 24px;
   margin-bottom: 30px;
   color: #234;
   text-align: center;
}

.add-products-form {
   background-color: #fff;
   border-radius: 10px;
   box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
   padding: 30px;
}

.add-products-flex {
   display: flex;
   flex-wrap: wrap;
   gap: 20px;
}

.add-products-inputBox {
   flex: 1;
   margin-bottom: 20px;
}

.add-products-label {
   font-size: 14px;
   color:black;
   margin-bottom: 8px;
   display: block;
}

.add-products-box {
   width: 100%;
   padding: 15px;
   background-color: #f8f9fa;
   border-radius: 8px;
   font-size: 16px;
   border: none;
   transition: background-color 0.3s;
}

.add-products-box:focus {
   background-color: #e8ebf0;
   outline: none;
}

.add-products-btn {
   width: 100%;
   padding: 14px;
   border: none;
   border-radius: 6px;
   background-color: #007bff;
   color: #fff;
   font-size: 18px;
   cursor: pointer;
   transition: background-color 0.3s, transform 0.3s;
}

.add-products-btn:hover {
   background-color: #0056b3;
   transform: translateY(-2px);
}

.add-products-textarea {
   width: 100%;
   padding: 10px;
   background-color: #f8f9fa;
   border-radius: 8px;
   font-size: 16px;
   resize: vertical;
   border: none;
   transition: background-color 0.3s;
}

.add-products-textarea:focus {
   background-color: #e8ebf0;
   outline: none;
}

   </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="add-products">
      <h1 class="add-products-heading">Add Product</h1>
      <form action="" method="post" enctype="multipart/form-data" class="add-products-form">
         <div class="add-products-flex">
            <div class="add-products-inputBox">
               <label for="name" class="add-products-label">Product Name (required)</label>
               <input type="text" id="name" class="add-products-box" required maxlength="100" placeholder="Enter product name" name="name">
            </div>
            <div class="add-products-inputBox">
               <label for="price" class="add-products-label">Product Price (required)</label>
               <input type="number" id="price" min="0" class="add-products-box" required max="9999999999" placeholder="Enter product price" onkeypress="if(this.value.length == 6) return false;" name="price">
            </div>
            <div class="add-products-inputBox">
               <label for="brand" class="add-products-label">Product Brand (required)</label>
               <textarea id="brand" name="brand" placeholder="Enter Brand Name" class="add-products-textarea" required maxlength="500" cols="30" rows="10"></textarea>
            </div>
         </div>
         <div class="add-products-inputBox">
            <label for="image_01" class="add-products-label">Photo (required)</label>
            <input type="file" id="image_01" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="add-products-box" required>
         </div>
         <div class="add-products-inputBox">
            <label for="details" class="add-products-label">Product Details (required)</label>
            <textarea id="details" name="details" placeholder="Enter product details" class="add-products-textarea" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
         <input type="submit" value="Add Product" class="add-products-btn" name="add_product">
      </form>
   </section>





<script src="../js/admin_script.js"></script>
   
</body>
</html>