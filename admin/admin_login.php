<?php

include '../components/connect.php';

session_start();

if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $pass = sha1(htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8'));

    $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
    $select_admin->execute([$name, $pass]);
    $row = $select_admin->fetch(PDO::FETCH_ASSOC);

    if ($select_admin->rowCount() > 0) {
        $_SESSION['admin_id'] = $row['id'];
        header('location:dashboard.php');
    } else {
        $message[] = 'Invalid username or password!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/style.css">

   <style>

      .message {
         display: flex;
         justify-content: space-between;
         align-items: center;
         background-color: #f8d7da;
         color: #721c24;
         padding: 10px 20px;
         margin: 10px 0;
         border: 1px solid #f5c6cb;
         border-radius: 5px;
      }

      .message span {
         flex: 1;
         margin-right: 10px;
      }

      .message i {
         color: #721c24;
         cursor: pointer;
      }

      .form-container {
         display: flex;
         flex-direction: column;
         align-items: center;
         background-color: #fff;
         border-radius: 10px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         padding: 40px;
         max-width: 500px;
         width: 90%;
         margin: 60px auto;
      }

      .form-container h3 {
         margin-bottom: 15px;
         color: #333;
         font-size: 24px;
      }

      .custom-box {
         width: 100%;
         padding: 15px;
         border: 1px solid #ccc;
         border-radius: 6px;
         font-size: 18px;
         margin-bottom: 15px;
      }

      .btn {
         width: 100%;
         padding: 18px;
         border: none;
         border-radius: 6px;
         background-color: #007bff;
         color: #fff;
         font-size: 20px;
         cursor: pointer;
         transition: background-color 0.3s;
      }

      .btn:hover {
         background-color: #0056b3;
      }
      /* Show/hide password */
      .input-container {
    position: relative;
    margin-bottom: 15px;
}

.input-container input {
    width: 100%;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 18px;
}

.eye-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}

.eye-icon i {
    color: #ccc;
}
   </style>
</head>
<body>
   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
         <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
   ?>

<section class="form-container">
    <form action="" method="post">
        <h3>Admin Login</h3>

        <div class="input-container">
            <input type="text" name="name" required placeholder="Enter your username" maxlength="20" class="custom-box" oninput="this.value = this.value.replace(/\s/g, '')">
        </div>

        <div class="input-container">
            <input type="password" name="pass" required placeholder="Enter your password" maxlength="20" class="custom-box" oninput="this.value = this.value.replace(/\s/g, '')">
            <span class="eye-icon" onclick="togglePasswordVisibility()">
                <i class="fas fa-eye"></i>
            </span>
        </div>

        <input type="submit" value="Login" class="btn" name="submit">
    </form>
</section>

   <script>
      // Show/hide password function
      function togglePasswordVisibility() {
         const passwordInput = document.querySelector('input[name="pass"]');
         const eyeIcon = document.querySelector('.eye-icon i');
         if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
         } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
         }
      }
   </script>
</body>
</html>