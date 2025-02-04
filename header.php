<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        /* Background */
        body {
            background-image: url('background.jpg'); /* Use a background image */
            background-size: cover;
            background-attachment: fixed;
            color: #333;
        }

        /* Main content styling */
        .main-content {
            background: rgba(255, 255, 255, 0.9); /* Semi-transparent background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* Navbar customization */
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff !important;
        }

        /* Search form styling */
        .search-form .form-control {
            width: 300px;
        }

        .property-list .property-card {
            display: flex;
            justify-content: center;
        }

        /* Property card styling */
        .property-card .card {
            transition: transform 0.3s ease;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .property-card .card:hover {
            transform: scale(1.05);
        }

        /* Centered text */
        .text-center {
            color: #333;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Real Estate System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_property.php">Add Property</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage_bookings.php">ManageBookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search.php">SearchProp</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>
</body>
</html>
