<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['trmsaid']) == 0) {
//     header('location:logout.php'); // Uncommented to redirect if session is not set
// } else {
    if (isset($_POST['submit'])) {
        $trmsaid = $_SESSION['trmsaid'];
        $StudentName = $_POST['fullname'];
        $RollId = $_POST['rollno'];
        $StudentEmail = $_POST['email'];
        $Gender = $_POST['gender'];
        $DOB = $_POST['dob'];
        $ClassId = $_POST['classname'];
        $FatherName = $_POST['fathername'];
        $RegNo = $_POST['regno'];
        $ExamYear = $_POST['examyear'];
        $ExaminationTerms = $_POST['exterms'];
        $status = 1;

        try {
            // SQL query for insertion
            $sql = "INSERT INTO stnstudents (RegDate, StudentName, RollId, StudentEmail, Gender, DOB, ClassId, FatherName, ExamYear, ExaminationTerms, RegNo, Status) 
                    VALUES (NOW(), :fullname, :rollno, :email, :gender, :dob, :classname, :fathername, :examyear, :exterms, :regno, :status)";
            
            $query = $dbh->prepare($sql);
            $query->bindParam(':fullname', $StudentName, PDO::PARAM_STR);
            $query->bindParam(':rollno', $RollId, PDO::PARAM_STR);
            $query->bindParam(':email', $StudentEmail, PDO::PARAM_STR);
            $query->bindParam(':gender', $Gender, PDO::PARAM_STR);
            $query->bindParam(':dob', $DOB, PDO::PARAM_STR);
            $query->bindParam(':classname', $ClassId, PDO::PARAM_STR);
            $query->bindParam(':fathername', $FatherName, PDO::PARAM_STR);
            $query->bindParam(':examyear', $ExamYear, PDO::PARAM_STR);
            $query->bindParam(':regno', $RegNo, PDO::PARAM_STR);
            $query->bindParam(':exterms', $ExaminationTerms, PDO::PARAM_STR);
            $query->bindParam(':status', $status, PDO::PARAM_STR);

            $query->execute();

            $LastInsertId = $dbh->lastInsertId();
            if ($LastInsertId > 0) {
                echo '<script>alert("Student has been added.")</script>';
                echo "<script>window.location.href ='add-student.php'</script>";
            } else {
                echo '<script>alert("Something went wrong. Please try again.")</script>';
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage(); // Proper error reporting
        }
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Add Student Details</title>
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
    <?php include_once('includes/sidebar.php');?>

    <div id="right-panel" class="right-panel">
        <?php include_once('includes/header.php');?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Student Details</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="add-student.php">Add Student</a></li>
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
                            <div class="card-header"><strong>Student</strong> <small>Details</small></div>
                            <form method="post" action="">
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label for="fullname" class="form-control-label">Full Name</label>
                                        <input type="text" name="fullname" placeholder="Enter Student Name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fathername" class="form-control-label">Father's Name</label>
                                        <input type="text" name="fathername" placeholder="Enter Father's Name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="rollno" class="form-control-label">Roll No.</label>
                                        <input type="text" name="rollno" placeholder="Enter Roll No." class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email</label>
                                        <input type="email" name="email" placeholder="Enter Email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender" class="form-control-label">Gender</label>
                                        <input type="radio" name="gender" value="Male" required> Male
                                        <input type="radio" name="gender" value="Female" required> Female
                                        <input type="radio" name="gender" value="Other" required> Other
                                    </div>
                                    <div class="form-group">
                                        <label for="classname" class="form-control-label">Class</label>
                                        <select name="classname" id="classname" class="form-control" required>
                                            <option value="">Select Class</option>
                                            <?php
                                            $sql = "SELECT * FROM stnclasses";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {
                                            ?>
                                            <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName . ' Section-' . $result->Section); ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="dob" class="form-control-label">Date of Birth</label>
                                        <input type="text" id="dob" name="dob" placeholder="YYYY-MM-DD" pattern="\d{4}-\d{2}-\d{2}" class="form-control" required>
                                        <small id="dobError" style="color:red; display:none;">Please enter a valid date in YYYY-MM-DD format.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="regno" class="form-control-label">Registration No.</label>
                                        <input type="text" name="regno" placeholder="eg. 2480" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="examyear" class="form-control-label">Exam Year</label>
                                        <input type="text" name="examyear" placeholder="Enter Exam Year (YYYY)" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exterms" class="form-control-label">Examination Terms</label>
                                        <input type="text" name="exterms" placeholder="1st Term, 2nd Term" class="form-control" required>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="submit" class="btn btn-primary">Add Student</button>
                                    </div>
                                </div>
                            </form>

                            <script>
                            document.querySelector('form').addEventListener('submit', function (e) {
                                var dob = document.getElementById('dob').value;
                                var dobPattern = /^\d{4}-\d{2}-\d{2}$/;

                                if (!dobPattern.test(dob)) {
                                    e.preventDefault();
                                    document.getElementById('dobError').style.display = 'block';
                                } else {
                                    document.getElementById('dobError').style.display = 'none';
                                }
                            });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>
