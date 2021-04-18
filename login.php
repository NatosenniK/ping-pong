<?php
session_start();
include_once 'includes/dbconnect.php';

if(isset($_SESSION['user'])!="")
{
	header("Location: index.php");
}

if(isset($_POST['btn-login']))
{
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$upass = mysqli_real_escape_string($conn, $_POST['password']);
	
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
	}

	// Perform query
	if ($result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'")) {
	  //echo "Returned rows are: " . mysqli_num_rows($result);
	  // Free result set

	  /* fetch associative array */
		while ($row = mysqli_fetch_assoc($result)) {
				if($row['password'] ??= md5($upass))
				{
					$_SESSION['user'] = $row['user_id'] ?? "";
					header("Location: index.php");
					
				}
				else
				{
					?>
					<script>alert('wrong details');</script>
					<?php
				}
			/*
			$username = $row["username"];
			$user_id = $row["user_id"];
			echo '<h1>' .$username. '</h1>';
			echo '<h1>' .$user_id. '</h1>';
			*/
			
		}
	}
	else
	{
		echo '<h1>THAT DID NOT WORK GOOD SIR</h1>';
	}
	
	mysqli_close($conn);
	
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

    <title>Ping Pong Tracker - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-8 offset-2">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
										<button class="btn btn-primary btn-user btn-block" type="submit" name="btn-login" value="Sign In">Sign In</button>
                                        <hr>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
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

</body>

</html>