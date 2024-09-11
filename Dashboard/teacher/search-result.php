<?php 
    include_once('includes/dbconnection.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Teacher Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" media="screen">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/solid.min.css">

    <link href="../../style.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="../../image/hpsslogo.jpg" type="image/x-icon">

    <link href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


	<noscript>
      <meta http-equiv="refresh" content="0.0;url=nojs.php">
    </noscript>
       </head>
   <body>

      <div class="top_header">
         <div class="row">
            <div class="col-lg-12">2024 August 28, Wednesday<span id="nepali_date"></span>
               <!-- <a href="./login.php">Login</a> -->
               <?php 
          if (isset($_SESSION['user_id'])) {
            echo '
            <a href="../../dashboard.php" id="dashboard_link">Dashboard</a>
            <a href="../../logout.php" id="logout_link">Logout</a>
          ';
          } else {
          echo '<a href="login.php" id="login_link">Login</a>';
          }
        ?>
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


            <!-- Blog preview section-->
            <section class="py-5">
                <div class="container px-5 my-5">
                    <form method="post" action="search-result.php">
   <aside class="bg-primary bg-gradient rounded-3 p-4 p-sm-5 mt-5">
                        <div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                            <div class="mb-4 mb-xl-0">
                                <div class="fs-3 fw-bold text-white">Search Teacher by Name or Subject</div>
                            </div>
                            <div class="ms-xl-4">
                                <div class="input-group mb-2">
                                    <input class="form-control" type="text" placeholder="Search Teacher by Name or Subject" aria-label="Email address..." aria-describedby="button-newsletter" name="searchinput" required style="width:350px;" />
                                    <button class="btn btn-outline-light" id="button-newsletter" type="submit">Search</button>
                                </div>
                            </div>
                        </div>
                    </aside>
                </form>
                    <hr />
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">
                            <div class="text-center">
<?php     $searchdata=$_POST['searchinput'];?>

                                <h2 class="fw-bolder">Search List Against <font color="red">"<?php echo $searchdata;?>"</font></h2>
<hr color="red" />
                            </div>
                        </div>
                    </div>
                    <div class="row gx-5">
                                    <?php
$sql="SELECT * from tblteacher where (isPublic='1') and (Name  like '%$searchdata%'|| TeacherSub like '%$searchdata%')";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>  

                        <div class="col-lg-4 mb-5">
                            <div class="card h-100 shadow border-0">
                                <img class="card-img-top" src="teacher/images/<?php echo $row->Picture;?>" alt="<?php  echo htmlentities($row->Name);?>" />
                                <div class="card-body p-4">
                                    <div class="badge bg-primary bg-gradient rounded-pill mb-2"><?php  echo htmlentities($row->TeacherSub);?></div>
                                    <a class="text-decoration-none link-dark stretched-link" href="teacher-details.php?tid=<?php echo $row->ID;?>" target="_blank">
                                        <h5 class="card-title mb-3"><?php  echo htmlentities($row->Name);?></h5></a>
                                    <p class="card-text mb-0"><small>Registered Since <?php  echo htmlentities($row->RegDate);?></small></p>
                                </div>
                         
                            </div>
                        </div>
<?php }} else{?>
<h3 align="center" style="color:red;">Record not Found</h3>
<?php } ?>
                 
                    </div>
                    <!-- Call to action-->
             
                </div>
            </section>
        </main>
        <footer>
            <div class="row" style="width: 100%;">
               <div class="col-lg-5 col-sm-8 first">
                   <p style="text-align:left;">Copyright: <a href="#">HPSS@2024</a></p>
               </div>

               <div class="col-lg-2 col-sm-12 second">
                  <p style="text-align:center;"><a href="#" style="margin-left:20px;font-weight: bold;">User Login</a></p>
               </div>

               <div class="col-lg-5 col-sm-8 third">
                  <p style="text-align:right;">Contact No.: 9807071324 &nbsp;&nbsp;<a href="#" >eMail: </a> </p>
               </div>
            </div>
         </footer>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    
      <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-advanced-news-ticker/1.0.1/js/newsTicker.min.js"></script>
      <script src="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.4.min.js"></script>
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
        <script src="js/scripts.js"></script>
    </body>
</html>
