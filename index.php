<?php
session_start();
include_once 'includes/dbconnect.php';
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

                <?php include("includes/top-bar.php"); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Ping Pong Tracker Stats</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Quick Stats Section -->
                    
					<?php include("includes/quick-stats.php"); ?>

                    <!-- Quick Stats Section -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Games Played</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
										<!--
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
										-->
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="col-xl-6 col-lg-6">
                        <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Player Ratings</h6>
                                </div>
                                <div class="card-body player-ratings">
								<?php
												if($res = mysqli_query($conn, "SELECT  username,
														SUM(wins),
														SUM(loss),
														SUM(PF),
														SUM(PA),
														elo
														FROM (
														(SELECT users.user_ID,
															users.username AS username,
															COUNT(games.WinnerID) AS wins,
															0 AS loss,
															SUM(games.PointsFor) AS PF,
															SUM(games.PointsAgainst) AS PA,
															users.Elo AS elo
														FROM users, games
														WHERE games.WinnerID = users.user_ID
														GROUP BY users.user_ID)
														UNION ALL
														(SELECT users.user_ID,
															users.username AS username,
															0 AS wins,
															COUNT(games.LoserID) AS loss,
															SUM(games.PointsAgainst) AS PF,
															SUM(games.PointsFor) AS PA,
															users.Elo AS elo
														FROM users, games
														WHERE games.LoserID = users.user_ID
														GROUP BY users.user_ID)
														) AS t
														GROUP BY username
														ORDER BY elo desc
														LIMIT 6;")) {
															$i = 0;
															while($row = mysqli_fetch_assoc($res))
															{
															 ?>
															  <h4 class="small font-weight-bold"><?php echo $row['username']; ?><span
																		class="float-right"><?php echo $row['elo']; ?></span></h4>
																<div class="progress mb-4">
																	<?php 
																		$elo = $row['elo'];
																		$max = $elo + 100;
																		$width = ($elo / 1750) * 100;
																		
																	?>
																	<div class="progress-bar bar-<?php echo $i; $i++ ?>" role="progressbar" style="width: <?php echo $width;?>%"
																		aria-valuenow="20" aria-valuemin="0" aria-valuemax="2000"></div>
																</div>

																<?php
															}
														} else {
															echo("Error description: " . mysqli_error($conn));
														}
											?>	
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
                        <span>Copyright &copy; Ping Pong Tracker <?php echo date("Y"); ?></span>
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
     <?php include("includes/logout.php"); ?>

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