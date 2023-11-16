<?php
// Start the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
// Determine the part of the day
$hour = date('H'); // Get the current hour in 24-hour format
$greeting = '';

if ($hour < 12) {
    $greeting = 'Good morning';
} elseif ($hour < 18) {
    $greeting = 'Good afternoon';
} else {
    $greeting = 'Good evening';
}

// Get the user's first name and last name from the session
$firstName = $_SESSION["firstname"] ?? '';
$lastName = $_SESSION["lastname"] ?? '';

// Check the user's role and set the navigation links based on it
$navigationLinks = [
    'customer' => [
        'Make a Request' => 'service_request.php',
        'Signup' => 'signup.php',
        'Logout' => '#',
    ],
    'staff' => [
        'Add Customer' => 'customer_form.php',
        'Assign Staff' => 'job_assignment.php',
        'Signup' => 'signup.php',
        'Add a new Staff' => 'staff_signup.php',
        'Logout' => '#',

    ]
];

// Get the role from the session
$userRole = $_SESSION['role'] ?? 'guest'; // Default to 'guest' if no role is set

// Now we use the role to get the correct set of links
$linksToShow = $navigationLinks[$userRole] ?? [];

// Include logout logic
if (isset($_POST['logout'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session.
    session_destroy();

    // Redirect to login page
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .nav-bar {
            background-color: #333;
            overflow: hidden;
            text-align: center;
        }
        .nav-bar ul {
            padding: 0;
            list-style-type: none;
            display: inline-block; /* Center the menu */
            margin: 0; /* Remove default margin */
        }
        .nav-bar ul li {
            display: inline;
        }
        .nav-bar ul li a {
            color: white;
            padding: 14px 16px;
            text-decoration: none;
            display: inline-block;
        }
        .nav-bar ul li a:hover {
            background-color: #ddd;
            color: black;
        }
        .nav-bar ul li a.logout-btn {
            background-color: #f44336;
            color: white;
            position: absolute;
            right: 0;
        }
        .nav-bar ul li a.logout-btn:hover {
            background-color: #ba000d;
        }
        .welcome-message {
            padding: 20px;
            background-color: #ffffff;
            text-align: left;
            margin-top: 20px;
            box-shadow: 0 2px 5px -2px rgba(0,0,0,.2);
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative; /* For absolute positioning of logout button */
        }
        #welcome{
            text-align:center;
        }
    </style>
</head>
<body>
    <h1 id="welcome">Welcome to our cleaning service portal</h1>
    <div class="nav-bar">
        <div class="container">
            <ul>

            <?php foreach ($linksToShow as $text => $url): ?>
                <?php if ($text === 'Logout'): ?>
                    <li><a href="<?php echo $url; ?>" class="logout-btn" onclick="document.getElementById('logout-form').submit();"><?php echo $text; ?></a></li>
                <?php else: ?>
                    <li><a href="<?php echo $url; ?>"><?php echo $text; ?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
            
            <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === 'customer'): ?>
                    <li><a href="make_review.php">Make a Review</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === 'customer'): ?>
                <li><a href="payment.php">Make Payment</a></li>
            <?php endif; ?>

                <!-- <li><a href="customer_form.php">Add Customer</a></li>
                <li><a href="signup.php">Signup</a></li>
                <li><a href="service_request.php">Make a Request</a></li>
                <li><a href="assign_staff.php">Assign Staff</a></li>
                <li><a href="#" class="logout-btn" onclick="document.getElementById('logout-form').submit();">Logout</a></li> -->
            </ul>
            <form id="logout-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="display: none;">
            <input type="hidden" name="logout" value="1">
        </form>
        </div>
    </div>
    <div class="container">
        <div class="welcome-message">
        <h3><?php echo $greeting; ?> <?php echo htmlspecialchars($firstName); ?> <?php echo htmlspecialchars($lastName); ?>, how are you doing today?</h3>
        </div>
        <!-- Rest of your welcome page content -->
    </div>
</body>
</html>
