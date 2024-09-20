<?php
require '../../include/db_conn.php';
page_protect();

// Get POST data and sanitize inputs
$planid = mysqli_real_escape_string($con, $_POST['planid']);
$name = mysqli_real_escape_string($con, $_POST['planname']);
$desc = mysqli_real_escape_string($con, $_POST['desc']);
$planval = (int)$_POST['planval']; // Casting to integer
$amount = (float)$_POST['amount']; // Casting to float

// Prepare the SQL statement to prevent SQL injection
$query = "INSERT INTO plan (pid, planName, description, validity, amount, active) VALUES ('$planid', '$name', '$desc', '$planval', '$amount', 'yes')";

// Execute the query and check for success
if (mysqli_query($con, $query)) {
    echo "<head><script>alert('PLAN Added Successfully');</script></head>";
    echo "<meta http-equiv='refresh' content='0; url=new_plan.php'>";
} else {
    echo "<head><script>alert('NOT SUCCESSFUL, Check Again: " . mysqli_error($con) . "');</script></head>";
}
?>
