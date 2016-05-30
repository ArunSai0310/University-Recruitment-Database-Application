<?php include("header.php")?>

	<header id="head">
		<div class="container">
             <div class="heading-text">							
							<h1 class="animated flipInY delay1">Welcome to Future Niners at Charlotte</h1>
							<p>A place where luck meets an opportunity </p>
						</div>
            
					<div class="fluid_container">                       
                    <div class="camera_wrap camera_emboss pattern_1" id="camera_wrap_4">
                        <div data-thumb="assets/images/slides/thumbs/img1.jpg" data-src="assets/images/slides/img1.jpg">
                            <h2>We develop.</h2>
                        </div> 
                        <div data-thumb="assets/images/slides/thumbs/img2.jpg" data-src="assets/images/slides/img2.jpg">
                        </div>
                        <div data-thumb="assets/images/slides/thumbs/img3.jpg" data-src="assets/images/slides/img3.jpg">
                        </div> 
                    </div> 
                </div>
		</div>
	</header>

<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="grey-box-icon">
				<div class="icon-box-top grey-box-icon-pos">
					<img src="assets/images/1.png" alt="" />
				</div>
				<!--icon box top -->
				<h4>Programs</h4>
				<p align="justify">Future Niner's offers hundreds of academic choices to
				 help you prepare for your future. Join more than 27,200
				  students on our beautiful campus, located in the heart
				  of North Carolina's largest metropolitan region, and
				  experience a large urban research university with a small college feel.</p>
				<p>
					<a href="Programs.php"><em>Learn More</em></a>
				</p>
			</div>
			<!--grey box -->
		</div>
		<!--/span3-->
		<div class="col-md-3">
			<div class="grey-box-icon">
				<div class="icon-box-top grey-box-icon-pos">
					<img src="assets/images/2.png" alt="" />
				</div>
				<!--icon box top -->
				<h4>Departments</h4>
				<p align="justify">An academic department is a division of a university or
				 school faculty devoted to a particular academic discipline. 
				 Academic Affairs plans for and facilitates academic programs
				 and services to help students and faculty achieve their academic
				 and professional goals.</p>
					</p>
				<p>
					<a href="listofdepts.php"><em>Learn More</em></a>
				</p>
			</div>
			<!--grey box -->
		</div>
		<!--/span3-->
		<div class="col-md-3">
			<div class="grey-box-icon">
				<div class="icon-box-top grey-box-icon-pos">
					<img src="assets/images/3.png" alt="" />
				</div>
				<!--icon box top -->
				<h4>Campus Life</h4>
				<p align="justify">There are many ways for students to get involved in campus life
				 beyond the classroom, whether through joining one of hundreds 
				of student organizations, participating in intramurals or
				 sport clubs, or by attending a cultural event or University-sponsored
				  activity.<br><br></p>
				<p>
					<a href="Campuslife.php"><em>Learn More</em></a>
				</p>
			</div>
			<!--grey box -->
		</div>
		<!--/span3-->
		<div class="col-md-3">
			<div class="grey-box-icon">
				<div class="icon-box-top grey-box-icon-pos">
					<img src="assets/images/4.png" alt="" />
				</div>
				<!--icon box top -->
				<h4>Faculty</h4>
				<p align="justify">Our faculty win accolades for teaching and
				 research activities and are often sought after as expert sources
				  to comment on important issues. Our staff are lauded for their
				  commitment to the University and the many services they provide
				  for our students.<br><br></p>
				<p>
					<a href="Faculty.php"><em>Learn More</em></a>
				</p>
			</div>
			<!--grey box -->
		</div>
		<!--/span3-->

	</div>
</div>

<hr>

<section class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="title-box clearfix ">
				<h2 class="title-box_primary">About Us</h2>
			</div>
			<p>
				<span>Future Niners is North Carolina's urban research institution.</span>
			</p>
			<p>Our campus is located in the piedmont of North Carolina, just two
			 hours from the mountains and three hours from the Atlantic Ocean.
			  A large public university with a small college feel, more than 
			  27,200 students consider Future Niner's 1,000-acre campus their 
			  home away from home.</p>
			<p>Future Niners maintains a particular commitment to addressing
			 the cultural, economic, educational, environmental, health, and
			  social needs of the greater Charlotte region.</p>
			<p>The complete mission statement is available online.</p>
			
<!-- 			<a href="#" title="read more" class="btn-inline " target="_self">Read -->
<!-- 				more</a> -->
		</div>


		<div class="col-md-4">
			<div class="title-box clearfix todo">
				<h2 class="title-box_primary">Up Coming Events</h2>
			</div>
			<div  class="list styled custom-list">
			<marquee  id='scroll_events' behavior="scroll" direction="up" scrollamount="9"
onmouseover="this.stop();"
onmouseout="this.start();">
				<?php 
				include "database/db_connection.php";
				$sql = "SELECT EventDATE, EventDesc FROM futureniner.schoolevents where EventDATE >= curdate()";
				
				$result = mysqli_query ( $dbcon, $sql );
				if (mysqli_num_rows ( $result ) > 0) {
				
					echo "<table class=\"table\" summary=\"Table\" border=\"0\"
						cellspacing=\"2\" cellpadding=\"1\"><tbody>";
					// output data of each row
					while ( $row = mysqli_fetch_assoc ( $result ) ) {
						$eventdate = $row["EventDATE"];
						$eventdesc = $row["EventDesc"];
						echo "<tr align=\"left\" valign=\"top\" style=\"color:blue\">
                        <td>" . $row["EventDATE"] . "</td>
                        <td>" . $row["EventDesc"] . "</td></tr>";
					}

					echo "</tbody></table>";
				}
				?>
			
				</marquee>
			</div>
		</div>
	</div>
</section>

<?php include("footer.php")?>	