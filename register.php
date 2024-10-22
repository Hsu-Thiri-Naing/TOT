<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register Form</title>
<link rel="stylesheet" href="./css/common.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<script>
   function validateForm(){
    const name = document.getElementById("uname").value;
    const PSW = document.getElementById("psw").value;
    const REPSW = document.getElementById("repsw").value;

    if( !isNaN( name ) ){
        alert( "User name can't be only numbers!" );
        return false;
    }else if( PSW != REPSW ){
        alert( "Your confirm password is incorrect!" );
        return false;
    }else{
        alert( "Registered successfully..." );
        return true;
    }
   }
</script>
</head>
<body>
<div class="wrapper">
<div class="avatar"></div>
<div class="input-box">
<form action="register_get_data.php" method="post" onsubmit="return validateForm()">

<div class="input-field">
 <input type="text" name="uname" id="uname" placeholder="Enter your name" required/>
 <i class='bx bxs-user'></i>
</div>
<div class="input-field">
 <input type="email" name="email" id="email" placeholder=" Enter your email" required/>
 <i class='bx bx-envelope'></i>
</div>
<div class="input-field">
 <input type="password" name="psw" id="psw" placeholder=" Create password" required/>
 <i class='bx bx-lock'></i>
</div>
<div class="input-field">
<input type="password" name="repsw" id="repsw" placeholder=" Confirm password" required/>
<i class='bx bxs-lock-alt'></i>
</div>

<button type="submit" class="btn">Register</button>
</form>

</div>
</div>
</body>
</html>