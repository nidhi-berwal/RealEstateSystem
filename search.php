<?php
include('header.php');
include('db_connect.php'); // Make sure this file initializes the $pdo variable

// Check if the $pdo variable is initialized
if (!isset($pdo)) {
    die('Database connection failed');
}

$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Default query for when there's no search term
$sql = "SELECT * FROM properties WHERE status = 'available'";

// If there's a search term, modify the query to filter by title, location, or price
if (!empty($searchQuery)) {
    $sql = "SELECT * FROM properties 
            WHERE (title LIKE :search OR location LIKE :search OR price LIKE :search) 
            AND status = 'available'";
}

try {
    $stmt = $pdo->prepare($sql);
    
    // Bind the search query to the SQL placeholder, adding '%' for partial matching
    if (!empty($searchQuery)) {
        $stmt->bindValue(':search', '%' . $searchQuery . '%');
    }

    $stmt->execute();
    $properties = $stmt->fetchAll();

    echo "<div class='container main-content py-5'>";
    echo "<h2 class='text-center'>Search Results</h2>";
    echo "<div class='property-list row'>";

    if ($properties) {
        foreach ($properties as $property) {
    echo "<div class='property-card col-md-4 my-3'>";
    echo "<div class='card h-100'>";

    // Check if the property has an image, if not, use h10.jpg as the fallback
    // Assuming images are stored in the 'uploads/' folder
    $imagePath = isset($property['image']) && !empty($property['image']) ? 'uploads/' . htmlspecialchars($property['image']) : 'images/h10.jpg';
    
    // Check if the file exists
    if (!file_exists($imagePath)) {
        $imagePath = 'images/h10.jpg'; // If the file doesn't exist, use the fallback image
    }

    // Display the image
    echo "<img src='" . $imagePath . "' class='card-img-top' alt='Property Image'>";
    
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>" . htmlspecialchars($property['title']) . "</h5>";
    echo "<p class='card-text'>Price: $" . htmlspecialchars($property['price']) . "</p>";
    echo "<p class='card-text'>Location: " . htmlspecialchars($property['location']) . "</p>";
    echo "<a href='property_details.php?id=" . $property['property_id'] . "' class='btn btn-outline-primary'>View Details</a>";
    echo "</div></div></div>";
}

    } else {
        echo "<p class='text-center'>No properties found matching your search. Please try again with different terms.</p>";
    }
    echo "</div></div>";
} catch (PDOException $e) {
    echo "<p class='text-center'>Unable to load properties: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>

<!-- Embedded CSS for styling -->
<style>
    body {
        background: url('h10.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: Arial, sans-serif;
        color: #333;
    }

    .main-content {
        background-image: url('g5.jpg');
        padding: 40px;
        margin-top: 30px;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    }

    h2 {
        color: #2c3e50;
        font-size: 36px;
        margin-bottom: 30px;
    }

    .property-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .property-card {
        margin-bottom: 20px;
        flex: 0 0 32%;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .property-card:hover {
        transform: scale(1.05);
        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
    }
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: none;
        overflow: hidden;
    }
    
    .card img {
        transition: transform 0.3s ease;
    }
    .card-img-top {
    width: 100%; /* Full width of the card */
    height: 300px; /* Fixed height for the images */
    object-fit: cover; /* Ensures the image covers the area without distortion */
}

    /* Hover effects */
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card:hover img {
        transform: scale(1.1);
    }

    .card-title {
        font-weight: bold;
    }

    .card-text {
        color: #555;
    }

    .btn-outline-primary {
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }

    /* Add responsiveness for smaller screens */
    @media (max-width: 768px) {
        .property-card {
            flex: 0 0 48%;
        }
    }

    @media (max-width: 576px) {
        .property-card {
            flex: 0 0 100%;
        }
    }

    .card-section {
        padding: 60px 0;
    }
</style>
