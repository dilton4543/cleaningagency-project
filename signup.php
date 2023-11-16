<?php
include 'db_connect.php'; // Include the database connection file

// Initialize variables and error messages
$firstName = $lastName = $email = $password = $confirm_password = "";
$firstName_err = $lastName_err = $email_err = $password_err = $confirm_password_err = "";

// When form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate first name
    if (empty(trim($_POST["firstName"]))) {
        $firstName_err = "Please enter your first name.";
    } else {
        $firstName = trim($_POST["firstName"]);
    }
    
    // Validate last name
    if (empty(trim($_POST["lastName"]))) {
        $lastName_err = "Please enter your last name.";
    } else {
        $lastName = trim($_POST["lastName"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } else {
        // Prepare a select statement to check if the email exists
        $sql = "SELECT UserID FROM users WHERE Email = ?";
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);
            // Set parameters
            $param_email = trim($_POST["email"]);
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $email_err = "This email is already taken.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            $stmt->close();
        }
    }
    
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";     
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";     
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if ($password != $confirm_password) {
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in the database
    if (empty($firstName_err) && empty($lastName_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO users (FirstName, LastName, Email, Password, Role) VALUES (?, ?, ?, ?, 'customer')";
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $param_firstName, $param_lastName, $param_email, $param_password);
            // Set parameters
            $param_firstName = $firstName;
            $param_lastName = $lastName;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            text-align: center;
        }
        p {
            color: #666;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 20px;
        }
        label {
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: block;
            width: 100%;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group span {
            color: #d9534f;
        }
        a {
            text-decoration: none;
            color: #5cb85c;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Customer Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="firstName" value="<?php echo $firstName; ?>">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastName" value="<?php echo $lastName; ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>">
                <span><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password">
                <span><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password">
                <span><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
            <!-- <p>Are you a staff? <a href="staff_signup.php">Register here</a>.</p> -->
            <p>Back Home ? <a href="index.php">Click here</a>.</p>
        </form>
    </div>
</body>
</html>