<?php
session_start();
error_reporting(E_ALL);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $eid = $_GET['editid'];
    $SubjectName = $_POST['subjectname'];
    $SubjectCode = $_POST['subjectnumeric'];

    $sql = "UPDATE stnsubjects SET SubjectName = :subjectname, SubjectCode = :subjectnumeric WHERE ID = :eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':subjectname', $SubjectName, PDO::PARAM_STR);
    $query->bindParam(':subjectnumeric', $SubjectCode, PDO::PARAM_STR);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();

    echo '<script>alert("Subject has been updated")</script>';
    echo '<script>window.location.href ="manage-subjects.php"</script>';
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <title>Update Subject</title>
    <link rel="shortcut icon" href="../../image/hpsslogo.jpg" type="image/x-icon">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
    <!-- Left Panel -->
    <?php include_once('includes/sidebar.php'); ?>

    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php include_once('includes/header.php'); ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Class</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="N-admin.php">Dashboard</a></li>
                            <li><a href="manage-classes.php">Subject</a></li>
                            <li class="active">Edit Subject</li>
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
                            <div class="card-header"><strong>Subject</strong><small> Detail</small></div>
                            <form method="post" action="">
                                <div class="card-body card-block">
                                <?php
                                    $eid = $_GET['editid'];
                                    $sql = "SELECT * FROM stnsubjects WHERE ID = :eid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                    $query->execute();
                                    $row = $query->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="form-group">
                                        <label for="subjectname" class="form-control-label">Subject Name</label>
                                        <input type="text" name="subjectname" value="<?php echo $row['SubjectName']; ?>" class="form-control" id="subjectname" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="subjectnumeric" class="form-control-label">Subject Code</label>
                                        <input type="text" name="subjectnumeric" value="<?php echo $row['SubjectCode']; ?>" class="form-control" id="subjectnumeric" required>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p style="text-align: center;">
                                        <button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit">
                                            <i class="fa fa-dot-circle-o"></i> Update
                                        </button>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="../vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>
