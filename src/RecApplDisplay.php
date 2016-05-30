<?php
include "database/db_connection.php";

page_protect ();



if (isset ( $_POST ['Admit'] )||isset ( $_POST ['Reject'] )) {
	$appID = $_POST["appid"];
	
	if ($_POST ['Admit'] == 'Admit') {
		$check_user_sql = "update Application set Status = 'Admitted' where applicationID ='$appID'";
		
		$result = mysqli_query ( $dbcon, $check_user_sql );
		header('Location:/futureniners/recruiterappreview.php');
		// Match row found with more than 1 results - the user is authenticated.
//		if (mysqli_num_rows ( $result ) > 0) {
//			
//			
//		} else {
//			$err [] = "Error - Invalid login. No such user exists";
//			// echo "<script>alert('username or password is incorrect!')</script>";
//			// header("Location: login.php");
//		}
	}


	if ($_POST ['Reject'] == 'Reject') {
		$check_user_sql = "update Application set Status = 'Rejected' where applicationID ='$appID'";
		
		$result = mysqli_query ( $dbcon, $check_user_sql );
		header('Location:/futureniners/recruiterappreview.php');
		
		// Match row found with more than 1 results - the user is authenticated.
//		if (mysqli_num_rows ( $result ) > 0) {
//			
//			
//		} else {
//			$err [] = "Error - Invalid login. No such user exists";
//			// echo "<script>alert('username or password is incorrect!')</script>";
//			// header("Location: login.php");
//		}
	}
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
    
        .btn-reject{color:#fff;background-color:#3d84e6;border-color:#3d84e6}.btn-reject:hover,.btn-reject:focus,.btn-reject:active,.btn-reject.active,.open>.dropdown-toggle.btn-reject{color:#fff;background-color:#FA0505;border-color:#FA0505}.btn-reject:active,.btn-reject.active,.open>.dropdown-toggle.btn-reject{background-image:none}.btn-reject.disabled,.btn-reject[disabled],fieldset[disabled] .btn-reject,.btn-reject.disabled:hover,.btn-reject[disabled]:hover,fieldset[disabled] .btn-reject:hover,.btn-reject.disabled:focus,.btn-reject[disabled]:focus,fieldset[disabled] .btn-reject:focus,.btn-reject.disabled:active,.btn-reject[disabled]:active,fieldset[disabled] .btn-reject:active,.btn-reject.disabled.active,.btn-reject[disabled].active,fieldset[disabled] .btn-reject.active{background-color:#FA0505;border-color:#FA0505}.btn-reject .badge{color:#FA0505;background-color:#fff}.
    </style>
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
				<a class="navbar-brand" href="RecruiterAppReview.php"> <img
					src="assets/images/logo.png" alt="Techro HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right mainNav">
					<li class="active"><a href="RecruiterAppReview.php">Home</a></li>
					<li><a href="logout.php">Sign Out</a></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>
	<!-- /.navbar -->

	<header id="head" class="secondary">
		<div class="container">
			<h1>Application under review</h1>
			<p>After review, update the status of the application!</p>
		</div>
	</header>

	<div>
		<section class="container">
			<div class="row">
				<!-- Article main content -->
				<content class="maincontent"> <br>
				<div>
<?php
if(isset($_SESSION ['recid'])){
$username=$_SESSION['user_name'];
$an = $_GET["appl"];
$sql = "SELECT * from Application where ApplicationId=$an";

$result = mysqli_query ( $dbcon, $sql );

if (mysqli_num_rows ( $result ) > 0) {
	
	// output data of each row
	while ( $row = mysqli_fetch_assoc ( $result ) ) {
		echo "<ul>";
		echo "<li><b>ApplicationId Id: </b>" . $row ["ApplicationId"] . "</li>";
		echo "</br>";
		echo "<li><b>Status: </b>" . $row ["Status"]; 
		echo "<br></br>";
		echo "<li><b>Application DATE: </b>" . $row ["ApplicationDATE"];
echo "<br></br>";
		echo "<li><b>High School GPA: </b>" . $row ["HighSchoolGPA"]; 
echo "<br></br>";
		echo "<li><b>SAT Score: </b>" . $row ["SATScore"]; 
echo "<br></br>";
		echo "<li><b>Undergrad GPA: </b>" . $row ["UndergradGPA"]; 
echo "<br></br>";
		echo "<li><b>GRE score: </b>" . $row ["GREscore"]; 
echo "<br></br>";
		echo "<li><b>TOEFL score: </b>" . $row ["TOEFLscore"]; 
echo "<br></br>";
		echo "<li><b>IELTSscore: </b>" . $row ["IELTSscore"]; 
		echo "</ul>";
		echo "<hr>";
	}
} else {
	echo "<p class= \" error\"> Sorry, No Departments found</p>";
}
echo "</tbody></table>";

	

?>
                    <form action="RecApplDisplay.php" method="post">
                    <input name="appid" value="<?php echo $an; ?>" hidden>
				
					                    <input class="btn btn-success" type="submit" value="Admit" name="Admit"> 
                    <input class="btn btn-reject" type="submit" value="Reject" name="Reject">
                    </form>

					</div>
<br>

				</content>
			</div>
		<?php echo "<a href=\"RecruiterAppReview.php\"> &#8592; Back to Review Applications </a>"; ?>
		</section>
	</div>

<?php }else{
	echo "<p class=\"error\">You should not be here.</p> Please go to <a href=index.php>Home</a>";
}?>





	<?php include("footer.php")?>