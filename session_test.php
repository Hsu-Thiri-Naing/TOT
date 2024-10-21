<?php
   // session_start();
   // $_SESSION['user_id'] = 2;

   session_start();

   if( !isset( $_SESSION['id'] ) ){
         header( "location: login.php");
   }
?>