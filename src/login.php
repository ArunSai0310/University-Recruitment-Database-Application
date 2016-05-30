<?php
include ("database/db_connection.php");
// session_start (); // session starts here

if (isset ( $_SESSION ['user_name'] )) {
	header ( "Location: index.php" );
}

$err = array ();
foreach ( $_GET as $key => $value ) {
	$get [$key] = filter ( $value ); // get variables are filtered.
}

if (isset ( $_POST ['login'] )) {
	if ($_POST ['login'] == 'login') {
		
		foreach ( $_POST as $key => $value ) {
			$data [$key] = filter ( $value ); // post variables are filtered
		}
		$user_username = $data ['username'];
		$user_pass = $data ['pass'];
		
		$check_user_sql = "select userid,username,password,email,fname,mname,lname from users WHERE Username='$user_username'AND Password='$user_pass'";
		
		$result = mysqli_query ( $dbcon, $check_user_sql );
		
		// Match row found with more than 1 results - the user is authenticated.
		if (mysqli_num_rows ( $result ) > 0) {
			
			list ( $userid, $username, $password, $email, $fname, $mname, $lname ) = mysqli_fetch_row ( $result );
			// echo $username;
			// check against salt
			if ($_POST ['type'] == 'student') {
				$check_user_sql = "select userid,sid from student WHERE UserID='$userid'";
				
				$result2 = mysqli_query ( $dbcon, $check_user_sql );
				if (mysqli_num_rows ( $result2 ) == 1) {
					list ( $userid2, $sid ) = mysqli_fetch_row ( $result2 );
					$pwd = PwdHash ( $password, substr ( $password, 0, 9 ) );
					if ($pwd === PwdHash ( $user_pass, substr ( $password, 0, 9 ) )) {
						session_start ();
						
						session_regenerate_id ( true ); // prevent against session fixation attacks.
						                                
						// this sets variables in the session
						$_SESSION ['user_name'] = $username;
						$_SESSION ['user_email'] = $email;
						$_SESSION ['user_fname'] = $fname;
						$_SESSION ['user_mname'] = $mname;
						$_SESSION ['user_lname'] = $lname;
						$_SESSION ['sid'] = $sid;
						// $_SESSION['user_level'] = $user_level;
						$_SESSION ['HTTP_USER_AGENT'] = md5 ( $_SERVER ['HTTP_USER_AGENT'] );
						// $_SESSION['user'] = $user;
						header ( "Location: index.php" );
					} else {
						// $msg = urlencode("Invalid Login. Please try again with correct user email and password. ");
						$err [] = "Invalid Login. Please try again with correct user email and password.";
						 header("Location: login.php");
					}
				}
			}
			if ($_POST ['type'] == 'recruiter') {
				$check_user_sql = "select userid,recid from recruiter WHERE UserID='$userid'";
				
				$result2 = mysqli_query ( $dbcon, $check_user_sql );
				if (mysqli_num_rows ( $result2 ) == 1) {
					list ( $userid2, $recid ) = mysqli_fetch_row ( $result2 );
					$pwd = PwdHash ( $password, substr ( $password, 0, 9 ) );
					if ($pwd === PwdHash ( $user_pass, substr ( $password, 0, 9 ) )) {
						session_start ();
						
						session_regenerate_id ( true ); // prevent against session fixation attacks.
						                                
						// this sets variables in the session
						$_SESSION ['user_name'] = $username;
						$_SESSION ['user_email'] = $email;
						$_SESSION ['user_fname'] = $fname;
						$_SESSION ['user_mname'] = $mname;
						$_SESSION ['user_lname'] = $lname;
						$_SESSION ['recid'] = $recid;
						// $_SESSION['user_level'] = $user_level;
						$_SESSION ['HTTP_USER_AGENT'] = md5 ( $_SERVER ['HTTP_USER_AGENT'] );
						// $_SESSION['user'] = $user;
						header ( "Location: recruiterappreview.php" );
					} else {
						// $msg = urlencode("Invalid Login. Please try again with correct user email and password. ");
						$err [] = "Invalid Login. Please try again with correct user email and password.";
						 header("Location: login.php");
					}
				}
			}
		} else {
			$err [] = "Error - Invalid login. No such user exists";
			 echo "<script>alert('username or password is incorrect!')</script>";
		 header("Location: login.php",'_self');
		}
	}
}
?>


<html>
<head lang="en">
<meta charset="UTF-8">
<link type="text/css" rel="stylesheet"
	href="bootstrap-3.2.0-dist\css\bootstrap.css">
<title>Login</title>
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
</head>
<style>
.login-panel {
	margin-top: 150px;
}
</style>

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
			<!--/.nav-collapse -->
		</div>
	</div>
	<!-- /.navbar -->


	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-success">
					<div>
						<h3 class="panel-title">Sign In</h3>
					</div>
					<p><?php
					/**
					 * ****************** ERROR MESSAGES*************************************************
					 * This code is to show error messages
					 * ************************************************************************
					 */
					if (! empty ( $err )) {
						echo "<div class= \" alert alert-danger msg\">";
						foreach ( $err as $e ) {
							echo "$e <br>";
						}
						echo "</div>";
					}
					/**
					 * ***************************** END *******************************
					 */
					?></p>
					<div class="panel-body">
						<form role="form" method="post" action="login.php">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="username"
										name="username" type="username" autofocus>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="password" name="pass"
										type="password" value="">
								</div>
								<div class="form-group" align="center">
								<input type="radio" name="type" value="student" required>Student
								<input type="radio" name="type" value="recruiter">Recruiter
								</div>

								<input class="btn btn-lg btn-success btn-block" type="submit"
									value="login" name="login">
						</fieldset>
					</form>
					<center>
						<b>New User ?</b><a href="Registration.php">Sign Up</a>
					</center>
				</div>
			</div>
		</div>
	</div>
	</div>
	<br>
	<?php include("footer.php")?>