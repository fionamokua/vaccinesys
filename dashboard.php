<?php
//start the session
session_start();

//check if the user is logged in
if(isset($_SESSION['idno'])) {
    //display a welcome message
    echo "Welcome, you are now logged in!";
} else {
    //if the user is not logged in
    //redirect them to the login page
    header('location: login.php');
}
?>