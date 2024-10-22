<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['em'];
    $password =  $_POST['pwd'];

    $query = $conn->prepare("SELECT email, password, id FROM users
                              WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0) {
        $query->bind_result($email, $hashed_psw, $id);
        $query->fetch();

        if (password_verify($password, $hashed_psw)) {
            session_start();
            $_SESSION["user_id"] = $id;
            echo "<script> 
            alert('Login successful!');
            window.location.href='index.php';
            </script>";
        } else {
            echo "<script> 
            alert('Invalid password.') 
            window.location.href='login.php';
            </script>";
        }
    } else {
        echo "<script> 
        alert('User email is not found.')
        window.location.href='login.php';
        </script>";
    }
    $query->close();
}
