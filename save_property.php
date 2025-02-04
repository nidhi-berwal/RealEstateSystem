<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    // $description = $_POST['description'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $type = $_POST['type'];

    // Insert property into the properties table
    $sql = "INSERT INTO properties (title, price, location, type) VALUES (:title, :price, :location, :type)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':title' => $title, ':price' => $price, ':location' => $location, ':type' => $type]);
    
    $property_id = $pdo->lastInsertId(); // Get the ID of the newly added property

    // Handle each uploaded image
    foreach ($_FILES['images']['tmp_name'] as $index => $tmp_name) {
        $image_name = $_FILES['images']['name'][$index];
        $image_path = "images/" . basename($image_name);

        // Move uploaded image to the images directory
        if (move_uploaded_file($tmp_name, $image_path)) {
            // Insert image path and property_id into the image table
            $sql = "INSERT INTO images (property_id, image_path) VALUES (:property_id, :image_path)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':property_id' => $property_id, ':image_path' => $image_path]);
        }
    }

    echo "Property and images added successfully!";
}
?>
