<?php
include "database/db_connection.php";
if (isset ( $_GET ['q'] )) {
	$SearchDept = $_GET ['q'];
	
	$sql = "select s.ScholarshipDesc as ScholarshipDesc ,s.Amount as Amount,s.Semester_Year as Semester_Year,p.ProgName as ProgName from scholarship s , department d ,program p , offers_eligible o
			where p.DeptID = d.deptID
			and o.ScholarshipID = s.ScholarshipID
			and  o.ProgID = p.ProgID
			and d.DeptName = '$SearchDept'
			order by p.ProgName,s.Semester_Year,s.Amount asc";
	$result = mysqli_query ( $dbcon, $sql );
	echo "<table class=\"table table-striped\" summary=\"Table\" border=\"1\" cellspacing=\"2\" cellpadding=\"1\">
		<thead><tr align=\"left\" valign=\"top\" style=\"color:Red;font-style:italic\"><th>Scholarship Description</th>
<th>Amount</th><th>Semester Year</th><th>Program Name</th>
</tr></thead><tbody>";
	if (mysqli_num_rows ( $result ) > 0) {
		
		// output data of each row
		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			echo "<tr align=\"left\" valign=\"top\" style=\"color:blue\"><td>" . $row ["ScholarshipDesc"] . "</td><td>" . $row ["Amount"] . "</td><td>" . $row ["Semester_Year"]  . "</td><td>" . $row ["ProgName"] . "</td></tr>";
		}
	} else {
		echo "<p class= \" error\"> Sorry, No Scholarship opportunities available currently.</p>";
	}
	echo "</tbody></table>";
}
?>