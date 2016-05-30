<?php
include "database/db_connection.php";

if (isset ( $_GET ['dept'] )) {
	$SearchDept = $_GET ['dept'];
	$Year = intval($_GET['year']);
	
	$sql = "select CompanyName, NoOfStudentsRec from companies c join deptrecruitscompanies dc join  department d 
on c.CompID=dc.CompID and dc.DeptID = d.DeptID where d.DeptName = '$SearchDept' and dc.RecruitedYear = $Year";
	$result = mysqli_query ( $dbcon, $sql );
	echo "<table class=\"table table-striped\" summary=\"Table\" border=\"1\" cellspacing=\"2\" cellpadding=\"1\">
		<thead><tr align=\"left\" valign=\"top\" style=\"color:Red;font-style:italic\">
			<th>Company Name</th>
			<th># of Students Recruited</th>
</tr></thead><tbody>";
	if (mysqli_num_rows ( $result ) > 0) {
		
		// output data of each row
		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			echo "<tr align=\"left\" valign=\"top\" style=\"color:blue\"><td>" .
			 $row ["CompanyName"] . "</td><td>" . $row ["NoOfStudentsRec"] ." Students</td>
			 		</tr>";
		}
	} else {
		echo "<p class= \" error\"> Sorry, No Companies have recruited in this Year.</p>";
	}
	echo "</tbody></table>";
}
?>