<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SPORTS CLUB | Routine</title>
    <link rel="stylesheet" href="../../css/style.css" id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
    <link href="a1style.css" rel="stylesheet" type="text/css">
    <style>
        .page-container .sidebar-menu #main-menu li#routinehassubopen > a {
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
                <div class="col-md-6 col-sm-8 clearfix">    
                </div>
                <div class="col-md-6 col-sm-4 clearfix hidden-xs">
                    <ul class="list-inline links-list pull-right">
                        <li>Welcome <?php echo $_SESSION['full_name']; ?></li>
                        <li>
                            <a href="logout.php">
                                Log Out <i class="entypo-logout right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <h3>Create Routine</h3>
            <hr />

            <div class="a1-container a1-small a1-padding-32" style="margin-top:2px; margin-bottom:2px;">
                <div class="a1-card-8 a1-light-gray" style="width:500px; margin:0 auto;">
                    <div class="a1-container a1-dark-gray a1-center">
                        <h6>NEW ROUTINE</h6>
                    </div>
                    <form id="form1" name="form1" method="post" class="a1-container" action="saveroutine.php">
    <table width="100%" border="0" align="center">
        <tr>
            <td height="35">ROUTINE NAME:</td>
            <td height="35"><input name="rname" size="30" required/></td>
        </tr>
        <tr>
            <td height="35">Plan ID:</td>
            <td height="35">
                <select name="pidd" required>
                    <option value="" disabled selected>Select a Plan</option>
                    <?php
                    // Fetch plan IDs from the database
                    $result = mysqli_query($con, "SELECT pid FROM plan");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['pid'] . "'>" . $row['pid'] . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td height="35">DAY 1:</td>
            <td height="35"><textarea name="day1" style="width: 236px; height: 42px; resize:none;"></textarea></td>
        </tr>
        <tr>
            <td height="35">DAY 2:</td>
            <td height="35"><textarea name="day2" style="width: 236px; height: 42px; resize:none;"></textarea></td>
        </tr>
        <tr>
            <td height="35">DAY 3:</td>
            <td height="35"><textarea name="day3" style="width: 236px; height: 42px; resize:none;"></textarea></td>
        </tr>
        <tr>
            <td height="35">DAY 4:</td>
            <td height="35"><textarea name="day4" style="width: 236px; height: 42px; resize:none;"></textarea></td>
        </tr>
        <tr>
            <td height="35">DAY 5:</td>
            <td height="35"><textarea name="day5" style="width: 236px; height: 42px; resize:none;"></textarea></td>
        </tr>
        <tr>
            <td height="35">DAY 6:</td>
            <td height="35"><textarea name="day6" style="width: 236px; height: 42px; resize:none;"></textarea></td>
        </tr>
        <tr>
            <td height="35">&nbsp;</td>
            <td height="35">
                <input class="a1-btn a1-blue" type="submit" name="submit" value="Add Routine">
                <input class="a1-btn a1-blue" type="reset" name="reset" value="Reset">
            </td>
        </tr>
    </table>
</form>
                </div>
            </div>

            <?php include('footer.php'); ?>
        </div>
    </div>
</body>
</html>
