<?php
include ("database/db_connection.php"); // make connection here

if ($_REQUEST ["id"] == "username") {
	$user_name = $_REQUEST ["username"]; // here getting result from the post array after submitting the form.
	$check_email_query = "select * from users WHERE username='$user_name'";
	$run_query = mysqli_query ( $dbcon, $check_email_query );
	
	if (mysqli_num_rows ( $run_query ) > 0) {
		
		$hint = false;
	} else {
		$hint = true;
	}
	echo $hint;
}
if ($_REQUEST ["id"] == "email") {
	
	$user_email = $_REQUEST ["email"]; // same
	$check_email_query = "select * from users WHERE email='$user_email'";
	$run_query = mysqli_query ( $dbcon, $check_email_query );
	
	if (mysqli_num_rows ( $run_query ) > 0) {
		$hint = false;
	} else {
		$hint = true;
	}
	
	echo $hint;
}

if ($_REQUEST ["id"] == "country") {

	$user_country = $_REQUEST ["country"]; // same
	if($user_country == "USA"){
		$hint = false;	
	}else{
		$hint=true;
	}
	
	echo $hint;
}


?>