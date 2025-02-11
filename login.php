<?php
    // Initialize the message variable
    $message = "";

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db_hostname = "127.0.0.1";
        $db_username = "root";
        $db_password = "";
        $db_name = "leave_management";

        // Establish connection
        $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

        if (!$conn) {
            $message = "Connection failed: " . mysqli_connect_error();
        } else {
            // Capture user input
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Validate user input
            if (strlen($email) == 0 || strlen($password) == 0) {
                $message = "Must fill all the details";
            } else {
                // Query to check if email and password exist in the database
                $sql = "SELECT * FROM signup WHERE email='$email' AND newpassword='$password'";

                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    $message = "Error: " . mysqli_error($conn);
                } else {
                    // Check if a record is found
                    $row = mysqli_fetch_assoc($result);
                    if ($row) {
                        // Redirect to the main page
                        header('Location: http://127.0.0.1/LeaveManagement/main.html');
                        exit;
                    } else {
                        // Login failed
                        $message = "Login failed";
                    }
                }
            }

            // Close the database connection
            mysqli_close($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="post" action="">
            <input type="email" placeholder="Email" name="email" required><br>
            <input type="password" placeholder="Password" name="password" required><br>
            <button id="sub" type="submit">Login</button>
            <button id="res" type="reset">Reset</button>
        </form>

        <?php
            // Display the message if it exists
            if (!empty($message)) {
                echo "<p style='color: red;'>$message</p>";
            }
        ?>

        <div class="text">
            <p>I don't have an account</p>
            <a href="signup.php">Signup</a>
        </div>
    </div>
</body>
</html>
