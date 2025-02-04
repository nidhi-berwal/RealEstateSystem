<?php
include('header.php');
include('db_connect.php'); 
// Database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('h7.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
            margin-bottom: 100px;
            padding: 30px;
            background-image: url('h2.jpg');
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #3a3f51;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: 600;
            color: #3a3f51;
        }

        .form-control, .btn {
            border-radius: 6px;
        }

        .btn-primary {
            background-image: url('h1.jpg');
            color: black;
            border-color: #4CAF50;
        }

        .btn-primary:hover {
            background-color: #45a049;
            border-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Add a New Property</h2>
    <form action="save_property.php" method="POST" enctype="multipart/form-data">
        <!-- Property Title -->
        <div class="mb-3">
            <label for="property_title" class="form-label">Property Title:</label>
            <input type="text" name="title" class="form-control" required placeholder="Enter the title of the property">
        </div>
        <div class="mb-3">
    <label for="property_id" class="form-label">Property ID:</label>
    <input type="text" name="property_id" class="form-control" required placeholder="Enter the property ID">
    </div>
  <!-- Property Location -->
        <div class="mb-3">
            <label for="property_location" class="form-label">Location:</label>
            <input type="text" name="location" class="form-control" required placeholder="Enter the location">
        </div>

        <!-- Property Price -->
        <div class="mb-3">
    <label for="property_price" class="form-label">Price:</label>
    <div class="input-group">
        <input 
            type="number" 
            name="price" 
            class="form-control" 
            required 
            placeholder="Enter the price"
        >
        <select name="price_unit" class="form-select">
            <option value="lakhs">Lakhs</option>
            <option value="crores">Crores</option>
        </select>
    </div>
</div>


        <!-- Property Type -->
        <div class="mb-3">
            <label for="property_type" class="form-label">Property Type:</label>
            <select name="type" class="form-control" required>
                <option value="sale">Sale</option>
                <option value="rent">Rent</option>
            </select>
        </div>

        <!-- Property Images -->
        <div class="mb-3">
            <label for="property_images" class="form-label">Upload Property Images:</label>
            <input type="file" name="images[]" class="form-control" accept="image/*" multiple required>
        </div>

        <!-- Submit Button -->
        <div class="d-grid">
            <input type="submit" value="Add Property" class="btn btn-primary">
        </div>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
