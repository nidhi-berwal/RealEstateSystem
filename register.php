<?php include('header.php'); 
include('db_connect.php');
?>

<h2>Register</h2>
<form action="process_register.php" method="POST">
    <label for="name">Name</label>
    <input type="text" name="name" required>
    
    <label for="email">Email</label>
    <input type="email" name="email" required>
    
    <label for="password">Password</label>
    <input type="password" name="password" required>
    
    <button type="submit">Register</button>
</form>

