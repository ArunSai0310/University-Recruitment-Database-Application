<?php
include "database/db_connection.php";
if (isset ( $_GET ['q'] )) {
	$SearchDept = $_GET ['q'];
	
	$sql = "select a.Asstship_Name as name, a.Asstship_Type as type, a.Duration as duration,
		 b.email as email from offersassistantship a inner join 
		(select ProfID, Email from professor where DeptID IN 
		(select DeptID from Department where DeptName = '$SearchDept')) b on a.ProfID = b.ProfID";
	$result = mysqli_query ( $dbcon, $sql );
	echo "<table class=\"table table-striped\" summary=\"Table\" border=\"1\" cellspacing=\"2\" cellpadding=\"1\">
		<thead><tr align=\"left\" valign=\"top\" style=\"color:Red;font-style:italic\"><th>Assistantship Name</th>
<th>Assistantship Type</th><th>Assistantship Duration</th><th>Professor Contact</th>
</tr></thead><tbody>";
	if (mysqli_num_rows ( $result ) > 0) {
		
		// output data of each row
		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			echo "<tr align=\"left\" valign=\"top\" style=\"color:blue\"><td>" . $row ["name"] . "</td><td>" . $row ["type"] . "</td><td>" . $row ["duration"] . " months" . "</td><td>" . $row ["email"] . "</td></tr>";
		}
	} else {
		echo "<p class= \" error\"> Sorry, No Jobs offered currently.</p>";
	}
	echo "</tbody></table>";
}
?>