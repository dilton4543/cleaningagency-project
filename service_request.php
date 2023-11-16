<?php
// Include the database connection file
include 'db_connect.php';

session_start();

// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Initialize variables to hold form data
$serviceType = $dateTime = $location = "";
$customerID = $_SESSION['customer_id'];

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize the input values
    $serviceType = $conn->real_escape_string($_POST['serviceType']);
    $dateTime = $conn->real_escape_string($_POST['dateTime']);
    $location = $conn->real_escape_string($_POST['location']);
    
    // Assume UserID is stored in session when user logs in
    $userID = $_SESSION["id"];
    // SQL query to insert the data into the database
    $sql = "INSERT INTO service_request (RequestID, ServiceType, DateTime, Location,CustomerID) VALUES (?, ?, ?, ?,?)";

    // Prepare a prepared statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("isssi", $RequestID,$serviceType, $dateTime, $location,$customerID,);
        
        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "<p>Request submitted successfully.</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Cleaning Request</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        form {
            width: 90%;
            margin: auto;
            box-sizing: border-box;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="datetime-local"],
        select,
        textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #fafafa;
        }
        input[type="submit"] {
            cursor: pointer;
            width: 100%;
            padding: 15px;
            border: none;
            background-color: #5cb85c;
            color: white;
            font-size: 18px;
            border-radius: 3px;
            transition: background-color 0.3s ease;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .back-to-home {
            display: inline-block; /* Align to the center */
            margin-top: 20px;
            margin-left: 190px;
            padding: 15px 20px; /* Smaller than the submit button */
            background-color: #0056b3;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
            text-align: center;
            font-weight: bold;
        }
        .back-to-home:hover {
            background-color: #003d7a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Fill Out This Form to Make a Cleaning Request</h2>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <div class="form-group">
            <label for="serviceType">Service Type:</label>
            <select id="serviceType" name="serviceType" required>
            <option value="">Select a service</option>
            <option value="General Cleaning">General Cleaning</option>
            <option value="Deep Cleaning">Deep Cleaning</option>
            <option value="Sanitization">Sanitization</option>
            <option value="Window Cleaning">Window Cleaning</option>
            <option value="Carpet Cleaning">Carpet Cleaning</option>
            <!-- Add more service types here -->
            </select>
            </div>

            <div class="form-group">
            <label for="dateTime">Date and Time:</label>
            <input type="datetime-local" id="dateTime" name="dateTime" required>
            </div>

            <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
            </div>

            <div class="form-action">
            <input type="submit" value="Submit Request">
            </div>
        </form>
        <a href="welcome.php" class="back-to-home">Back to Home</a>
    </div>
</body>
</html>