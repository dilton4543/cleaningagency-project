<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace with your database connection details
    $conn = new mysqli("localhost", "root", "", "cleaningservicedb");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $staffID = $_POST['staffID'];
    $requestID = $_POST['requestID'];
    $status = $_POST['status'];

    $sql = "INSERT INTO job_assignment (staffID, requestID, status) VALUES (?, ?, ?)";

    // Prepared statement to avoid SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $staffID, $requestID, $status);
    
    if ($stmt->execute()) {
        echo "New assignment created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Job Assignment</title>
    <style>
        /* Overall body styling */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    /* Styling for the form container */
    form {
        background: white;
        padding: 40px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        width: 300px;
    }

    /* Styling for form labels */
    label {
        display: block;
        margin-bottom: 5px;
        color: #333;
    }

    /* Styling for input fields */
    input[type=text] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    /* Styling for the submit button */
    input[type=submit] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        background-color: #5cb85c;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-weight: bold;
    }

    input[type=submit]:hover {
        background-color: #4cae4c;
    }

    /* Additional styling for focus on inputs */
    input[type=text]:focus {
        border-color: #007bff;
        outline: none;
    }

    /* Add some spacing and styling to form elements */
    .form-element {
        margin-bottom: 20px;
    }

    /* Style for form title */
    .form-title {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    /* Styling for the Back to Home button */
.back-to-home {
    display: inline-block;
    padding: 10px 20px;
    text-decoration: none;
    background-color: #007bff;
    color: white;
    border-radius: 4px;
    font-size: 16px;
    transition: background-color 0.3s ease;
    margin-left: 80px;
    font-weight: bold;
}

.back-to-home:hover {
    background-color: #0056b3;
    text-decoration: none;
    color: white;
}

/* Additional styling for focus on the button */
.back-to-home:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.5);
}

    /* Small screen responsiveness */
    @media (max-width: 600px) {
        form {
            width: 90%;
            padding: 20px;
        }
    }


    </style>
</head>
<body>
    <form action="job_assignment.php" method="post">
        <label for="staffID">Staff ID:</label>
        <input type="text" id="staffID" name="staffID"><br><br>

        <label for="requestID">Service Request ID:</label>
        <input type="text" id="requestID" name="requestID"><br><br>

        <label for="status">Status (Available/Not Available):</label>
        <input type="text" id="status" name="status"><br><br>

        <input type="submit" value="Assign Job"> <br><br>

        <a href="welcome.php" class="back-to-home">Back to Home</a>

    </form>
    
</body>
</html>
