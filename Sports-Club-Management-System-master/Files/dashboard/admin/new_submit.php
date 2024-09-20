<?php
require '../../include/db_conn.php';
page_protect();

// Retrieve POST data
$memID = $_POST['m_id'];
$uname = $_POST['u_name'];
$stname = $_POST['street_name'];
$city = $_POST['city'];
$zipcode = $_POST['zipcode'];
$state = $_POST['state'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$phn = $_POST['mobile'];
$email = $_POST['email'];
$jdate = $_POST['jdate'];
$plan = $_POST['plan'];

// Start a transaction
mysqli_begin_transaction($con);
try {
    // Inserting into users table
    $stmt = $con->prepare("INSERT INTO users (username, gender, mobile, email, dob, joining_date, userid) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . mysqli_error($con));
    }

    // Bind parameters
    $stmt->bind_param("ssssssi", $uname, $gender, $phn, $email, $dob, $jdate, $memID);
    
    if ($stmt->execute()) {
        // Retrieve information of plan selected by user
        $query1 = "SELECT * FROM plan WHERE pid = ?";
        $stmt1 = $con->prepare($query1);
        $stmt1->bind_param("s", $plan);
        $stmt1->execute();
        $result = $stmt1->get_result();
        
        if ($result->num_rows > 0) {
            $value = $result->fetch_row();
            date_default_timezone_set("Asia/Calcutta"); 
            $d = strtotime("+" . $value[3] . " Months");
            $cdate = date("Y-m-d"); // current date
            $expiredate = date("Y-m-d", $d); // adding validity retrieved from plan to current date
            
            // Inserting into enrolls_to table
            $stmt2 = $con->prepare("INSERT INTO enrolls_to (pid, uid, paid_date, expire, renewal) VALUES (?, ?, ?, ?, ?)");
            $stmt2->bind_param("sssss", $plan, $memID, $cdate, $expiredate, $renewal);
            $renewal = 'yes'; // Declare this variable before binding

            if ($stmt2->execute()) {
                // Insert into health_status table
                $stmt3 = $con->prepare("INSERT INTO health_status (uid) VALUES (?)");
                $stmt3->bind_param("s", $memID);

                if ($stmt3->execute()) {
                    // Insert into address table
                    $stmt4 = $con->prepare("INSERT INTO address (id, streetName, state, city, zipcode) VALUES (?, ?, ?, ?, ?)");
                    $stmt4->bind_param("sssss", $memID, $stname, $state, $city, $zipcode);
                    
                    if ($stmt4->execute()) {
                        // Commit transaction
                        mysqli_commit($con);
                        echo "<head><script>alert('Member Added');</script></head><body><meta http-equiv='refresh' content='0; url=new_entry.php'></body></html>";
                    } else {
                        throw new Exception("Address Insert Failed: " . mysqli_error($con));
                    }
                } else {
                    throw new Exception("Health Status Insert Failed: " . mysqli_error($con));
                }
            } else {
                throw new Exception("Enrollment Insert Failed: " . mysqli_error($con));
            }
        } else {
            throw new Exception("Plan Not Found: " . mysqli_error($con));
        }
    } else {
        throw new Exception("User Insert Failed: " . mysqli_error($con));
    }
} catch (Exception $e) {
    // Rollback transaction
    mysqli_rollback($con);
    echo "<head><script>alert('Member Addition Failed: " . $e->getMessage() . "');</script></head><body><meta http-equiv='refresh' content='0; url=new_entry.php'></body></html>";
}

// Close the prepared statements
$stmt->close();
if (isset($stmt1)) $stmt1->close();
if (isset($stmt2)) $stmt2->close();
if (isset($stmt3)) $stmt3->close();
if (isset($stmt4)) $stmt4->close();
$con->close();
?>
