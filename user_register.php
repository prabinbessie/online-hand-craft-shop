<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $cpass = $_POST['cpass'];
   $cpass = filter_var($cpass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email,]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'Email already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm password does not match!';
      }else{
         $hashedPassword = password_hash($cpass, PASSWORD_DEFAULT);

         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
         $insert_user->execute([$name, $email, $hashedPassword]);
         $message[] = 'Registered successfully! Please login now.';
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
   <title>Register</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link for login page style -->
   <link rel="stylesheet" href="css/style.css">
   
   <style>
    

        .login-heading {
        margin-bottom: 30px;
        color: #333;
        font-size: 32px;
    }

    
    .login-box h2.login-heading {
        margin: 20px auto;
    }
        .login-box {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 500px;
            width: 90%;
            margin: 60px auto;
        }

        .message {
            color: red;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .box {
            width: 100%;
            padding: 12px 30px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 15px;
        }
        .option-text {
    font-size: 18px;
    color: #555;
    margin-bottom: 10px;
    text-align: center;
}

.option-btn-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 20px;
}

.option-btn {
    padding: 12px 30px;
    border: none;
    border-radius: 4px;
    background-color: #f0f0f0;
    color: #007bff;
    font-size: 18px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

.option-btn:hover {
    background-color: #e0e0e0;
}


        .btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .option-btn {
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            background-color: #f0f0f0;
            color: #007bff;
            font-size: 18px;
            text-decoration: none;
            cursor: pointer;
        }

        .option-btn:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="login-box">

   <form action="" method="post">
      <h2 class="login-heading">Register</h2>
      <?php if (isset($message)) { 
         foreach($message as $msg) {
            echo '<div class="message">' . $msg . '</div>';
         }
      } ?>
      <input type="text" name="name" required placeholder="Enter your username" maxlength="20" class="box">
      <input type="email" name="email" required placeholder="Enter your email" maxlength="50" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Enter your password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="Confirm your password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Register Now" class="btn" name="submit">
      <div class="option-btn-container">
    <p class="option-text">Already have an account?</p>
    <a href="user_login.php" class="option-btn">Login Now</a>
</div>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
