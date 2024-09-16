<?php
session_start();
error_reporting(0);
include('conn.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" media="screen">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/solid.min.css">

    <link href="./style.css" rel="stylesheet">
    <link rel="shortcut icon" href="image/hpsslogo.jpg" type="image/x-icon">

    <link href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<noscript>
      <meta http-equiv="refresh" content="0.0;url=nojs.php">
    </noscript>
       </head>
  <body>

      <div class="top_header">
        <div class="row">
          <div class="col-lg-12"><span id="english_date"></span><span id="nepali_date"></span><a href="./login.php">Login</a></div>
          
        </div>
      </div>
      <div class="header">
        <div class="row">
          <div class="col-lg-3 text-end"><img src="./image/hpsslogo.jpg" class="img-responsive" title="ctevt logo" width="60px"></div>
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
              <a href="./notice.php" class="list-group-item ">Notice Board</a>
              <a href="./checkResults.php" class="list-group-item active"></i>Check Results</a>
              <a href="./admission.php" class="list-group-item ">Process Your Admission</a>  
              <a href="./teacher.php" class="list-group-item ">Our Teachers | शिक्षकहरु</a>
    		  <a href="./examnir.php" class="list-group-item "></i>परीक्षा निर्देशिका</a>
              <a href="./calendar.php" class="list-group-item "></i>शैक्षिक क्यालेण्डर</a>
              <a href="#" style="color:#f10808;" class="list-group-item "></i>Scholarship Online (Classified)</a>
            </div>

          
          </div>   <div class="col-lg-6">
    <div class="jumbotron">
      <h5>Check Results</h5>
    
    </div>
    <div class="form_jumbotron">
       <div class="col-lg-12" style="margin-top:20px;">
            <form name="frmCheckResults" id="frmCheckResults" action="./Dashboard/results/result.php" method="post" target="_blank" autocomplete="off">
                <div class="row" >
                    <label for="" class="col-lg-3 control-label">Examination Year:</label>
                    <div class="col-lg-3">
                        <select required name="examyear" id="src_year" class="form-control">
                            <option value="">-- Select --</option>
                            <option value="2081" >2081</option>
                        </select>
                    </div>
                </div><br />
                <div class="row">
                    <label for="" class="col-lg-3 control-label">Exam Terms :</label>
                    <div class="col-lg-3">
                        <select  name="examterms" id="src_level" class="form-control" required>
                            <option value="">-- Select --</option>
                            <option value="2">Pre-diploma</option>
                        </select>
                    </div>
                </div><br/>
                <div class="row">
                    <label for="" class="col-lg-3 control-label" >Roll No. :</label>
                    <div class="col-lg-5" >
                        <input type="text" name="rollno" id="exam_symbol_number" class="form-control" placeholder="e.g. 1000234" required >
                    </div>
                </div><br />
                <div class="row">
                    <label for="" class="col-lg-3 control-label" >Date of Birth :</label>
                    <div class="col-lg-5" >
                        <input type="text" name="dob" id="dob" placeholder="Date Format: YYYY-MM-DD" class="form-control"  required >
                    </div>
                </div><br />
                <div class="col-lg-12 text-center"><input type="submit" name="submit" value="Search" class="btn btn-primary"></div>
            </div>
            </form>
        </div>
    </div>
            
          
  

  <script type="text/javascript">
    $(document).ready(function() {

    // toggle between inst and ctevtuser
    $("#classified_box").hide();
    $("#full_paying_box").hide();
    $("#src_application_type").change(function() {
      if($(this).val() != '')
      {
        if($(this).val() == '5')
        {
          $("#classified_box").hide();
          $("#src_user").removeAttr('required');
          $("#full_paying_box").show();
          $("#src_dist").attr('required');
          $("#src_institute").attr('required');
        }
        else
        {
          $("#full_paying_box").hide();
          $("#src_dist").removeAttr('required');
          $("#src_institute").removeAttr('required');
          $("#classified_box").show();
          $("#src_user").attr('required');
        }
      }
    });
    // end of toggle between inst and ctevtuser


	 $("#src_level").change(function() {
		var src_level = $(this).val();			
          $.post( "#", 
                  {sel_level:src_level }, 
                  function( data ) {
                  $( "#src_faculty" ).html( data );
                  //alert(data);
                  });
        });


    $("#src_faculty").change(function() {
		var src_level = $("#src_level").val();
		 var sel_faculty = $("#src_faculty").val();
          $.post( "#", 
                  {sel_level:src_level ,sel_faculty: $(this).val()}, 
                  function( data ) {
                  $( "#src_sub_faculty" ).html( data );
                  //alert(data);
                  });
        });
		
		
		
		$("#src_sub_faculty").change(function() {
		var src_level = $("#src_level").val();
		 var sel_faculty = $("#src_sub_faculty").val();
          $.post( "#", 
                  {sel_level:src_level ,sel_faculty: $(this).val()}, 
                  function( data ) {
                  $( "#src_year_semeter" ).html( data );
                  //alert(data);
                  });
        });
		
		
	

    $("#src_sub_faculty").change(function() {
        var level =  $("#src_level").val();
        var faculty = $("#src_faculty").val();
        var sub_faculty = $("#src_sub_faculty").val();

        if(level == '' || faculty == '' || sub_faculty == '')
        {
          alert('Please select Level, Faculty and Trade !!');
        }
        else
        {
          $.post( "#", 
                  {
                  /*sel_team: team_cd,
                  sel_level:  level, 
                  sel_faculty: faculty,*/
                  sel_program:  sub_faculty}, 
                  function( data ) {
                    //alert(data);
                  $( "#src_institute" ).html( data );
          });
          $.post( "#", 
                  {

                  sel_level:  level, 
                  sel_faculty: faculty,
                  sel_program:  sub_faculty}, 
                  function( data ) {
                    //alert(data);
                  $( "#src_dist" ).html( data );
          });
        }
    });
    $("#src_dist").change(function() {
        var level = $("#src_level").val();
        var faculty = $("#src_faculty").val();
        var sub_faculty = $("#src_sub_faculty").val();
        //var active_edu_year = $("#active_edu_year").val();
        var dist = $("#src_dist").val();

        //alert(faculty+sub_faculty+dist);

        if(faculty == '' || sub_faculty == '' || dist == '')
        {
          alert('Please select Level, Faculty, Program and District !!');
        }
        else
        {
          $.post( "#", 
                  {
                  sel_level:  level, 
                  sel_faculty: faculty,
                  sel_program:  sub_faculty,
                  sel_dist: dist
                  }, 
                  function( data ) {
                    //alert(data);
                  $( "#src_institute" ).html( data );
          });
          
        }
    });
  
  });
</script>       <div class="col-lg-3">
                  <div class="member-group">
                     <img src="./image/Sajjad Ansari.jpg" class="img img-fluid" style="width:120px">
                     <div><label><strong>Mr. Sajjad Ansari</strong></label></div>
                     <div><label>Member Secretary, HPSS</label></div>
		            </div>
                  
                  <div class="member-group">
                     <img src="./image/Sajjad Ansari.jpg" class="img img-fluid" style="width:120px">
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

 <footer>
    <div class="row">
      
       <div class="col-lg-5 col-sm-8 first">
              <p style="text-align:left;">Copyright: <a href="#">HPSS@2024</a></p>
          </div>

          <div class="col-lg-2 col-sm-12 second">
              <!-- <p style="text-align:center;"><a href="https://itms.ctevt.org.np:5580/itmsAdmin" style="margin-left:20px;font-weight: bold;">User Login</a></p> -->
              
           </div>

          <div class="col-lg-5 col-sm-8 third">
              <p style="text-align:right;">Contact No.: 9807071324 &nbsp;&nbsp;<a href="mailto:info@ctevtexam.org.np" style="">eMail: hilalpublicschool096@gmail.com</a> </p>
          </div>

     
    </div>

  </footer>


</div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-advanced-news-ticker/1.0.1/js/newsTicker.min.js"></script>
    <script src="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js"></script>
    
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
