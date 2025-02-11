<?php
    $message = ""; // To store any messages (error or success)

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Database connection
        $db_hostname = "127.0.0.1";
        $db_username = "root";
        $db_password = "";
        $db_name = "leave_management";
        
        // Establish connection
        $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

        if (!$conn) {
            $message = "Connection failed: " . mysqli_connect_error();
        } else {
            // Capture form data
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $newpassword = $_POST['newpassword'];
            $confirmpassword = $_POST['confirmpassword'];

            // Validate form inputs
            if (strlen($firstname) == 0 || strlen($lastname) == 0 || strlen($email) == 0 || strlen($newpassword) == 0 || strlen($confirmpassword) == 0) {
                $message = "Please fill in all the fields.";
            } else {
                if ($newpassword !== $confirmpassword) {
                    $message = "Passwords do not match!";
                } else {
                    // Insert user into the database
                    $sql = "INSERT INTO signup (firstname, lastname, email, newpassword, confirmpassword) 
                            VALUES ('$firstname', '$lastname', '$email', '$newpassword', '$confirmpassword')";
                    
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        $message = "Error: " . mysqli_error($conn);
                    } else {
                        // Redirect to login page after successful registration
                        header('Location: login.php');
                        exit; // Make sure to stop further execution of the script
                    }
                }
            }

            // Close the connection
            mysqli_close($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <div class="container">
        <h1>Signup</h1>
        <form method="post" action="">
            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="lastname" placeholder="Last Name" required>
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" placeholder="New Password" name="newpassword" required>
            <input type="password" placeholder="Confirm Password" name="confirmpassword" required>
            <button id="sub" type="submit">Signup</button>
            <button id="res" type="reset">Reset</button>
        </form>

        <?php
            // Display the message (if any)
            if (!empty($message)) {
                echo "<p style='color: red;'>$message</p>";
            }
        ?>

        <div class="text">
            <p>Already have an account?</p>
            <a href="login.php">Login</a>
        </div>
    </div>
</body>
</html>
