<?php
include ("database/db_connection.php"); // make connection here
include ("validateuser.php"); 

if (isset ( $_POST ['register'] )) {
if(validateuser()){
	$user_name = $_POST ['username']; // here getting result from the post array after submitting the form.
	$user_pass = $_POST ['pass']; // same
	$user_email = $_POST ['email']; // same
	$user_fname = $_POST ['fname']; // same
	$user_lname = $_POST ['lname']; // same
	$user_mname = $_POST ['mname']; // same
	
	$user_gender = $_POST ['gender']; // same
	$user_dob = $_POST ['dob']; // same
	$user_phonenumber = $_POST ['phonenumber']; // same
	$user_line1 = $_POST ['line1']; // same
	$user_line2 = $_POST ['line2']; // same
	$user_city = $_POST ['city']; // same
	//$user_statetext = $_POST ['statetext']; // same
	//$user_stateselect = $_POST['stateselect'];
	$user_zip = $_POST ['zip']; // same
	$user_country = $_POST ['country']; // same
	                                    
if($user_country!="USA"){
	$user_state = $_POST['statetext'];
}else{
	$user_state = $_POST['stateselect'];
}
	                                    
	// here query check weather if user already registered so can't register again.
	$check_email_query = "select * from users WHERE username='$user_name'";
	$run_query = mysqli_query ( $dbcon, $check_email_query );
	
	if (mysqli_num_rows ( $run_query ) > 0) {
		$err [] = "Error - User already exist. Please try another one";
		exit ();
	}
	// insert the user into the database.
	$insert_user = "insert into users (Username, Password, PhoneNumber, Email, Gender,
	 fName, lName, mName, DOB, AddressLine1, AddressLine2, City, State, ZIP, Country) 
	VALUES ('$user_name','$user_pass','$user_phonenumber','$user_email','$user_gender','$user_fname',
	'$user_lname','$user_mname','$user_dob','$user_line1','$user_line2','$user_city','$user_state','$user_zip','$user_country')";
	
	// $insert_user = "insert into users (Username, Password, PhoneNumber, Email, Gender,
	// fName, lName, mName, DOB, AddressLine1, AddressLine2, City, State, ZIP, Country)
	// VALUES ('samw','asdf','1234567891','sam@email.com','m','safadsf',
	// 'asdfasfd','asdfasdfa','1991-09-09','asdf','asdfa','adsfa','NC','28262','USA')";
	
	$result = mysqli_query ( $dbcon, $insert_user );
	
	if ($result) {
		$insert_user = "select UserID from users where Username='$user_name'";
		$result = mysqli_query ( $dbcon, $insert_user );
		if (mysqli_num_rows ( $result ) == 1) {
			$data = mysqli_fetch_assoc ( $result );
			$insert_user = "insert into student (UserID) VALUES ('$data[UserID]')";
			$result = mysqli_query ( $dbcon, $insert_user );
			if ($result) {
				header ( "Location: index.php" );
				exit ();
			}
		} else {
			$insert_user = "delete from users where username = '$user_name'";
			$result = mysqli_query ( $dbcon, $insert_user );
			header ( "Location: Registration.php",'_self' );
		}
		// echo"<script>window.open('welcome.php','_self')</script>";
	} else {
		$err [] = "Registration unsuccessful";
		// echo"<script>window.open('registration.php','_self')</script>";
	}
}else{
	echo"<script>alert('Enter valid information')</script>";
	$err [] = "Registration unsuccessful";
	header ( "Location: Registration.php" );
exit();
}

}
?>
<html>
<head lang="en">
<meta charset="UTF-8">
<link type="text/css" rel="stylesheet"
	href="bootstrap-3.2.0-dist\css\bootstrap.css">
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
.login-panel {
	margin-top: 150px;
}

.error {
	color: red;
}

.success {
	color: green;
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
					<li class="active"><a href="index.php">Home</a></li>
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
	<script>
var xmlhttp;
function loadXMLDoc(url,cfunc)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=cfunc;
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function checkuser(str)
{
loadXMLDoc("user_email.php?id=username&username="+str,function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	    if(xmlhttp.responseText == true){
	    	document.getElementById("userHint").className = "success";
	    	document.getElementById("userHint").innerHTML="Available";
	                
		}
	    else{
	    	//document.getElementById("userid").value = "";
	    	document.getElementById("userHint").className = "error";
	    	document.getElementById("userHint").innerHTML="User "+xmlhttp.responseText+" Already Exists";
	        }
    }
  });
}

function checkemail(str)
{
loadXMLDoc("user_email.php?id=email&email="+str,function()
  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	    if(xmlhttp.responseText == true){
	    	document.getElementById("emailHint").className = "success";
	    	document.getElementById("emailHint").innerHTML="Available";
	                
		}
	    else{
	    	document.getElementById("emailHint").className = "error";
	    	document.getElementById("emailHint").innerHTML="Email "+xmlhttp.responseText+" Already Exists";
	        }
    }
  });
}

function changestate(str)
{
loadXMLDoc("user_email.php?id=country&country="+str,function()
  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	    if(xmlhttp.responseText == true){
	    	document.getElementById("statetext").className = "form-control";
	    	document.getElementById("stateselect").className = "form-control hidden";
	    	document.getElementById("stateselect").value = "";	                
		}
	    else{
	    	document.getElementById("stateselect").className = "form-control";
	    	document.getElementById("stateselect").value = "";
	    	document.getElementById("statetext").className = "form-control hidden";
	    	document.getElementById("statetext").value = "";
	    	}
    }
  });
}


</script>
<script type='text/javascript'>
function check(input) {
if (input.value != document.getElementById('pass').value) {
input.setCustomValidity('Password Must be Matching.');
} else {
// input is valid -- reset the error message
input.setCustomValidity('');
}
}
</script>
	<!-- <script src="bootstrap-3.2.0-dist/js/script.js"></script> -->
	<title>Registration</title>


</head>
<style>
.login-panel {
	margin-top: 150px;
}
</style>

<body>


	<div class="container">
		<!-- container class is used to centered  the body of the browser with some decent width-->
		<div class="row">
			<!-- row class is used for grid system in Bootstrap-->
			<div class="col-md-4 col-md-offset-4">
				<!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
				<div class="panel panel-success">
					<div>
						<h3 style="color: Blue; font-style: italic">Student Registration</h3>
					</div>
					<div class="panel-body">
						<div><?php
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
								?></div>
						<form role="form" method="post" action="Registration.php"
							name="registration" id="registrationid" >
							<fieldset>
								<br>
								
								<label for="username">Username*</label>
								<div class="form-group">
									<input class="form-control compulsory" placeholder="Username"
										name="username" type="text" id="userid"
										onkeyup="checkuser(this.value)" autofocus required>
								</div>
								<p>
									Availablity: <span id="userHint" style="font-weight: bold">Not Available</span>
								</p>
								<input class="form-control" placeholder="Password" id="pass" name="pass"
									type="password" value="" required><br> 
								<input class="form-control"
									placeholder="Re-enter Password" name="pass2" type="password"
									value="" oninput="check(this)" required>
								<hr>
								<label for="email">E-Mail*</label>
								<div class="form-group">
									<input class="form-control" placeholder="sam@uncc.edu"
										name="email" id="emailid" type="email"
										onkeyup="checkemail(this.value)" autofocus required>
								</div>
								<p>
									Availablity: <span id="emailHint" style="font-weight: bold">Not available</span>
								</p>
								<!-- 								<label for="password">Password*</label>								 -->
								<!-- 								<div class="form-group"> -->
								<!-- 									<input class="form-control" placeholder="Password" name="pass" -->
								<!-- 										type="password" value=""> -->
								<!-- 								</div> -->
								<hr>
								<label for="fname">First name*</label>
								<div class="form-group">
									<input class="form-control" placeholder="Sam" name="fname"
										type="text" value="" required>
								</div>
								<label for="lname">Last Name*</label>
								<div class="form-group">
									<input class="form-control" placeholder="Peter" name="lname"
										type="text" value="" required>
								</div>
								<label for="mname">Middle Name</label>
								<div class="form-group">
									<input class="form-control" placeholder="K" name="mname"
										type="text" value="">
								</div>
								<label for="gender">Gender*</label>
								<div class="radio">
									<label><input type="radio" name="gender" value="M" required>Male</label>
									<label><input type="radio" name="gender" value="F" >Female</label>
								</div>
								<label for="dob">Date of Birth (YYYY-MM-DD)*</label>
								<div class="form-group">
									<input class="form-control" placeholder="1991-08-23" name="dob"
										type="date" min="1950-01-01" max="2000-01-02" value="" required>
								</div>
								<hr>
								<label for="phonenumber">Phone Number (XXX-XXX-XXXX)*</label>
								<div class="form-group">
									<input class="form-control" placeholder="PhoneNumber*"
										name="phonenumber" type="text" required pattern="^\d{3}-\d{3}-\d{4}$">
								</div>
								<label for="line1">Address Line 1*</label>
								<div class="form-group">
									<input class="form-control"
										placeholder="9312 Kittansett Dr. Apt X" name="line1"
										type="text" value="" required>
								</div>
								<label for="line2">Address Line 2</label>
								<div class="form-group">
									<input class="form-control"
										placeholder="Near Mallard creek Starbucks" name="line2"
										type="text" value="">
								</div>
								<label for="city">City*</label>
								<div class="form-group">
									<input class="form-control" placeholder="Eg: Charlotte"
										name="city" type="text" value="" required>
								</div>
									<label for="country">Country*</label>
								<div class="form-group">
									<select title="Country" class="form-control" id="country"
										name="country" onchange="changestate(this.value)" required>
										<option>USA</option>
										<option>CHINA</option>
										<option>INDIA</option>
										<option>JAPAN</option>
										<option>UK</option>
										<option>FRANCE</option>
									</select>
								</div>
								<label for="State">State*</label>
								<div class="form-group">
									<input class="form-control hidden" placeholder="Eg: Delhi"
										name="statetext" id = "statetext" type="text" value="" >
									<select class="form-control" id="stateselect" name="stateselect">
										<option>AL</option>
										<option>AK</option>
										<option>AS</option>
										<option>AZ</option>
										<option>AR</option>
										<option>CA</option>
										<option>CO</option>
										<option>CT</option>
										<option>DE</option>
										<option>DC</option>
										<option>FM</option>
										<option>FL</option>
										<option>GA</option>
										<option>GU</option>
										<option>HI</option>
										<option>ID</option>
										<option>IL</option>
										<option>IN</option>
										<option>IA</option>
										<option>KS</option>
										<option>KY</option>
										<option>LA</option>
										<option>ME</option>
										<option>MH</option>
										<option>MD</option>
										<option>MA</option>
										<option>MI</option>
										<option>MN</option>
										<option>MS</option>
										<option>MO</option>
										<option>MT</option>
										<option>NE</option>
										<option>NV</option>
										<option>NH</option>
										<option>NJ</option>
										<option>NM</option>
										<option>NY</option>
										<option selected>NC</option>
										<option>ND</option>
										<option>MP</option>
										<option>OH</option>
										<option>OK</option>
										<option>OR</option>
										<option>PW</option>
										<option>PA</option>
										<option>PR</option>
										<option>RI</option>
										<option>SC</option>
										<option>SD</option>
										<option>TN</option>
										<option>TX</option>
										<option>UT</option>
										<option>VT</option>
										<option>VA</option>
										<option>VI</option>
										<option>WA</option>
										<option>DC</option>
										<option>WV</option>
										<option>WI</option>
										<option>WY</option>
									</select>
								</div>
								<label for="zip">Zip*</label>
								<div class="form-group">
									<input class="form-control" placeholder="Eg: 28262" name="zip"
										type="text" value="" required pattern="^\d{5}$">
								</div>
							
								<hr>

								<div>
									<input class="btn btn-lg btn-success btn-block" type="submit"
									 value="register" name="register"/>
								</div>
								<br />
								<div style="width: 200px; float: center">
									<input class="btn btn-lg btn-success btn-block2" type="reset"
										value="reset" name="reset" />
								</div>
							</fieldset>
						</form>

						<center>
							<b>Already registered ?</b> <br> </b><a href="login.php">Login
								here</a>
						</center>
						<!--for centered text-->
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include("footer.php")?>