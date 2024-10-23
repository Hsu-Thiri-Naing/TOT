<?php
 session_start();
 unset( $_SESSION['id'] );
//  session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link rel="stylesheet" href="./css/style2.css">
</head>
<body>
<div class="container">
 <h1 class="H1">Goodbye for now!</h1>
 <p class="p">You have been logged out successfully.<br>
  Come back anytime.</p>
 <button class="logout-btn"><a href="login.php" class="logout-btn1">Log Back In</a></button>
</div>
</body>
</html>