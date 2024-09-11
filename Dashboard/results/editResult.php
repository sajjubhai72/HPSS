<?php
session_start();
error_reporting(E_ALL); // Show all errors
ini_set('display_errors', 1); // Display errors

include('includes/dbconnection.php');

// $stid=intval($_GET['stid']);
if (isset($_POST['submit'])) {
    $rowid=$_POST['id'];
    $fullmarks = $_POST['fullmarks'];
    $passmarks = $_POST['passmarks'];
    $obtainedmarks = $_POST['obtainedmarks'];


    // Flag to check if any insert failed
    $insertFailed = false;

    // Loop through each subject and insert marks
    for ($i = 0; $i < count($obtainedmarks); $i++) {
        $obt_marks = $obtainedmarks[$i];
        $f_marks = $fullmarks[$i];
        $p_marks = $passmarks[$i];
        $sid = $sid1[$i];

        // Insert result into database
        $sql = "UPDATE stnresult 
        SET UpdationDate = NOW(), FullMarks = :fullmarks, PassMarks = :passmarks, ObtainedMarks = :obtainedmarks 
        WHERE id = :resultid";

        // $sql="update tblresult  set marks=:mrks where id=:iid ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fullmarks', $f_marks, PDO::PARAM_STR);
        $query->bindParam(':passmarks', $p_marks, PDO::PARAM_STR);
        $query->bindParam(':obtainedmarks', $obt_marks, PDO::PARAM_STR);
        
        if (!$query->execute()) {
            $insertFailed = true;
        }
    }

    // Set success or error message based on insert status
    if ($insertFailed) {
        $_SESSION['error'] = "Something went wrong. Please try again.";
    } else {
        $_SESSION['msg'] = "Result info added successfully.";
    }

    // Redirect to the same page to show message
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <title>Update Result</title>
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
                        <h1>Edit Result</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="N-admin.php">Dashboard</a></li>
                            <li><a href="manage-classes.php">Result</a></li>
                            <li class="active">Edit Result</li>
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
                            <div class="card-header"><strong>Result</strong><small> Detail</small></div>
                            <form method="post" action="">


                                <div class="card-body card-block">
                                <?php 

$ret = "SELECT stnstudents.StudentName, stnclasses.ClassName, stnclasses.Section from stnresult join stnstudents on stnresult.id=stnresult.StudentId join stnsubjects on stnsubjects.id=stnresult.SubjectId join stnclasses on stnclasses.id=stnstudents.ClassId where stnstudents.id=:stid limit 1";
$stmt = $dbh->prepare($ret);
$stmt->bindParam(':stid',$stid,PDO::PARAM_STR);
$stmt->execute();
$result=$stmt->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($stmt->rowCount() > 0)
{
foreach($result as $row)
{  ?>
                                    <div class="form-group">
                                        <label for="classname" class="form-control-label">Student Name</label>
                                        <input type="text" name="classname" value="<?php echo htmlentities($row->StudentName);?>" class="form-control" id="classname" onChange>
                                    </div>

                                    <div class="form-group">
                                        <label for="classnumeric" class="form-control-label">Class Name</label>
                                        <input type="text" name="classnumeric" value="<?php echo htmlentities($row->StudentName);?>" class="form-control" id="classnumeric" onChange>
                                    </div>
                                    <?php } }?>

                                    <?php 
$sql = "SELECT distinct stnstudents.StudentName, stnstudents.id, stnclasses.ClassName, stnclasses.Section, stnsubjects.SubjectName, stnresult.FullMarks, stnresult.PassMarks, stnresult.ObtainedMarks, stnresult.id as resultid from stnresult join stnstudents on stnstudents.id=stnresult.StudentId join stnsubjects on stnsubjects.id=stnresult.SubjectId join stnclasses on stnclasses.id=stnstudents.ClassId where stnstudents.id=:stid ";
$query = $dbh->prepare($sql);
$query->bindParam(':stid',$stid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>

                                    <div class="form-group">
                                        <label for="section" class="form-control-label">Section</label>
                                        <input type="hidden" name="subjectid[]" value="<?php echo htmlentities($row['id']); ?>" />
                                        <input type="text" name="fullmarks[]" value="<?php echo htmlentities($result->FullMarks)?>" placeholder="Enter Full Marks" class="form-control" required>
                                        <input type="text" name="passmarks[]" value="<?php echo htmlentities($result->PassMarks)?>" placeholder="Enter Pass Marks" class="form-control" required>
                                        <input type="text" name="obtainedmarks[]" value="<?php echo htmlentities($result->ObtainedMarks)?>" placeholder="Enter Obtained Marks" class="form-control" required>
                                    </div>

                                    <?php } }?>

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
