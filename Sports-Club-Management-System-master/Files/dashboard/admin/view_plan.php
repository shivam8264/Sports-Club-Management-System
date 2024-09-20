<?php
require '../../include/db_conn.php';
page_protect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SPORTS CLUB | View Sports Plan</title>
    <link rel="stylesheet" href="../../css/style.css" id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
    <link href="a1style.css" rel="stylesheet" type="text/css">
    <style>
        #button1 { width: 126px; }
        .page-container .sidebar-menu #main-menu li#planhassubopen > a {
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

            <h3>Manage Plan</h3>
            <hr />

            <table class="table table-bordered datatable" id="table-1" border="1">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Sports Plan ID</th>
                        <th>Sports Plan Name</th>
                        <th>Sports Plan Details</th>
                        <th>Validity</th>
                        <th>Rate</th>
                        <th>Action</th>
                    </tr>
                </thead>		
                <tbody>
                    <?php
                    $query = "SELECT * FROM plan WHERE active='yes' ORDER BY amount DESC";
                    $result = mysqli_query($con, $query);
                    $sno = 1;

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$sno}</td>
                                <td>{$row['pid']}</td>
                                <td>{$row['planName']}</td>
                                <td width='380'>{$row['description']}</td>
                                <td>{$row['validity']}</td>
                                <td>₹{$row['amount']}</td>
                                <td>
                                    <a href='edit_plan.php?id={$row['pid']}'><input type='button' class='a1-btn a1-blue' style='width:100%' value='Edit Plan'></a>
                                    <form action='del_plan.php' method='post' onSubmit='return ConfirmDelete();' style='display:inline;'>
                                        <input type='hidden' name='name' value='{$row['pid']}'/>
                                        <input type='submit' id='button1' value='Delete Plan' class='a1-btn a1-orange'/>
                                    </form>
                                </td>
                            </tr>";
                            $sno++;
                        }
                    } else {
                        echo "<tr><td colspan='7'>No active plans found.</td></tr>";
                    }
                    ?>																
                </tbody>
            </table>

            <?php include('footer.php'); ?>
        </div>
    </div>
</body>
</html>
