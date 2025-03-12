
    window.onpopstate = function () {
        if (window.location.pathname.endsWith("user_login.php")) {
            var confirmLogout = confirm("Do you want to log out?");
            if (confirmLogout) {
                window.location.href = "logout.php";
            }
        }
    };