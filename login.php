<?php
if(isset($_POST['idno']) && isset($_POST['password'])){
    $idno = $_POST['idno'];
    $password = $_POST['password'];

    //connect to the database
    $db = mysqli_connect('host', 'username', 'password', 'dbname');

    //query to check if the idno and password match with the database
    $query = "SELECT * FROM users WHERE idno='$idno' AND password='$password'";
    $result = mysqli_query($db, $query);

    //if the query returns a match
    if(mysqli_num_rows($result) == 1) {
        //start a session
        session_start();
        //store the idno in a session variable
        $_SESSION['idno'] = $idno;
        //redirect to the dashboard
        header('location: dashboard.php');
    } else {
        //if the query returns no match
        //display an error message
        echo "Invalid ID Number or Password";
    }
}
?>


