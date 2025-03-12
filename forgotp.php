<?php
include 'components/connect.php';

session_start();

$message = ''; 

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $newPassword = $_POST['new_password'];

    $username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $newPassword = filter_var($newPassword, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $stmt = $conn->prepare("SELECT * FROM `users` WHERE name = ? AND email = ?");
    $stmt->execute([$username, $email]);
    $user = $stmt->fetch();

    if (!$user) {
        $message = 'Username and email do not match!';
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $updatePasswordStmt = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
        $updatePasswordStmt->execute([$hashedPassword, $user['id']]);

        $_SESSION['password_changed'] = true; // Set session variable to notify successful password change

        // Redirect to user_login.php
        header("Location: user_login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <style>
       
        .forgot-password-container {
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
            height: auto;
        }

        .forgot-password-heading {
            margin: 20px auto;
            color: #333;
            font-size: 28px;
        }

        .forgot-password-message {
            color: red;
            font-size: 18px;
            margin: 10px 0;
            text-align: center;
        }

        .forgot-password-message.success {
            color: green;
        }

        .forgot-password-box {
            width: 100%;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .forgot-password-btn {
            width: 100%;
            padding: 18px;
            border: none;
            border-radius: 6px;
            background-color: #007bff;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
        }

        .forgot-password-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<section class="forgot-password-container">
    <form action="" method="post">
        <h3 class="forgot-password-heading">Forgot Password</h3>
        <?php if (!empty($message)) { ?>
            <div class="forgot-password-message">
                <?php echo $message; ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['password_changed'])) { ?>
            <div class="forgot-password-message success">
                Password changed successfully!
            </div>
            <?php unset($_SESSION['password_changed']); ?>
        <?php } ?>
        <input type="text" name="username" required placeholder="Enter your username" maxlength="20" class="forgot-password-box">
        <input type="email" name="email" required placeholder="Enter your email" maxlength="50" class="forgot-password-box">
        <input type="password" name="new_password" required placeholder="Enter new password" class="forgot-password-box" maxlength="8">
        <input type="submit" value="Reset Password" class="forgot-password-btn" name="submit">
    </form>
</section>

<script src="js/script.js"></script>

</body>
</html>
