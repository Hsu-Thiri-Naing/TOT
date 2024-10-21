<?php
   include 'session_test.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/glass_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,800;1,800&display=swap" rel="stylesheet">
    

    <script src="https://kit.fontawesome.com/d89d276368.js" crossorigin="anonymous"></script>

</head>
<body>

    
    <header>
        <div class="app-logo">
            <img src="./assets/tot_logo_orange.png" width="60" height="60" alt="App Logo">
        </div>

        <div class="search">
            <form action="" method="post">
                <input type="search" placeholder="Type here to search content">
                <button type="submit" class="img"></button>
            </form>
        </div>
       
        <nav>
            <a href="index.php">Home</a>
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    
    <main>
        
        <aside class="categories">
            <h2>Post Categories</h2>
            <ul id="category-list">
                
                <?php include('load_categories.php'); ?>
            </ul>
        </aside>

       
        <section class="post-feed" id="post-feed">
            <?php include('load_posts.php'); ?>
        </section>

       
        <aside class="registered-users">
            <h2>Registered Users: <span id="user-count"><?php include('user_count.php'); ?></span></h2>
            <div class="user-list">

                <ul><?php include('show_user_list.php');?></ul>
            </div>
        </aside>
    </main>

    <footer>
        <p>&copy; 2024 Trends Of Tum</p>
    </footer>

    <script src="js/script.js">

    </script> 
   

</body>
</html>
