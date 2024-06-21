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
    $about_info = $_POST['about-info'];
    $people_count = $_POST['people-count'];
    $justification = $_POST['justification'];
    $contact = $_POST['contact'];

  
    if(isset($_FILES['media'])) {
        $file_name = $_FILES['media']['name'];
        $file_tmp = $_FILES['media']['tmp_name'];
        
      
        $upload_dir = "uploads/";
        
      
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
       
        if ($file_tmp) {
            $file_destination = $upload_dir . $file_name;
            if (move_uploaded_file($file_tmp, $file_destination)) {
                $media = $file_destination; 
            } else {
                echo "Error moving file.";
            }
        } else {
            $media = ""; 
        }
    } else {
        $media = ""; 
    }

    $sql = "INSERT INTO benefitter_info (about_info, people_count, media, justification, contact) VALUES ('$about_info', '$people_count', '$media', '$justification', '$contact')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thanks for registering!'); window.location.href='Benefitter_home.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
