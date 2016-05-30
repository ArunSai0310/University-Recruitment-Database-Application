<?php
include "database/db_connection.php";
if (isset ( $_GET ['q'] )) {
	$SearchDept = $_GET ['q'];
	
	$sql = "select concat(concat(fname,' '),lname) as fname, Email, DESCRIPTION, 
		Address from professor where DeptID IN (select DeptID
		from Department where DeptName = '$SearchDept')";
	$result = mysqli_query ( $dbcon, $sql );
	// echo "<table class=\"table table-striped\" summary=\"Table\" border=\"1\" cellspacing=\"2\" cellpadding=\"1\">
	// <thead><tr align=\"left\" valign=\"top\" style=\"color:Red;font-style:italic\"><th>Assistantship Name</th>
	// <th>Assistantship Type</th><th>Assistantship Duration</th><th>Professor Contact</th>
	// </tr></thead><tbody>";
	
	if (mysqli_num_rows ( $result ) > 0) {
		
		// output data of each row
		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			
			echo "<ul>";
			echo "<li><b>Professor Name: </b>" . $row ["fname"] . "</li>";
			echo "<li><b>Description: </b>" . $row ["DESCRIPTION"] . "</li>";
			echo "<li><b>E-mail: </b>" . $row ["Email"] . "</li>";
			echo "<li><b>Address: </b>" . $row ["Address"] . "</li>";
			echo "</ul>";
			echo "<hr>";
		}
	} else {
		echo "<p class= \" error\"> Sorry, No Faculty Under this department currently.</p>";
	}
	echo "</tbody></table>";
}
?>