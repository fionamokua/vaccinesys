<?php
session_start();

$server="localhost";
$username="root";
$password="";
$database="mydb";


$conn = new mysqli("localhost", "root", "","mydb");

if (isset($_POST["LOGIN"])) 
{
	
    $firstname=$_POST["firstname"];
    $password=$_POST["password"]; 
   
	
	
	$sql="SELECT * From users Where email=? AND password=?";

	$stmt=$conn->prepare($sql);
	$stmt->bind_param("ss",$email,$password);
	$stmt->execute();
	$result=$stmt->get_result();
	$row=$result->fetch_assoc();

	session_regenerate_id();
	$_SESSION['username']=$row['firstname'];
		session_write_close();

	
	}



if (isset($_POST['register'])) { 

    $idNo=$_POST["idNo"];
    $email=$_POST["email"];
    $firstname=$_POST["firstname"];
    $lastname=$_POST["lastname"]; 
    $phone=$_POST["phone"]; 
    $password=$_POST["password"];
    
   
        $sql = "INSERT INTO `users`(idNo,firstame,lastname,email,password,phone) VALUES ('$idNo','$firstname','$lastname','$email','$password','$phone')";

        mysqli_query($conn, $sql); 
        $_SESSION['message']="Record has been saved";
	$_SESSION['msg_type']="success";

	
}  
?>