<?php session_start();
//error_reporting(0);
include('../includes/dbconnection.php');
//Add Teacher Details  
if(isset($_POST['submit']))
{
$eid=$_GET['tid'];
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
$sql="update admission set s_name=:fullName,f_name=:fatherName,m_name=:motherName,s_gender=:gender,s_dob=:dob,address=:address,e_mail=:email,mobile_number=:mobile,s_nationality=:nationality,s_class=:class where id=:eid";
$query = $dbh->prepare($sql);
$query->bindParam(':fullName',$s_name,PDO::PARAM_STR);
$query->bindParam(':fatherName',$f_name,PDO::PARAM_STR);
$query->bindParam(':motherName',$m_name,PDO::PARAM_STR);
$query->bindParam(':gender',$s_gender,PDO::PARAM_STR);
$query->bindParam(':dob',$s_dob,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':email',$e_mail,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile_number,PDO::PARAM_STR);
$query->bindParam(':nationality',$s_nationality,PDO::PARAM_STR);
$query->bindParam(':class',$s_class,PDO::PARAM_STR);
$query->execute();
echo '<script>alert("Your profile succesfull updated.")</script>';
echo "<script>window.location.href='dashboard.php'</script>";

  }
  ?>

<!doctype html>
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

    <?php include_once('../includes/sidebar.php');?>

    <div id="right-panel" class="right-panel">


        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Update Student Detail</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="manage-teacher.php">Update Student</a></li>
                            <li class="active">Update</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                  
                    <!--/.col-->

                    <div class="col-lg-6" style="float-left:left !important">
                        <div class="card">
                            <div class="card-header"><strong>Student</strong><small> Personal Details</small></div>
                            <form name="" method="post" action="" enctype="multipart/form-data">
                                
                            <div class="card-body card-block">
 <?php
$eid=$_GET['tid'];
$sql="SELECT * from  admission where id=$eid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
<div class="form-group">
<label for="company" class=" form-control-label">Student Name</label>
<input type="text" name="tname" value="<?php  echo $row->s_name;?>" class="form-control" id="tname" required="true">
</div>

<div class="form-group">
<label for="company" class=" form-control-label">Student Pic</label> &nbsp;
<?php if($row->s_photo==''):?>
<img src="images/no-image.png" width="150" height="150"  alt="NO Image">
<?php else: ?>    
<img src="../teacher/images/<?php echo $row->s_photo;?>" width="150" height="150" value="<?php  echo $row->s_photo;?>">
<?php endif;?>
<a href="changeimage.php?tid=<?php echo $row->ID;?>"> &nbsp; Edit Image</a>
</div>

<div class="form-group">
<label for="street" class=" form-control-label">Teacher Email ID</label>
<input type="text" name="email" value="<?php  echo $row->Email;?>" id="email" class="form-control" required="true">
</div>



<div class="row form-group">
<div class="col-12">
<div class="form-group"><label for="city" class=" form-control-label">Teacher Mobile Number</label><input type="text" name="mobilenumber" id="mobilenumber" value="<?php  echo $row->MobileNumber;?>" class="form-control" required="true" maxlength="10" pattern="[0-9]+"></div>
</div>
</div>


<div class="row form-group">
<div class="col-12">
<div class="form-group"><label for="city" class=" form-control-label">Teacher Address</label><textarea type="text" name="address" id="address" class="form-control" rows="3" cols="12" required="true"><?php  echo $row->Address;?></textarea></div>
</div>
</div>



<div class="row form-group">
<div class="col-12">
<div class="form-group"><label for="city" class=" form-control-label">Joining Date</label><input type="date" name="joiningdate" id="joiningdate" value="<?php  echo $row->JoiningDate;?>" class="form-control" required="true"></div>
</div>
</div>
</div>
                                                     
                                                </div>
                                     
                                            </div>
<!---------------------------------------------------------------------------------------------------->
          <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Teacher</strong><small> Professional Details</small></div>
                            <form name="" method="post" action="" enctype="multipart/form-data">
                                
                            <div class="card-body card-block">

<div class="row form-group">
<div class="col-12">
<div class="form-group">
<label for="city" class=" form-control-label">Teacher Qualifications(Sepereted by comma)</label>
<input type="text" name="qualifications" id="qualifications" value="<?php  echo $row->Qualifications;?>" class="form-control" required="true">
</div>
</div>
</div>

<div class="row form-group">
<div class="col-12">
<div class="form-group">
<label for="city" class=" form-control-label">Teaching Experience (in Years)</label>
<input type="text" name="teachingexp" id="teachingexp" pattern="[0-9]+" title="only numbers"  value="<?php  echo $row->teachingExp;?>" class="form-control" required="true">
</div>
</div>
</div>


<div class="row form-group">
<div class="col-12">
<div class="form-group"><label for="city" class=" form-control-label">Teacher Subjects</label><select type="text" name="tsubjects" id="tsubjects" value="" class="form-control" required="true">
<option value="<?php  echo $row->TeacherSub;?>"><?php  echo $row->TeacherSub;?></option>
<?php 
$sql2 = "SELECT * from   tblsubjects ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);
foreach($result2 as $row1)
{          
?>  
<option value="<?php echo htmlentities($row1->Subject);?>"><?php echo htmlentities($row1->Subject);?></option>
 <?php } ?> 
</select></div>
</div>
 </div>

<div class="row form-group">
<div class="col-12">
<div class="form-group"><label for="city" class=" form-control-label">Description (if Any)</label><textarea type="text" name="description" id="description" class="form-control" rows="3" cols="12" required="true"><?php  echo $row->description;?></textarea></div>
</div>
</div>

<div class="row form-group">
<div class="col-12">
<div class="form-group"><label for="city" class=" form-control-label">Profile Status <small style="color:red">(Public profile anybody can your details and not public only you can view)</small></label>
    <select type="text" name="status" id="status" value="" class="form-control" required="true">
         <?php if($row->isPublic=='1'):?>  
<option value="1">Public</option>
<option value="0">Not public</option>
<?php else: ?>
<option value="0">Not public</option>
<option value="1">Public</option>
<?php endif;?>
</select></div>
</div>
 </div>

</div>
<?php $cnt=$cnt+1;}} ?>

<p style="text-align: center;"><button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit"><i class="fa fa-dot-circle-o"></i> Update</button></p> 
                                                     
                                                </div>
                                                </form>
                                            </div>

                                           
                                            </div>
                                        </div><!-- .animated -->
                                    </div><!-- .content -->
                                </div><!-- /#right-panel -->
                                <!-- Right Panel -->


                            <script src="../../vendors/jquery/dist/jquery.min.js"></script>
                            <script src="../../vendors/popper.js/dist/umd/popper.min.js"></script>

                            <script src="../../vendors/jquery-validation/dist/jquery.validate.min.js"></script>
                            <script src="../../vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>

                            <script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
                            <script src="../../assets/js/main.js"></script>
</body>
</html>
