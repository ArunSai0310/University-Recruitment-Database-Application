<?php include('header.php')?>
<script>
        //This Ajax Redirect to _SELF and excute php to display Job Information for selected Department
        function setdept(str) {
            document.getElementById("setdept").value = str;
            document.getElementById("ProgID").value = "";
            document.getElementById("txtHint").innerHTML = "";
        }
        function showcontent(src) {

            var dept = document.getElementById("setdept").value;
            var program = src;

            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "Displaytutionfees.php?dept="+dept+"&prog="+program, true);
            xmlhttp.send();

        }


</script>

	<header id="head" class="secondary">
		<div class="container">
			<h1>Tuition Fees</h1>
			<p>Tuition fees for the 2014-2015 academic year</p>
		</div>
	</header>
<div>
		<section class="container">

			<div class="row">

				<!-- Article main content -->
				<content class="maincontent"> <br>
<p id="setdept" ></p>
<?php
include "database/db_connection.php";

$sql = "select DeptName from department order by DeptName asc";
$result = mysqli_query ( $dbcon, $sql );

$sql = "select distinct ProgName from program order by ProgName asc";
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
	echo "<select id=\"ProgID\" name=\"Prog\" onchange=\"showcontent(this.value)\">";
	echo "<option value=\"\">Select a Program:</option>";
	while ( $row = mysqli_fetch_assoc ( $result2 ) ) {
		echo "<option>" . $row ["ProgName"] . "</option>";
	}
	echo "</select>";
}
// echo " <input class=\"btn btn-success\" type=\"submit\"
// 		value=\"submit\" name=\"submit\" onclick=\showcontent()\">";
		echo "</form>";
?>
<br>
				<div id="txtHint">
					<b>Tuition fees of the department will be listed here...</b>


				</div>

				</content>
			</div>
		</section>
	</div>
	<footer class="footer2">
		<!-- <div class="footer2"> -->
		<div class="container">
			<div class="row">

				<div class="col-md-6 panel">
					<div class="panel-body">
						<p class="simplenav">
							<a href="index.php">Home</a> | <a href="ListofDepts.php">Departments</a>
							| <a href="Programs.php">Program</a> | <a href="Contact.php">Contact</a>
							| <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i
								class="fa fa-facebook"></i></a> <a href="#"><i
								class="fa fa-dribbble"></i></a> <a href="#"><i
								class="fa fa-flickr"></i></a> <a href="#"><i
								class="fa fa-github"></i></a>

						</p>

					</div>
				</div>

				<div class="col-md-6 panel">
					<div class="panel-body">
						<p class="text-right">
							Copyright &copy; 2015. Designed by <a href="http://uncc.edu/"
								rel="develop">FutureNiners.com</a>
						</p>
					</div>
				</div>

			</div>
			<!-- /row of panels -->
		</div>
		<!-- </div>-->
	</footer>

	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="assets/js/modernizr-latest.js"></script>
	<script type='text/javascript' src='assets/js/jquery.min.js'></script>
	<script type='text/javascript'
		src='assets/js/fancybox/jquery.fancybox.pack.js'></script>

	<script type='text/javascript'
		src='assets/js/jquery.mobile.customized.min.js'></script>
	<script type='text/javascript' src='assets/js/jquery.easing.1.3.js'></script>
	<script type='text/javascript' src='assets/js/camera.min.js'></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script>
		jQuery(function(){
			
			jQuery('#camera_wrap_4').camera({
                transPeriod: 500,
                time: 3000,
				height: '600',
				loader: 'false',
				pagination: true,
				thumbnails: false,
				hover: false,
                playPause: false,
                navigation: false,
				opacityOnGrid: false,
				imagePath: 'assets/images/'
			});

		});
      
	</script>

</body>
</html>
