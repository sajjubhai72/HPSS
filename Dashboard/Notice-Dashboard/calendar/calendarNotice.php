<?php
// Include the database connection
include '../../../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $main_title = $_POST['maintitle'];
    $title = $_POST['title'];

    $targetDir = "calendar-notice/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    // Move the uploaded file to the desired directory
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        // Insert data into notice table
        $sql = "INSERT INTO calendar (main_title, title, file) VALUES ( '$main_title', '$title', '$targetFilePath')";

        if (mysqli_query($conn, $sql)) {
            echo '<script>
                alert("Exam Notice Uploaded successfully!");
            </script>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "File upload failed.";
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
   
    <title>Exam Notice Form</title>
    <link rel="shortcut icon" href="../../../image/hpsslogo.jpg" type="image/x-icon">

    <link rel="apple-touch-icon" href="apple-icon.png">


    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../Notice.css" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>



</head>

<body>
    <!-- Left Panel -->

    <?php include_once('includes/sidebar.php');?>

    <div id="right-panel" class="right-panel">
    <?php include_once('includes/header.php');?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Exam Notice</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="../N-admin.php">Dashboard</a></li>
                            <li><a href="add-subjects.php">Exam Notice</a></li>
                            <li class="active">Add</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-6">
                       <!-- .card -->

                    </div>
                    <!--/.col-->

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>Notice </strong><small> Details</small></div>
                            <form action="" method="post" class="notice-form" enctype="multipart/form-data">
    <h1>Create Notice</h1>
    <div class="field">
        <label for="maintitle">Main Title</label>
        <input type="text" name="maintitle" id="maintitle">
    </div>
    <div class="field">
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
    </div>
    <div class="field">
        <label for="file">Upload File</label>
        <input type="file" name="file" id="file">
    </div>
    <input type="submit" value="Submit" class="btn">
</form>
                        </div>



                                           
                    </div>
                </div><!-- .animated -->
            </div><!-- .content -->
        </div><!-- /#right-panel -->
                                <!-- Right Panel -->


    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="../vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>
