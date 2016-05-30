<?php
include ("database/db_connection.php"); // make connection here

if (isset ( $_POST ['save'] ) || isset ( $_POST ['submit'] )) {

		$sid = $_POST ['sid'];
		$program = $_POST ['program'];
		$dept = $_POST ['dept'];
		$student_fname = $_POST ['student_fname']; // here getting result from the post array after submitting the form.
		$student_mname = $_POST ['student_mname'];
		$student_lname = $_POST ['student_lname'];
		$application_date = $_POST ['Application_date'];
		$last_updated_date = date("Y-m-d");
		$student_email = $_POST ['student_email'];
		//$status = $_POST ['status'];
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
		
		$r1_fname = $_POST ['r1_fname'];
		$r1_lname = $_POST ['r1_lname'];
		$r1_email = $_POST ['r1_email'];
		$r1_line1 = $_POST ['r1_line1'];
		$r1_line2 = $_POST ['r1_line2'];
		$r1_city = $_POST ['r1_city'];
		$r1_state = $_POST ['r1_state'];
		$r1_country = $_POST ['r1_country'];
		
		$r2_fname = $_POST ['r2_fname'];
		$r2_lname = $_POST ['r2_lname'];
		$r2_email = $_POST ['r2_email'];
		$r2_line1 = $_POST ['r2_line1'];
		$r2_line2 = $_POST ['r2_line2'];
		$r2_city = $_POST ['r2_city'];
		$r2_state = $_POST ['r2_state'];
		$r2_country = $_POST ['r2_country'];
		
		$w1_company = $_POST ['w1_company'];
		$w1_location = $_POST ['w1_location'];
		$w1_startdate = $_POST ['w1_startdate'];
		$w1_enddate = $_POST ['w1_enddate'];
		
		$w2_company = $_POST ['w2_company'];
		$w2_location = $_POST ['w2_location'];
		$w2_startdate = $_POST ['w2_startdate'];
		$w2_enddate = $_POST ['w2_enddate'];
		
		$recruiterid = rand ( 1, 10 );
// 		echo $sid;
// 		echo $application_date;
		
// 		echo "<script>alert ('$sid')</script>";
		
		// Insert Application details
		$insert_appln_query = "INSERT INTO application
(ApplicationDATE,Status,UndergradGPA,GREscore,GREverbalScore,GREquantitativeScore,GREanalyticalWritingScore,
TOEFLscore,TOEFLreading,TOEFLlistening,TOEFLspeaking,TOEFLwriting,IELTSscore,RecID,HighSchoolGPA,SATScore)
VALUES(
'$application_date','$status','$gpa','$gretotal','$verbal','$quant','$awa',
'$toefltotal','$reading','$listening','$speaking','$writing','$ielts','$recruiterid','$highschoolgpa','$satscore')";
		
		$result = mysqli_query ( $dbcon, $insert_appln_query );
		
		if ($result) {
			$application_id = mysqli_insert_id ( $dbcon ); // Get application id
			                                               
			// Insert Recommendations
			if ($r1_fname != null) {
				$insert_recom_query = "INSERT INTO recommendations
				(ApplicationID,fName,lName,AddressLine1,AddressLine2,City,State,Country,Email)
				VALUES ('$application_id','$r1_fname','$r1_lname','$r1_line1','$r1_line2',
		'$r1_city','$r1_state','$r1_country','$r1_email')";
				
				$result = mysqli_query ( $dbcon, $insert_recom_query ); // inserts recommendation 1
				
				if ($result && $r2_fname != null) { // go in only if there is rec2 AND rec1 inserted good
					$insert_recom_query = "INSERT INTO recommendations
					(ApplicationID,fName,lName,AddressLine1,AddressLine2,City,State,Country,Email)
					VALUES ('$application_id','$r2_fname','$r2_lname','$r2_line1','$r2_line2',
					'$r2_city','$r2_state','$r2_country','$r2_email')";
					
					$result = mysqli_query ( $dbcon, $insert_recom_query ); // inserts recommendation 2
				}
			}
			
			// Insert WorkExp
			if ($w1_company != null) {
				$insert_work_query = "INSERT INTO workexperience 
						(ApplicationID,CompanyName,Location,StartDATE,EndDATE)
					VALUES('$application_id','$w1_company','$w1_location','$w1_startdate','$w1_enddate')";
				
				$result = mysqli_query ( $dbcon, $insert_work_query ); // inserts work ex 1
				
				if ($result && $w2_company != null) { // go in only if there is work2 AND work1 inserted good
					$insert_work_query = "INSERT INTO workexperience
					(ApplicationID,CompanyName,Location,StartDATE,EndDATE)
					VALUES('$application_id','$w2_company','$w2_location','$w2_startdate','$w2_enddate')";
					
					$result = mysqli_query ( $dbcon, $insert_work_query ); // inserts work ex 2
				}
			}
			
			// Getting Program ID & Insert into applies
			$insert_link_prog_stud = "select ProgID from program where ProgName = '$program' and deptid in 
			(select deptid from department where DeptName = '$dept')";
			$result = mysqli_query ( $dbcon, $insert_link_prog_stud ); // Select Program id
			
			if (mysqli_num_rows ( $result ) == 1) {
// 				$prog_dummy = mysqli_fetch_assoc ( $result );
// 				$prog_id = $prog_dummy [ProgID]; // gets the value of program id
				list ( $prog_id) = mysqli_fetch_row ( $result );
				$insert_applies = "INSERT INTO applies (ProgID,ApplicationID,SID,LastUpDATEd)
								VALUES('$prog_id','$application_id','$sid','$last_updated_date')";
				
				$result = mysqli_query ( $dbcon, $insert_applies ); // insert into applies table
				if ($result) {
					//Update Status based on SAVE or SUBMIT
					if(isset ( $_POST ['submit'] )){
						$update_query = "UPDATE application SET status = 'Submitted' WHERE ApplicationId = '$application_id'";	
						$result = mysqli_query ( $dbcon, $update_query );
					}
					header ( "Location: Myapplications.php" );
					exit ();
				} else {
					//$insert_user = "delete from application where ApplicationId = '$application_id'";
					//$result = mysqli_query ( $dbcon, $insert_user );
					echo "<script>alert ('There is a problem, Please try again later..')</script>";
					header ( "Location: Apply.php", '_self' );
				}
			}
		}
		else 
		{
		echo "<script>alert('Enter valid information')</script>";
		header ( "Location: Apply.php", '_self' );
		exit ();
		}
}else{
	echo "<script>alert('Wrong.........')</script>";
	header ( "Location: index.php", '_self' );
	exit ();
}		
		
		
?>