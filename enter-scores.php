<?php
session_start();
include_once 'includes/dbconnect.php';
include 'elo.php';

if(isset($_POST['btn-post']))
{
	$opponent = $_POST["opponent"];
	//$opponent = array_key_exists('opponent', $_POST) ? $_POST['opponent'] : false;
	
	$userscore = mysqli_real_escape_string($conn, $_POST['userscore']);
	$oppscore = mysqli_real_escape_string($conn, $_POST['oppscore']);
	
	if($userscore != $oppscore)
	{
		if($userscore > $oppscore)
		{
			$Winner_ID = $_SESSION['user'];
			$query = mysqli_query($conn, "SELECT user_id FROM users WHERE username = '".$opponent."'");
			$result = mysqli_fetch_assoc($query) or die(mysqli_error($conn));
			$Loser_ID = $result['user_id'];
			
			$query1 = mysqli_query($conn, "SELECT Elo FROM users WHERE user_id=".$_SESSION['user']);
			$result1 = mysqli_fetch_assoc($query1) or die(mysqli_error($conn));
			$winnerRating = $result1['Elo'];
			
			$query2 = mysqli_query($conn, "SELECT Elo FROM users WHERE user_id=".$Loser_ID);
			$result2 = mysqli_fetch_assoc($query2) or die(mysqli_error($conn));
			$loserRating = $result2['Elo'];
			
			$rating = new Rating($winnerRating, $loserRating, 1, 0);			
			$results = $rating->getNewRatings();
			
			if(mysqli_query($conn, "UPDATE users SET Elo = " . $results['a'] . " WHERE user_id=".$_SESSION['user']))
			{

			}
			else
			{
				?>
				<script>alert('There was an error while entering winners(user) ranking...');</script>
				<?php
			}
			if(mysqli_query($conn, "UPDATE users SET Elo = " . $results['b'] . " WHERE user_id=".$Loser_ID))
			{
			
			}
			else
			{
				?>
				<script>alert('There was an error while entering losers(opp) ranking..');</script>
				<?php
			}
			
		}	
		elseif($oppscore > $userscore)
		{		
			$Loser_ID = $_SESSION['user'];
			$query = mysqli_query($conn, "SELECT user_id FROM users WHERE username = '".$opponent."'");
			$result = mysql_fetch_array($query) or die(mysql_error());
			$Winner_ID = $result['user_id'];
			
			//get rating from user table in database
			
			$query1 = mysqli_query($conn, "SELECT Elo FROM users WHERE user_id=".$_SESSION['user']);
			$result1 = mysql_fetch_array($query1) or die(mysql_error());
			$loserRating = $result1['Elo'];
			
			$query2 = mysqli_query($conn, "SELECT Elo FROM users WHERE user_id=".$Loser_ID);
			$result2 = mysql_fetch_array($query2) or die(mysql_error());
			$winnerRating = $result2['Elo'];
			
			$rating = new Rating($winnerRating, $loserRating, 1, 0);			
			$results = $rating->getNewRatings();
			
			$results = $rating->getNewRatings();
			if(mysqli_query($conn, "UPDATE users SET Elo = " . $results['b'] . " WHERE user_id=".$_SESSION['user']))
			{
				
			}
			else
			{
				?>
				<script>alert('There was an error while entering losers(user) ranking...');</script>
				<?php
			}
			if(mysql_query("UPDATE users SET Elo = " . $results['a'] . " WHERE user_id=".$Winner_ID))
			{

			}
			else
			{
				?>
				<script>alert('There was an error while entering winners(opp) ranking...');</script>
				<?php
			}
			
		}
		if(mysqli_query($conn, "INSERT INTO games(WinnerID,LoserID,PointsFor,PointsAgainst) VALUES('$Winner_ID','$Loser_ID','$userscore','$oppscore')"))
		{
			?>
			<script>alert('Your scores were successfully entered');</script>
			<?php
		}
		else
		{
			?>
			<script>alert('There was an error while entering your score...');</script>
			<?php
		}
	}
	else
	{
		?>
		<script>alert('There cannot be a tie in ping pong, please re-enter your scores...');</script>
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

    <title>Ping Pong Score Tracking</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
		<?php include("includes/navigation.php"); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
						<?php
						
						
						$user_id = $_SESSION['user'] ?? "";
						
						// Perform query
						if ($result = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$user_id'")) {
						  //echo "Returned rows are: " . mysqli_num_rows($result);
						  // Free result set

						  /* fetch associative array */
							while ($row = mysqli_fetch_assoc($result)) {
								$username = $row["username"];
							}
						}
						
						?>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
									<?php 
									if (empty($username)) {
										echo "";
									}
									else 
									{
										echo $username;
									}
									
									 ?>
								</span>
                                <img class="img-profile rounded-circle"
                                    src="img/kinnesotan.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Enter Scores</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    
                    <!-- Content Row -->

                    <div >
						<!-- Outer Row -->
        <div>

            <div class="col-xl-12 col-lg-12 col-md-12 ">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div>
                            <div>
                                <div class="p-5">
                                    <div class="text-center">
                                        <h3 class="h4 text-gray-900 mb-4">Winner Enters Scores Below</h3>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <select class="form-control custom-select-lg" id='opponent' name='opponent' />
											<option selected>Select</option>
											<?php
											
												$user_id = $_SESSION['user'] ?? "";
												$result = mysqli_query($conn, "SELECT username, user_id FROM users WHERE user_id!=".$user_id);
												$row = mysqli_fetch_assoc($result);
												$totalRows = mysqli_num_rows($result);
												
										
												
												
												do {  
													?>
													<option value="<?php echo $row['username'] ?>"<?php if (!(strcmp($row['username'], $row['username'])))  ?>><?php echo $row['username']?></option>
													<?php
												} while ($row = mysqli_fetch_assoc($result));
													  $rows = mysqli_num_rows($result);
													  if($rows > 0) {
													  mysqli_data_seek($result, 0);
													  $row = mysqli_fetch_assoc($result);
												  }
											?>
											
											</select>
                                        </div>
										<div class="form-group">
                                            <input class="form-control form-control-user" type="number" name="userscore" placeholder="Enter your score" required />
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control form-control-user" type="number" name="oppscore" placeholder="Enter opponent's score" required />
                                        </div>

										<button class="btn btn-primary btn-user btn-block" type="submit" name="btn-post" value="submit">Submit Scores</button>
                                        
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
                       
                            </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Ping Pong Tracker 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>