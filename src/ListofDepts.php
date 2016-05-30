<?php include("header.php")?>

<header id="head" class="secondary">
	<div class="container">
		<h1>Departments</h1>
		<p>Various Departments and the contact info is listed below</p>
	</div>
</header>





<div>
	<section class="container">

		<div class="row">

			<!-- Article main content -->
			<content class="maincontent"> <br>
			<div>
<?php
include "database/db_connection.php";

$sql = "select DeptName, DeptHead, Contact from Department";
$result = mysqli_query ( $dbcon, $sql );
// echo "<table class=\"table table-striped\" summary=\"Table\" border=\"1\" cellspacing=\"2\" cellpadding=\"1\">
// <thead><tr align=\"left\" valign=\"top\" style=\"color:Red;font-style:italic\"><th>Assistantship Name</th>
// <th>Assistantship Type</th><th>Assistantship Duration</th><th>Professor Contact</th>
// </tr></thead><tbody>";

if (mysqli_num_rows ( $result ) > 0) {
	
	// output data of each row
	while ( $row = mysqli_fetch_assoc ( $result ) ) {
		echo "<ul>";
		echo "<li><b>Department Name: </b>" . $row ["DeptName"] . "</li>";
		echo "<li><b>Department Head: </b>" . $row ["DeptHead"];
		echo "<div align=\"right\"> <form role=\"form\" action=\"Courses.php\" method=\"post\">
			<input type=\"hidden\" name=\"deptname\" value=\"" . $row ["DeptName"] . "\"/>
			<input class=\"btn btn-success\" type=\"submit\"
			value=\"View Course List\" name=\"courses\"/></form></div>";
		echo "<li><b>Contact: </b>" . $row ["Contact"] . "</li>";
		echo "</ul>";
		echo "<hr>";
	}
} else {
	echo "<p class= \" error\"> Sorry, No Departments found</p>";
}
echo "</tbody></table>";

?></div>
			<br>

			</content>
		</div>
	</section>
</div>


<?php include("footer.php")?>