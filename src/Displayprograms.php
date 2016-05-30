<?php
include "database/db_connection.php";
if (isset ( $_GET ['q'] )) {
	$SearchDept = $_GET ['q'];
	
	$sql = "Select d.DeptName,p.Description,p.CreditHours from department d,
program p where d.DeptID=p.DeptID and p.ProgName='$SearchDept' 
group by d.DeptName;";
	$result = mysqli_query ( $dbcon, $sql );
	//echo "<table class=\"table table-striped\" summary=\"Table\" border=\"1\" cellspacing=\"2\" cellpadding=\"1\">
	//	<thead><tr align=\"left\" valign=\"top\" style=\"color:Red;font-style:italic\"><th>Department Name</th>
//<th>Description</th><th>Degree</th><th>Credit Hours</th>
//</tr></thead><tbody>";
	
	if (mysqli_num_rows ( $result ) > 0) {
		
		// output data of each row
		
		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			echo "<ul>";
			echo "<li><b>Department Name: </b>" . $row ["DeptName"] . "</li>";
// 			echo "<li><b>Degree: </b>" . $row ["Degree"];
			echo "<li><b>Credit Hours: "."</b>" . $row ["CreditHours"] . "</li>";
			echo "<li><b>Description: "."</b>" . $row ["Description"] . "</li>";
			echo "</ul>";
			echo "<hr>";
		}
	} else {
		echo "<p class= \" error\"> Sorry, No Department offers the selected program.</p>";
	}
	echo "</tbody></table>";
}
?>













