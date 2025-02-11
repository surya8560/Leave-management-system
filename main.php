<?php
$db_hostname = "127.0.0.1";
$db_username = "root";
$db_password = "";
$db_name = "leave_management";

$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
    $spr = isset($_POST['spr']) ? $_POST['spr'] : '';
    
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $year = isset($_POST['year']) ? $_POST['year'] : '';
    $dept = isset($_POST['dept']) ? $_POST['dept'] : '';
    $date1 = isset($_POST['date1']) ? $_POST['date1'] : '';
    $date2 = isset($_POST['date2']) ? $_POST['date2'] : '';
    $reason = isset($_POST['reason']) ? $_POST['reason'] : '';

    if (empty($firstname) || empty($lastname) || empty($spr) || empty($phone) || empty($gender) || empty($year) || empty($dept) || empty($date1) || empty($date2) || empty($reason)) {
        $message = "All fields are required!";
    } else {
        $sql = "INSERT INTO details (firstname, lastname, spr, phone, gender, year, dept, date1, date2, reason) 
                VALUES ('$firstname', '$lastname', '$spr', '$phone', '$gender', '$year', '$dept', '$date1', '$date2', '$reason')";

        if (mysqli_query($conn, $sql)) {
            $message = "Leave application submitted successfully!";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Application</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="container">
        <h1>Apply Your Leave</h1>

        <?php
            if (!empty($message)) {
                echo "<p style='color: red;'>$message</p>";
            }
        ?>

        <form method="post" action="main.php">
            <div class="form-row">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="firstname" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lastname" placeholder="Last Name" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>SPR Number</label>
                    <input type="text" name="spr" placeholder="SPR Number" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" placeholder="Phone Number" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Gender</label>
                    <label><input type="radio" name="gender" value="Male" required> Male</label>
                    <label><input type="radio" name="gender" value="Female" required> Female</label>
                </div>
                <div class="form-group">
                    <label>Year</label>
                    <select name="year" required>
                        <option value="">Choose Year</option>
                        <option value="1">I</option>
                        <option value="2">II</option>
                        <option value="3">III</option>
                        <option value="4">IV</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Department</label>
                    <select name="dept" required>
                        <option value="">Choose Department</option>
                        <option value="CSE-A">CSE-A</option>
                        <option value="CSE-B">CSE-B</option>
                        <option value="ECE">ECE</option>
                        <option value="CIVIL">CIVIL</option>
                        <option value="EEE">EEE</option>
                        <option value="MECH">MECH</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>From Date</label>
                    <input type="date" name="date1" required>
                </div>
                <div class="form-group">
                    <label>To Date</label>
                    <input type="date" name="date2" required>
                </div>
            </div>
            <div class="form-group">
                <label>Reason for Leave</label>
                <textarea name="reason" placeholder="Enter your reason..." required></textarea>
            </div>
            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
        </form>
    </div>
</body>
</html>
