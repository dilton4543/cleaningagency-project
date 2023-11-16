<?php
// Start the session
session_start();

// Check if the user is logged in and is a customer, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'customer') {
    header("location: login.php");
    exit;
}

// Include your database connection file
include 'db_connect.php';

// Initialize variables to hold review data
$rating = $comment = "";
$rating_err = $comment_err = "";

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate rating
    if (empty(trim($_POST["rating"]))) {
        $rating_err = "Please enter a rating.";
    } elseif (intval($_POST["rating"]) < 1 || intval($_POST["rating"]) > 10) {
        $rating_err = "Rating must be between 1 and 10.";
    } else {
        $rating = trim($_POST["rating"]);
    }

    // Validate comment
    if (empty(trim($_POST["comment"]))) {
        $comment_err = "Please enter your comment.";
    } else {
        $comment = trim($_POST["comment"]);
    }

    // Check input errors before inserting in the database
    if (empty($rating_err) && empty($comment_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO review (Rating, Comment, CustomerID) VALUES (?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("isi", $param_rating, $param_comment, $param_customerID);
            
            // Set parameters
            $param_rating = $rating;
            $param_comment = $comment;
            $param_customerID = $_SESSION["id"]; // Assuming CustomerID is stored as "id" in session
            
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                echo "<p>Thank you for your review.</p>";
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
    <title>Make a Review</title>
    <style>
        /* Your existing styles */
        /* Add styles for the review form */
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
        input[type="number"],
        textarea {
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
        <h2>Make a Review</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="rating">Rating (1-10):</label>
                <input type="number" id="rating" name="rating" min="1" max="10" required>
                <span class="error"><?php echo $rating_err; ?></span>
            </div>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment" rows="4" required></textarea>
                <span class="error"><?php echo $comment_err; ?></span>
            </div>
            <div class="form-group">
            <input type="submit" value="Submit Review">   <a href="welcome.php" class="back-to-home">Back to Home</a>
                
            </div>
            
        </form>
    </div>
</body>
</html>
