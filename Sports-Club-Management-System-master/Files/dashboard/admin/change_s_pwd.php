<?php
require '../../include/db_conn.php';

$key = trim($_POST['login_key']);
$pass = trim($_POST['pwfield']);
$user_id_auth = trim($_POST['login_id']);
$passconfirm = trim($_POST['confirmfield']);

if ($pass === $passconfirm) {
    if (isset($user_id_auth) && isset($pass) && isset($key)) {
        // Prepare statement to prevent SQL injection
        $stmt = $con->prepare("SELECT * FROM admin WHERE username=?");
        $stmt->bind_param("s", $user_id_auth);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->num_rows;

        if ($count == 1) {
            // Update password and secure key
            $stmt = $con->prepare("UPDATE admin SET pass_key=?, securekey=? WHERE username=?");
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
            $stmt->bind_param("sss", $hashed_pass, $key, $user_id_auth);

            if ($stmt->execute()) {
                echo "<script>alert('Profile Updated, Login Again');</script>";
                echo "<meta http-equiv='refresh' content='0; url=logout.php'>";
            } else {
                echo "<script>alert('Change Unsuccessful');</script>";
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "<script>alert('Change Unsuccessful: User not found');</script>";
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "<script>alert('Change Unsuccessful: Invalid input');</script>";
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "<script>alert('Confirm Password Mismatch');</script>";
    echo "<meta http-equiv='refresh' content='0; url=change_pwd.php'>";
}
?>
<center>
<img src="loading.gif">
</center>
