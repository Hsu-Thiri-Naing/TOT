<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="./css/common.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script>
        function validateForm() {
            const name = document.getElementById("uname").value;
            const PSW = document.getElementById("psw").value;
            const REPSW = document.getElementById("repsw").value;

            if (!isNaN(name)) {
                alert("User name can't be only numbers!");
                return false;
            } else if (PSW != REPSW) {
                alert("Your confirm password is incorrect!");
                return false;
            } else {
                // alert("Registered successfully...");
                return true;
            }
        }
    </script>
</head>

<body>
<?php
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $type = $_GET['type'];
    echo "<div class='$type' id='msgBox'>$message Try again.</br><small>Click to close the box</small></div>";
}
?>

    <div class="wrapper">
        <div class="avatar"> <img src="./assets/tot_square_logo.png" width="80" height="80" alt=""></div>
        <div class="input-box">
            <form action="user_add.php" method="post" onsubmit="return validateForm()">

                <div class="input-field">
                    <input type="text" name="uname" id="uname" placeholder="Enter your name" required />
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-field">
                    <input type="email" name="email" id="email" placeholder=" Enter your email" required />
                    <i class='bx bx-envelope'></i>
                </div>
                <div class="input-field">
                    <input type="password" name="psw" id="psw" placeholder=" Create password" required />
                    <i class='bx bx-lock'></i>
                </div>
                <div class="input-field">
                    <input type="password" name="repsw" id="repsw" placeholder=" Confirm password" required />
                    <i class='bx bxs-lock-alt'></i>
                </div>

                <button type="submit" class="btn">Register</button>
                <div class="p">Don't have an account?<a href="register.php" class="register">Register Now</a></div>
            </form>

        </div>
    </div>

    <script>
    // Wait for the DOM to load
    document.addEventListener("DOMContentLoaded", function() {
        // Get the message box element by its ID
        var msgBox = document.getElementById('msgBox');

        // Check if the message box exists before adding the event listener
        if (msgBox) {
            // Add a click event listener to the message box
            msgBox.addEventListener('click', function() {
                // Hide the message box when clicked
                msgBox.style.display = 'none';
            });
        }
    });
</script>
</body>

</html>