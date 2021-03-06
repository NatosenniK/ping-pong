
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-table-tennis"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Ping Pong Tracker</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Nav Item - Dashboard -->
	<li class="nav-item active">
		<a class="nav-link" href="http://localhost/ping-pong/">
			<i class="fas fa-fw fa-home"></i>
			<span>Home</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Account Management
	</div>

	<!-- Nav Item - Pages Collapse Menu -->
	<li class="nav-item">
		
		<?php
		if(!isset($_SESSION['user']))
		{
			echo '<a class="nav-link" href="login.php">
				<i class="fas fa-sign-in-alt"></i>
				<span>Login</span></a>
				<a class="nav-link" href="register.php">
						<i class="fas fa-user"></i>
						<span>Register</span></a>';
		}
		else
		{
			//echo $_SESSION['user'];
			//header("Location: index.php");
			echo '<a class="nav-link" href="profile.php">
				<i class="fas fa-user"></i>
				<span>Profile</span></a>';
			echo '<a class="nav-link" href="logout.php">
				<i class="fas fa-sign-out-alt"></i>
				<span>Logout</span></a>';
			
		}
		?>
		<!--
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
			aria-expanded="true" aria-controls="collapseTwo">
			<i class="fas fa-fw fa-cog"></i>
			<span>My Account</span>
		</a>
		
		<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Account Management</h6>
				<a class="collapse-item" href="buttons.html">Login</a>
				<a class="collapse-item" href="cards.html">Register</a>
			</div>
		</div>
		-->
	</li>

	<!-- Nav Item - Utilities Collapse Menu -->
	<!--
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
			aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-fw fa-wrench"></i>
			<span>Utilities</span>
		</a>
		<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
			data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Custom Utilities:</h6>
				<a class="collapse-item" href="utilities-color.html">Colors</a>
				<a class="collapse-item" href="utilities-border.html">Borders</a>
				<a class="collapse-item" href="utilities-animation.html">Animations</a>
				<a class="collapse-item" href="utilities-other.html">Other</a>
			</div>
		</div>
	</li>
	-->
	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Score Tracking
	</div>

	<!-- Nav Item - Pages Collapse Menu -->
	<!--
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
			aria-expanded="true" aria-controls="collapsePages">
			<i class="fas fa-fw fa-folder"></i>
			<span>Pages</span>
		</a>
		<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header">Login Screens:</h6>
				<a class="collapse-item" href="login.html">Login</a>
				<a class="collapse-item" href="register.html">Register</a>
				<a class="collapse-item" href="forgot-password.html">Forgot Password</a>
				<div class="collapse-divider"></div>
				<h6 class="collapse-header">Other Pages:</h6>
				<a class="collapse-item" href="404.html">404 Page</a>
				<a class="collapse-item" href="blank.html">Blank Page</a>
			</div>
		</div>
	</li>
	-->
	<!-- Nav Item - Charts -->
	<li class="nav-item">
	<?php
		if(isset($_SESSION['user']))
		{
			//echo $_SESSION['user'];
			//header("Location: index.php");
			echo '<a class="nav-link" href="enter-scores.php">
				<i class="fas fa-table-tennis"></i>
				<span>Enter Scores</span></a>';
		}
		?>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="stats.php">
			<i class="fas fa-fw fa-chart-area"></i>
			<span>Stats</span></a>
	</li>

	<!-- Nav Item - Tables -->
	<li class="nav-item">
		<a class="nav-link" href="standings.php">
			<i class="fas fa-fw fa-table"></i>
			<span>Standings</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

	<!-- Sidebar Message -->
	<!--
	<div class="sidebar-card">
		<img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="">
		<p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
		<a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
	</div>
	-->

</ul>
<!-- End of Sidebar -->