<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['em'];
    $password =  $_POST['pwd'];
    if ($email === "totadmin2024@gmail.com" && $password === "5webwizards") {
        session_start();
        $_SESSION["admin_id"] = 'admin';  // Assign an identifier for the admin user
        header("location:admin.php?message=Welcome+Admin!&type=success");
        exit();
    }
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
            // echo "<script> 
            // alert('Login successful!');
            // window.location.href='index.php';
            // </script>";
            header("location:index.php?message=Successfully+Logged In!&type=success");
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
