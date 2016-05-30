<?php
session_start ();
if (isset ( $_SESSION ['user_name'] )) {
	
	$usr = $_SESSION ['user_name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Future Niners</title>
<link rel="favicon" href="assets/images/favicon.png">
<link rel="stylesheet" media="screen"
	href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/bootstrap-theme.css"
	media="screen">
<link rel="stylesheet" href="assets/css/style.css">
<link rel='stylesheet' id='camera-css' href='assets/css/camera.css'
	type='text/css' media='all'>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->

<style>
.login-panel {
	margin-top: 150px;
}

.error {
	color: red;
}

.success {
	color: green;
}

.todo {
	color: red;
}
</style>

</head>
<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span class="icon-bar"></span><span class="icon-bar"></span><span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"> <img
					src="assets/images/logo.png" alt="Techro HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right mainNav">
					<li><a href="index.php">Home</a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">Apply <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="ApplicationReq.php">Application Requirements</a></li>
							<li><a href="Apply.php">Apply</a></li>
							<li><a href="Myapplications.php">My Applications</a></li>
						</ul></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">Departments<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="ListofDepts.php">List of Departments</a></li>
							<li><a href="Facilities.php">Facilities</a></li>
							<li><a href="VisitingCompanies.php">Visiting Companies</a></li>
							<li><a href="Scholarships.php">Scholarships</a></li>
							<li><a href="Research.php">Research</a></li>
							<li><a href="Faculty.php">Faculty</a></li>
							<li><a href="Jobs.php">Jobs</a></li>
						</ul></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">Programs<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="Tuitionfee.php">Tuition Fees</a></li>
							<li><a href="programs.php">Program Listing</a></li>
						</ul>
					
					<li>
				
				</ul>
			</div>

			<p><?php
			/**
			 * ****************** Session MESSAGES*************************************************
			 * This code is to show session messages
			 * ************************************************************************
			 */
			if (! empty ( $usr )) {
				echo "<div align = right class= \" success\">";
				// foreach ( $usr as $e ) {
				// echo "$e <br>";
				// }
				echo "Welcome, " . $usr . ". ";
				echo "<a href=\"logout.php\">Sign Out</a>";
				echo "</div>";
			} else {
				echo "<div align=right class= \" success\">";
				// foreach ( $usr as $e ) {
				// echo "$e <br>";
				// }
				echo "<a href=\"login.php\">Sign In</a>";
				echo "</div>";
			}
			/**
			 * ***************************** END *******************************
			 */
			?></p>
			<!--/.nav-collapse -->
			<hr>
		</div>
	</div>
	<!-- /.navbar -->







	<!-- 
	<header id="head">
		<div class="container">
             <div class="heading-text">							
							<h1 class="animated flipInY delay1">Welcome to UNC at Charlotte</h1>
							<p>Free Online education template for elearning and online education institute.</p>
						</div>
            
					<div class="fluid_container">                       
                    <div class="camera_wrap camera_emboss pattern_1" id="camera_wrap_4">
                        <div data-thumb="assets/images/slides/thumbs/img1.jpg" data-src="assets/images/slides/img1.jpg">
                            <h2>We develop.</h2>
                        </div> 
                        <div data-thumb="assets/images/slides/thumbs/img2.jpg" data-src="assets/images/slides/img2.jpg">
                        </div>
                        <div data-thumb="assets/images/slides/thumbs/img3.jpg" data-src="assets/images/slides/img3.jpg">
                        </div> 
                    </div> #camera_wrap_3
                </div>.fluid_container
		</div>
	</header>
  -->