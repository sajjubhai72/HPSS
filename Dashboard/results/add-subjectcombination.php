<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['trmsaid']) == 0) {
//     header('location:logout.php');
// } else {
    if (isset($_POST['submit'])) {
        $trmsaid = $_SESSION['trmsaid'];
        $ClassId = $_POST['classname'];
        $SubjectId = $_POST['subjectname'];
        $status=1;

        // SQL query with CreationDate
        $sql = "INSERT INTO stnsubjectcombination (ClassId, SubjectId, status) VALUES (:classname, :subjectname, :status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':classname', $ClassId, PDO::PARAM_STR);
        $query->bindParam(':subjectname', $SubjectId, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();

        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("Subject Combinations has been added.")</script>';
            echo "<script>window.location.href ='add-subjectcombination.php'</script>";
        } else {
            echo '<script>alert("Something went wrong. Please try again.")</script>';
        }
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Create Combination Subject</title>
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
                        <h1>Create Student Subject</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="add-subjects.php">Subject Details</a></li>
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
                            <div class="card-header"><strong>Subject</strong><small> Details</small></div>
                            <form name="" method="post" action="">
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label for="classname" class="form-control-label">Class Name</label>
                                        <select name="classname" id="classtname" class="form-control">
                                            <option value="">Select Class</option>
                                            <?php $sql = "SELECT * from stnclasses";
                                                  $query = $dbh->prepare($sql);
                                                  $query->execute();
                                                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                  if($query->rowCount() > 0)
                                                  {
                                                  foreach($results as $result)
                                                  {   ?>
                                            <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName); ?>&nbsp; Section-<?php echo htmlentities($result->Section); ?></option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="subjectname" class="form-control-label">Subject</label>
                                        <select name="subjectname" id="subjectname" class="form-control">
                                            <option value="">Select Subject</option>
                                            <?php $sql = "SELECT * from stnsubjects";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                    if($query->rowCount() > 0)
                                                    {
                                                    foreach($results as $result)
                                                    {   ?>
                                            <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->SubjectName); ?></option>
                                            <?php }} ?>
                                        </select>
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
