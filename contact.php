<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

if (isset($_POST['send'])) {

   $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
   $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $msg = filter_input(INPUT_POST, 'msg', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   // Validate form inputs
   if (empty($name) || empty($email) || empty($number) || empty($msg)) {
      $message[] = 'Please fill in all the required fields.';
   } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $message[] = 'Please enter a valid email address.';
   } elseif (!preg_match('/^[0-9]{10}$/', $number)) {
      $message[] = 'Please enter a valid 10-digit phone number.';
   } else {
      // 
      $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
      $select_message->execute([$name, $email, $number, $msg]);

      if ($select_message->rowCount() > 0) {
         $message[] = 'Already sent message!';
      } else {
         // 
         $insert_message = $conn->prepare("INSERT INTO `messages` (user_id, name, email, number, message) VALUES (?, ?, ?, ?, ?)");
         $insert_message->execute([$user_id, $name, $email, $number, $msg]);

         $message[] = 'Message sent successfully!';
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      html, body {
         height: 100%;
      }

      .wrapper {
         display: flex;
         flex-direction: column;
         min-height: 100%;
      }

      .content {
         flex: 1 0 auto;
      }

      .footer {
         flex-shrink: 0;
      }
   </style>

</head>
<body>
   <div class="wrapper">
      <?php include 'components/user_header.php'; ?>

      <section class="contact content">
   <form action="" method="post">
      <h3>Your Feedback</h3>
      <?php if (!empty($message) && is_array($message)) { ?>
         <div class="message">
            <?php foreach ($message as $msg) {
               echo $msg;
            } ?>
         </div>
      <?php } ?>
      <input type="text" name="name" placeholder="Enter your name" required maxlength="20" class="box">
      <input type="email" name="email" placeholder="Enter your email" required maxlength="50" class="box">
      <input type="text" name="number" placeholder="enter your number" class="box" pattern="[0-9]{10}" inputmode="numeric" required>
      <textarea name="msg" class="box" placeholder="Enter your message" cols="30" rows="10"></textarea>
      <input type="submit" value="Send" name="send" class="btn">
   </form>
</section>


      <?php include 'components/footer.php'; ?>
   </div>

   <script src="js/script.js"></script>
</body>
</html>
