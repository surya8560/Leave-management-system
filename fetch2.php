<?php
    
    $db_hostname="127.0.0.1";
    $db_usernanme="root";
    $db_password="";
    $db_name="leave_management";

    $conn=mysqli_connect($db_hostname,$db_usernanme,$db_password,$db_name);
    if(!$conn){
        echo "Connection filed:" .mysqli_connect_error();
        exit;
    }

    $sql="SELECT * FROM signup";

    $result=mysqli_query($conn,$sql);
    if(!$result){
        echo "Error:".mysqli_error($conn);
        exit;
    }

    while($row=mysqli_fetch_assoc($result)){
        echo $row['name'];
    }

    mysqli_close($conn);
?>