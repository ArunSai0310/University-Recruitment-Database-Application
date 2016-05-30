<?php
include ("database/db_connection.php"); // make connection here

if (isset ( $_POST ['save'] ) || isset ( $_POST ['submit'] )) {
	
	$sid = $_POST ['sid'];
// 	$program = $_POST ['program'];
// 	$dept = $_POST ['dept'];
	$appid = $_POST ['appid'];
	$student_fname = $_POST ['student_fname']; // here getting result from the post array after submitting the form.
	$student_mname = $_POST ['student_mname'];
	$student_lname = $_POST ['student_lname'];
	$application_date = $_POST ['Application_date'];
	$last_updated_date = date ( "Y-m-d" );
	$student_email = $_POST ['student_email'];
	// $status = $_POST ['status'];
	$status = "Not Submitted";
	$quant = $_POST ['quant']; // quant
	$verbal = $_POST ['verbal']; // verbal
	$awa = $_POST ['awa']; // awa
	$gretotal = $_POST ['gretotal']; // Gre total
	
	$reading = $_POST ['reading'];
	$speaking = $_POST ['speaking'];
	$listening = $_POST ['listening'];
	$writing = $_POST ['writing'];
	$toefltotal = $_POST ['toefltotal'];
	$ielts = $_POST ['ielts'];
	
	$gpa = $_POST ['gpa'];
	$highschoolgpa = $_POST ['highschoolgpa'];
	$satscore = $_POST ['satscore'];
	
	$r1_id = $_POST ['r1_id'];
	$r1_fname = $_POST ['r1_fname'];
	$r1_lname = $_POST ['r1_lname'];
	$r1_email = $_POST ['r1_email'];
	$r1_line1 = $_POST ['r1_line1'];
	$r1_line2 = $_POST ['r1_line2'];
	$r1_city = $_POST ['r1_city'];
	$r1_state = $_POST ['r1_state'];
	$r1_country = $_POST ['r1_country'];
	
	$r2_id = $_POST ['r2_id'];
	$r2_fname = $_POST ['r2_fname'];
	$r2_lname = $_POST ['r2_lname'];
	$r2_email = $_POST ['r2_email'];
	$r2_line1 = $_POST ['r2_line1'];
	$r2_line2 = $_POST ['r2_line2'];
	$r2_city = $_POST ['r2_city'];
	$r2_state = $_POST ['r2_state'];
	$r2_country = $_POST ['r2_country'];
	
	$w1_id = $_POST ['w1_id'];
	$w1_company = $_POST ['w1_company'];
	$w1_location = $_POST ['w1_location'];
	$w1_startdate = $_POST ['w1_startdate'];
	$w1_enddate = $_POST ['w1_enddate'];
	
	$w2_id = $_POST ['w2_id'];
	$w2_company = $_POST ['w2_company'];
	$w2_location = $_POST ['w2_location'];
	$w2_startdate = $_POST ['w2_startdate'];
	$w2_enddate = $_POST ['w2_enddate'];
	
	$recruiterid = $_POST ['recid'];
	
	
	// Insert Application details
	$insert_appln_query = "UPDATE application
SET
ApplicationDATE = '$application_date',
Status = '$status',
HighSchoolGPA = '$highschoolgpa',
SATScore = '$satscore',
UndergradGPA = '$gpa',
GREscore = '$gretotal',
GREverbalScore = '$verbal',
GREquantitativeScore = '$quant',
GREanalyticalWritingScore = '$awa',
TOEFLscore = '$toefltotal',
TOEFLreading = '$reading',
TOEFLlistening = '$listening',
TOEFLspeaking = '$speaking',
TOEFLwriting = '$writing',
IELTSscore = '$ielts',
RecID = '$recruiterid'
WHERE ApplicationId = '$appid'";
	
	$result = mysqli_query ( $dbcon, $insert_appln_query );
	
	if ($result) {
		// $appid = mysqli_insert_id ( $dbcon ); // Get application id
		
		// update Recommendations
		if ($r1_id != null) {
			$insert_recom_query = "UPDATE recommendations SET
		fName = '$r1_fname',lName = '$r1_lname', AddressLine1 = '$r1_line1', AddressLine2 = '$r1_line2', City = '$r1_city',
		State = '$r1_state',Country = '$r1_country',Email = '$r1_email'
		WHERE ApplicationID = '$appid' AND recommendation_id = '$r1_id'";
			
			$result = mysqli_query ( $dbcon, $insert_recom_query ); // inserts recommendation 1
			
			if ($result && $r2_id != null) { // go in only if there is rec2 AND rec1 updated good
				$insert_recom_query = "UPDATE recommendations SET
		fName = '$r2_fname',lName = '$r2_lname', AddressLine1 = '$r2_line1', AddressLine2 = '$r2_line2', City = '$r2_city',
		State = '$r2_state',Country = '$r2_country',Email = '$r2_email'
		WHERE ApplicationID = '$appid' AND recommendation_id = '$r2_id'";
				
				$result = mysqli_query ( $dbcon, $insert_recom_query ); // inserts recommendation 2
			}
		}
		
		// Insert WorkExp
			$delete_work_query = "delete from workexperience where applicationid = '$appid'";
			
			$result = mysqli_query ( $dbcon, $delete_work_query ); // delete work ex 1
			
			
	if ($w1_company != null) {
				$insert_work_query = "INSERT INTO workexperience 
						(ApplicationID,CompanyName,Location,StartDATE,EndDATE)
					VALUES('$appid','$w1_company','$w1_location','$w1_startdate','$w1_enddate')";
				
				$result = mysqli_query ( $dbcon, $insert_work_query ); // inserts work ex 1
				if ($result && $w2_company != null) { // go in only if there is work2 AND work1 inserted good
					$insert_work_query = "INSERT INTO workexperience
					(ApplicationID,CompanyName,Location,StartDATE,EndDATE)
					VALUES('$appid','$w2_company','$w2_location','$w2_startdate','$w2_enddate')";
					$result = mysqli_query ( $dbcon, $insert_work_query ); // inserts work ex 2
					
				}
			}
		
	
	if (isset ( $_POST ['submit'] )) {
					$update_query = "UPDATE application SET status = 'Submitted' WHERE ApplicationId = '$appid'";
					$result = mysqli_query ( $dbcon, $update_query );
					header ( "Location: Myapplications.php" );
				exit ();
	}
	header ( "Location: Myapplications.php" );
	exit ();
	

	} else {
		echo "<script>alert('Enter valid information')</script>";
		header ( "Location: Apply.php", '_self' );
		exit ();
	}
	
}

?>