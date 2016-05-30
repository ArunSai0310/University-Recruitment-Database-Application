<?php include("header.php")?>

	
<script>
//This Ajax Redirect to _SELF and excute php to display Job Information for selected Department
function showcontent(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "List of Faculty Information under a department will be listed here...";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","Displayfaculty.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>	
	
	<header id="head" class="secondary">
		<div class="container">
			<h1>Faculty Information</h1>
			<p>Faculty win accolades for teaching and research activities,are often sought after as expert sources for the University</p>
		</div>
	</header>
	<div>
		<section class="container">

			<div class="row">

				<!-- Article main content -->
				<content class="maincontent"> <br>
<?php
include "database/db_connection.php";

$sql = "select DeptName from department";
$result = mysqli_query ( $dbcon, $sql );

if (mysqli_num_rows ( $result ) > 0) {
	echo "<form><select name=\"Dept\" onchange=\"showcontent(this.value)\">";
	echo "<option value=\"\">Select a Department:</option>";
	while ( $row = mysqli_fetch_assoc ( $result ) ) {
		echo "<option>" . $row ["DeptName"] . "</option>";
	}
	echo "</select></form>";
}

?>
<br>
				<div id="txtHint">
					<b>List of Professors under a department will be listed here...</b>


				</div>

				</content>
			</div>
		</section>
	</div>






<?php include("footer.php")?>