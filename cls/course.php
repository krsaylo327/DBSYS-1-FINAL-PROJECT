<?php
require_once("dbconnect.php");
$sql = "SELECT * FROM course";
$result = mysqli_query($con, $sql);
$course = array();
while($row=mysqli_fetch_array($result)){
	$course[$row["courseid"]] = array(
				"id"=>$row["courseid"],
				"c"=>$row["code"],
				"cn"=>$row["coursename"],
				"dept"=>$row["department"]		
			); 
}
//echo "<pre>"; 
//	print_r($users);
	//echo "</pre>";
require_once("header.php");
?>
	<div class="container">
		<div class="row mt-5">	
			<div class="offset-md-2 col-md-8 ">
				<h1>COURSE</h1>
				
			</div>	
		</div>
		<div class="row mt-1">	
			<div class="offset-md-2 col-md-8 ">
				<a href="addcourse.php" class="btn btn-primary">ADD NEW COURSE</a>
				
			</div>	
		</div>
		<div class="row mt-2">	
			<div class="offset-md-2 col-md-8 ">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>CODE</th>
							<th>COURSENAME</th>
							<th>DEPARTMENT</th>
							<th>ACTION</th>
						</tr>
					</thead>
					<?php
						foreach($course as $id=>$val){
							echo "<tr>";
								echo "<td>".$val["id"]."</td>";
								echo "<td>".$val["c"]."</td>";
								echo "<td>".$val["cn"]."</td>";
								echo "<td>".$val["dept"]."</td>";
								echo "<td>";
									echo "<a href=\"editcourse.php?id=$id\" class=\"btn btn-primary btn-sm\">EDIT</a>&nbsp;&nbsp;";
									echo "<button class=\"btn btn-danger btn-sm\">DELETE</button>";
								echo "</td>";
							echo "</tr>";
						}
					
					?>
				</table>
			</div>	
		</div>
	</div>
	
<?php
require_once("footer.php");
?>