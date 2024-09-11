<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if ($_GET['delid']) {
    $tid = $_GET['delid'];
    $query = $dbh->prepare("delete from admission where ID=:tid");
    $query->bindParam(':tid', $tid, PDO::PARAM_STR);
    $query->execute();
    echo '<script>alert("Record deleted")</script>';
    echo "<script>window.location.href ='manage-admission.php'</script>";
}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Manage Admission</title>
    <link rel="shortcut icon" href="../../image/hpsslogo.jpg" type="image/x-icon">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <!-- Left Panel -->
    <?php include_once('includes/sidebar.php'); ?>
    <div id="right-panel" class="right-panel">
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>UKG Class</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="A-admin.php">Dashboard</a></li>
                            <li><a href="manage-admission.php">Admission Classes</a></li>
                            <li class="active">UKG Class</li>
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
                            <div class="card-header">
                                <strong class="card-title">Manage Admission</strong>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="display responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Student Photo</th>
                                            <th>Student Name</th>
                                            <th>Father's Name</th>
                                            <th>Mother's Name</th>
                                            <th>Gender</th>
                                            <th>DOB</th>
                                            <th>Address</th>
                                            <th>E-Mail</th>
                                            <th>Mobile Number</th>
                                            <th>Nationality</th>
                                            <th>Class</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $sql = "SELECT * FROM admission WHERE s_class = 'ukg'";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) {
                                    ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><img src="http://localhost/HPSS/<?php echo htmlentities($row->s_photo); ?>" alt="Student Photo" style="width: 50px; height: 50px;"></td>
                                                <td><?php echo htmlentities($row->s_name); ?></td>
                                                <td><?php echo htmlentities($row->f_name); ?></td>
                                                <td><?php echo htmlentities($row->m_name); ?></td>
                                                <td><?php echo htmlentities($row->s_gender); ?></td>
                                                <td><?php echo htmlentities($row->s_dob); ?></td>
                                                <td><?php echo htmlentities($row->address); ?></td>
                                                <td><?php echo htmlentities($row->e_mail); ?></td>
                                                <td><?php echo htmlentities($row->mobile_number); ?></td>
                                                <td><?php echo htmlentities($row->s_nationality); ?></td>
                                                <td><?php echo htmlentities($row->s_class); ?></td>
                                                <td><a href="ukg.php?delid=<?php echo htmlentities($row->id); ?>" class="btn btn-danger" onclick="return confirm('Do you really want to delete?');">Delete</a>
                                                </td>
                                            </tr>
                                    <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->
    <!-- Right Panel -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
</body>

</html>
