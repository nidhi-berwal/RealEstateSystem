<?php
include('header.php'); // Include navigation or header file if needed
include('db_connect.php'); // Database connection

// Handle add/update booking
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $_POST['client_id'];
    $client_name = $_POST['client_name'];
    $property_id = $_POST['property_id'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = $_POST['status'];

    // Check if the property_id exists in the properties table
    $check_property_sql = "SELECT COUNT(*) FROM properties WHERE property_id = :property_id";
    $stmt = $pdo->prepare($check_property_sql);
    $stmt->bindParam(':property_id', $property_id, PDO::PARAM_INT);
    $stmt->execute();
    $property_exists = $stmt->fetchColumn();

    if (!$property_exists) {
        echo "<script>alert('Property ID does not exist. Please select a valid property.');</script>";
    } else {
        if (isset($_POST['booking_id']) && $_POST['booking_id'] != "") {
            // Update booking
            $booking_id = $_POST['booking_id'];
            $sql = "UPDATE bookings 
                    SET client_id = :client_id, client_name = :client_name, property_id = :property_id, location = :location, date = :date, time = :time, status = :status 
                    WHERE booking_id = :booking_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':client_id', $client_id);
            $stmt->bindParam(':client_name', $client_name);
            $stmt->bindParam(':property_id', $property_id);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "<script>alert('Booking updated successfully.'); window.location.href='manage_bookings.php';</script>";
            } else {
                echo "<script>alert('Failed to update booking.');</script>";
            }

        } else {
            // Add new booking
            $sql = "INSERT INTO bookings (client_id, client_name, property_id, location, date, time, status, created_at) 
                    VALUES (:client_id, :client_name, :property_id, :location, :date, :time, :status, NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':client_id', $client_id);
            $stmt->bindParam(':client_name', $client_name);
            $stmt->bindParam(':property_id', $property_id);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            $stmt->bindParam(':status', $status);

            if ($stmt->execute()) {
                echo "<script>alert('Booking added successfully.'); window.location.href='manage_bookings.php';</script>";
            } else {
                echo "<script>alert('Failed to add booking.');</script>";
            }
        }
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
    <style>
        /* CSS for styling the page */
        body {
            background-image: url('g7.jpg');
            font-family: Arial, sans-serif;
            font-weight: bold;
            color: black;
        }
        .mb-4{
            font-weight: bold;
            color: honeydew;
        }

        .container {
            margin-top: 30px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 100px;
            background-image: url('g4.jpg');
            font-weight: bold;
            color: honeydew;
        }

        .form-control, .btn {
            font-size: 1.1rem;
        }

        .btn-primary {
            background-color: black;
            border: none;
        }
        .btn-primary:hover {
            background-color: hotpink;
            
        }

        .btn-info, .btn-danger {
            margin-right: 5px;
            background-color: black;
            cursor: pointer;
            border: none;
        }
        .btn-danger:hover{
            background-color: hotpink;
            border: none;
        }
        .table{
            margin-bottom: 80px;
            margin-top: 80px;
        }

        .table th{
            text-align: center;
            color: white;
            font-weight: bold;
        }
        .table td {
            color:black ;
            font-weight: bold;
        }

        .table th {
            background-color:black;
            color: #fff;
            font-weight: bold;
        }

        .edit-btn {
            background-color: black;
            color: white;
            border: none;
            cursor: pointer;
        }

        .edit-btn:hover {
            background-color: hotpink;
        }

        
        /* Styling form inputs */
        .form-group label {
            font-weight: bold;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Manage Bookings</h2>

    <!-- Add/Edit Booking Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="manage_bookings.php">
                <input type="hidden" name="booking_id" id="booking_id">
                <div class="form-group">
                    <label for="client_id">Client ID</label>
                    <input type="text" class="form-control" id="client_id" name="client_id" required>
                </div>
                <div class="form-group">
                    <label for="client_name">Client Name</label>
                    <input type="text" class="form-control" id="client_name" name="client_name" required>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
                <div class="form-group">
                    <label for="property_id">Property ID</label>
                    <input type="text" class="form-control" id="property_id" name="property_id" required>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="time">Time</label>
                    <input type="time" class="form-control" id="time" name="time" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Pending">Pending</option>
                        <option value="Confirmed">Confirmed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save Booking</button>
            </form>
        </div>
    </div>

    <!-- Bookings Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Client Name</th>
                <th>Location</th>
                <th>Client ID</th>
                <th>Property ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch bookings from database
            $sql = "SELECT * FROM bookings ORDER BY created_at DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $bookings = $stmt->fetchAll();
            
            foreach ($bookings as $booking) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($booking['client_name']) . "</td>";
                echo "<td>" . htmlspecialchars($booking['location']) . "</td>";
                echo "<td>" . htmlspecialchars($booking['client_id']) . "</td>";
                echo "<td>" . htmlspecialchars($booking['property_id']) . "</td>";
                echo "<td>" . htmlspecialchars($booking['date']) . "</td>";
                echo "<td>" . htmlspecialchars($booking['time']) . "</td>";
                echo "<td>" . htmlspecialchars($booking['status']) . "</td>";
                echo "<td>" . htmlspecialchars($booking['created_at']) . "</td>";
                echo "<td>
                    <button class='btn btn-info edit-btn' onclick='editBooking(" . $booking['booking_id'] . ")'>Edit</button>
                    <a href='delete_booking.php?booking_id=" . $booking['booking_id'] . "' class='btn btn-danger'>Delete</a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    function editBooking(booking_id) {
        // Send an AJAX request to fetch booking data for editing
        fetch(`get_booking.php?booking_id=${booking_id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('booking_id').value = data.booking_id;
                document.getElementById('client_id').value = data.client_id;
                document.getElementById('client_name').value = data.client_name;
                document.getElementById('property_id').value = data.property_id;
                document.getElementById('location').value = data.location;
                document.getElementById('date').value = data.date;
                document.getElementById('time').value = data.time;
                document.getElementById('status').value = data.status;
            });
    }
</script>

</body>
</html>
