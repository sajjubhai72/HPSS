<?php
session_start();
error_reporting(E_ALL);
include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $eid = $_GET['editid'];
    $StudentName = $_POST['fullname'];
    $RollId = $_POST['rollno'];
    $StudentEmail = $_POST['email'];
    $Gender = $_POST['gender'];
    $DOB = $_POST['dob'];
    $FatherName = $_POST['fathername'];
    $ExamYear = $_POST['examyear'];
    $ExaminationTerms = $_POST['exterms'];
    $status = 1;

    $sql = "UPDATE stnstudents SET 
            StudentName=:fullname, 
            RollId=:rollno, 
            StudentEmail=:email, 
            Gender=:gender, 
            DOB=:dob, 
            FatherName=:fathername, 
            ExamYear=:examyear, 
            ExaminationTerms=:exterms, 
            Status=:status 
            WHERE ID = :eid";

    $query = $dbh->prepare($sql);
    $query->bindParam(':fullname', $StudentName, PDO::PARAM_STR);
    $query->bindParam(':rollno', $RollId, PDO::PARAM_STR);
    $query->bindParam(':email', $StudentEmail, PDO::PARAM_STR);
    $query->bindParam(':gender', $Gender, PDO::PARAM_STR);
    $query->bindParam(':dob', $DOB, PDO::PARAM_STR);
    $query->bindParam(':fathername', $FatherName, PDO::PARAM_STR);
    $query->bindParam(':examyear', $ExamYear, PDO::PARAM_STR);
    $query->bindParam(':exterms', $ExaminationTerms, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_INT);
    $query->bindParam(':eid', $eid, PDO::PARAM_INT);

    if ($query->execute()) {
        echo '<script>alert("Student details have been updated")</script>';
        echo '<script>window.location.href ="manage-student.php"</script>';
    } else {
        echo '<script>alert("Something went wrong. Please try again.")</script>';
    }
}

?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <title>Edit Student Details</title>
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
                            <li><a href="manage-classes.php">Student</a></li>
                            <li class="active">Edit Student Details</li>
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
                            <div class="card-header"><strong>Student</strong><small> Detail</small></div>
                            <form method="post" action="">
                                <div class="card-body card-block">
                                <?php
                                    $eid = $_GET['editid'];

                                    $sql = "SELECT stnstudents.StudentName, stnstudents.RollId, stnstudents.StudentEmail, stnstudents.Gender, stnclasses.ClassName, stnstudents.DOB, stnstudents.FatherName, stnstudents.ExamYear, stnstudents.ExaminationTerms, stnstudents.id, stnstudents.Status, stnclasses.Section from stnstudents join stnclasses on stnclasses.id=stnstudents.ClassId where stnstudents.id=:eid";
                                    
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':eid', $eid, PDO::PARAM_INT);
                                    $query->execute();
                                    $result = $query->fetch(PDO::FETCH_ASSOC);
                                    
                                    if($result) {
                                ?>
                                    <div class="form-group">
                                        <label for="fullname" class="form-control-label">Full Name</label>
                                        <input type="text" name="fullname" value="<?php echo htmlspecialchars($result['StudentName']); ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fathername" class="form-control-label">Father's Name</label>
                                        <input type="text" name="fathername" value="<?php echo htmlspecialchars($result['FatherName']); ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="rollno" class="form-control-label">Roll No.</label>
                                        <input type="text" name="rollno" value="<?php echo htmlspecialchars($result['RollId']); ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email</label>
                                        <input type="email" name="email" value="<?php echo htmlspecialchars($result['StudentEmail']); ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender" class="form-control-label">Gender</label>
                                        <input type="radio" name="gender" value="Male" <?php echo ($result['Gender'] == 'Male') ? 'checked' : ''; ?> required> Male
                                        <input type="radio" name="gender" value="Female" <?php echo ($result['Gender'] == 'Female') ? 'checked' : ''; ?> required> Female
                                        <input type="radio" name="gender" value="Other" <?php echo ($result['Gender'] == 'Other') ? 'checked' : ''; ?> required> Other
                                    </div>
                                    <div class="form-group">
                                        <label for="classname" class="form-control-label">Class</label>
                                        <input type="text" name="classname" value="<?php echo htmlspecialchars($result['ClassName'] . ' Section-' . $result['Section']); ?>" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="dob" class="form-control-label">Date of Birth</label>
                                        <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($result['DOB']); ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="examyear" class="form-control-label">Exam Year</label>
                                        <input type="text" name="examyear" value="<?php echo htmlspecialchars($result['ExamYear']); ?>"  class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exterms" class="form-control-label">Examination Terms</label>
                                        <input type="text" name="exterms" value="<?php echo htmlspecialchars($result['ExaminationTerms']); ?>"  class="form-control" required>
                                    </div>
                                    
                                    <p style="text-align: center;">
                                        <button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit">
                                            <i class="fa fa-dot-circle-o"></i> Update
                                        </button>
                                    </p>
                                    <?php } else { echo "No student found."; } ?>  
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