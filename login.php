<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "details";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start the session
session_start();

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer autoloader
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// Function to send a welcome email
function sendWelcomeEmail($username, $userEmail) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ndkisan51@gmail.com';
        $mail->Password   = 'emdsgyqnuhgnwarh'; // Update with your SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('ndkisan51@gmail.com', 'Your Furniture Store');
        $mail->addAddress($userEmail, $username); // Add the user's email and name

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to Your Furniture Store';
        $mail->Body    = 'Dear ' . $username . ',<br>Welcome to Your Furniture Store!';

     
        if ($mail->send()) {
            echo "Message has been sent successfully!";
        } else {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } catch (Exception $e) {
        
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);


    $stmt->execute();

   
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if ($password === $row['password']) {
            
            $_SESSION['name'] = $row['name'];
         
            sendWelcomeEmail($row['name'], $row['username']); 

          
            $referringPage = $_SERVER['HTTP_REFERER'];
            if (strpos($referringPage, 'bedroom.php') !== false) {
                header("Location: bedroom.php");
            } else {
                header("Location: index.php");
            }
            exit(); 
        } else {
            $errorMsg = "Incorrect password!";
        }
    } else {
        $errorMsg = "User not found!";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
