<?php
// Start the session
session_start();

// Include the database connection file
include 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if the admin exists
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Admin exists, login successful
        $_SESSION['username'] = $username; // Store username in session
        header("Location: index.html"); // Redirect to index.html
        exit();
    } else {
        // Invalid credentials
        echo "<script>
                alert('Invalid username or password.');
                window.location.href = 'login.html'; // Redirect back to login page
              </script>";
    }
}

// Close the connection
$conn->close();
?>