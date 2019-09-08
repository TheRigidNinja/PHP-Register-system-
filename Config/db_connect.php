<?php 
    // Mysql Table
    $conn = mysqli_connect("localhost","Demo","pdtbL_vx3U.*LmM","members_data");

    // Check connection 
    if(!$conn){
        echo "Connection error: ". mysqli_connect_error();
    }
?>