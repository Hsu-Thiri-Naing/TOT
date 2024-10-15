<?php
include 'db_config.php';

$query = "SELECT username FROM users";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()){ ?>
<div class="user-container">
    <img src="user_logo.png" alt="user-logo" width="30" height="30">
<li><a href="#"><?php echo $row['username']?></a></li>
</div>


<?php } 
?>