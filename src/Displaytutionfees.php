<?php
include "database/db_connection.php";

if (isset ( $_GET ['dept'] )) {
	$SearchDept = $_GET ['dept'];
	$Prog = $_GET['prog'];

	$sql = "select Amount_Instate, Amount_Outstate,CreditHours,amount_instate * credithours as totalcost1,Amount_Outstate*credithours as totalcost2 from program where 
	ProgName = '$Prog' and DeptID in ( select c.DeptID from program c 
	join department d on  c.DeptID = d.DeptID where d.DeptName = '$SearchDept')";
    
	$result = mysqli_query ( $dbcon, $sql );
	if (mysqli_num_rows ( $result ) > 0) {
	echo "<table class=\"table table-striped\" summary=\"Table\" border=\"1\" cellspacing=\"2\" cellpadding=\"1\">
		<thead><tr align=\"left\" valign=\"top\" style=\"color:Red;font-style:italic\">
            <th>        </th>
			<th>In-State</th>
            <th>Out-State</th>
			<th>International</th>
</tr></thead><tbody>";
		
		// output data of each row
    
while ( $row = mysqli_fetch_assoc ( $result ) ) {
			echo "<tr align=\"left\" valign=\"top\" style=\"color:blue\"><td>Cost per Credit Hour</td><td>" ."$ ".
    $row ["Amount_Instate"] . "</td><td>" ."$ ". $row ["Amount_Outstate"] ."</td><td>" ."$ ". $row ["Amount_Outstate"] ."</td>
			 		</tr>";
            echo "<tr align=\"left\" valign=\"top\" style=\"color:blue\"><td>Total Number of Credit Hours</td><td>" .
            $row ["CreditHours"] . "</td><td>" . $row ["CreditHours"] ."</td><td>" . $row ["CreditHours"] ."</td>
			 		</tr>";
            echo "<tr align=\"left\" valign=\"top\" style=\"color:blue\"><td>Total Cost</td><td>" ."$ ".
            $row ["totalcost1"] . "</td><td>" ."$ ". $row ["totalcost2"] ."</td><td>" . "$ ".$row ["totalcost2"] ."</td>
               </tr>";
		}
	echo "</tbody></table>";

    } else {
		echo "<p class= \" error\"> Sorry, No Tution fee Information Available now. Please check back later.</p>";
	}
}
?>