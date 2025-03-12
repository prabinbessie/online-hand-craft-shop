<?php
include 'components/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        
body {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.payment {
  flex-grow: 1;
}

.thank-you-box {
  padding: 20px;
  background-color: #f1f1f1;
  margin: 20px;
  text-align: center;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.thank-you-box h2 {
  font-size: 24px;
  margin-bottom: 10px;
  color: #3a6cf4;
}

.thank-you-box p {
  font-size: 16px;
  margin-bottom: 10px;
}

.thank-you-box img {
  max-width: 200px;
  margin: 20px auto;
}


body {
  background-image: url('path/to/background-image.jpg');
  background-size: cover;
}


.payment {
  display: flex;
  justify-content: center;
  align-items: center;
}


h2, p {
  font-family: 'Open Sans', Arial, sans-serif;
}


.thank-you-box img:hover {
  transform: scale(1.1);
  transition: transform 0.3s ease-in-out;
}


@media screen and (max-width: 768px) {
  .thank-you-box {
    margin: 10px;
  }
  
  .thank-you-box h2 {
    font-size: 20px;
  }
  
  .thank-you-box p {
    font-size: 14px;
  }
  
  .thank-you-box img {
    max-width: 150px;
  }
}

    </style>
</head>

<body>

    <?php include 'components/user_header.php'; ?>

    <section class="payment">

        <div class="thank-you-box">
            <h2 style="color:#3a6cf4;">Thank You for Shopping with Us!</h2>
            <p>Your order has been placed.</p>
            <p style="color: green;">Payed through eSewa</p>
            <img src="images/done.png" alt="Thank You Image">
        </div>

    </section>
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
