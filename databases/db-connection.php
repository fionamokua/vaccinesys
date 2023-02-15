<?php
$username = "localhost";
$password = "";
$database = "cvmsdb";


$conn = mysqli_connect($username, $password, $database);

if($conn){
    echo "Connected";
}
else{
    echo 'Connection Error';
}
