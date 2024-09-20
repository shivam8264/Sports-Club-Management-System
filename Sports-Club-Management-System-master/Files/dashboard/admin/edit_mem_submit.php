<?php
require '../../include/db_conn.php';
page_protect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST['uid'];
    $uname = $_POST['uname'];
    $gender = $_POST['gender'];
    $mobile = $_POST['phone'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $jdate = $_POST['jdate'];
    $stname = $_POST['stname'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];
    $calorie = $_POST['calorie'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $fat = $_POST['fat'];
    $remarks = $_POST['remarks'];

    // Using prepared statements for security
    $query1 = "UPDATE users SET username=?, gender=?, mobile=?, email=?, dob=?, joining_date=? WHERE userid=?";
    $stmt1 = $con->prepare($query1);
    $stmt1->bind_param("ssssssi", $uname, $gender, $mobile, $email, $dob, $jdate, $uid);

    if ($stmt1->execute()) {
        $query2 = "UPDATE address SET streetName=?, state=?, city=?, zipcode=? WHERE id=?";
        $stmt2 = $con->prepare($query2);
        $stmt2->bind_param("ssssi", $stname, $state, $city, $zipcode, $uid);

        if ($stmt2->execute()) {
            $query3 = "UPDATE health_status SET calorie=?, height=?, weight=?, fat=?, remarks=? WHERE uid=?";
            $stmt3 = $con->prepare($query3);
            $stmt3->bind_param("ssssss", $calorie, $height, $weight, $fat, $remarks, $uid);

            if ($stmt3->execute()) {
                echo "<script>alert('Member updated successfully');</script>";
                echo "<meta http-equiv='refresh' content='0; url=view_mem.php'>";
            } else {
                echo "<script>alert('ERROR! Update operation unsuccessful');</script>";
                echo "Error: " . $stmt3->error;
            }
            $stmt3->close();
        } else {
            echo "<script>alert('ERROR! Update operation unsuccessful');</script>";
            echo "Error: " . $stmt2->error;
        }
        $stmt2->close();
    } else {
        echo "<script>alert('ERROR! Update operation unsuccessful');</script>";
        echo "Error: " . $stmt1->error;
    }
    $stmt1->close();
}

$con->close();
?>
