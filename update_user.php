<?php
include 'components/connect.php';

session_start();

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Fetch user profile
    function get_user_profile($conn, $user_id) {
        $query = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
        $query->execute([$user_id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    $fetch_profile = get_user_profile($conn, $user_id);

    $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
    $update_profile->execute([$name, $email, $user_id]);

    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $prev_pass = $fetch_profile["password"];
    $old_pass = $_POST['old_pass'];
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $new_pass = $_POST['new_pass'];
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cpass = $_POST['cpass'];
    $cpass = filter_var($cpass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($old_pass)) {
        $message[] = 'Please enter old password!';
    } elseif (!password_verify($old_pass, $prev_pass)) {
        $message[] = 'Old password not matched!';
    } elseif ($new_pass != $cpass) {
        $message[] = 'Confirm password not matched!';
    } else {
        if (!empty($new_pass) && $new_pass != $empty_pass) {
            $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);
            $update_admin_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_admin_pass->execute([$hashed_password, $user_id]);
            $message[] = 'Password updated successfully!';
        } else {
            $message[] = 'Please enter a new password!';
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
   <title>Update Profile</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Update Profile</h3>
      <input type="hidden" name="prev_pass" value="<?= $fetch_profile["password"]; ?>">
      <input type="text" name="name" required placeholder="Enter your username" maxlength="20"  class="box" value="<?= $fetch_profile["name"]; ?>">
      <input type="email" name="email" required placeholder="Enter your email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile["email"]; ?>">
      <input type="password" name="old_pass" placeholder="Enter your old password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="Enter your new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" placeholder="Confirm your new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Update Profile" class="btn" name="submit">
   </form>

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
