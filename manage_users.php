<?php
include('header.php'); // Include header with navigation, if any
include('db_connect.php'); // Database connection

// Handle Delete Request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM users WHERE user_id = :delete_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':delete_id', $delete_id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully.'); window.location.href='manage_users.php';</script>";
    } else {
        echo "<script>alert('Failed to delete user.');</script>";
    }
}

// Handle Add or Update Request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    
    if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
        // Update user
        $user_id = $_POST['user_id'];
        $sql = "UPDATE users SET name = :name, email = :email, role = :role WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        echo "<script>alert('User updated successfully.'); window.location.href='manage_users.php';</script>";
    } else {
        // Add new user
        $sql = "INSERT INTO users (name, email, role) VALUES (:name, :email, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        echo "<script>alert('User added successfully.'); window.location.href='manage_users.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('r2.jpg');
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 20px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            background-image: url('r5.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            padding: 20px;
        }
        h2 {
            color: black;
            font-weight: bold;
        }
        label {
            font-weight: 600;
            color: #555;
        }
        .form-control {
            font-size: 1rem;
            color: #333;
        }
        .btn-primary {
            background-color: black;
            border: none;
        }
        .btn-primary:hover {
            background-color: hotpink;
        }
        .table {
            background-image: url('r3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        table.table {
              font-weight: bold;
              color: black;
        }
        .table thead th {
            background-color: black;
            color: #ffffff;
            font-weight: bold;
        }
        .btn-info {
            background-color: black;
            border: none;
        }
        .btn-info:hover {
            background-color: hotpink;
        }
        .btn-danger {
            background-color: grey;
            border: none;
        }
        .btn-danger:hover {
            background-color: black;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Manage Users</h2>

    <!-- Add/Edit User Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="manage_users.php">
                <input type="hidden" name="user_id" id="user_id">
                <div class="form-group">
                    <label for="name">User Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save User</button>
            </form>
        </div>
    </div>

    <!-- Users Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php
    // Fetch users from database
    $sql = "SELECT * FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll();
    
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($user['name']) . "</td>";
        echo "<td>" . htmlspecialchars($user['email']) . "</td>";
        echo "<td>" . htmlspecialchars($user['role']) . "</td>";
        echo "<td>";
        
        // Check if 'user_id' exists before accessing it
        if (isset($user['user_id'])) {
            echo "<button class='btn btn-info btn-sm edit-btn' data-id='" . htmlspecialchars($user['user_id']) . "' data-name='" . htmlspecialchars($user['name']) . "' data-email='" . htmlspecialchars($user['email']) . "' data-role='" . htmlspecialchars($user['role']) . "'>Edit</button> ";
            echo "<a href='manage_users.php?delete_id=" . htmlspecialchars($user['user_id']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>";
        } else {
            echo "<button class='btn btn-secondary btn-sm' disabled>No ID</button>";
        }
        
        echo "</td>";
        echo "</tr>";
    }
    ?>
</tbody>

    </table>
</div>

<!-- Optional Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // JavaScript to handle Edit button functionality
    $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var email = $(this).data('email');
        var role = $(this).data('role');

        $('#user_id').val(id);
        $('#name').val(name);
        $('#email').val(email);
        $('#role').val(role);
    });
</script>

</body>
</html>  
