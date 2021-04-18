<?php
session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location: index.php");
}
include_once 'includes/dbconnect.php';

if(isset($_POST['register']))
{
	$uname = mysqli_real_escape_string($conn, $_POST['username']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$upass = md5(mysqli_real_escape_string($conn, $_POST['password']));

	$insert_user = mysqli_query($conn,"INSERT INTO `users` (username, email, password) VALUES('$uname','$email','$upass')");
	if($insert_user)
	{
		?>
        <script>alert('You successfully registered ');</script>
        <?php
	}
	else
	{
		?>
        <script>alert('There was an error while registering you...');</script>
        <?php
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ping Pong Tracking - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
	<style>
	/* PASSWORD STRENGTH BAR */
    #progressBar {
      height: 20px;
      width: 100%;
      border-radius:50px;
      border:2px solid #ddd
    }

    #progress-bar {
      width: 0%;
      height: 100%;
      transition: width 500ms linear;
      border-radius:50px;
      box-shadow:0px 1px 5px #555
    }

    .progress-bar-danger {
      background: #d00;
    }

    .progress-bar-warning {
      background: #f50;
    }

    .progress-bar-success {
      background: #080;
    }
    .pwd-s {
        font-size: 10px;
        font-weight: 700;
    }
	</style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-8 offset-2">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="post">
                                <div class="form-group">
									<input type="text" class="form-control form-control-user" id="username"
										placeholder="Username" name="username">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email"
                                        placeholder="Email Address" name="email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="txtNewPassword" placeholder="Password" name="password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="txtConfirmPassword" placeholder="Repeat Password" onChange="checkPasswordMatch();">
                                    </div>
                                </div>
								<div class="form-group">
								<div class="registrationFormAlert" id="divCheckPasswordMatch"></div>
								<span class="pwd-s">Password Strength:</span>
								<div id="progressBar">
								  <div id="progress-bar"></div>
								</div><br>
								</div>
								<button class="btn btn-primary btn-user btn-block" type="submit" name="register" value="Register">Register</button>
                                <hr>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
		    <script>
        jQuery(function($) {
            function checkPasswordMatch() {
                var password = $("#txtNewPassword").val();
                var confirmPassword = $("#txtConfirmPassword").val();
            
                if (password != confirmPassword)
                    $("#divCheckPasswordMatch").html("Passwords do not match!");
                else
                    $("#divCheckPasswordMatch").html("Passwords match.");
            }
            
            $(document).ready(function () {
               $("#txtConfirmPassword").keyup(checkPasswordMatch);
            });
            
            
        }(jQuery));
        jQuery.strength = function( element, password ) {
            var desc = [{'width':'0px'}, {'width':'20%'}, {'width':'40%'}, {'width':'60%'}, {'width':'80%'}, {'width':'100%'}];
            var descClass = ['', 'progress-bar-danger', 'progress-bar-danger', 'progress-bar-warning', 'progress-bar-success', 'progress-bar-success'];
            var score = 0;
    
            if(password.length > 6){
                score++;
            }
    
            if ((password.match(/[a-z]/)) && (password.match(/[A-Z]/))){
                score++;
            }
    
            if(password.match(/\d+/)){
                score++;
            }
    
            if(password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)){
                score++;
            }
    
            if (password.length > 10){
                score++;
            }
    
            element.removeClass( descClass[score-1] ).addClass( descClass[score] ).css( desc[score] );
        };
    
    jQuery(function() {
      jQuery("#txtNewPassword").keyup(function() {
                        jQuery.strength(jQuery("#progress-bar"), jQuery(this).val());
                    });
    });
    </script>

</body>

</html>