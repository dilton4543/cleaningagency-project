<?php
// Include the database connection file
include 'db_connect.php';

// Initialize variables to hold form data
$firstName = $lastName = $phone = $email = $servicesRequired = $address = "";

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize the input values
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $servicesRequired = $conn->real_escape_string($_POST['servicesRequired']);
    $address = $conn->real_escape_string($_POST['address']);

    // SQL query to insert the data into the database
    $sql = "INSERT INTO Customer (FirstName, LastName, Phone, Email, ServicesRequired, Address) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare a prepared statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ssssss", $firstName, $lastName, $phone, $email, $servicesRequired, $address);
        
        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "<p>New customer added successfully.</p>";
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

<!-- Your existing HTML structure here, with additional form fields added below -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e7e7e7;
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
        textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #fafafa;
        }
        .form-action {
            text-align: center;
        }
        input[type="submit"] {
            cursor: pointer;
            width: 100%; /* Adjust the width as needed */
            padding: 15px 30px; /* Add some padding for aesthetics */
            border: none;
            background-color: #5cb85c;
            color: white;
            font-size: 18px;
            border-radius: 3px;
            transition: background-color 0.3s ease;
            display: inline-block; /* Center the button */
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
        <h2>Add Customer</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<div class="form-group">
    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName" required>
</div>
<div class="form-group">
    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" required>
</div>
<div class="form-group">
    <label for="phone">Phone Number:</label>
    <input type="text" id="phone" name="phone" required>
</div>
<div class="form-group">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
</div>
<div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
<div class="form-group">
    <label for="servicesRequired">Services Required:</label>
    <textarea id="servicesRequired" name="servicesRequired" required></textarea>
</div>

            <input type="submit" value="Submit">
        </form>
        <a href="welcome.php" class="back-to-home">Back to Home</a>
    </div>
</body>
</html>
