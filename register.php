<?php

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 

// Check if the form has been submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     // Validate and sanitize the input
//     $idNo = filter_var($_POST["idNo"], FILTER_SANITIZE_STRING);
//     $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
//     $fullname = filter_var($_POST["fullname"], FILTER_SANITIZE_STRING);
//     $phone = filter_var($_POST["phone"], FILTER_SANITIZE_EMAIL);
//     $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
   
//     //Checking if email is valid
//     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         die("Invalid email address");
//     }
//     //Checking if password meets the criteria
//     if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) {
//         die("password is not strong enough");
//     }

//     // Hash the password for security
//     $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

//     // Insert the user into the database
//     $stmt = $conn->prepare("INSERT INTO users (idNo,email,fullname,phone, password,) VALUES (?,?,?)");
//     $stmt->bind_param("sss",$idNo, $email, $fullname,$phone, $password,);

//     if ($stmt->execute()) {
//         echo "New record created successfully";
//     } else {
//         echo "Error Registering user, try again later: " . $conn->error;
//     }
// }
// $conn->close();
//
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["fullname"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
