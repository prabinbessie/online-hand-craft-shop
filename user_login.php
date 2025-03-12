<?php
// Include the database connection file
include 'components/connect.php';

// Start the session
session_start();


$message = '';

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Check if the user is on the login page
    $current_page = basename($_SERVER['PHP_SELF']);
    $login_page = 'user_login.php'; // Adjust this to the actual login page filename

    if ($current_page === $login_page) {
        // Destroy the session and redirect to the login page
        session_destroy();
        $_SESSION = array(); // Clear session variables
    }
} else {
    $user_id = '';
}

// Handle the form submission
if (isset($_POST['submit'])) {
    // Get the submitted email and password
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = $_POST['pass'];

    // Retrieve the user from the database based on the email
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select_user->execute([$email]);
    $user = $select_user->fetch(PDO::FETCH_ASSOC);

    // Verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Set the user_id in the session and redirect to the home page
        $_SESSION['user_id'] = $user['id'];
        header('location: home.php');
    } else {
        // error message if the email or password is incorrect
        $message = 'Incorrect email or password!';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
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
        height: 450px; 
    }

    #message {
        color: red;
        font-size: 20px;
        margin-bottom: 15px;
    }

    .input-container {
        position: relative;
        display: flex;
        align-items: center;
        margin-bottom: 30px;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        color: #ccc;
    }

    .input-field {
        width: 100%;
        padding: 15px 50px 15px 35px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 18px;
    }

    .login-btn {
        width: 100%;
        padding: 18px;
        border: none;
        border-radius: 6px;
        background-color: #007bff;
        color: #fff;
        font-size: 20px;
        cursor: pointer;
    }

    .login-btn:hover {
        background-color: #0056b3;
    }

    .options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
    }

    .option-btn {
        padding: 18px 25px;
        border: none;
        border-radius: 5px;
        background-color: #f0f0f0;
        color: #007bff;
        font-size: 20px;
        text-decoration: none;
        cursor: pointer;
    }

    .option-btn:hover {
        background-color: #e0e0e0;
    }
</style>
<script>
        // Check if the user is logged in
        var isLoggedIn = <?php echo json_encode(isset($_SESSION['user_id'])); ?>;
        

        var currentPage = window.location.href;
        
   
        window.addEventListener('popstate', function(event) {
            
            if (isLoggedIn && currentPage.endsWith('user_login.php')) {
                var confirmLogout = confirm('Do you want to log out?');
                if (confirmLogout) {
                    // Redirect to the logout page
                    window.location.href = 'logout.php';
                } else {
                    // Prevent going back to the login page if not logging out
                    history.pushState(null, null, currentPage);
                }
            }
        });
    </script>
</head>


<body>
    <div class="header-container">
        <?php include 'components/user_header.php'; ?>
    </div>
 
    <section class="login-box">
    <h2 class="login-heading">Login now!</h2> 
        <form action="" method="post">
       

            <?php if (!empty($message)) { ?>
                <!-- Display the error message if it is not empty -->
                <div id="message">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <div class="input-container">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" name="email" required placeholder="Enter your email" class="input-field" maxlength="50">
            </div>

            <div class="input-container">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="pass" required placeholder="Enter your password" class="input-field" maxlength="20">
                <span class="eye-icon" onclick="togglePasswordVisibility()">
                    <i class="fas fa-eye"></i>
                </span>
            </div>

            <input type="submit" value="LOG IN" class="login-btn" name="submit">

            <div class="options">
                <a href="user_register.php" class="option-btn">New customer? Register</a>
                <a href="forgotp.php" class="option-btn">Forgot Password?</a>
            </div>
        </form>
    </section>


    <?php include 'components/footer.php'; ?>

    <script src="js/script.js"></script>

    <script>
        // Remove invalid username message
        setTimeout(function () {
            var messageElement = document.getElementById('message');
            if (messageElement) {
                messageElement.remove();
            }
        }, 4000);

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