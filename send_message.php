<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $_POST['receiver_id'];
    $property_id = $_POST['property_id'];
    $message_content = $_POST['message_content'];

    // Insert message into database
    $sql = "INSERT INTO messages (sender_id, receiver_id, property_id, message_content) VALUES (:sender_id, :receiver_id, :property_id, :message_content)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['sender_id' => $sender_id, 'receiver_id' => $receiver_id, 'property_id' => $property_id, 'message_content' => $message_content]);

    echo "Message sent!";
}
?>
