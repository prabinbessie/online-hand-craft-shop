<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
}
//w
include 'components/like_cart.php';

if(isset($_POST['delete'])){
   $like_id = $_POST['like_id'];
   $delete_like_item = $conn->prepare("DELETE FROM `like` WHERE id = ?");
   $delete_like_item->execute([$like_id]);
}

if(isset($_GET['delete_all'])){
   $delete_like_item = $conn->prepare("DELETE FROM `like` WHERE user_id = ?");
   $delete_like_item->execute([$user_id]);
   header('location:like.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>favorites</title>
   
   <!-- font awesome  link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products">

   <h3 class="heading">Your favorites!</h3>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_like = $conn->prepare("SELECT * FROM `like` WHERE user_id = ?");
      $select_like->execute([$user_id]);
      if($select_like->rowCount() > 0){
         while($fetch_like = $select_like->fetch(PDO::FETCH_ASSOC)){
            $grand_total += $fetch_like['price'];  
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_like['pid']; ?>">
      <input type="hidden" name="like_id" value="<?= $fetch_like['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_like['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_like['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_like['image']; ?>">
      <a href="quick_view.php?pid=<?= $fetch_like['pid']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_like['image']; ?>" alt="">
      <div class="name"><?= $fetch_like['name']; ?></div>
      <div class="flex">
         <div class="price">₨<?= $fetch_like['price']; ?>/-</div>
         <input type="number" name="qty" class="qty" min="1" max="9" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="Add to Cart" class="btn" name="add_to_cart">
      <input type="submit" value="Delete Item" onclick="return confirm('Delete this from like?');" class="delete-btn" name="delete">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">Your like is empty</p>';
   }
   ?>
   </div>

   <div class="wishlist-total">
      <p>Total Amount: <span>₨<?= $grand_total; ?>/-</span></p>
      <a href="shop.php" class="option-btn">Continue Shopping</a>
      <a href="like.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Delete all from like?');">Delete All Items</a>
   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
