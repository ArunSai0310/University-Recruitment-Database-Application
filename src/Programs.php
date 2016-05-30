<?php include("header.php")?>

<script>
//This Ajax Redirect to _SELF and excute php to display Job Information for selected Department
function showcontent(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "Program list will appear here...";
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
        xmlhttp.open("GET","Displayprograms.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>


	<header id="head" class="secondary">
		<div class="container">
			<h1>Programs</h1>
			<p>Explore your program details, including degrees available, tuition fees for various degrees in the department and department contact info.</p>
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

					$sql = "select distinct ProgName from program order by ProgName asc";
					$result = mysqli_query ( $dbcon, $sql );

					// echo "<table class=\"table table-striped\" summary=\"Table\" border=\"1\" cellspacing=\"2\" cellpadding=\"1\">
					// <thead><tr align=\"left\" valign=\"top\" style=\"color:Red;font-style:italic\"><th>Assistantship Name</th>
					// <th>Assistantship Type</th><th>Assistantship Duration</th><th>Professor Contact</th>
					// </tr></thead><tbody>";
					
					echo "<form>";
					echo "<img src=\"assets/images/programs.png\" align=right >";
					if (mysqli_num_rows ( $result ) > 0) {
						echo "<select id = \"programName\" name=\"programName\" onchange=\"showcontent(this.value)\">";
						echo "<option value=\"\">Select a Program Name:</option>";
						while ( $row = mysqli_fetch_assoc ( $result ) ) {
							echo "<option>" . $row ["ProgName"] . "</option>";
						}
						echo "</select>";
					}
					echo "</form>";

					?>
					</div>
				<br>
				
					<div id="txtHint">
					<b>Program list will appear here...</b>


				</div>
					
					
					
				</content>
			</div>
		</section>
	</div>
	
	<div id="txtHint"></div>








<?php include("footer.php")?>