<?php
session_start();

// Include the database connection file
include('db_connect.php');
include('header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $client_name = htmlspecialchars($_POST['client_name']);
    $property_id = $_POST['property_id'];
    $location = htmlspecialchars($_POST['location']); // Assume location is fetched from the property details
    $booking_date = date('Y-m-d H:i:s'); // Current date and time

    // Insert into the bookings table
    try {
        $sql = "INSERT INTO bookings (client_name, location, property_id, date) 
                VALUES (:client_name, :location, :property_id, :date)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':client_name', $client_name);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':property_id', $property_id);
        $stmt->bindParam(':date', $booking_date);

        $stmt->execute();

        // Store confirmation message in session and redirect
        $_SESSION['confirmation_message'] = "Booking confirmed! Thank you for your booking.";
        header("Location: booking_confirmation.php"); // Redirect to a confirmation page
        exit();
    } catch (PDOException $e) {
        // Handle error
        $_SESSION['confirmation_message'] = "Error: " . $e->getMessage();
        header("Location: booking_confirmation.php"); // Redirect to error page
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">Manage Bookings</h2>
    
    <!-- Add Booking Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="manage_booking.php">
                <div class="form-group">
                    <label for="client_name">Client Name</label>
                    <input type="text" class="form-control" id="client_name" name="client_name" required>
                </div>
                <div class="form-group">
                    <label for="property_id">Property ID</label>
                    <input type="number" class="form-control" id="property_id" name="property_id" required>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
                <button type="submit" class="btn btn-primary">Confirm Booking</button>
            </form>
        </div>
    </div>
</div>

<!-- Optional Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
