<?php
require '../../include/db_conn.php';
page_protect();

if (isset($_POST['submit'])) {
    $usrname = $_POST['login_id'];
    $fulname = $_POST['full_name'];

    // Prepare the update statement
    $query = "UPDATE admin SET username=?, Full_name=? WHERE username=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("sss", $usrname, $fulname, $_SESSION['full_name']);

    if ($stmt->execute()) {
        echo "<head><script>alert('Profile updated successfully');</script></head></html>";
        echo "<meta http-equiv='refresh' content='0; url=logout.php'>";
    } else {
        echo "<head><script>alert('Update not successful, please check again');</script></head></html>";
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>ATHLEX SPORTS CLUB | Admin</title>
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

        <h3>Edit User Profile</h3>
        <p>(You will be required to login again after profile update)</p>
        <hr />

        <div class="a1-container a1-small a1-padding-32" style="margin-top:2px; margin-bottom:2px;">
            <div class="a1-card-8 a1-light-gray" style="width:600px; margin:0 auto;">
                <div class="a1-container a1-dark-gray a1-center">
                    <h6>CHANGE PROFILE</h6>
                </div>
                <form id="form1" name="form1" method="post" class="a1-container" action="">
                    <table width="100%" border="0" align="center">
                        <tr>
                            <td height="35">ID:</td>
                            <td height="35">
                                <input type="text" name="login_id" value="<?php echo htmlspecialchars($_SESSION['user_data']); ?>" class="form-control" required/>
                            </td>
                        </tr>
                        <tr>
                            <td height="35">FULL NAME:</td>
                            <td height="35">
                                <input class="form-control" type="text" name="full_name" id="textfield2" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" maxlength="25" required>
                            </td>
                        </tr>
                        <tr>
                            <td height="35">PASSWORD</td>
                            <td height="35">
                                <span class="form-control">*********</span>
                                <a href="change_pwd.php" class="a1-btn a1-orange">Change password</a>
                                <span class="help-block">*For security reasons hidden</span>
                            </td>
                        </tr>
                        <tr>
                            <td height="35">&nbsp;</td>
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
