<?php 
    include "conn.php";
    session_start();

    // $sql = "SELECT * FROM notice";
    $sql = "SELECT * FROM calendar";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>HPSS / Yearly Calender</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" media="screen">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/solid.min.css">

    <link href="./style.css" rel="stylesheet">
    <link rel="shortcut icon" href="image/hpsslogo.jpg" type="image/x-icon">

    <link href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    

    <style>
     
    </style>

	<noscript>
      <meta http-equiv="refresh" content="0.0;url=nojs.php">
    </noscript>
       </head>
  <body>

      <div class="top_header">
        <div class="row">
          <div class="col-lg-12"><span id="english_date">2024 August 28, Wednesday</span><span id="nepali_date"></span><a href="./login.html">Login</a></div>
          
        </div>
      </div>
      <div class="header">
        <div class="row">
          <div class="col-lg-3 text-end"><img src="./image/hpsslogo.jpg" class="img-responsive" title="hpss logo" width="60px"></div>
          <div class="col-lg-6">
            <h4>Hilal Public Sec. School</h4>
            <h3>Controller of Examinations</h3>
            <h5>Harinagar-7, Sunsari</h5>
          </div>
          <div class="col-lg-3 text-end"> 
          </div>

        </div>
                
      </div>
        
     
        <div class="container-fluid">

      <div class="page-header" id="banner">
        <div class="row">
          <div class="col-lg-3">
            <div class="list-group">       	
              <a href="./index.php" class="list-group-item ">Home</a>
              <a href="./notice.php" class="list-group-item ">Notice Board </a>
               <a href="./results.html" class="list-group-item "></i>Check Results</a>
               <a href="./admission.php" class="list-group-item ">Process Your Admission</a>
               <a href="./teacher.php" class="list-group-item ">Our Teachers | शिक्षकहरु</a>
               <a href="./exam-nir.php" class="list-group-item "></i>परीक्षा निर्देशिका</a>
               <a href="./calender.php" class="list-group-item active"></i>शैक्षिक क्यालेण्डर</a>
               <a href="#" style="color:#f10808;" class="list-group-item "></i>Scholarship Online (Classified)</a>
            </div>

          
          </div> <div class="col-lg-6">
  <div class="jumbotron">
    <h5>शैक्षिक क्यालेण्डर</h5>
  </div>
  <div class="jumbotron" style="background: #FFF;">
    <div class="row">
     
        <div class="col-lg-12">
          
          <div style="margin-top: 20px">    
         
            </div>
            <?php
              $counter = 0; // Initialize the counter
              while ($row = mysqli_fetch_assoc($result)) {
                $counter++; // Increment the counter for each row
            echo'<div><p><h4 style="color:#585454; margin-bottom: 20px; margin-top:40px;font-size: 20px">'. $row['main_title'] . '</h4></p></div>';
            echo'<div style="margin-top: 20px"><p><a href="./dashboard/Notice-Dashboard/calendar/' . $row['file'] .'" target="_blank"><i class="fa-solid fa-file-pdf" title="Academic Calender"></i>'. $row['title'] .'</a></p></div>';
             } ?>
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
                                    <img src="" class="img img-fluid" style="width:120px">
                                <div><label><strong>Mr. Umesh Kumar Mishra</strong></label></div>
                <div><label>Controller of Examinations</label></div>
		                </div>
                                <div class="member-group">
                                    <img src="" class="img img-fluid" style="width:120px">
                                <div><label><strong>Mr. Govinda Kumar Shrestha</strong></label></div>
                <div><label>Deputy Controller of Examinations/Information Official, HPSS</label></div>
		                    <div><label><i class="fa fa-phone me-1" style="font-size:13px;"></i>9807071324</label></div>
                                </div>
                        </div>

   </div>
</div>    

 <footer>
    <div class="row">
      
       <div class="col-lg-5 col-sm-8 first">
              <p style="text-align:left;">Copyright: <a href="#">HPSS@2024</a></p>
          </div>

          <div class="col-lg-2 col-sm-12 second">
              <!-- <p style="text-align:center;"><a href="#" style="margin-left:20px;font-weight: bold;">User Login</a></p> -->
              
           </div>

          <div class="col-lg-5 col-sm-8 third">
              <p style="text-align:right;">Contact No.: 9807071324 &nbsp;&nbsp;<a href="#" >eMail: hilalpublicschool096@gmail.com</a> </p>
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
     $(document).ready(function(){

         table = $('#table1').DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "ajax": {url:"notices/get-ajax-notices",
                        data:{"tab_id":'tab-0'}
                    },
                
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

        $('body').on('click','.nav-link', function(){
           
            var id = $(this).attr('id');
            
            table = $('#table1').DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "ajax": {url:"notices/get-ajax-notices",
                        data:{"tab_id":id}
                    },
                
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
               
        });
        

        $('.notice-body').AcmeTicker({
             type:'marquee',/*horizontal/horizontal/Marquee/type*/
             direction: 'left',/*up/down/left/right*/
             speed: 0.04,/*true/false/number*/ /*For vertical/horizontal 600*//*For marquee 0.05*//*For typewriter 50*/
             controls: {
                 toggle: $('.acme-news-ticker-pause'),/*Can be used for horizontal/horizontal/typewriter*//*not work for marquee*/
             }
        });
     })

     //nepali date
      currMonth = NepaliFunctions.GetCurrentBsMonth();
      currDay = NepaliFunctions.GetCurrentBsDay();
      currYear = NepaliFunctions.GetCurrentBsYear();
      
      day = NepaliFunctions.GetBsFullDayInUnicode({year: currYear, month: currMonth, day: currDay});
      currentDate = NepaliFunctions.GetBsFullDate({year: currYear, month: currMonth, day: currDay}, true);

      full_date = day + ', ' + currentDate;
      document.getElementById("nepali_date").innerHTML = full_date;
      
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
