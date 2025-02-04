<?php
include('db_connect.php');
$property_id = $_GET['id'];
$sender_id = $_SESSION['user_id'];

// Fetch messages
$sql = "SELECT * FROM messages WHERE property_id = :property_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['property_id' => $property_id]);
$messages = $stmt->fetchAll();

foreach ($messages as $message) {
    echo "<div class='message'>";
    echo "<p>" . htmlspecialchars($message['message_content']) . "</p>";
    echo "<span>" . $message['timestamp'] . "</span>";
    echo "</div>";
}
?>
