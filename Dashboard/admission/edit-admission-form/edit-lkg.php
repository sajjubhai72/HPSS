<?php
include '../../../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // File upload directory
    $targetDir = "../admission-data-upload/";

    // Handle file uploads
    $photoPath = handleFileUpload($_FILES["photo"], $targetDir);

    // Handle other form data
    $s_name = $_POST['fullName'];
    $f_name = $_POST['fatherName'];
    $m_name = $_POST['motherName'];
    $s_gender = $_POST['gender'];
    $s_dob = $_POST['dob'];
    $address = $_POST['address'];
    $e_mail = $_POST['email'];
    $mobile_number = $_POST['mobile'];
    $s_nationality = $_POST['nationality'];
    $s_class = $_POST['class'];
    $a_fee = $_POST['fee'];

    // Insert data into student_admission table using prepared statements
    $sql = "INSERT INTO admission (s_name, f_name, m_name, s_gender, s_dob, address, e_mail, mobile_number, s_nationality, s_class, a_fee, s_photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssssssssss", $s_name, $f_name, $m_name, $s_gender, $s_dob, $address, $e_mail, $mobile_number, $s_nationality, $s_class, $a_fee, $photoPath);
    
    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Student admission form submitted successfully!");</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

function handleFileUpload($file, $targetDir) {
    if ($file["error"] === UPLOAD_ERR_NO_FILE) {
        return "No file was uploaded.";
    } elseif ($file["error"] !== UPLOAD_ERR_OK) {
        return "File upload failed with error code: " . $file["error"];
    }

    // Proceed with file upload
    $fileName = basename($file["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check file size, type, etc., and move it to the destination directory
    // Implement your file validation logic here

    if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
        return $targetFilePath;
    } else {
        return "File upload failed. Please check your server configuration.";
    }
}

?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <title>Student Profile</title>
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="stylesheet" href="../../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../../vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="../../assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
    <!-- Left Panel -->
    <?php include_once('../includes/sidebar.php'); ?>
    <div id="right-panel" class="right-panel">
        <div class="breadcrumbs">
            <!-- Include breadcrumb navigation here -->
        </div>
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <!-- Form content here -->
                    <div class="col-lg-6" style="float-left:left !important">
                        <div class="card">
                            <div class="card-header"><strong>Student</strong><small> Personal Details</small></div>
                            <form name="" method="post" action="" enctype="multipart/form-data">
                                <div class="card-body card-block">
                                    <?php
                                    if(isset($_GET['id'])) {
                                        $eid=$_GET['id'];
                                        $sql="SELECT * from  admission where id=$eid";
                                        $query = $conn -> prepare($sql);
                                        $query->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt=1;
                                        if($query->rowCount() > 0) {
                                            foreach($results as $row) {
                                    ?>
                                    <!-- Your form fields here -->
                                    <div class="form-group">
                    <label for="fullName" class=" form-control-label">Student Full Name:</label>
                    <input type="text" name="fullName" value="<?php  echo $row->s_name;?>" class="form-control" id="fullName" required="true">
                  </div>
                                    <?php
                                            }
                                        }
                                    } else {
                                        echo "No ID parameter found.";
                                    }
                                    ?>
                                    <!-- Submit button -->
                                    <p style="text-align: center;"><button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit"><i class="fa fa-dot-circle-o"></i> Update</button></p>
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
</html
