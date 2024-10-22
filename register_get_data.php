<?php
 include 'db_config.php';

 $username = $_POST['uname'];
 $email = $_POST['email'];
 $password = $_POST['psw'];
 $hashed_password = password_hash( $password, PASSWORD_DEFAULT );

 $query = "INSERT INTO users( username, email, password )
           VALUES( '$username', '$email', '$hashed_password' ) ";
        
 mysqli_query( $conn, $query );

 header( "location: login.php" ); 
?>