<?php
require '../../include/db_conn.php';
page_protect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_id = $_POST['login_id'];
    $login_key = $_POST['login_key'];
    $new_password = $_POST['pwfield'];
    $confirm_password = $_POST['confirmfield'];

    // Validate input
    if ($new_password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.');</script>";
    } elseif (strlen($new_password) < 6) { // Minimum length check
        echo "<script>alert('Password must be at least 6 characters long.');</script>";
    } elseif (!preg_match('/[A-Za-z]/', $new_password) || !preg_match('/[0-9]/', $new_password)) { // Check for letters and numbers
        echo "<script>alert('Password must contain both letters and numbers.');</script>";
    } else {
        // Prepare the statement for updating the password
        $query = "UPDATE admin SET password=? WHERE username=? AND login_key=?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("sss", password_hash($new_password, PASSWORD_DEFAULT), $login_id, $login_key);

        if ($stmt->execute()) {
            echo "<script>alert('Password changed successfully.');</script>";
            echo "<meta http-equiv='refresh' content='0; url=logout.php'>";
        } else {
            echo "<script>alert('Error updating password. Please check your login key.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SPORTS CLUB | Change Password</title>
    <link rel="stylesheet" href="../../css/style.css" id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
    <link href="a1style.css" rel="stylesheet" type="text/css">
    <style>
        .page-container .sidebar-menu #main-menu li#adminprofile > a {
            background-color: #2b303a;
            color: #ffffff;
        }
        #boxx {
            width: 220px;
        }
    </style>
</head>
<body class="page-body page-fade" onload="collapseSidebar()">

<div class="page-container sidebar-collapsed" id="navbarcollapse">
    <div class="sidebar-menu">
        <header class="logo-env">
            <div class="logo">
                <a href="main.php">
                    <img src="logo.png" alt="" width="192" height="80" />
                </a>
            </div>
            <div class="sidebar-collapse" onclick="collapseSidebar()">
                <a href="#" class="sidebar-collapse-icon with-animation">
                    <i class="entypo-menu"></i>
                </a>
            </div>
        </header>
        <?php include('nav.php'); ?>
    </div>

    <div class="main-content">
        <div class="row">
            <div class="col-md-6 col-sm-8 clearfix"></div>
            <div class="col-md-6 col-sm-4 clearfix hidden-xs">
                <ul class="list-inline links-list pull-right">
                    <li>Welcome <?php echo htmlspecialchars($_SESSION['full_name']); ?></li>
                    <li>
                        <a href="logout.php">
                            Log Out <i class="entypo-logout right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <h3>Change Password</h3>
        <hr />

        <div class="a1-container a1-small a1-padding-32" style="margin-top:2px; margin-bottom:2px;">
            <div class="a1-card-8 a1-light-gray" style="width:500px; margin:0 auto;">
                <div class="a1-container a1-dark-gray a1-center">
                    <h6>CHANGE PASSWORD</h6>
                </div>
                <form id="form1" name="form1" action="change_s_pwd.php" method="POST" class="a1-container">
                    <table width="100%" border="0" align="center">
                        <tr>
                            <td height="35">ID:</td>
                            <td height="35">
                                <input type="text" id="boxx" name="login_id" readonly value="<?php echo htmlspecialchars($_SESSION['user_data']); ?>" required />
                            </td>
                        </tr>
                        <tr>
                            <td height="35">LOGIN KEY:</td>
                            <td height="35">
                                <input type="text" id="boxx" name="login_key" class="form-control" required placeholder="Your secret key" />
                            </td>
                        </tr>
                        <tr>
                            <td height="35">NEW PASSWORD:</td>
                            <td height="35">
                                <input type="password" name="pwfield" id="boxx" class="form-control" required minlength="6" placeholder="Your new password" />
                            </td>
                        </tr>
                        <tr>
                            <td height="35">CONFIRM PASSWORD:</td>
                            <td height="35">
                                <input type="password" name="confirmfield" id="boxx" class="form-control" required minlength="6" placeholder="Confirm your new password" />
                            </td>
                        </tr>
                        <tr>
                            <td height="35"></td>
                            <td height="35">
                                <input class="a1-btn a1-blue" type="submit" name="submit" id="submit" value="SUBMIT">
                                <input class="a1-btn a1-blue" type="reset" name="reset" id="reset" value="Reset">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <?php include('footer.php'); ?>
    </div>
</body>
</html>
