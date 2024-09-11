<?php
session_start();
error_reporting(E_ALL);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $eid = $_GET['editid'];
    $ClassName = $_POST['classname'];
    $ClassNameNumeric = $_POST['classnumeric'];
    $Section = $_POST['section'];

    $sql = "UPDATE stnclasses SET ClassName = :classname, ClassNameNumeric = :classnumeric, Section = :section WHERE ID = :eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':classname', $ClassName, PDO::PARAM_STR);
    $query->bindParam(':classnumeric', $ClassNameNumeric, PDO::PARAM_STR);
    $query->bindParam(':section', $Section, PDO::PARAM_STR);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();

    echo '<script>alert("Class has been updated")</script>';
    echo '<script>window.location.href ="manage-classes.php"</script>';
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <title>Update Class</title>
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
                            <li><a href="manage-classes.php">Class</a></li>
                            <li class="active">Edit Class</li>
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
                            <div class="card-header"><strong>Class</strong><small> Detail</small></div>
                            <form method="post" action="">
                                <div class="card-body card-block">
                                <?php
                                    $eid = $_GET['editid'];
                                    $sql = "SELECT * FROM stnclasses WHERE ID = :eid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                    $query->execute();
                                    $row = $query->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="form-group">
                                        <label for="classname" class="form-control-label">Class Name</label>
                                        <input type="text" name="classname" value="<?php echo $row['ClassName']; ?>" class="form-control" id="classname" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="classnumeric" class="form-control-label">Class Name in Numeric</label>
                                        <input type="text" name="classnumeric" value="<?php echo $row['ClassNameNumeric']; ?>" class="form-control" id="classnumeric" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="section" class="form-control-label">Section</label>
                                        <input type="text" name="section" value="<?php echo $row['Section']; ?>" class="form-control" id="section" required>
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
