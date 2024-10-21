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
<div class="container">
  <form id="loginForm" action="check.php" method="post" onsubmit="return validateForm()">
   <div class="login-box">
   <div class="A1"></div>
   <div class="input-field">
   <input type="email" id="em" name="em" placeholder="gmail" required>    
   <i class='bx bx-envelope'></i><br>
   </div>
   <div class="input-field">
   <input type="password" id="pwd" name="pwd" placeholder="password" required>
   <i class='bx bx-lock'></i><br>
   </div>
   <button type="submit" >Log In</button>
   </div>
   <div class="p">Don't have an account?<a href="register.php" class="register">Register Now</a></div>
   </form>  
<script>
//  function validateForm(){
//   const EMAIL=document.getElementById("em").value;
//   const PASSWORD=document.getElementById("pwd").value;

//   if(!EMAIL || !PASSWORD ){
//    alert("Please fill in both fields.");
//    return false;
//   }
//   return true;}
</script>
</body>