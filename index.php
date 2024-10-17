
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/glass_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>

    
    <header>
        <div class="app-logo">
            <img src="twice_logo.png" width="30" height="30" alt="App Logo">
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
