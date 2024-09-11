<?php
session_start();
error_reporting(E_ALL); // Show all errors for debugging
ini_set('display_errors', 1); // Display errors
include('includes/dbconnection.php');

// For Activate Student
if (isset($_GET['acid'])) {
    $acid = intval($_GET['acid']);
    $status = 1;
    $sql = "UPDATE stnresult SET Status=:status WHERE StudentId=:acid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':acid', $acid, PDO::PARAM_INT);
    $query->bindParam(':status', $status, PDO::PARAM_INT);
    if ($query->execute()) {
        $msg = "Student activated successfully";
    } else {
        $msg = "Failed to activate Student";
    }
}

// For Deactivate Student
if (isset($_GET['did'])) {
    $did = intval($_GET['did']);
    $status = 0;
    $sql = "UPDATE stnresult SET Status=:status WHERE StudentId=:did";
    $query = $dbh->prepare($sql);
    $query->bindParam(':did', $did, PDO::PARAM_INT);
    $query->bindParam(':status', $status, PDO::PARAM_INT);
    if ($query->execute()) {
        $msg = "Student deactivated successfully";
    } else {
        $msg = "Failed to deactivate Student";
    }
}

// For Delete Student
if (isset($_GET['delid'])) {
    $delid = intval($_GET['delid']);
    $sql = "DELETE FROM stnresult WHERE StudentId=:delid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':delid', $delid, PDO::PARAM_INT);
    if ($query->execute()) {
        echo '<script>alert("Student details deleted successfully!")</script>';
    } else {
        echo '<script>alert("Failed to delete Student Details!")</script>';
    }
    echo "<script>window.location.href ='manage-student.php'</script>";
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Manage Results Details</title>
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../../image/hpsslogo.jpg" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
    <!-- Left Panel -->
    <?php include_once('includes/sidebar.php');?>

    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php include_once('includes/header.php');?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Manage Results</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="manage-result.php">Manage Results Details</a></li>
                            <li class="active">Manage Results Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Manage Results Details</strong>
                            </div>
                            <div class="card-body">
                                <?php if (isset($msg)) { ?>
                                    <div class="alert alert-info"><?php echo htmlentities($msg); ?></div>
                                <?php } ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                            <th>Student Name</th>
                                            <th>Roll No.</th>
                                            <th>Class & Section</th>
                                            <th>Registered Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // Adjust the SQL query based on your database schema
                                    $sql = "SELECT stnstudents.StudentName, stnstudents.RollId, stnstudents.RegDate, stnstudents.id AS StudentId, stnstudents.Status, 
                                            GROUP_CONCAT(DISTINCT CONCAT(stnclasses.ClassName, ' Section-(', stnclasses.Section, ')') SEPARATOR ', ') AS ClassSection 
                                            FROM stnresult 
                                            JOIN stnstudents ON stnstudents.id = stnresult.StudentId  
                                            JOIN stnclasses ON stnclasses.id = stnresult.ClassId
                                            GROUP BY stnstudents.id";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if (count($results) > 0) {
                                        foreach ($results as $result) {
                                    ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo htmlentities($result->StudentName); ?></td>
                                            <td><?php echo htmlentities($result->RollId); ?></td>
                                            <td><?php echo htmlentities($result->ClassSection); ?></td>
                                            <td><?php echo htmlentities($result->RegDate); ?></td>
                                            <td><?php echo htmlentities($result->Status == 0 ? 'Inactive' : 'Active'); ?></td>
                                            <td>
                                                <a href="editResult.php?editid=<?php echo htmlentities($result->StudentId); ?>" class="btn btn-primary">Edit</a>
                                                <a href="manage-result.php?delid=<?php echo htmlentities($result->StudentId); ?>" class="btn btn-danger" onclick="return confirm('Do you really want to delete?');">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                            $cnt++;
                                        }
                                    } else {
                                        echo '<tr><td colspan="7">No records found</td></tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>
