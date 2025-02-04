<?php
// Start the session
session_start();

// Include the database connection file
include('db_connect.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Check if the session variable 'user_id' exists
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
    
    // Retrieve session variable and POST data
    $client_id = $_SESSION['user_id'];
    $property_id = $_POST['property_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Validation
    if (empty($property_id) || empty($date) || empty($time)) {
        echo "All fields are required!";
        exit;
    }

    // Fetch client name from session
    $client_name = $_SESSION['client_name'];

    // Fetch property location
    $sql_location = "SELECT location FROM properties WHERE property_id = :property_id";
    $stmt_location = $pdo->prepare($sql_location);
    $stmt_location->execute(['property_id' => $property_id]);
    $location_data = $stmt_location->fetch(PDO::FETCH_ASSOC);
    $location = $location_data ? $location_data['location'] : "Unknown location";

    try {
        // Insert booking into the database
        $sql = "INSERT INTO bookings (client_name, location, client_id, property_id, date, time) 
                VALUES (:client_name, :location, :client_id, :property_id, :date, :time)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'client_name' => $client_name,
            'location' => $location,
            'client_id' => $client_id,
            'property_id' => $property_id,
            'date' => $date,
            'time' => $time
        ]);
        
        header("Location: booking_confirmation.php");
        exit;
        
    } catch (PDOException $e) {
        echo "Error processing your booking. Please try again later.";
        exit;
    }
}
?>
