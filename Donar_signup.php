<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_donor";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];


    $check_sql = "SELECT * FROM donars WHERE email='$email'";
    $check_result = $conn->query($check_sql);
    if ($check_result->num_rows > 0) {
        echo "<script>alert('User already exists!');windows.location.href='donor_login.html';</script>";
    } 
    else {
        
        $sql = "INSERT INTO donars (name, email, password) VALUES ('$name', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>window.location.href='index_home.html';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
