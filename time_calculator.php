<?php
function simple_time_ago($created_at) {
    $time_ago = strtotime($created_at); 
    $current_time = time(); 
    $time_difference = $current_time - $time_ago; 
    $seconds = $time_difference;

    
    if ($seconds <= 60) {
        return "Just now";
    } elseif ($seconds <= 3600) {
        return floor($seconds / 60) . " minutes ago";
    } elseif ($seconds <= 86400) {
        return floor($seconds / 3600) . " hours ago";
    } else {
        return floor($seconds / 86400) . " days ago";
    }
}
?>