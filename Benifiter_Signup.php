<?php

$servername = "localhost"; 
$username = "root";
$password = ""; 
$database = "food_donor"; 


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $orphanage_name = $_POST['orphanage-name'];
    $address = $_POST['address'];
    $licence_id = $_POST['LicenceId'];
    $upi_id = $_POST['UPIId'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO benefitter (orphanage_name, address, licence_id, upi_id, email, password) VALUES ('$orphanage_name', '$address', '$licence_id', '$upi_id', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='Benefitter_home.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();
?>
