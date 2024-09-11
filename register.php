<?php
// Include the database connection
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $Name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $comPassword = $_POST['re_password'];

    // Check if passwords match
    if ($password !== $comPassword) {
        echo '<script>
            alert("Passwords do not match.!");
            </script>';
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert data into signup table
        $sql = "INSERT INTO register (name, email, password) VALUES ('$Name', '$email', '$hashedPassword')";

        if (mysqli_query($conn, $sql)) {
            echo '<script>
                alert("Registration Successful!");
                setTimeout(function() {
                window.location.href = "login.php";
            }, 1000);
            </script>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>HPSS / Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" media="screen">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/solid.min.css">

    <link rel="stylesheet" href="./style1.css">
    <link rel="shortcut icon" href="image/hpsslogo.jpg" type="image/x-icon">

    <link href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <link href="https://cdn.datatables.net/rowreorder/1.5.0/css/rowReorder.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.min.css" rel="stylesheet">
    

    <noscript>
      <meta http-equiv="refresh" content="0.0;url=../nojs.php">
    </noscript>

  </head>
  <body>
      
      <div class="top_header">
        <div class="row">
          <div class="col-lg-6 text-start"><span id="english_date">2024 August 28, Wednesday</span><span id="nepali_date"></span></div>
          <div class="col-lg-6 text-end">
                    <a href="./register.html">Register</a><a href="./login.php">Login</a>
                    </div>
        </div>
      </div>
      <div class="header">
        <div class="row">
          <div class="col-lg-3 text-end"><img src="./image/hpsslogo.jpg" class="img-responsive" title="HPSS logo" width="60px"></div>
          <div class="col-lg-6">
            <h4>Hilal Public Sec. School</h4>
            <h3>Curriculum Development and Equivalence Division</h3>
            <h5>Harinagar-7, Sunsari</h5>
          </div>
          <div class="col-lg-3 text-end"> 
          </div>

        </div>
                
      </div>
        
     
        <div class="container-fluid" style="padding:20px;">

      <script src="https://www.google.com/recaptcha/api.js" async defer>
    </script>


<div class="col-md-6 register_box">
	 
		
	<h5>Register</h5>
	<form class="" method="post" action="#" name="register">
		<div class="form-group row ">
			<label class="col-md-4">Name*</label>
			<div class="col-md-6">
				<input type="text" name="name" id="name" class="form-control" value="" required autocomplete="off">
			</div>
		</div>

		<div class="form-group row ">
			<label class="col-md-4">Email*</label>
			<div class="col-md-6">
				<input type="email" name="email" class="form-control" value="" required autocomplete="off">
			</div>
		</div>

		<div class="form-group row ">
			<label class="col-md-4">Password*</label>
			<div class="col-md-6">
				<input type="password" name="password" id="password" class="form-control" value="" required>
			</div>
		</div>

		<div class="form-group row ">
			<label class="col-md-4">Confirm Password*</label>
			<div class="col-md-6">
				<input type="password" name="re_password" class="form-control" value="" required>
			</div>
		</div>

    <div class="form-group row ">
			<label class="col-md-12 register_note"><i>Note: Password must have at least 6 characters with number, alphabet and special character.</i></label>
		</div>

		<div class="form-group row ">
			
			<div class="col-md-12 text-center">
				<input type="submit" class="btn btn-primary" value="Submit">
			</div>
		</div>
	</form>
</div>



<script type="application/javascript">

    $(document).ready(function(){

    	$(window).keydown(function(event){
        if(event.keyCode == 13) {
	        event.preventDefault();
	        return false;
	      }
	    });


      $("form[name='register']").validate({
        rules: {
        	name: "required",
        	password: {
            	required: true,
            	minlength: 6
        	},
	        re_password: {
	            required: true,
	            minlength: 6,
	            equalTo: "#password" //for checking both passwords are same or not
	        },
	        email: {
	            required: true,
	            email: true
	        },
          

        },
        messages: {
            name: "Please enter name",
            email: {
                required: " Please enter an email address",
                email: " Please enter valid email address"
            },
            password: {
                required: " Please enter a password",
                minlength: " Your password must be consist of at least 6 characters"
            },
            re_password: {
                required: " Please enter a password",
                minlength: " Your password must be consist of at least 6 characters",
                equalTo: " Please enter the same password as above"
            },

        },
        submitHandler: function(form) {
	      form.submit();
	    }
       
        
      });

    });


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
                          <p style="text-align:right;"><a href="mailto:equivalence@ctevt.org.np" style="">Email: </a> </p>
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
