<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_id = $_POST['property_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $location = $_POST['location'];

    // Update property in the database
    $sql = "UPDATE properties SET title = :title, description = :description, price = :price, location = :location WHERE property_id = :property_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title, 'description' => $description, 'price' => $price, 'location' => $location, 'property_id' => $property_id]);

    header("Location: property_details.php?id=" . $property_id);
}
?>
