
<?php
// Start the session
session_start();

// Include the database connection
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM register WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            // Store user information in session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_email'] = $row['email'];

            // Redirect to dashboard or other page
            header("Location: index.php");
            exit();
        } else {
            echo '<script>
                alert("Invalid email or password.");
            </script>';
        }
    } else {
        echo '<script>
            alert("Invalid email or password.");
        </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>HPSS / Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/solid.min.css">
    <link rel="shortcut icon" href="image/hpsslogo.jpg" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

<style>
  body{
	  padding-top:75px; background-color:#F3F7F9;
  }
  .container{
	text-align: center;
  }
  .panel{
	width: 625px;
	margin: 0 auto;
	box-shadow: 0 3px 10px #466182;
  }
  .panel-body{
	border: 1px solid #CCC;
    text-align: center;    
    width: 100%;    
    background: #144f82;    
  }
  .panel-heading{
	background-color: #FFF;
    padding: 15px 0;
    min-height: 87px;
    margin: 0 5px;
  }
  .panel-heading h5,.panel-heading h4,.panel-heading h6{
	color: #144f82;
  }

  .panel-heading h4{
	font-size: 21px;
    margin-bottom: 5px;  
  }
  .panel-heading h5{
	margin-bottom: 5px;
   font-size: 18px; 
  }
  .panel-heading h6{
	margin-bottom: 0;
   font-size: 15px;

  }

  .panel-body form {
	width: 250px;
	margin: 0 auto;
	padding: 20px 0 20px;
  }
  .form-group{
	
	margin-top: 10px;
  }

  a{
	color: #FFF;
  }

  .panel-body a:hover{
	color: #FFF;
  }
  footer{
	
	padding: 10px 20px;
	 background: #144f82; 
	 height: 45px; 
	 color:#FFF;
	 position: fixed; 
	 left:0;
	  bottom: 0; 
	  width: 100%
  }

  p a, .form-group a{
	text-decoration: none;
  }
  .err_modal{
	color: red;
	margin-left: 10px;
	font-style: italic;
  }

  .panel-body h6{
	padding: 10px 20px;
	color: #FFF;
  }

  .alert{
	padding: 5px;
  }

  .modal-body form{
	padding: 0 20px;
   }

   label.error{color:red; font-style: italic;}
</style>

	<noscript>
      <meta http-equiv="refresh" content="0.0;url=../nojs.php">
    </noscript>
  </head>
  <body>
    <div class="container">
      
   		<div class="panel panel-default">
		  	<div class="panel-heading row">
          <div class="col-lg-1">
          <img src="./image/hpsslogo.jpg" class="img-responsive" title="HPSS logo" width="60px">
        </div>
        <div class="col-lg-10">
            <h5>Hilal Public Sec. School</h5>
            <h4>Office of the Controller of Examinations</h4>
            <h6>Harinagar-7, Sunsari</h6>
          </div>
          <div class="col-lg-1"></div>
                         
        </div>
              		  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form" action="#" method="post">
              <input type="hidden" name="csrf_test_name" value="c30766f24896753fd2f0165deb999dbd" />                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Email" name="email" type="email">
                            			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="password" type="password" value="">
                            			    		</div>

			    	  <div class="form-group">
			    		<input class="btn btn-primary btn-block" type="submit" value="Login">
              </div>
              <div class="form-group text-center" style="margin-top: 20px;">
              <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#forgotModal">Forgot Password?</a> 
              </div>
              
              			    	</fieldset>
			      	</form>

		    </div>
			</div>
		</div>

   
    <!-- Modal -->
<div class="modal fade" id="forgotModal" tabindex="-1" aria-labelledby="forgotModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Forgot Password?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="post" name="forgot_password" enctype="multipart">
          <input type="hidden" name="csrf_test_name" value="c30766f24896753fd2f0165deb999dbd" />               
            <!-- <div class="form-group">
              
              <input class="form-control" placeholder="Enter Username" name="username" type="text" id="username">
            </div> -->
            <div class="form-group">
              
              <input class="form-control" placeholder="Enter Email" name="email" type="email" id="email">
            </div>
            <div class="form-group">
              
              <input class="form-control" placeholder="Choose File" name="file" type="file" id="file">
            </div>
            
            <div class="form-group">
            <button class="btn btn-primary submit" type="submit" name="submit"><i class="fa-solid fa-paper-plane"></i> Send Request</button>
            </div>
         
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

    <footer>
       
        <div class="col-lg-12 row">
          
            <div class="col-lg-6">
                <p style="text-align:left;">Copyright: <a href="#" style="color:#FFF;">HPSS @ 2024</a></p>
            </div>

            <div class="col-lg-6">
                <p style="text-align:right;">Contact No.: 9807071324 &nbsp;&nbsp;<a href="#" style="color:#FFF;">Email: hilalpublicschool096@gmail.com</a> </p>
            </div>

        </div>      

      </footer>
      <script>
        $(document).ready(function(){
          $("form[name='forgot_password']").validate({
            rules: {
            username: "required",
            email: { required:true,
                    email:true
            },
            file:"required",

          },
          messages: {
            username: "Please enter user name",
            email: "Please enter valid email",
            file: "Please select file",

          },
         
          submitHandler: function(form) {
            
            $(".err_modal").remove();
             
            var form_data = new FormData();
                var files = $('#file')[0].files[0];
                form_data.append('file',files);
                form_data.append('username', $("#username").val());
                form_data.append('email', $("#email").val());
                               
              $.ajax({
                    type: 'post',
                    url: "#",
                    data: form_data,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    
                    success: function (rs) {
                      if(rs.msg == '1'){
                        $('#username').val('');
                        $('#email').val('');
                        $('#file').val('');
                        $('.submit').after('<span class="err_modal">Request sent successfully.</span>');
                        setTimeout(showMessage, 5000);
                        
                      }else if(rs.msg == '2'){
                        $('.submit').after('<span class="err_modal">Request already sent !</span>');
                      }else if(rs.msg == '4'){
                        $('.submit').after('<span class="err_modal">Invalid File !</span>');
                      }else{
                        $('.submit').after('<span class="err_modal">Something went wrong!</span>');
                      }
                      
                    }
                 });
            

        }
        });

          
        })

        function showMessage(){
          $('#forgotModal').modal('hide');
        }
      </script>
      
  </body>
</html>		