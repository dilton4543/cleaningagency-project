<?php
include 'db_connect.php'; // Your database connection file
session_start();

// Check if the user is logged in and is a customer
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'customer') {
    header("location: login.php");
    exit;
}

// Initialize variables to hold payment data
$amount = "";
$payment_err = "";

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate amount
    if (empty(trim($_POST["amount"]))) {
        $payment_err = "Please enter an amount.";
    } elseif (!is_numeric($_POST["amount"])) {
        $payment_err = "Please enter a valid amount.";
    } else {
        $amount = trim($_POST["amount"]);
    }

    // Check input errors before inserting in the database
    if (empty($payment_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO payment (Amount, PaymentDate, CustomerID) VALUES (?, NOW(), ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("di", $param_amount, $param_customerID);
            
            // Set parameters
            $param_amount = $amount;
            $param_customerID = $_SESSION["id"]; // Assuming CustomerID is stored as "id" in session
            
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                echo "<p>Payment successful.</p>";
            } else {
                echo "<p>Oops! Something went wrong. Please try again later.</p>";
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
    <title>Make Payment</title>
    <style>
        /* Add your existing CSS styles here */
        /* Additional styles for payment form */
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
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
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        span.error {
            color: #d9534f;
        }
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Make Payment</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" min="0.01" step="0.01" required>
                <span class="error"><?php echo $payment_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit Payment">  <a href="welcome.php" class="back-to-home">Back to Home</a>
            </div>
        </form>
    </div>
</body>
</html>
