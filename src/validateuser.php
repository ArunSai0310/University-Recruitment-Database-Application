<?php
function validateuser(){
	if (isset ( $_POST ['register'] )) {
$user_name = $_POST ['username']; // here getting result from the post array after submitting the form.
$userHint = $_POST['userHint'];
$user_pass = $_POST ['pass']; // same
$user_pass2 = $_POST ['pass2']; // same

$user_email = $_POST ['email']; // same
$emailHint = $_POST ['emailHint']; // same

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

if ($user_name == '' || $user_pass == '' || $user_email == '' || $user_fname == ''||
		$user_lname==''||$user_gender==''||$user_dob==''||$user_phonenumber==''||
		$user_line1==''||$user_city==''||$user_state=''||$user_zip==''||$user_country=='') {
$flag = false;
		}
else {
			// Notifying error fields
			if($userHint=='User Already Exists'||$user_pass!=$user_pass2||
					$emailHint=='Email Already Exists'){
				$flag = false;
						}
			else {
				// Submit Form When All values are valid.
	$flag = true;
					}
}
return $flag;
	}
}
?>		