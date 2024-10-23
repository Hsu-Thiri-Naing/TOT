<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/style1.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<?php
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $type = $_GET['type'];
    echo "<div class='$type' id='msgBox'><b>$message</b></br>
    <p>Please Log  to continue</p></br><small>Click the box to close</small></div>";
}
?>
  <div class="container">
    <form id="loginForm" action="check.php" method="post" onsubmit="return validateForm()">
      <div class="login-box">
        <div class="A1">
          <img src="./assets/tot_square_logo.png" width="80" height="80" alt="">
        </div>
        <div class="input-field">
          <input type="email" id="em" name="em" placeholder="Enter you email:" required>
          <i class='bx bx-envelope'></i><br>
        </div>
        <div class="input-field">
          <input type="password" id="pwd" name="pwd" placeholder="Enter your password:" required>
          <i class='bx bx-lock'></i><br>
        </div>
        <button type="submit">Log In</button>
      </div>
      <div class="p">Don't have an account?<a href="register.php" class="register">Register Now</a></div>
    </form>
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
    </script>
</body>