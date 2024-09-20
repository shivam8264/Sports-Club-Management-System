<?php
require '../../include/db_conn.php';
page_protect();

// Get values from the form
$rname = $_POST["rname"];
$day1 = $_POST["day1"];
$day2 = $_POST["day2"];
$day3 = $_POST["day3"];
$day4 = $_POST["day4"];
$day5 = $_POST["day5"];
$day6 = $_POST["day6"];
$pid = $_POST["pidd"];  // Ensure this is a valid plan ID from the `plan` table

// Prepare the SQL statement to prevent SQL injection
$stmt = $con->prepare("INSERT INTO sports_timetable (tname, day1, day2, day3, day4, day5, day6, pid) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $rname, $day1, $day2, $day3, $day4, $day5, $day6, $pid);

// Execute the statement
if ($stmt->execute()) {
    echo "<head><script>alert('Routine Added');</script></head>";
    echo "<meta http-equiv='refresh' content='0; url=addroutine.php'>";
} else {
    // Display the error message if the insertion fails
    echo "<head><script>alert('Routine Addition Failed: " . mysqli_error($con) . "');</script></head>";
}

// Close the statement
$stmt->close();

// Close the database connection
$con->close();
?>
