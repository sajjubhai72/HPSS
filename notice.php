<?php 
    include "conn.php";
    session_start();

    // $sql = "SELECT * FROM notice";
    $sql = "SELECT * FROM notice ORDER BY published_date DESC";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>HPSS / Notice</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/solid.min.css">
        <link href="./style.css" rel="stylesheet">
        <link rel="shortcut icon" href="image/hpsslogo.jpg" type="image/x-icon">
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	    <noscript>
            <meta http-equiv="refresh" content="0.0;url=nojs.php">
        </noscript>
    </head>
<body>
    <div class="top_header">
        <div class="row">
           <div class="col-lg-12"><span id="english_date">2024 August 28, Wednesday</span><span id="nepali_date"></span>
               <!-- <a href="./login.html">Login</a> -->
               <?php 
          if (isset($_SESSION['user_id'])) {
            echo '
            <a href="dashboard.php" id="dashboard_link">Dashboard</a>
            <a href="logout.php" id="logout_link">Logout</a>
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
            <div class="col-lg-3 text-end"><img src="./image/hpsslogo.jpg" class="img-responsive" title="HPSS logo" width="60px"></div>
            <div class="col-lg-6">
                <h4>Hilal Public Sec. School</h4>
                <h3>Controller of Examinations</h3>
                <h5>Harinagar-7, Sunsari</h5>
            </div>
            <div class="col-lg-3 text-end"></div>
        </div>
    </div>
    
    <div class="container-fluid">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-3">
                <div class="list-group">       	
                    <a href="./index.php" class="list-group-item ">Home</a>
                    <a href="./notice.php" class="list-group-item active">Notice Board</a>     
                    <a href="./checkResults.php" class="list-group-item ">Check Results</a>       
                    <a href="./admission.php" class="list-group-item ">Process Your Admission</a>
                    <a href="./teacher.php" class="list-group-item ">Our Teachers | शिक्षकहरु</a>   
                    <a href="./exam-nir.php" class="list-group-item ">परीक्षा निर्देशिका</a>
                    <a href="./calender.php" class="list-group-item ">शैक्षिक क्यालेण्डर</a>
                    <a href="#" style="color:#f10808;" class="list-group-item ">Scholarship Online (Classified)</a>
                </div>
            </div> 
            <div class="col-lg-6">
                <div class="jumbotron">
                    <h5 class="notice_header">Notice Board</h5>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item first_item" role="presentation">
                        <a class="nav-link show active" id="tab-0" data-bs-toggle="tab" href="#tabs0" role="tab" aria-controls="tabs0" aria-selected="true">All Notices</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent"></div>  
                <div class="jumbotrons" style="background: #FFF;">
                    <div class="row">
                        <div class="col-lg-12">            
                            <table width="100%" border="1" bordercolor="#CCC" class="table table-striped table-hover table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th width="1%" class="text-center">S.N</th>
                                        <th width="14%" class="text-center">Published Date</th>
                                        <th width="55%" class="text-center">Notice Title</th>
                                        <th width="15%" class="text-center">Files</th>
                                        <th width="15%" class="text-center">Published By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
              $counter = 0; // Initialize the counter
              while ($row = mysqli_fetch_assoc($result)) {
                $counter++; // Increment the counter for each row
                echo '<tr class="text-center">';
                echo '<td>' . $counter . '</td>'; // Use the counter as serial number
                echo '<td>' . $row['published_date'] . '</td>';
                echo '<td>' . $row['title'] . '</td>';
                // echo '<td><a href="./dashboard/Notice-Dashboard/' . $row['file'] . '" target="_blank"><i class="fa-solid fa-file-pdf" title=""></i></a></td>';
                
                // Fetch file extension using pathinfo
                $file_extension = strtolower(pathinfo($row['file'], PATHINFO_EXTENSION));

                // Define icon based on file extension
                if ($file_extension == 'pdf') {
                    $icon = '<i class="fa-solid fa-file-pdf" title="PDF File"></i>';
                } elseif (in_array($file_extension, ['jpg', 'jpeg', 'png'])) {
                    $icon = '<i class="fa-solid fa-file-image" title="Image File"></i>';
                } elseif ($file_extension == 'zip') {
                    $icon = '<i class="fa-solid fa-file-zipper" title="ZIP File"></i>';
                } else {
                 $icon = '<i class="fa-solid fa-file" title="File"></i>'; // Default icon for other file types
                }

                // Display the file with the appropriate icon
                echo '<td><a href="./dashboard/Notice-Dashboard/' . $row['file'] . '" target="_blank">' . $icon . '</a></td>';


                echo '<td>' . $row['publisher'] . '</td>';
                echo '</tr>';
              }
            ?>
                                </tbody>        
                            </table>
                        </div>
                    </div> 
                </div>
            </div>
            
            <div class="col-lg-3">
                <div class="member-group">
                    <img src="./image/Sajjad Ansari.jpg" class="img img-fluid" style="width:120px">
                    <div><label><strong>Mr. Sajjad Ansari</strong></label></div>
                    <div><label>Member Secretary, HPSS</label></div>
                </div>
                <div class="member-group">
                    <img src="#" class="img img-fluid" style="width:120px">
                    <div><label><strong>Mr. Umesh Kumar Mishra</strong></label></div>
                    <div><label>Controller of Examinations</label></div>
                </div>
                <div class="member-group">
                    <img src="#" class="img img-fluid" style="width:120px">
                    <div><label><strong>Mr. Govinda Kumar Shrestha</strong></label></div>
                    <div><label>Deputy Controller of Examinations/Information Official, HPSS</label></div>
                    <div><label><i class="fa fa-phone me-1" style="font-size:13px;"></i>9807071324</label></div>
                </div>
            </div>
        </div>
    </div>
            </div>    
    
    <footer>
        <div class="row">     
            <div class="col-lg-5 col-sm-8 first" style="padding: 0 40px;">
                <p style="text-align:left;">Copyright: <a href="#">HPSS@2024</a></p>
            </div>
            <div class="col-lg-2 col-sm-12 second">
                <!-- <p style="text-align:center;"><a href="#" style="margin-left:20px;font-weight: bold;">User Login</a></p> -->
            </div>
            <div class="col-lg-5 col-sm-8 third">
                <p style="text-align:right;">Contact No.: 9807071324 &nbsp;&nbsp;<a href="mailto:info@ctevtexam.org.np" >eMail: hilalpublicschool096@gmail.com</a> </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-advanced-news-ticker/1.0.1/js/newsTicker.min.js"></script>
    <script src="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.4.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,

                "columns": [
                           { "data": "serial_no" },
                           { "data": "updated_date" },
                           { "data": "notice_title" },
                           { "data": "notice_files" },
                           { "data": "publisher" },
                       ],
                       
                       'columnDefs': [
                           {
                           "targets": 0, 
                           "className": "text-center",
                           "orderable": false
                           },
                           {
                           "targets": 1, 
                           "orderable": false
                           },
                           {
                           "targets": 2, 
                           "orderable": false
                           },
                           
                           {
                           "targets": 3, 
                           "className": "text-center",
                           "searchable": false,
                           "orderable": false
       
                           },
                           {
                           "targets": 4, 
                           "orderable": false
                           }
                       ]
            });
            

            // Load Nepali Date
            var currMonth = NepaliFunctions.GetCurrentBsMonth();
            var currDay = NepaliFunctions.GetCurrentBsDay();
            var currYear = NepaliFunctions.GetCurrentBsYear();
            
            var day = NepaliFunctions.GetBsFullDayInUnicode({ year: currYear, month: currMonth, day: currDay });
            var currentDate = NepaliFunctions.GetBsFullDate({ year: currYear, month: currMonth, day: currDay }, true);

            var full_date = day + ', ' + currentDate;
            document.getElementById("nepali_date").innerHTML = full_date;
        });
    </script>
    <script>
      function updateDates() {
        const currentDate = new Date();

        // Update English date
        const options = {
          year: "numeric",
          month: "long",
          day: "numeric",
          weekday: "long",
        };
        document.getElementById("english_date").textContent =
          currentDate.toLocaleDateString("en-US", options);

        // Update Nepali date (replace with your actual logic)
        const nepaliDate = getNepaliDate(currentDate); // Your logic to get Nepali date
        document.getElementById("nepali_date").textContent = nepaliDate;
      }

      // Call the updateDates function to update dates on page load
      updateDates();

      // Update dates every second
      setInterval(updateDates, 1000);
    </script>
</body>
</html>
