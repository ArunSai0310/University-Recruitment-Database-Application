<?php include("header.php")?>
	
	<script>
//This Ajax Redirect to _SELF and excute php to display Job Information for selected Department
function setdept(str) {
	    document.getElementById("setdept").value = str;
	    document.getElementById("selectyear").value = "";
	    document.getElementById("txtHint").innerHTML = "";    	
}
function showcontent(src) {

    var dept = document.getElementById("setdept").value;
    var year = src;
     
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
        xmlhttp.open("GET","Displaycompanies.php?dept="+dept+"&year="+year,true);
        xmlhttp.send();
    
}


</script>
	<header id="head" class="secondary">
		<div class="container">
			<h1>Visiting Companies</h1>
			<p>The Bridge across College and Corporate</p>
		</div>
	</header>
	<div>
		<section class="container">

			<div class="row">

				<!-- Article main content -->
				<content class="maincontent"> <br>
<p id=setdept ></p>
<p id=setyear hidden></p>
<?php
include "database/db_connection.php";

$sql = "select DeptName from department order by DeptName asc";
$result = mysqli_query ( $dbcon, $sql );

$sql = "select Distinct RecruitedYear from deptrecruitscompanies order by RecruitedYear asc;";
$result2 = mysqli_query ( $dbcon, $sql );

echo "<form>";
if (mysqli_num_rows ( $result ) > 0) {
	echo "<select id = \"Deptid\" name=\"Dept\" onchange=\"setdept(this.value)\">";
	echo "<option value=\"\">Select a Department:</option>";
	while ( $row = mysqli_fetch_assoc ( $result ) ) {
		echo "<option>" . $row ["DeptName"] . "</option>";
	}
	echo "</select>";
}

if (mysqli_num_rows ( $result2 ) > 0) {
	echo "<select id=\"selectyear\" name=\"Year\" onchange=\"showcontent(this.value)\">";
	echo "<option value=\"\">Select a Year:</option>";
	while ( $row = mysqli_fetch_assoc ( $result2 ) ) {
		echo "<option>" . $row ["RecruitedYear"] . "</option>";
	}
	echo "</select>";
}
// echo " <input class=\"btn btn-success\" type=\"submit\"
// 		value=\"submit\" name=\"submit\" onclick=\showcontent()\">";
		echo "</form>";
?>
<br>
				<div id="txtHint">
					<b>List of Companies recruited in department will be listed here...</b>


				</div>

				</content>
			</div>
		</section>
	</div>






<?php include("footer.php")?>