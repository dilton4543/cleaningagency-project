<?php
include 'db_connect.php'; // Your database connection file

// Initialize variables and error messages
$firstName = $lastName = $phoneNumber = $email = $skills = $availability = "";
$firstName_err = $lastName_err = $phoneNumber_err = $email_err = $skills_err = $availability_err = "";

// When form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate first name
    if (empty(trim($_POST["firstName"]))) {
        $firstName_err = "Please enter the first name.";
    } else {
        $firstName = trim($_POST["firstName"]);
    }
    
    // Validate last name
    if (empty(trim($_POST["lastName"]))) {
        $lastName_err = "Please enter the last name.";
    } else {
        $lastName = trim($_POST["lastName"]);
    }

    // Validate phone number
    if (empty(trim($_POST["phoneNumber"]))) {
        $phoneNumber_err = "Please enter the phone number.";
    } else {
        $phoneNumber = trim($_POST["phoneNumber"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate skills
    if (empty(trim($_POST["skills"]))) {
        $skills_err = "Please enter skills.";
    } else {
        $skills = trim($_POST["skills"]);
    }

    // Validate availability
    if (empty(trim($_POST["availability"]))) {
        $availability_err = "Please enter availability.";
    } else {
        $availability = trim($_POST["availability"]);
    }

    // Check input errors before inserting in the database
    if (empty($firstName_err) && empty($lastName_err) && empty($phoneNumber_err) && empty($email_err) && empty($skills_err) && empty($availability_err)) {
        
        // Prepare an insert statement
        $sql = "INSERT INTO cleaning_staff (FirstName, LastName, PhoneNumber, Email, Skills, Availability) VALUES (?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssss", $param_firstName, $param_lastName, $param_phoneNumber, $param_email, $param_skills, $param_availability);
            
            // Set parameters
            $param_firstName = $firstName;
            $param_lastName = $lastName;
            $param_phoneNumber = $phoneNumber;
            $param_email = $email;
            $param_skills = $skills;
            $param_availability = $availability;
            
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                header("location: login.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 25px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            color: #666;
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: block;
            width: 100%;
            box-sizing: border-box; /* Adds padding without increasing the width */
        }
        input[type="submit"] {
            padding: 12px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .form-group span {
            color: #d9534f;
            font-size: 14px;
        }
        a {
            text-decoration: none;
            color: #5cb85c;
        }
        a:hover {
            text-decoration: underline;
        }
        a.register-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-weight: bold;
            color: #337ab7;
        }
        .back-to-home {
        display: inline-block;
        padding: 10px 7px;
        text-decoration: none;
        background-color: #007bff;
        color: white;
        border-radius: 4px;
        font-size: 16px;
        transition: background-color 0.3s ease;
        margin-left: 30px;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Staff Registration</h2>
        <p>Please fill in this form to create a staff account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="firstName" value="<?php echo $firstName; ?>">
                <span><?php echo $firstName_err; ?></span>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastName" value="<?php echo $lastName; ?>">
                <span><?php echo $lastName_err; ?></span>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phoneNumber" value="<?php echo $phoneNumber; ?>">
                <span><?php echo $phoneNumber_err; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>">
                <span><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Skills</label>
                <input type="text" name="skills" value="<?php echo $skills; ?>">
                <span><?php echo $skills_err; ?></span>
            </div>
            <div class="form-group">
                <label>Availability</label>
                <input type="text" name="availability" value="<?php echo $availability; ?>">
                <span><?php echo $availability_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" value="Register"> <a href="welcome.php" class="back-to-home">Back to Home</a>
            </div>
        </form>
        <!-- <p>Already have an account? <a href="login.php">Login here</a>.</p>
        <p>Are you a customer? <a href="signup.php">Register here</a>.</p> -->
    </div>
</body>
</html>
