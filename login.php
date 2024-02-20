<?php
include 'db_connect.php'; // Include your database connection file

session_start(); // Start the session at the beginning of the script

// Initialize variables
$email = $password = "";
$email_err = $password_err = "";

// When form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if email is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    } else {
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT UserID, FirstName, LastName, Email, Password FROM users WHERE Email = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);

            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();
                
                // Check if email exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($id, $firstName, $lastName, $email, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session

                            $sql = "SELECT Role, UserID, StaffID FROM users WHERE UserID = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $stmt->bind_result($role, $customerID, $staffID);
            if ($stmt->fetch()) {
                // Now we store the role in the session
                $_SESSION["role"] = $role;
                
                // Depending on the role, store either CustomerID or StaffID
                if ($role === 'customer') {
                    $_SESSION["customer_id"] = $customerID;
                } elseif ($role === 'staff') {
                    $_SESSION["staff_id"] = $staffID;
                }
            }
            $stmt->close();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    
    
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["firstname"] = $firstName;
                            $_SESSION["lastname"] = $lastName;
                            $_SESSION["email"] = $email;
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                            exit; // It's important to call exit after headers to ensure the script stops executing
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    // Display an error message if email doesn't exist
                    $email_err = "No account found with that email.";
                }
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

<!-- HTML for the login form goes here -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
    }
    .form-group {
        margin-bottom: 15px;
    }
    label {
        display: block;
        margin-bottom: 5px;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: calc(100% - 20px); /* subtract padding */
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    input[type="submit"] {
        padding: 10px;
        background-color: #5cb85c;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.2s;
        font-weight:bold;
    }
    input[type="submit"]:hover {
        background-color: #4cae4c;
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
    .back-to-home {
            display: inline-block; /* Align to the center */
            /* margin-top: 20px; */
            margin-left: 10px;
            padding: 8px 5px; /* Smaller than the submit button */
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
            text-decoration:none;
        }
</style>

</head>
<body>
    <div>
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>">
                <span><?php echo $email_err; ?></span>
            </div>    
            <div>
                <label>Password</label>
                <input type="password" name="password">
                <span><?php echo $password_err; ?></span>
            </div>
            <div>
                <input type="submit" value="Login"> <a href="index.php" class="back-to-home">Back to Home</a>
            </div>
            <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
        </form>
        
    </div>    
</body>
</html>
