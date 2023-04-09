<?php

$conn = mysqli_connect('localhost','root','','blog2');
    
    if(!$conn){
        echo 'Connection error: '.mysqli_connect_error();
    }

?>