<?php
// Database connection
// Database connection
$servername = "localhost"; // This is typically "localhost" for XAMPP
$username = "root"; // Default username in XAMPP is "root"
$password = ""; // Default password in XAMPP is an empty string
$dbname = "real_estate_db"; // Replace this with your actual database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data and file are received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $propertyTitle = $_POST['property_title'];
    $propertyLocation = $_POST['property_location'];
    $propertyPrice = $_POST['property_price'];
    
    // Handle file upload
    $targetDir = __DIR__ . "/uploads/"; // Absolute path for uploads folder
    $fileName = basename($_FILES["property_image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allow only certain file formats
    $allowedTypes = array("jpg", "jpeg", "png", "gif");
    if (in_array($imageFileType, $allowedTypes)) {
        // Upload file to the server
        if (move_uploaded_file($_FILES["property_image"]["tmp_name"], $targetFilePath)) {
            // Insert data into the database
            $sql = "INSERT INTO properties (title, location, price, image) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Check if prepare failed
            if ($stmt === false) {
                die('MySQL prepare error: ' . $conn->error);
            }

            $stmt->bind_param("ssis", $propertyTitle, $propertyLocation, $propertyPrice, $targetFilePath);

            if ($stmt->execute()) {
                echo "Property added successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Only JPG, JPEG, PNG & GIF files are allowed.";
    }
}

$conn->close();

?>
