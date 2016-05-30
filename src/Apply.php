<?php
include "database/db_connection.php";

page_protect ();

if (isset ( $_SESSION ['user_name'] )) {
	
	$user_name = $_SESSION ['user_name'];
	$user_email = $_SESSION ['user_email'];
	$user_fname = $_SESSION ['user_fname'];
	$user_mname = $_SESSION ['user_mname'];
	$user_lname = $_SESSION ['user_lname'];
	$sid = $_SESSION ['sid'];
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
</head>

<style>
.bluedata {
	color: blue;
}

.reddata {
	color: red;
}
</style>
<script>
function gretotalfunc() {
var t1 = document.getElementById("quantid").value;
var t2 = document.getElementById("verbalid").value;
t1 = Number(t1)+Number(t2);
document.getElementById("gretotalid").value = t1; 
}
function toeflfunc() {
	var t1 = document.getElementById("readingid").value;
	var t2 = document.getElementById("writingid").value;
	var t3 = document.getElementById("listeningid").value;
	var t4 = document.getElementById("speakingid").value;
	t1 = Number(t1)+Number(t2)+Number(t3)+Number(t4);
	document.getElementById("toefltotalid").value = t1; 
	}
</script>
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

	<!-- 	<header class="secondary">
		<div class="container">
			<h1>Apply for Admission</h1>
		</div>
	</header> -->

	<div class="container">
		<div class="panel panel-success">
			<div>
				<h3 style="color: Blue; font-style: italic">Apply for Admission</h3>
			</div>
		</div>
		<form method="post" action="InsertApplication.php" name="applyname"
			id="applyid">
			<fieldset>
				<br>
				<input name="sid" value = <?php echo $sid ?> readonly hidden>

				<div class="row">
					<div class="col-md-3" align="left">
						<b>First Name:&nbsp;</b> 
						<input name="student_fname"
							class="bluedata" value=<?php echo $user_fname; ?>	readonly>
					</div>
					<div class="col-md-3" align="left">
						<b>Middle Name:&nbsp;</b> 
						<input name="student_mname"
							class="bluedata" value=<?php echo $user_mname; ?>	readonly>
					</div>
					<div class="col-md-3" align="left">
						<b>Last Name:&nbsp;</b> 
						<input name="student_lname"
							class="bluedata" value=<?php echo $user_lname; ?> readonly>
					</div>
					<div class="col-md-3" align="left">
						<b>Application Date:&nbsp;</b> 
						<input name="Application_date"
							class="bluedata" value = <?php echo date("Y-m-d"); ?>	readonly>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-3" align="left">
						<b>Email:&nbsp;</b> 
						<input name="student_email" class="bluedata" value=	<?php echo $user_email; ?> readonly>
					</div>
					<div class="col-md-3" align="left">
					<?php
					
					$sql = "select distinct ProgName from program order by ProgName desc";
					$result = mysqli_query ( $dbcon, $sql );
					
					if (mysqli_num_rows ( $result ) > 0) {
						echo "<select name=\"program\" required>";
						echo "<option value=\"\">Select a Program:</option>";
						while ( $row = mysqli_fetch_assoc ( $result ) ) {
							echo "<option>" . $row ["ProgName"] . "</option>";
						}
						echo "</select>";
					}
					
					?>
					
					</div>
					<div class="col-md-3" align="left">
					<?php
					
					$sql = "select distinct deptName from department order by DeptName asc";
					$result = mysqli_query ( $dbcon, $sql );
					
					if (mysqli_num_rows ( $result ) > 0) {
						echo "<select name=\"dept\" required>";
						echo "<option value=\"\">Select a Department:</option>";
						while ( $row = mysqli_fetch_assoc ( $result ) ) {
							echo "<option>" . $row ["deptName"] . "</option>";
						}
						echo "</select>";
					}
					
					?>
					</div>
					<div class="col-md-3" align="center">
						<b>Status:&nbsp;</b> <span name="status" class="reddata"> Not
							Submitted </span>
					</div>
				</div>
				<br>
				<hr>

				<div class="row">
					<div class="col-md-12" align="left">
						<b><u>GRE:&nbsp;</u></b>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2" align="left">
						<b>Quant*:&nbsp;</b> <input type="number" min="130" max="170"
							id="quantid" value="130" name="quant" onchange="gretotalfunc()"
							required>
					</div>
					<div class="col-md-2" align="left">
						<b>Verbal*:&nbsp;</b> <input type="number" min="130" max="170"
							id="verbalid" value="130" name="verbal" onchange="gretotalfunc()"
							required>
					</div>
					<div class="col-md-2" align="left">
						<b>AWA*:&nbsp;</b> <input type="number" min="0" max="6"
							value="0" name="awa" required>
					</div>
					<div class="col-md-2" align="left">
						<b>Total:&nbsp;</b> <input type="number" min="260" max="340"
							id="gretotalid" value="260" name="gretotal" readonly required>
					</div>

				</div>
				<br>
				<hr>
				<div class="row">
					<div class="col-md-12" align="left">
						<b><u>TOEFL:&nbsp;</u></b>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2" align="left">
						<b>Reading*:&nbsp;</b> <input type="number" min="10" max="30"
							id="readingid" value="10" name="reading" onchange="toeflfunc()"
							required>
					</div>
					<div class="col-md-2" align="left">
						<b>Speaking*:&nbsp;</b> <input type="number" min="10" max="30"
							id="speakingid" value="10" name="speaking" onchange="toeflfunc()"
							required>
					</div>
					<div class="col-md-2" align="left">
						<b>Listening*:&nbsp;</b> <input type="number" min="10" max="30"
							id="listeningid" value="10" name="listening" onchange="toeflfunc()"
							required>
					</div>
					<div class="col-md-2" align="left">
						<b>Writing*:&nbsp;</b> <input type="number" min="10" max="30"
							id="writingid" value="10" name="writing" onchange="toeflfunc()"
							required>
					</div>
					<div class="col-md-2" align="left">
						<b>Total:&nbsp;</b> <input type="number" min="40" max="120"
							id="toefltotalid" value="40" name="toefltotal" readonly required>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6" align="left">
						<b><u>IELTS:&nbsp;</u></b> <input type="number" min="0" max="9"
							id="ielts" value="0" name="ielts">

					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-4" align="left">
						<b><u>UnderGraduation GPA*:&nbsp;</u></b> <input type="number"
							min="2" max="4" id="gpa" value="2" name="gpa" step=".1" required>/4
					</div>
					<div class="col-md-4" align="left">
						<b><u>High School GPA*:&nbsp;</u></b> <input type="number"
							min="2" max="4" id="highschoolgpa" value="2" name="highschoolgpa" step=".1" required>/4
					</div>
					<div class="col-md-4" align="left">
						<b><u>SAT Score:&nbsp;</u></b> <input type="number"
							min="600" max="2400" id="satscore" value="600" name="satscore" step="10" >/2400
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6" align="left">
						<b><u>Recommendation*(provide 2 recommendations):&nbsp;</u></b>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="row">
						<div class="col-md-3" align="left">
							<b>1. First Name:&nbsp;</b> <input id="r1_fname" name="r1_fname"
								value="" required>
						</div>
						<div class="col-md-3" align="left">
							<b>Last Name:&nbsp;</b> <input id="r1_lname" name="r1_lname"
								value="" required>
						</div>
						<div class="col-md-3" align="left">
							<b>Email:&nbsp;</b> <input type="email" id="r1_email"
								name="r1_email" required>
						</div>
						<div class="col-md-3" align="left">
							<b>Line 1:&nbsp;</b> <input id="r1_line1" name="r1_line1"
								value="" required>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3" align="left">
							<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Line 2:&nbsp;</b> <input
								id="r1_line2" name="r1_line2" value="">
						</div>
						<div class="col-md-3" align="left">
							<b>City:&nbsp;</b> <input id="r1_city" name="r1_city" value=""
								required>
						</div>
						<div class="col-md-3" align="left">
							<b>State:&nbsp;</b> <input id="r1_state" name="r1_state" value=""
								required>
						</div>
						<div class="col-md-3" align="left">
							<b>Country:&nbsp;</b> <input id="r1_country" name="r1_country"
								value="" required>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="row">
						<div class="col-md-3" align="left">
							<b>2. First Name:&nbsp;</b> <input id="r2_fname" name="r2_fname"
								value="" required>
						</div>
						<div class="col-md-3" align="left">
							<b>Last Name:&nbsp;</b> <input id="r2_lname" name="r2_lname"
								value="" required>
						</div>
						<div class="col-md-3" align="left">
							<b>Email:&nbsp;</b> <input type="email" id="r2_email"
								name="r2_email" required>
						</div>
						<div class="col-md-3" align="left">
							<b>Line 1:&nbsp;</b> <input id="r2_line1" name="r2_line1"
								value="" required>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3" align="left">
							<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Line 2:&nbsp;</b> <input
								id="r2_line2" name="r2_line2" value="">
						</div>
						<div class="col-md-3" align="left">
							<b>City:&nbsp;</b> <input id="r2_city" name="r2_city" value=""
								required>
						</div>
						<div class="col-md-3" align="left">
							<b>State:&nbsp;</b> <input id="r2_state" name="r2_state" value=""
								required>
						</div>
						<div class="col-md-3" align="left">
							<b>Country:&nbsp;</b> <input id="r2_country" name="r2_country"
								value="" required>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6" align="left">
						<b><u>Work Experience (if applicable):&nbsp;</u></b>
					</div>
				</div>
				<br>
				<div class="row" id="workex">
					<div class="row">
						<div class="col-md-4" align="left">
							<b>1. CompanyName:</b> <input id="w1_company" name="w1_company"
								value="">
						</div>
						<div class="col-md-4" align="left">
							<b>Location:&nbsp;</b> <input id="w1_location" name="w1_location"
								value="">
						</div>
						<div class="col-md-4" align="left">
							<b>Start Date:&nbsp;</b> <input type="date" min="2000-01-01"
								id="w1_startdate" name="w1_startdate" value="">
						</div>
						<div class="col-md-4" align="left">
							<b>End Date:&nbsp;</b> <input type="date" min="2000-01-01"
								id="w1_enddate" name="w1_enddate" value="">
						</div>
						<br>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4" align="left">
							<b>2. CompanyName:</b> <input id="w2_company" name="w2_company"
								value="">
						</div>
						<div class="col-md-4" align="left">
							<b>Location:&nbsp;</b> <input id="w2_location" name="w2_location"
								value="">
						</div>
						<div class="col-md-4" align="left">
							<b>Start Date:&nbsp;</b> <input type="date" min="2000-01-01"
								id="w2_startdate" name="w2_startdate" value="">
						</div>
						<div class="col-md-4" align="left">
							<b>End Date:&nbsp;</b> <input type="date" min="2000-01-01"
								id="w2_enddate" name="w2_enddate" value="">
						</div>
						<br>
					</div>
				</div>
				<hr>
				<div class="row" align="left">

					<div class="col-md-3" align="center"></div>
					<div class="col-md-3" align="center" style="width: 200px">
						<input class="btn btn-success btn-block" type="submit"
							value="Save for Later" name="save" />
					</div>
					<div class="col-md-3" align="center" style="width: 200px">
						<input class="btn btn-success btn-block" type="submit"
							value="Submit" name="submit" />
					</div>
					<div class="col-md-3" align="left" style="width: 200px">
						<input class="btn btn-success btn-block2" type="reset"
							value="reset" name="reset" />
					</div>
				</div>
			</fieldset>
		</form>


	</div>

	

<?php include("footer.php")?>