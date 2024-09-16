<?php
session_start();
error_reporting(E_ALL); // Show all errors
ini_set('display_errors', 1); // Display errors

include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $class = $_POST['classname'];  // Changed to classname as per form field
    $studentid = $_POST['studentid']; 
    $fullmarks = $_POST['fullmarks'];
    $passmarks = $_POST['passmarks'];
    $pracmarks = $_POST['pracmarks'];
    $obtainedmarks = $_POST['obtainedmarks'];

    // Fetch subjects for the selected class
    $stmt = $dbh->prepare("SELECT stnsubjects.SubjectName, stnsubjects.id FROM stnsubjectcombination 
                            JOIN stnsubjects ON stnsubjects.id = stnsubjectcombination.SubjectId 
                            WHERE stnsubjectcombination.ClassId = :cid ORDER BY stnsubjects.SubjectName");
    $stmt->execute(array(':cid' => $class));
    
    $sid1 = array(); // Subject IDs
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($sid1, $row['id']);
    }

    // Flag to check if any insert failed
    $insertFailed = false;

    // Loop through each subject and insert marks
    for ($i = 0; $i < count($obtainedmarks); $i++) {
        $obt_marks = $obtainedmarks[$i];
        $f_marks = $fullmarks[$i];
        $pt_marks = $pracmarks[$i];
        $p_marks = $passmarks[$i];
        $sid = $sid1[$i];
    
        // Insert result into database
        $sql = "INSERT INTO stnresult (PostingDate, StudentId, ClassId, SubjectId, FullMarks, PassMarks, PracticalMarks, ObtainedMarks) 
                VALUES (NOW(), :studentid, :class, :sid, :fullmarks, :passmarks, :pracmarks, :obtainedmarks)";
    
        $query = $dbh->prepare($sql);
        $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
        $query->bindParam(':class', $class, PDO::PARAM_STR);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->bindParam(':fullmarks', $f_marks, PDO::PARAM_STR);
        $query->bindParam(':passmarks', $p_marks, PDO::PARAM_STR);
        $query->bindParam(':pracmarks', $pt_marks, PDO::PARAM_STR);
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

<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Add Results Details</title>
    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../../image/hpsslogo.jpg" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script>
        function getStudent(val) {
            $.ajax({
                type: "POST",
                url: "get_student.php",
                data: 'classid=' + val,
                success: function(data){
                    $("#studentid").html(data);
                }
            });
            $.ajax({
                type: "POST",
                url: "get_student.php",
                data: 'classid1=' + val,
                success: function(data){
                    $("#subject").html(data);
                }
            });
        }
    </script>
    <script>
        function getresult(val, clid){      
            var clid = $(".clid").val();
            var val = $(".stid").val();
            var abh = clid + '$' + val;
            $.ajax({
                type: "POST",
                url: "get_student.php",
                data: 'studclass=' + abh,
                success: function(data){
                    $("#reslt").html(data);
                }
            });
        }
    </script>
</head>

<body>
    <?php include_once('includes/sidebar.php');?>

    <div id="right-panel" class="right-panel">
        <?php include_once('includes/header.php');?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Result Details</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="add-student.php">Add Result</a></li>
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
                            <form name="" method="post" action="">
                                <!-- Display success and error messages -->
                            <?php if (isset($_SESSION['msg'])) { ?>
                                <div class="alert alert-success">
                                    <?php echo htmlentities($_SESSION['msg']); unset($_SESSION['msg']); ?>
                                </div>
                            <?php } ?>
                            
                            <?php if (isset($_SESSION['error'])) { ?>
                                <div class="alert alert-danger">
                                    <?php echo htmlentities($_SESSION['error']); unset($_SESSION['error']); ?>
                                </div>
                            <?php } ?>
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label for="classname" class="form-control-label"><strong>Class Name</strong></label>
                                        <select name="classname" id="classname" class="form-control" onChange="getStudent(this.value)">
                                            <option value="">Select Class</option>
                                            <?php 
                                            $sql = "SELECT * from stnclasses";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            if($query->rowCount() > 0) {
                                                foreach($results as $result) { ?> 
                                                <option value="<?php echo htmlentities($result->id); ?>">
                                                    <?php echo htmlentities($result->ClassName); ?> Section-<?php echo htmlentities($result->Section); ?>
                                                </option>
                                            <?php }} ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="studentid" class="form-control-label"><strong>Student Name</strong></label>
                                        <select name="studentid" class="form-control stid" id="studentid" required onChange="getresult(this.value);"></select>
                                    </div>

                                    <div class="form-group">
                                        <div id="reslt"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="subject" class="form-control-label"><strong>Subjects</strong></label>
                                        <div id="subject"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Declare Result</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
