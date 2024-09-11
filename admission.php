<?php
include './conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // File upload directory
    $targetDir = "dashboard/admission/admission-data-upload/";

    // Handle file uploads
    $photoPath = handleFileUpload($_FILES["photo"], $targetDir);
    $nationalityPhotoPath = handleFileUpload($_FILES["nationalityPhoto"], $targetDir);
    $tcCertificatePath = handleFileUpload($_FILES["tcContainer"], $targetDir);
    $marksheetPath = handleFileUpload($_FILES["marksheetContainer"], $targetDir);

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

    // Insert data into student_admission table using prepared statements
    $sql = "INSERT INTO admission (s_name, f_name, m_name, s_gender, s_dob, address, e_mail, mobile_number, s_nationality, s_class, s_photo, nationality_photo, tc_certificate, s_marksheet) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssssssssss", $s_name, $f_name, $m_name, $s_gender, $s_dob, $address, $e_mail, $mobile_number, $s_nationality, $s_class, $photoPath, $nationalityPhotoPath, $tcCertificatePath, $marksheetPath);
    
    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Student admission form submitted successfully!");</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

function handleFileUpload($file, $targetDir) {
  if ($file["error"] === UPLOAD_ERR_NO_FILE) {
      return "No file was uploaded.";
  }

  // Handle other error cases
  elseif ($file["error"] !== UPLOAD_ERR_OK) {
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
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>HPSS / Admission</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" media="screen">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/solid.min.css">

    <!-- <link href="./style.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="./style1.css">
    <link rel="shortcut icon" href="image/hpsslogo.jpg" type="image/x-icon">

    <link href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <link href="https://cdn.datatables.net/rowreorder/1.5.0/css/rowReorder.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nepali-datepicker/2.2.3/nepali.datepicker.min.css">
    

    <noscript>
      <meta http-equiv="refresh" content="0.0;url=../nojs.php">
    </noscript>
    <style>
        .file-preview {
            margin-top: 20px;
            position: relative;
            display: inline-block;
        }
        .file-preview img {
            max-width: 100%;
            height: auto;
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        .zoomed {
            transform: scale(2); /* Adjust zoom level here */
            cursor: zoom-out;
        }
        .file-preview img {
            max-width: 200px; /* Adjust thumbnail size */
        }
    </style>

  </head>
  <body>
      
      <div class="top_header">
        <div class="row">
          <div class="col-lg-6 text-start"><span id="english_date">2024 August 28, Wednesday</span><span id="nepali_date"></span></div>
          <!-- <div class="col-lg-6 text-end">
                    <a href="./register.html">Register</a><a href="./login.html">Login</a>
                    </div> -->
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
          <div class="col-lg-3 text-end"> 
          </div>

        </div>
                
      </div>
        
     
        <div class="container-fluid" style="padding:20px;">

      <script src="https://www.google.com/recaptcha/api.js" async defer>
    </script>


<!-- <div class="col-md-6 register_box"> -->
	 
		
	<h1 style="text-align: center; padding-top: 40px;">Student Admission Form</h1>

    <div class="content mt-3">
      <div class="animated fadeIn">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header"><strong>Student </strong><small> Personal Details </small></div>

              <form name="" method="post" action="#" enctype="multipart/form-data">

                <div class="card-body card-block">
                  <div class="form-group">
                    <label for="fullName" class=" form-control-label">विद्यार्थीको पुरा नाम / Student Full Name:</label>
                    <input type="text" name="fullName" value="" class="form-control" id="fullName" required="true">
                  </div>

                  <div class="form-group">
                    <label for="fatherName" class=" form-control-label">बुबाको नाम / Father's Name:</label>
                    <input type="text" name="fatherName" value="" class="form-control" id="fatherName" required="true">
                  </div>

                  <div class="form-group">
                    <label for="motherName" class=" form-control-label">आमाको नाम / Mother's Name:</label>
                    <input type="text" name="motherName" value="" class="form-control" id="motherName" required="true">
                  </div>

                  <div class="form-group">
                    <label for="gender" class=" form-control-label">लिङ्ग / gender:</label>
                    <select id="gender" name="gender" class="form-control" required>
                      <option value="" disabled selected>Select Gender</option>  
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                                                                          
                                        
                  <div class="form-group">
                    <label for="dob" class="form-control-label">जन्म मिती / Date of Birth:</label>
                    <input type="text" name="dob" id="dob" placeholder="YYYY-MM-DD" class="form-control" required="true">
                  </div>                  

                  <div class="form-group">
                      <label for="email" class=" form-control-label">E-mail:</label>
                      <input type="email" name="email" value="" id="email" class="form-control" required="true">
                  </div>
                                        
                  <div class="row form-group">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="mobile" class=" form-control-label">मोबाईल नम्बर / Mobile Number:</label>
                        <input type="text" name="mobile" id="mobile" value="" class="form-control" required="true" maxlength="10" pattern="[0-9]+">
                      </div>
                    </div>
                  </div>

                  <div class="row form-group">
                    <div class="col-12">
                      <div class="form-group">
                      <label for="nationality" class=" form-control-label">राष्टिता / Nationality:</label>
                          <select id="nationality" name="nationality" class="form-control" required>
                            <option value="" disabled selected>Select Nationality</option>
                            <option value="Nepal">Nepal</option>
                            <option value="India">India</option>
                            <option value="Other">Other</option>
                          </select>
                      </div>
                    </div>
                  </div>
                                                    
                  <div class="row form-group"></div>
                  <div class="row form-group">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="city" class=" form-control-label">विद्यार्थीको ठेगाना / Student Address:</label>
                        <textarea type="text" name="address" id="address" value="" class="form-control" rows="4" cols="12" required="true"></textarea>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row form-group">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="class" class=" form-control-label">कक्षा / Class:</label>
                        <select id="class" name="class" class="form-control" onchange="validateForm(); toggleExtraFields(); ">
  <option value="" disabled selected>Your Class</option>
  <option value="nursery">Nursery</option>
  <option value="lkg">LKG</option>
  <option value="ukg">UKG</option>
  <!-- Add classes dynamically as in your existing code -->
  <?php
    for ($i = 1; $i <= 9; $i++) {
      echo "<option value=\"$i\">Class $i</option>";
    }
  ?>
  <option value="11">Class 11</option>
</select>

                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>

         <!---------------------------------------------------------->
         <div class="col-lg-6">
            <div class="card">
              <div class="card-header"><strong>Student </strong><small> Documents Details</small></div>
              <div class="card-body card-block">                 

                <div class="row form-group">
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="photo" class="form-control-label">विद्यार्थीको फोटो / Student Photo:</label>
                                    <input type="file" name="photo" id="photo" class="form-control" accept="image/jpeg, image/png">
                                    <div class="file-preview" id="photo-preview">
                                        <!-- Photo preview will appear here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="row form-group">
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nationalityPhoto" class="form-control-label">विद्यार्थीको जन्मदर्ता वा नागरिकता / Student Citizenship Certificate:</label>
                                    <input type="file" id="nationalityPhoto" name="nationalityPhoto" class="form-control" accept="image/*">
                                    <div class="file-preview" id="nationality-photo-preview">
                                        <!-- Nationality Photo preview will appear here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="row form-group" id="tcContainer">
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="tcContainer" class="form-control-label">विद्यार्थीको टीसी वा चरित्र प्रमाण पत्र / Student TC/Character:</label>
                                    <input type="file" id="tcContainer" name="tcContainer" class="form-control" accept="image/*, .pdf, .doc, .docx">
                                    <div class="file-preview" id="tc-container-preview">
                                        <!-- TC Container preview will appear here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="row form-group" id="marksheetContainer">
                    <div class="card-body card-block">
                        <div class="row form-group">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="marksheetContainer"class="form-control-label">विद्यार्थीको मार्कशीट / Student Marksheet:</label>
                                    <input type="file" id="marksheetContainer" name="marksheetContainer" class="form-control" accept="image/*, .pdf, .doc, .docx">
                                    <div class="file-preview" id="marksheet-container-preview">
                                        <!-- Marksheet Container preview will appear here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <p><button type="submit" value="Submit" class="btn btn-primary btn-sm" name="submit" id="submit">
                    <i class="fa fa-dot-circle-o"></i>  Submit Your Form
                  </button></p>
                
                                                    
              </div>
              </form>
            </div>
          </div>
        </div><!-- .animated -->
      </div><!-- .content -->
    </div><!-- /#right-panel -->



    <script>
    
    
        function toggleExtraFields() {
            var selectedClass = document.getElementById('class').value;
            var tcContainer = document.getElementById('tcContainer');
            var marksheetContainer = document.getElementById('marksheetContainer');
    
            // Reset the display style
            tcContainer.style.display = 'block';
            marksheetContainer.style.display = 'block';
    
            // Hide extra fields for Nursery, UKG, and LKG
            if (selectedClass === 'nursery' || selectedClass === 'ukg' || selectedClass === 'lkg') {
                tcContainer.style.display = 'none';
                marksheetContainer.style.display = 'none';
            }
        }
    
        function validateForm() {
            // Your existing validation logic
    
            // Additional validation based on the selected class
            var selectedClass = document.getElementById('class').value;
    
            if (selectedClass !== 'nursery' && selectedClass !== 'ukg' && selectedClass !== 'lkg') {
                var tc = document.getElementById('tcContainer').value;
                var marksheet = document.getElementById('marksheetContainer').value;
    
                if (tc === '' || marksheet === '') {
                    alert('TC and Marksheet are required for Class ' + selectedClass + '.');
                    return false;
                }
            }
    
            return true;
        }
      </script>
<style>
	@media (min-width: 575px) {
		footer{
			position: fixed;
		    bottom: 0;
		    width: 100%;
		}
	}
</style></div>
 <footer>
    <div class="row">
      
       
          <div class="col-lg-6 col-sm-12 first">
              <p style="text-align:left;">Copyright: <a href="#">HPSS @ 2024</a></p>
          </div>

          

          <div class="col-lg-6 col-sm-12 third">
                          <p style="text-align:right;"><a href="#" >Email: hilalpublicschool096@gmail.com</a> </p>
          </div>

     
    </div>

  </footer>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>    
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-advanced-news-ticker/1.0.1/js/newsTicker.min.js"></script>
    <script src="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.4.min.js"></script>

    <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/rowReorder.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nepali-datepicker/2.2.3/nepali.datepicker.min.js"></script>
    
    
    <script>
        function handleFileUpload(inputId, previewId) {
            const input = document.getElementById(inputId);
            const previewContainer = document.getElementById(previewId);

            input.addEventListener('change', function(event) {
                const file = event.target.files[0];
                previewContainer.innerHTML = ''; // Clear any previous preview

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const filePreview = document.createElement('img');
                        filePreview.src = e.target.result;
                        filePreview.alt = 'Uploaded File';
                        previewContainer.appendChild(filePreview);

                        filePreview.addEventListener('click', function() {
                            filePreview.classList.toggle('zoomed'); // Toggle zoom effect on click
                        });
                    }
                    reader.readAsDataURL(file); // Read the file as a data URL
                }
            });
        }

        handleFileUpload('photo', 'photo-preview');
        handleFileUpload('nationalityPhoto', 'nationality-photo-preview');
        handleFileUpload('tcContainer', 'tc-container-preview');
        handleFileUpload('marksheetContainer', 'marksheet-container-preview');
    </script>
    
    <script> 
        $(document).ready(function(){
            $('.scc_msg_close').click(function(){
              $(this).parent().remove();
            })

            let swidth = screen.width;
            if(swidth > 575){
                $('.top_icon_heading').show(); 
                $('.top_icon_mini_heading').hide(); 

                $('.max_heading').show(); 
                $('.mini_heading').hide();              
            }else{
                $('.top_icon_heading').hide(); 
                $('.top_icon_mini_heading').show();

                $('.max_heading').hide(); 
                $('.mini_heading').show();  
            }

            if($('#table1').length > 0){
                $('#table1').DataTable( {
                       "lengthMenu": [[50, 100, 200], [50, 100, 200]],
                        rowReorder: {
                            selector: 'td:nth-child(2)'
                        },
                       responsive: true
                } );
            }
        })    


        if($('#table2').length > 0){
            $('#table2').DataTable( {
                    "lengthMenu": [[50, 100, 200], [50, 100, 200]],
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true
            } );
        }

        if($('#table3').length > 0){
            $('#table3').DataTable( {
                    "lengthMenu": [[50, 100, 200], [50, 100, 200]],
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true
            } );
        }

        document.addEventListener('DOMContentLoaded', function() {
  var nepaliDatePicker = new NepaliDatePicker({
    el: '#dob', // Selector for your input field
    format: 'YYYY-MM-DD', // Set date format
    onSelect: function(date) {
      console.log('Selected Date:', date);
    }
  });
});


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
