<?php

include 'db_config.php';


$sql = "SELECT * FROM users";
$result = $conn->query($sql);
//$userList = array();


if ($result->num_rows > 0) {
    
    echo '<table>';
    echo '<tr><th>ID</th><th>Username</th><th>Email</th><th>Actions</th></tr>'; 

   
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>'; 
        echo '<td>' . htmlspecialchars($row['username']) . '</td>'; 
        echo '<td>' . htmlspecialchars($row['email']) . '</td>'; 
        echo '<td>
                <a href="edit_user.php?id=' . $row['id'] . '">Edit</a> | 
                <a href="delete_user.php?id=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this user?\');">Delete</a>
              </td>'; 
        echo '</tr>';
      
        
    }

    echo '</table>'; 
} else {
    echo 'No users found.';
}


$conn->close();
?>
