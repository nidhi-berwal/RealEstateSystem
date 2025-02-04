
<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include('header.php'); // Header with navigation, if available
include('db_connect.php'); // Database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{
            background-image: url('g5.jpg');
        }
        /* Custom styles for the dashboard */
        .dashboard-header {
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            color: #333;
        }

        .card {
            transition: box-shadow 0.3s, transform 0.3s;
            background-image: url('g4.jpg');
            max-height: 300px;
            color: black;
            font-weight: bold;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-weight: 600;
            color: honeydew;
            font-weight: bold;
        }

        .btn-primary {
            transition: background-color 0.3s ease;
        }
        .btn-primary {
            background-color: black;
        }

        .btn-primary:hover {
            background-color: chocolate;
        }

        .dashboard-section {
            margin-top: 30px;
        }

        /* Custom scrollbar for cards */
        .scrollable-card {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 100px;
            background-image: url('g2.jpg');
            color: black;
            font-weight: bold;

        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="dashboard-header">Admin Dashboard</h1>

    <div class="row">
        <!-- Properties Section -->
        <div class="col-md-4 dashboard-section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage Properties</h5>
                    <p class="card-text">Add, update, or delete properties listed on the platform.</p>
                    <a href="add_property.php" class="btn btn-primary">Go to Properties</a>
                </div>
            </div>
        </div>

        <!-- Users Section -->
        <div class="col-md-4 dashboard-section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage Users</h5>
                    <p class="card-text">View and manage user accounts and roles.</p>
                    <a href="manage_users.php" class="btn btn-primary">Go to Users</a>
                </div>
            </div>
        </div>

        <!-- Bookings Section -->
        <div class="col-md-4 dashboard-section">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage Bookings</h5>
                    <p class="card-text">Review and handle bookings made by users.</p>
                    <a href="manage_bookings.php" class="btn btn-primary">Go to Bookings</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mt-4">
        <div class="col-md-4 dashboard-section">
            <div class="card scrollable-card">
                <div class="card-body">
                    <h5 class="card-title">Recent Properties</h5>
                    <ul class="list-group list-group-flush">
                        <?php
                        $sql = "SELECT title, location, price FROM properties ORDER BY created_at DESC LIMIT 5";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $properties = $stmt->fetchAll();
                        foreach ($properties as $property) {
                            echo "<li class='list-group-item'>";
                            echo "<strong>" . htmlspecialchars($property['title']) . "</strong><br>";
                            echo "Location: " . htmlspecialchars($property['location']) . "<br>";
                            echo "Price: $" . number_format($property['price'], 2);
                            echo "</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4 dashboard-section">
            <div class="card scrollable-card">
                <div class="card-body">
                    <h5 class="card-title">Recent Users</h5>
                    <ul class="list-group list-group-flush">
                        <?php
                        $sql = "SELECT name, email, role FROM users ORDER BY created_at DESC LIMIT 5";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $users = $stmt->fetchAll();
                        foreach ($users as $user) {
                            echo "<li class='list-group-item'>";
                            echo "<strong>" . htmlspecialchars($user['name']) . "</strong><br>";
                            echo "Email: " . htmlspecialchars($user['email']) . "<br>";
                            echo "Role: " . htmlspecialchars($user['role']);
                            echo "</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

     <div class="col-md-4 dashboard-section">
    <div class="card scrollable-card">
        <div class="card-body">
            <h5 class="card-title">Recent Bookings</h5>
            <ul class="list-group list-group-flush">
                <?php
                // SQL query to fetch recent bookings with property title
                $sql = "SELECT b.client_name, p.title AS property_title, b.date
                        FROM bookings b
                        JOIN properties p ON b.property_id = p.property_id
                        ORDER BY b.date DESC LIMIT 5";
                
                // Prepare and execute the query
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $bookings = $stmt->fetchAll();

                // Loop through the bookings and display each one
                foreach ($bookings as $booking) {
                    echo "<li class='list-group-item'>";
                    echo "<strong>" . htmlspecialchars($booking['client_name']) . "</strong><br>";
                    echo "Property: " . htmlspecialchars($booking['property_title']) . "<br>";
                    echo "Date: " . htmlspecialchars($booking['date']);
                    echo "</li>";
                }
                ?>
            </ul>
        </div>
    </div>
</div>

            </ul>
        </div>
    </div>
</div>

<!-- Optional Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
