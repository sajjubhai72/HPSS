<?php include_once('includes/dbconnection.php');


//Coding For query
if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$emailid=$_POST['emailid'];
$mobileno=$_POST['mobileno'];
$querymsg=$_POST['query'];
$teacherid=$_GET['tid'];
$sql="insert into tblquery(teacherId,fName,emailId,mobileNumber,Query)values(:teacherid,:fname,:emailid,:mobileno,:querymsg)";
$query=$dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':emailid',$emailid,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':querymsg',$querymsg,PDO::PARAM_STR);
$query->bindParam(':teacherid',$teacherid,PDO::PARAM_STR);
$query->execute();
$LastInsertId=$dbh->lastInsertId();
if ($LastInsertId>0) {
echo '<script>alert("Message Sent Successfully.")</script>';
echo "<script>window.location.href ='index.php'</script>";
}else{
    echo '<script>alert("Something Went Wrong. Please try again")</script>';
   }}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Teachers Details</title>
        <!-- Favicon-->
        <link rel="shortcut icon" href="../../image/hpsslogo.jpg" type="image/x-icon">
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="../../style.css" rel="stylesheet">
    </head>
    <body class="d-flex flex-column h-100">
    <div class="top_header">
         <div class="row">
            <div class="col-lg-12 text-start">2024 August 28, Wednesday<span id="nepali_date"></span>
            </div>
         </div>
      </div>
      <div class="header">
         <div class="row">
            <div class="col-lg-3 text-end"><img src="../../image/hpsslogo.jpg" class="img-responsive" title="HPSS logo" width="60px"></div>
               <div class="col-lg-6">
                  <h4>Hilal Public Sec. School</h4>
                  <h3>Office of the Controller of Examinations</h3>
                  <h5>Harinagar-7, Sunsari</h5>
               </div>
               <div class="col-lg-3 text-end"></div>
            </div>
         </div>
        <main class="flex-shrink-0">
            
            <!-- Page Content-->

<?php
$tid=intval($_GET['tid']);
$sql="SELECT * from tblteacher where isPublic='1' and ID='$tid'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?> 
            <section class="py-5">
                <div class="container px-5 my-5">
                    <div class="text-center mb-5">
                        <h1 class="fw-bolder"><?php  echo htmlentities($row->Name);?>'s Details</h1>
                        <p class="lead fw-normal text-muted mb-0">Registered Since <?php  echo htmlentities($row->RegDate);?></p>
                    </div>
                    <div class="row gx-5">
                        <div class="col-xl-8">
                            <!-- FAQ Accordion 1-->
                     <!--        <h2 class="fw-bolder mb-3">Persoanl Details </h2> -->
                            <div class="accordion mb-5" id="accordionExample">
                                <div class="accordion-item">
                                    <h3 class="accordion-header" id="headingOne"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Personal Details</button></h3>
                                    <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
              <table style="text-align: center;" class="table table-bordered">
                  
                    <tr>
                      
                      <td colspan="2"><img src="teacher/images/<?php  echo htmlentities($row->Picture);?>" width="200"></td>
                      
                  </tr>
                  <tr>
                      <th>Teacher Name</th>
                      <td><?php  echo htmlentities($row->Name);?></td>
                  </tr>

                  <tr>
                      <th>Teacher Email ID</th>
                      <td><?php  echo htmlentities($row->Email);?></td>
                  </tr>

                  <tr>
                      <th>Teacher Mobile Number</th>
                      <td><?php  echo htmlentities($row->MobileNumber);?></td>
                  </tr>
                  <tr>
                      <th>Teacher Address</th>
                      <td><?php  echo htmlentities($row->Address);?></td>
                  </tr>
                  <tr>
                      <th>Registered Since</th>
                      <td><?php  echo htmlentities($row->RegDate);?></td>
                  </tr>
              </table>
                                        </div>
                                    </div>
                                </div>
                    
                     
                            </div>
                            <!-- FAQ Accordion 2-->
                           
                        <div class="col-xl-4">
                            <div class="card border-0 bg-light mt-xl-5">
                                <div class="card-body p-4 py-lg-5">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="text-center">
                                            <div class="h6 fw-bolder">Have more questions?</div>
                                            <p class="text-muted mb-4">
                                                Contact me at
                                                <br />
                                                <a href="#!"><?php  echo htmlentities($row->Email);?></a>
                                            </p>
                                            <h5>OR</h5>
<form method="post">
 <p>  <input type="text" name="fname" placeholder="Enter your fullname" class="form-control" required></p>
<p><input type="email" name="emailid" placeholder="Enter your emaild" class="form-control" required></p>
<p><input type="text" name="mobileno" placeholder="Enter your mobile no" class="form-control" pattern="[0-9]{10}" title="10 numeric characters only" required></p>
<p><textarea class="form-control" name="query" placeholder="Query / Message" required></textarea>
</p>
<input type="submit" class="btn btn-primary" name="submit">
</form>

                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } } else{ ?>
<hr />
<h3 align="center" style="color:red;">Record not Found</h3>
        <?php } ?>
        </main>
        <footer>
            <div class="row" style="width: 100%;">
               <div class="col-lg-5 col-sm-8 first" style="padding: 0 40px;">
                   <p style="text-align:left;">Copyright: <a href="#">HPSS@2024</a></p>
               </div>

               <div class="col-lg-2 col-sm-12 second">
                  <!-- <p style="text-align:center;"><a href="#" style="margin-left:20px;font-weight: bold;">User Login</a></p> -->
               </div>

               <div class="col-lg-5 col-sm-8 third">
                  <p style="text-align:right;">Contact No.: 9807071324 &nbsp;&nbsp;<a href="#" >eMail: </a> </p>
               </div>
            </div>
         </footer>
      </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.4.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script>
            //nepali date
      currMonth = NepaliFunctions.GetCurrentBsMonth();
      currDay = NepaliFunctions.GetCurrentBsDay();
      currYear = NepaliFunctions.GetCurrentBsYear();
      
      day = NepaliFunctions.GetBsFullDayInUnicode({year: currYear, month: currMonth, day: currDay});
      currentDate = NepaliFunctions.GetBsFullDate({year: currYear, month: currMonth, day: currDay}, true);

      full_date = day + ', ' + currentDate;
      document.getElementById("nepali_date").innerHTML = full_date;
        </script>
    </body>
</html>
