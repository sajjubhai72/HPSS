<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// For Activate Subject
if (isset($_GET['acid'])) {
    $acid = intval($_GET['acid']);
    $status = 1;
    $sql = "UPDATE stnsubjectcombination SET status=:status WHERE id=:acid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':acid', $acid, PDO::PARAM_INT);
    $query->bindParam(':status', $status, PDO::PARAM_INT);
    if ($query->execute()) {
        $msg = "Subject activated successfully";
    } else {
        $msg = "Failed to activate subject";
    }
}

// For Deactivate Subject
if (isset($_GET['did'])) {
    $did = intval($_GET['did']);
    $status = 0;
    $sql = "UPDATE stnsubjectcombination SET status=:status WHERE id=:did";
    $query = $dbh->prepare($sql);
    $query->bindParam(':did', $did, PDO::PARAM_INT);
    $query->bindParam(':status', $status, PDO::PARAM_INT);
    if ($query->execute()) {
        $msg = "Subject deactivated successfully";
    } else {
        $msg = "Failed to deactivate subject";
    }
}

// For Delete Subject
if (isset($_GET['delid'])) {
    $delid = intval($_GET['delid']);
    $sql = "DELETE FROM stnsubjectcombination WHERE id=:delid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':delid', $delid, PDO::PARAM_INT);
    if ($query->execute()) {
        echo '<script>alert("Subject deleted successfully!")</script>';
    } else {
        echo '<script>alert("Failed to delete subject!")</script>';
    }
    echo "<script>window.location.href ='manage-subjectcombination.php'</script>";
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Manage Subjects Combination</title>
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
                        <h1>Manage Subjects</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="manage-Subjects.php">Manage Subject Combination</a></li>
                            <li class="active">Manage Subject Combination</li>
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
                                <strong class="card-title">Manage Subject Combination</strong>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                            <th>Class & Section</th>
                                            <th>Subject</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = "SELECT stnclasses.ClassName, stnclasses.Section, stnsubjects.SubjectName, stnsubjectcombination.id as scid, stnsubjectcombination.status 
                                            FROM stnsubjectcombination 
                                            JOIN stnclasses ON stnclasses.id = stnsubjectcombination.ClassId  
                                            JOIN stnsubjects ON stnsubjects.id = stnsubjectcombination.SubjectId";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;

                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                    ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo htmlentities($result->ClassName . " Section- (" . $result->Section . ")"); ?></td>
                                            <td><?php echo htmlentities($result->SubjectName); ?></td>
                                            <td><?php echo htmlentities($result->status == 0 ? 'Inactive' : 'Active'); ?></td>
                                            <td>
                                                <?php if ($result->status == 0) { ?>
                                                    <a href="manage-subjectcombination.php?acid=<?php echo htmlentities($result->scid);?>" onclick="return confirm('Do you really want to activate this subject?');"><i class="fa fa-check btn btn-primary" title="Activate Record"></i></a>
                                                <?php } else { ?>
                                                    <a href="manage-subjectcombination.php?did=<?php echo htmlentities($result->scid);?>" onclick="return confirm('Do you really want to deactivate this subject?');"><i class="fa fa-times btn btn-primary" title="Deactivate Record"></i></a>
                                                <?php } ?>
                                                <a href="manage-subjectcombination.php?delid=<?php echo htmlentities($result->scid); ?>" class="btn btn-danger" onclick="return confirm('Do you really want to delete?');">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                        $cnt++;
                                        }
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
