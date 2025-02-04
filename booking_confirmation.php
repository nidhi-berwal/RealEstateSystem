<?php
session_start();
if (isset($_SESSION['confirmation_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['confirmation_message'] . "</div>";
    unset($_SESSION['confirmation_message']); // Clear the message after displaying it
}
?>
