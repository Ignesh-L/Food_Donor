<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "food_donor";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM donars WHERE email = '$email' AND password= '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<script>window.location.href='index_home.html';</script>";
} 
else {
  
    $sql_check_email = "SELECT * FROM donars WHERE email = '$email'";
    $result_check_email = $conn->query($sql_check_email);

    if ($result_check_email->num_rows > 0) {
        
        echo "<script>alert('Incorrect password.Check your and Please try again.'); window.location.href='donor_login.html';</script>";
    } 
    else {
        
        echo "<script>alert('Invaild User/SignUp first'); window.location.href='Donor_Signup.html';</script>";
    }
    
}

$conn->close();
?>
