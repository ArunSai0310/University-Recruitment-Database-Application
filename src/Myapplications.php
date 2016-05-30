<?php
include "database/db_connection.php";

page_protect ();

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

.todo {color:red;}

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
					<li><a href="logout.php">Sign Out</a></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>
	<!-- /.navbar -->

	<header id="head" class="secondary">
		<div class="container">
			<h1>My Applications</h1>
			<p>Your applications for bright future!</p>
		</div>
	</header>


	<div>
		<section class="container">

			<div class="row">

				<!-- Article main content -->
				<content class="maincontent"> <br>
				<div>
<?php

$username=$_SESSION['user_name'];
$sid = $_SESSION['sid'];
$sql = "SELECT A.ApplicationId AS AppId, P.ProgName AS pname, A.ApplicationDATE AS appldate, 
		A.Status AS stat FROM application A, applies B, program P
		 WHERE 
		A.ApplicationID=B.ApplicationID AND P.ProgID=B.ProgID AND B.SID='$sid'";

	$result = mysqli_query ( $dbcon, $sql );
	if (mysqli_num_rows ( $result ) > 0) {
		
	echo "<table class=\"table \" summary=\"Table\" border=\"0\" cellspacing=\"2\" cellpadding=\"1\">
		<thead><tr align=\"left\" valign=\"top\" style=\"color:black;font-style:regular\"><th>Application ID*</th>
<th>Program Name</th><th>Application Date</th><th>Application Status</th>
</tr></thead><tbody>";
		// output data of each row
		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			
			$appl = $row ["AppId"];
			$apLink = "<a class = \"error\" href=ApplicationDisplay.php?appl=$appl>" . $row ["AppId"] . "</a>";
			
			echo "<tr align=\"left\" valign=\"top\" style=\"color:blue\"><td>" . "<h5>" .  $apLink . "</h5>" . "</td><td>" . $row ["pname"] . "</td><td>" . $row ["appldate"] . "</td><td>" . $row ["stat"] . "</td></tr>";
		}
	} else {
		echo "<p class= \" error\"> Sorry, No Applications found.</p> ";
		echo "Create a new application here - <a href=Apply.php>Apply Now</a>";
	}
	echo "</tbody></table>";
	echo "*See more details about application by clicking application id";

?>
</div>
<br>

				</content>
			</div>
		</section>
	</div>
	












	<?php include("footer.php")?>