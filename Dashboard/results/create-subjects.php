<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['trmsaid']) == 0) {
//     header('location:logout.php');
// } else {
    if (isset($_POST['submit'])) {
        $trmsaid = $_SESSION['trmsaid'];
        $subjectname = $_POST['subjectname'];
        $subjectnumeric = $_POST['subjectnumeric'];

        // SQL query with CreationDate
        $sql = "INSERT INTO stnsubjects (Creationdate, SubjectName, SubjectCode) VALUES (NOW(), :subjectname, :subjectnumeric)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':subjectname', $subjectname, PDO::PARAM_STR);
        $query->bindParam(':subjectnumeric', $subjectnumeric, PDO::PARAM_STR);
        $query->execute();

        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("Subject has been added.")</script>';
            echo "<script>window.location.href ='create-subjects.php'</script>";
        } else {
            echo '<script>alert("Something went wrong. Please try again.")</script>';
        }
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Create Subjects</title>
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
                        <h1>Create Student Subjects</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="manage-subjects.php">Subject Details</a></li>
                            <li class="active">Add</li>
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
                            <div class="card-header"><strong>Subjects</strong><small> Details</small></div>
                            <form name="" method="post" action="">
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label for="subjectname" class="form-control-label">Subject Name</label>
                                        <input type="text" name="subjectname" placeholder="Subject Name" class="form-control" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="subjectnumeric" class="form-control-label">Subject Code</label>
                                        <input type="text" name="subjectnumeric" placeholder="Subject Code" class="form-control" required="true">
                                    </div>
                                    <p style="text-align: center;">
                                        <button type="submit" class="btn btn-primary btn-sm" name="submit">
                                            <i class="fa fa-dot-circle-o"></i> Add
                                        </button>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- .animated -->
            </div><!-- .content -->
        </div><!-- /#right-panel -->
    </div>

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="../vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>
