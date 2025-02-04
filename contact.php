<?php
// Include the database connection file
include('db_connect.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Insert data into the database
    $sql = "INSERT INTO contact_us (first_name, last_name, email, phone, message) 
            VALUES (:first_name, :last_name, :email, :phone, :message)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':message', $message);

    // Execute query
    if ($stmt->execute()) {
        echo "<script>openDialog();</script>"; // Open dialog on success
    } else {
        echo "<script>console.log('Failed to send your message. Please try again later.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }
    .fade-in {
      animation: fadeIn 1.5s ease-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    /* Dialog Box Styling */
    .dialog-box {
      display: none;
      position: fixed;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    .dialog-content {
      background-color: white;
      padding: 2rem;
      border-radius: 8px;
      max-width: 400px;
      width: 100%;
      text-align: center;
      animation: fadeIn 0.5s ease-out;
    }

    .dialog-content h2 {
      color: #38a169;
      font-size: 2rem;
      font-weight: bold;
    }

    .dialog-content p {
      color: #4A4A4A;
      font-size: 1.1rem;
    }

    .dialog-close-btn {
      background-color: #38a169;
      color: white;
      padding: 0.5rem 1.5rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1.1rem;
      margin-top: 1rem;
    }

    .dialog-close-btn:hover {
      background-color: #2f855a;
    }
  </style>
</head>
<body class="bg-[#1A1A4B] text-white">
  <!-- Header -->
  <header class="bg-[#1A1A4B]">
   <div class="container mx-auto flex justify-between items-center py-4 px-6">
    <nav class="flex space-x-6">
     <a href="dashboard.php" class="text-white hover:text-gray-300">ABOUT</a>
     <a href="index.php" class="text-white hover:text-gray-300">HOME</a>
     <a href="contact.php" class="text-white hover:text-gray-300">CONTACT</a>
    </nav>
   </div>
  </header>

  <!-- Banner -->
  <div class="relative fade-in">
   <div class="relative">
     <img src="https://storage.googleapis.com/a1aa/image/y24me454TU2qK6iRxBltp87XFDn9g4ykCDrFwVcnieMteBfOB.jpg" alt="Banner Image with trees and sunlight" class="w-full h-72 object-cover brightness-110"/>
     <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/20 to-black/30"></div>
   </div>
   <div class="absolute inset-0 flex items-center justify-center">
    <h1 class="text-6xl font-bold text-white drop-shadow-lg">CONTACT</h1>
   </div>
  </div>

  <!-- Contact Form -->
  <section class="container mx-auto py-16 px-6">
   <div class="bg-gradient-to-r from-purple-800 via-blue-600 to-indigo-700 p-10 rounded-lg shadow-lg text-center md:text-left">
    <h2 class="text-4xl font-bold mb-6 text-green-400">Contact Us</h2>
    <p class="mb-10 text-gray-300">
     For inquiries, reach out at <a href="mailto:inquiries@ire.ms" class="text-blue-400 underline">inquiries@ire.ms</a>
    </p>
    <form method="POST" action="contact.php" class="space-y-6">
     <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div>
       <label for="first-name" class="block text-sm font-medium text-gray-300">First Name</label>
       <div class="flex items-center bg-white text-black border border-gray-300 rounded-md p-2 mt-1">
        <i class="fas fa-user mr-2 text-gray-500"></i>
        <input type="text" id="first-name" name="first_name" class="w-full focus:outline-none" placeholder="Your First Name" required/>
       </div>
      </div>
      <div>
       <label for="last-name" class="block text-sm font-medium text-gray-300">Last Name</label>
       <div class="flex items-center bg-white text-black border border-gray-300 rounded-md p-2 mt-1">
        <i class="fas fa-user mr-2 text-gray-500"></i>
        <input type="text" id="last-name" name="last_name" class="w-full focus:outline-none" placeholder="Your Last Name" required/>
       </div>
      </div>
     </div>
     <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div>
       <label for="email" class="block text-sm font-medium text-gray-300">E-mail *</label>
       <div class="flex items-center bg-white text-black border border-gray-300 rounded-md p-2 mt-1">
        <i class="fas fa-envelope mr-2 text-gray-500"></i>
        <input type="email" id="email" name="email" class="w-full focus:outline-none" placeholder="Your Email" required/>
       </div>
      </div>
      <div>
       <label for="phone" class="block text-sm font-medium text-gray-300">Phone</label>
       <div class="flex items-center bg-white text-black border border-gray-300 rounded-md p-2 mt-1">
        <i class="fas fa-phone mr-2 text-gray-500"></i>
        <input type="tel" id="phone" name="phone" class="w-full focus:outline-none" placeholder="Your Phone Number"/>
       </div>
      </div>
     </div>
     <div>
      <label for="message" class="block text-sm font-medium text-gray-300">Message</label>
      <textarea id="message" name="message" rows="4" class="mt-1 block w-full bg-white text-black border border-gray-300 rounded-md p-2 focus:outline-none" placeholder="Your Message" required></textarea>
     </div>
     <div>
      <button type="submit" class="bg-green-500 text-white font-bold py-3 px-6 rounded-md hover:bg-green-600 transition duration-300 shadow-lg">
       Send Message
      </button>
     </div>
    </form>
   </div>
  </section>
  <!-- Dialog Box HTML -->
  <div id="messageDialog" class="dialog-box flex">
    <div class="dialog-content">
      <h2>Message Sent</h2>
      <p>Your message has been sent successfully! We'll get back to you soon.</p>
      <button class="dialog-close-btn" onclick="closeDialog()">Close</button>
    </div>
  </div>

  <script>
    // Function to open the dialog box
    function openDialog() {
      document.getElementById('messageDialog').style.display = 'flex';
    }

    // Function to close the dialog box
    function closeDialog() {
      document.getElementById('messageDialog').style.display = 'none';
    }
  </script>
</body>
</html>
</body>
</html>
