<?php
// Set database connection credentials
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is empty
$dbname = "cleaningservicedb"; // The name of the database you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// For debugging purposes, you might want to confirm the connection
//echo "Connected successfully"; 

//In a production environment, you should not output the success message or any potential errors directly to the user, as this can be a security risk. Instead, handle errors gracefully and log them to a file that is not publicly accessible.

// Close the PHP tag if you're going to mix HTML with PHP or include this file in HTML files
// Otherwise, it's best practice to not close the PHP tag to avoid accidental output

