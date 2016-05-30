<?php include('header.php')?>

	<header id="head" class="secondary">
		<div class="container">
			<h1>Courses</h1>
			<p>Listed below are the courses for your selected department </p>
		</div>
	</header>
	<br>
	
	<div>
		<section class="container">
			<div class="row">
				<!-- Article main content -->
				<content class="maincontent"> <br>
				<div>
<?php
include "database/db_connection.php";
if (isset ( $_POST ['courses'] )) {
	
	foreach ( $_POST as $key => $value ) {
		$data [$key] = filter ( $value ); // post variables are filtered
	}
	$SearchDept = $data ['deptname'];
	$sql = "select CourseID, COURSE_TITLE, CREDIT_HOURS, DESCRIPTION
 from courses where DeptID IN (select DeptID
from Department where DeptName = '$SearchDept');";
	$result = mysqli_query ( $dbcon, $sql );
	// echo "<table class=\"table table-striped\" summary=\"Table\" border=\"1\" cellspacing=\"2\" cellpadding=\"1\">
	// <thead><tr align=\"left\" valign=\"top\" style=\"color:Red;font-style:italic\"><th>Assistantship Name</th>
	// <th>Assistantship Type</th><th>Assistantship Duration</th><th>Professor Contact</th>
	// </tr></thead><tbody>";
	
	echo "<h2 align = \"center\">" . $SearchDept . "</h2>";
	if (mysqli_num_rows ( $result ) > 0) {
		// output data of each row
			while ( $row = mysqli_fetch_assoc ( $result ) ) {
				echo "<ul>";
				echo "<h4>" . $row ["COURSE_TITLE"] . "</h4>"; 
				echo "<li><b> (" . $row ["CREDIT_HOURS"] . " Credit Hours)" . "</b></li>";
				echo "<br>";
				echo "<li>" . $row ["DESCRIPTION"] . "</li>";
				echo "</ul>";
				echo "<hr>";
			}
	} else {
		echo "<p class= \" error\"> Sorry, No Courses offered currently.</p>";
	}
	echo "</tbody></table>";
}
?></div>
				<br>
				</content>
			</div>
		</section>
	</div>
    
<div align="center"> <form role="form" action="ListofDepts.php" method="post">
			<input class="btn btn-success" type="submit"
			value="Back to Departments" name="backtodepts"/></form></div>
    
    
    
    
    
<?php include('footer.php')?>