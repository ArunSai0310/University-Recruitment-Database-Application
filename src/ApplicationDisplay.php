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
	$appl = $_GET ['appl'];
	$check_appl_sql = "SELECT ApplicationId,
    ApplicationDATE,Status,HighSchoolGPA,SATScore, UndergradGPA,GREscore,GREverbalScore,GREquantitativeScore,
    GREanalyticalWritingScore,TOEFLscore,TOEFLreading,TOEFLlistening,TOEFLspeaking,TOEFLwriting,IELTSscore,
    RecID FROM application where ApplicationId = '$appl'";
	
	$result2 = mysqli_query ( $dbcon, $check_appl_sql );
	if (mysqli_num_rows ( $result2 ) == 1) {
		
		list ( $ApplicationId, $ApplicationDATE, $Status, $HighSchoolGPA,
				 $SATScore, $UndergradGPA, $GREscore, $GREverbalScore, $GREquantitativeScore,
				 $GREanalyticalWritingScore, $TOEFLscore, $TOEFLreading, $TOEFLlistening, $TOEFLspeaking,
				 $TOEFLwriting, $IELTSscore, $RecID ) = mysqli_fetch_row ( $result2 );
		
		$get_recom = "SELECT ApplicationID,fName,lName,AddressLine1,AddressLine2,City,State,Country,Email,
    recommendation_id FROM recommendations where ApplicationId = '$ApplicationId'";
		
		$result2 = mysqli_query ( $dbcon, $get_recom );
		$i = 0;
		if (mysqli_num_rows ( $result2 ) == 2) {//Get recommendation
			while ( $row = mysqli_fetch_assoc ( $result2 ) ) {
				$r_fname [$i] = $row ["fName"];
				$r_lname [$i] = $row ["lName"];
				$r_AddressLine1 [$i] = $row ["AddressLine1"];
				$r_AddressLine2 [$i] = $row ["AddressLine2"];
				$r_City [$i] = $row ["City"];
				$r_State [$i] = $row ["State"];
				$r_Country [$i] = $row ["Country"];
				$r_Email [$i] = $row ["Email"];
				$r_id [$i] = $row ["recommendation_id"];
				$i = $i + 1;
			}
		}else if(mysqli_num_rows ( $result2 ) == 1){
			while ( $row = mysqli_fetch_assoc ( $result2 ) ) {
				$r_fname [0] = $row ["fName"];
				$r_lname [0] = $row ["lName"];
				$r_AddressLine1 [0] = $row ["AddressLine1"];
				$r_AddressLine2 [0] = $row ["AddressLine2"];
				$r_City [0] = $row ["City"];
				$r_State [0] = $row ["State"];
				$r_Country [0] = $row ["Country"];
				$r_Email [0] = $row ["Email"];
				$r_id [0] = $row ["recommendation_id"];
			}
			$r_fname [1] = null;
			$r_lname [1] = null;
			$r_AddressLine1 [1] = null;
			$r_AddressLine2 [1] = null;
			$r_City [1] = null;
			$r_State [1] = null;
			$r_Country [1] = null;
			$r_Email [1] = null;
			$r_id [1] = null;
		}else if(mysqli_num_rows ( $result2 ) == 0){
			$i=0;
			while ( $i<2 ) {
				$r_fname [$i] = null;
				$r_lname [$i] = null;
				$r_AddressLine1 [$i] = null;
				$r_AddressLine2 [$i] = null;
				$r_City [$i] = null;
				$r_State [$i] = null;
				$r_Country [$i] = null;
				$r_Email [$i] = null;
				$r_id [$i] = null;
				$i = $i+1;
			}
		}
		
		
		//Get work experience
		$get_work = "SELECT ApplicationID,CompanyName,Location,StartDATE,EndDATE,workexperienceid
					FROM workexperience where ApplicationId = '$ApplicationId'";
		
		$result2 = mysqli_query ( $dbcon, $get_work );
		$i = 0;
		if (mysqli_num_rows ( $result2 ) == 2) {
			while ( $row = mysqli_fetch_assoc ( $result2 ) ) {
				$w_company [$i] = $row ["CompanyName"];
				$w_location [$i] = $row ["Location"];
				$w_startdate [$i] = $row ["StartDATE"];
				$w_enddate [$i] = $row ["EndDATE"];
				$w_exid [$i] = $row ["workexperienceid"];
				$i=$i+1;
			}
				
		}else if(mysqli_num_rows ( $result2 ) == 1){
			while ( $row = mysqli_fetch_assoc ( $result2 ) ) {
				$w_company [0] = $row ["CompanyName"];
				$w_location [0] = $row ["Location"];
				$w_startdate [0] = $row ["StartDATE"];
				$w_enddate [0] = $row ["EndDATE"];
				$w_exid [0] = $row ["workexperienceid"];
			}
			$w_company [1] = null;
			$w_location [1] = null;
			$w_startdate [1] = null;
			$w_enddate [1] = null;
			$w_exid [1] = null;
		}else if(mysqli_num_rows ( $result2 ) == 0){
			$i=0;
			while ($i<2) {
				$w_company [$i] = null;
				$w_location [$i] = null;
				$w_startdate [$i] = null;
				$w_enddate [$i] = null;
				$w_exid [$i] = null;
				$i = $i+1;
			}
		}
		
		$get_prog = "select progName, deptname from program p, department d,
		 applies a where a.progid = p.progid and p.DeptID = d.DeptID and 
		ApplicationId ='$ApplicationId'";
		
		$result2 = mysqli_query ( $dbcon, $get_prog );
		if (mysqli_num_rows ( $result2 ) == 1) {
			
			list ( $progName, $deptname ) = mysqli_fetch_row ( $result2 );
		}
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
				<h4 style="color: Blue; font-style: italic">Application ID:&nbsp;<?php echo $ApplicationId; ?></h4>
			</div>
		</div>
		<form method="post" action="UpdateApplication.php" name="applyname"
			id="applyid">
			<fieldset>
				<br> <input name="sid" value="<?php echo $sid; ?>" readonly hidden>
				<input name="recid" value="<?php echo $RecID; ?>" readonly hidden>
				<input name="appid" value="<?php echo $appl; ?>" readonly hidden>
				
				<input name="r1_id" value="<?php echo $r_id [0]; ?>" readonly hidden>
				<input name="r2_id" value="<?php echo $r_id [1]; ?>" readonly hidden>
				
				<input name="w1_id" value="<?php echo $w_exid[0]; ?>" readonly hidden>
				<input name="w2_id" value="<?php echo $w_exid[1]; ?>" readonly hidden>
				
				<?php //echo "w1:".$w_exid[0]." w2:".$w_exid[1];?>
				<div class="row">
					<div class="col-md-3" align="left">
						<b>First Name:&nbsp;</b> <input name="student_fname"
							class="bluedata" value="<?php echo $user_fname; ?>" readonly>
					</div>
					<div class="col-md-3" align="left">
						<b>Middle Name:&nbsp;</b> <input name="student_mname"
							class="bluedata" value="<?php echo $user_mname; ?>" readonly>
					</div>
					<div class="col-md-3" align="left">
						<b>Last Name:&nbsp;</b> <input name="student_lname"
							class="bluedata" value="<?php echo $user_lname; ?>" readonly>
					</div>
					<div class="col-md-3" align="left">
						<b>Application Date:&nbsp;</b> <input name="Application_date"
							class="bluedata" value="<?php echo $ApplicationDATE; ?>" readonly>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-3" align="left">
						<b>Email:&nbsp;</b> <input name="student_email" class="bluedata"
							value="<?php echo $user_email; ?>" readonly>
					</div>
					<div class="col-md-3" align="left">
					Program:&nbsp;<i  style="color: Blue"><?php echo $progName; ?></i>
					
					</div>
					<div class="col-md-3" align="left">
				Department:&nbsp;<i  style="color: Blue"><?php echo $deptname?></i>				
	</div>
					<div class="col-md-3" align="center">
						<b>Status:&nbsp;</b> <span name="status" class="reddata"><?php echo $Status?>	  </span>
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
						<b>Quant:&nbsp;</b> <input type="number" min="130" max="170"
							id="quantid" value="<?php echo $GREquantitativeScore;?>"
							name="quant" onchange="gretotalfunc()" required>
					</div>
					<div class="col-md-2" align="left">
						<b>Verbal:&nbsp;</b> <input type="number" min="130" max="170"
							id="verbalid" value="<?php echo $GREverbalScore;?>" name="verbal"
							onchange="gretotalfunc()" required>
					</div>
					<div class="col-md-2" align="left">
						<b>AWA:&nbsp;</b> <input type="number" min="0" max="6"
							value="<?php echo $GREanalyticalWritingScore;?>" name="awa"
							required>
					</div>
					<div class="col-md-2" align="left">
						<b>Total:&nbsp;</b> <input type="number" min="260" max="340"
							id="gretotalid" value="<?php echo $GREscore;?>" name="gretotal"
							readonly required>
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
						<b>Reading:&nbsp;</b> <input type="number" min="10" max="30"
							id="readingid" value="<?php echo $TOEFLreading;?>" name="reading"
							onchange="toeflfunc()" required>
					</div>
					<div class="col-md-2" align="left">
						<b>Speaking:&nbsp;</b> <input type="number" min="10" max="30"
							id="speakingid" value="<?php echo $TOEFLspeaking;?>"
							name="speaking" onchange="toeflfunc()" required>
					</div>
					<div class="col-md-2" align="left">
						<b>Listening:&nbsp;</b> <input type="number" min="10" max="30"
							id="listeningid" value="<?php echo $TOEFLlistening;?>"
							name="listening" onchange="toeflfunc()" required>
					</div>
					<div class="col-md-2" align="left">
						<b>Writing:&nbsp;</b> <input type="number" min="10" max="30"
							id="writingid" value="<?php echo $TOEFLwriting;?>" name="writing"
							onchange="toeflfunc()" required>
					</div>
					<div class="col-md-2" align="left">
						<b>Total:&nbsp;</b> <input type="number" min="40" max="120"
							id="toefltotalid" value="<?php echo $TOEFLscore;?>"
							name="toefltotal" readonly required>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6" align="left">
						<b><u>IELTS:&nbsp;</u></b> <input type="number" min="0" max="9"
							id="ielts" value="<?php echo $IELTSscore;?>" name="ielts">

					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-4" align="left">
						<b><u>UnderGraduation GPA:&nbsp;</u></b> <input type="number"
							min="2" max="4" id="gpa" value="<?php echo $UndergradGPA;?>" name="gpa" step=".1" required>/4
					</div>
					<div class="col-md-4" align="left">
						<b><u>High School GPA:&nbsp;</u></b> <input type="number" min="2"
							max="4" id="highschoolgpa" value="<?php echo $HighSchoolGPA;?>" name="highschoolgpa"
							step=".1" required>/4
					</div>
					<div class="col-md-4" align="left">
						<b><u>SAT Score:&nbsp;</u></b> <input type="number" min="0"
							max="2400" id="satscore" value="<?php echo $SATScore;?>" name="satscore" step="10">/2400
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6" align="left">
						<b><u>Recommendation:&nbsp;</u></b>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="row">
						<div class="col-md-3" align="left">
							<b>1. First Name:&nbsp;</b> <input id="r1_fname" name="r1_fname"
								value="<?php echo $r_fname[0];?>" required>
						</div>
						<div class="col-md-3" align="left">
							<b>Last Name:&nbsp;</b> <input id="r1_lname" name="r1_lname"
								value="<?php echo $r_lname[0];?>" required>
						</div>
						<div class="col-md-3" align="left">
							<b>Email:&nbsp;</b> <input type="email" id="r1_email" value="<?php echo $r_Email[0];?>"
								name="r1_email" required>
						</div>
						<div class="col-md-3" align="left">
							<b>Line 1:&nbsp;</b> <input id="r1_line1" name="r1_line1"
								value="<?php echo $r_AddressLine1[0];?>" required>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3" align="left">
							<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Line 2:&nbsp;</b> <input
								id="r1_line2" name="r1_line2" value="<?php echo $r_AddressLine2[0];?>">
						</div>
						<div class="col-md-3" align="left">
							<b>City:&nbsp;</b> <input id="r1_city" name="r1_city" value="<?php echo $r_City[0];?>"
								required>
						</div>
						<div class="col-md-3" align="left">
							<b>State:&nbsp;</b> <input id="r1_state" name="r1_state" value="<?php echo $r_State[0];?>"
								required>
						</div>
						<div class="col-md-3" align="left">
							<b>Country:&nbsp;</b> <input id="r1_country" name="r1_country"
								value="<?php echo $r_Country[0];?>" required>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="row">
						<div class="col-md-3" align="left">
							<b>2. First Name:&nbsp;</b> <input id="r2_fname" name="r2_fname"
								value="<?php echo $r_fname[1];?>" required>
						</div>
						<div class="col-md-3" align="left">
							<b>Last Name:&nbsp;</b> <input id="r2_lname" name="r2_lname"
								value="<?php echo $r_lname[1];?>" required>
						</div>
						<div class="col-md-3" align="left">
							<b>Email:&nbsp;</b> <input type="email" id="r2_email" value="<?php echo $r_Email[1];?>"
								name="r2_email" required>
						</div>
						<div class="col-md-3" align="left">
							<b>Line 1:&nbsp;</b> <input id="r2_line1" name="r2_line1"
								value="<?php echo $r_AddressLine1[1];?>" required>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3" align="left">
							<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Line 2:&nbsp;</b> <input
								id="r2_line2" name="r2_line2" value="<?php echo $r_AddressLine2[1];?>">
						</div>
						<div class="col-md-3" align="left">
							<b>City:&nbsp;</b> <input id="r2_city" name="r2_city" value="<?php echo $r_City[1];?>"
								required>
						</div>
						<div class="col-md-3" align="left">
							<b>State:&nbsp;</b> <input id="r2_state" name="r2_state" value="<?php echo $r_State[1];?>"
								required>
						</div>
						<div class="col-md-3" align="left">
							<b>Country:&nbsp;</b> <input id="r2_country" name="r2_country"
								value="<?php echo $r_Country[1];?>" required>
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
								value="<?php echo $w_company[0];?>">
						</div>
						<div class="col-md-4" align="left">
							<b>Location:&nbsp;</b> <input id="w1_location" name="w1_location"
								value="<?php echo $w_location[0];?>">
						</div>
						<div class="col-md-4" align="left">
							<b>Start Date:&nbsp;</b> <input type="date" min="2000-01-01"
								id="w1_startdate" name="w1_startdate" value="<?php echo $w_startdate[0];?>">
						</div>
						<div class="col-md-4" align="left">
							<b>End Date:&nbsp;</b> <input type="date" min="2000-01-01"
								id="w1_enddate" name="w1_enddate" value="<?php echo $w_enddate[0];?>">
						</div>
						<br>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4" align="left">
							<b>2. CompanyName:</b> <input id="w2_company" name="w2_company"
								value="<?php echo $w_company[1];?>">
						</div>
						<div class="col-md-4" align="left">
							<b>Location:&nbsp;</b> <input id="w2_location" name="w2_location"
								value="<?php echo $w_location[1];?>">
						</div>
						<div class="col-md-4" align="left">
							<b>Start Date:&nbsp;</b> <input type="date" min="2000-01-01"
								id="w2_startdate" name="w2_startdate" value="<?php echo $w_startdate[1];?>">
						</div>
						<div class="col-md-4" align="left">
							<b>End Date:&nbsp;</b> <input type="date" min="2000-01-01"
								id="w2_enddate" name="w2_enddate" value="<?php echo $w_enddate[1];?>">
						</div>
						<br>
					</div>
				</div>
				<hr>

<?php
if (isset ( $_GET ['appl'] )) {
	$AppId = $_GET ['appl'];
	$check_appl_sql = "select status from application WHERE ApplicationId = '$AppId'";
	$result = mysqli_query ( $dbcon, $check_appl_sql );
	if (mysqli_num_rows ( $result ) == 1) {
		list ( $appstatus ) = mysqli_fetch_row ( $result );
		if ($appstatus != 'Not Submitted') {
			echo "<a href=\"Myapplications.php\"> <- Back to MyApplications </a>";

						} else {
							echo "<div class=\"row\" align=\"left\" name = \"buttons\">
							
							<div class=\"col-md-3\" align=\"center\"></div>
							<div class=\"col-md-3\" align=\"center\" style=\"width: 200px\">
							<input class=\"btn btn-success btn-block\" type=\"submit\"
									value=\"Save for Later\" name=\"save\" />
							</div>
							<div class=\"col-md-3\" align=\"center\" style=\"width: 200px\">
								<input class=\"btn btn-success btn-block\" type=\"submit\"
											value=\"Submit\" name=\"submit\" />
							</div>
							<div class=\"col-md-3\" align=\"left\" style=\"width: 200px\">
								<input class=\"btn btn-success btn-block2\" type=\"reset\"
										value=\"reset\" name=\"reset\" />
							</div>
							</div>";
							
							echo "<a href=\"Myapplications.php\"> &#8592; Back to MyApplications </a>";
						}
					}
				}else{
					header("Location: Myaaplications.php",'_self');
				}
				
?>



</fieldset>
		</form>
	</div>
<?php include("footer.php")?>