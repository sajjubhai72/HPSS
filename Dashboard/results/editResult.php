<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('includes/dbconnection.php');

// Check if editid is set in the URL
if(isset($_GET['editid'])) {
    $editid = intval($_GET['editid']);
} else {
    // Redirect to manage-result.php if editid is not set
    header("Location: manage-result.php");
    exit();
}

if (isset($_POST['submit'])) {
    $fullmarks = $_POST['fullmarks'];
    $passmarks = $_POST['passmarks'];
    $pracmarks = $_POST['pracmarks'];
    $obtainedmarks = $_POST['obtainedmarks'];
    $resultids = $_POST['resultid'];

    // Flag to check if any update failed
    $updateFailed = false;

    // Loop through each subject and update marks
    for ($i = 0; $i < count($obtainedmarks); $i++) {
        $obt_marks = $obtainedmarks[$i];
        $f_marks = $fullmarks[$i];
        $pt_marks = $pracmarks[$i];
        $p_marks = $passmarks[$i];
        $resultid = $resultids[$i];

        // Update result in database
        $sql = "UPDATE stnresult 
                SET UpdationDate = NOW(), FullMarks = :fullmarks, PassMarks = :passmarks, PracticalMarks=:pracmarks, ObtainedMarks = :obtainedmarks 
                WHERE id = :resultid";

        $query = $dbh->prepare($sql);
        $query->bindParam(':fullmarks', $f_marks, PDO::PARAM_STR);
        $query->bindParam(':passmarks', $p_marks, PDO::PARAM_STR);
        $query->bindParam(':pracmarks', $pt_marks, PDO::PARAM_STR);
        $query->bindParam(':obtainedmarks', $obt_marks, PDO::PARAM_STR);
        $query->bindParam(':resultid', $resultid, PDO::PARAM_INT);
        
        if (!$query->execute()) {
            $updateFailed = true;
            break;
        }
    }

    // Set success or error message based on update status
    if ($updateFailed) {
        $_SESSION['error'] = "Something went wrong. Please try again.";
    } else {
        $_SESSION['msg'] = "Result info updated successfully.";
    }

    // Redirect to the same page to show message
    header("Location: editResult.php?editid=" . $editid);
    exit();
}

// Fetch student details
$stmt = $dbh->prepare("SELECT stnstudents.StudentName, stnclasses.ClassName, stnclasses.Section 
                       FROM stnstudents 
                       JOIN stnclasses ON stnclasses.id = stnstudents.ClassId 
                       WHERE stnstudents.id = :editid");
$stmt->bindParam(':editid', $editid, PDO::PARAM_INT);
$stmt->execute();
$studentInfo = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch result details
$query = $dbh->prepare("SELECT stnresult.id as resultid, stnsubjects.SubjectName, stnresult.FullMarks, stnresult.PassMarks, stnresult.PracticalMarks, stnresult.ObtainedMarks
                        FROM stnresult 
                        JOIN stnsubjects ON stnsubjects.id = stnresult.SubjectId 
                        WHERE stnresult.StudentId = :editid");
$query->bindParam(':editid', $editid, PDO::PARAM_INT);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_ASSOC);
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
                        <div class="card-header"><strong>Edit Result</strong></div>
                        <div class="card-body card-block">
                            <?php
                            if(isset($_SESSION['error'])) {
                                echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
                                unset($_SESSION['error']);
                            }
                            if(isset($_SESSION['msg'])) {
                                echo "<div class='alert alert-success'>" . $_SESSION['msg'] . "</div>";
                                unset($_SESSION['msg']);
                            }
                            ?>
                            <form method="post" action="">
                                <div class="form-group">
                                    <label><strong>Student Name:</strong> <?php echo htmlspecialchars($studentInfo['StudentName']); ?></label>
                                </div>
                                <div class="form-group">
                                    <label><strong>Class:</strong> <?php echo htmlspecialchars($studentInfo['ClassName']); ?> (<?php echo htmlspecialchars($studentInfo['Section']); ?>)</label>
                                </div>

                                <?php foreach ($results as $result): ?>
    <div class="form-group">
        <label><strong><?php echo htmlspecialchars($result['SubjectName']); ?></strong></label>
        <input type="hidden" name="resultid[]" value="<?php echo $result['resultid']; ?>"><br>
        Full Marks: <input type="text" name="fullmarks[]" value="<?php echo htmlspecialchars($result['FullMarks']); ?>" class="form-control" required><br>
        Pass Marks: <input type="text" name="passmarks[]" value="<?php echo htmlspecialchars($result['PassMarks']); ?>" class="form-control" required><br>
        Practical Marks: <input type="text" name="pracmarks[]" value="<?php echo htmlspecialchars($result['PracticalMarks']); ?>" class="form-control" required><br>
        Obtained Marks: <input type="text" name="obtainedmarks[]" value="<?php echo htmlspecialchars($result['ObtainedMarks']); ?>" class="form-control" required><br>
    </div>
<?php endforeach; ?>


                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary">Update Result</button>
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