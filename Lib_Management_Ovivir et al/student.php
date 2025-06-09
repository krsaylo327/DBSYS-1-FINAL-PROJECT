<?php
require_once("dbconnect.php");
$query = $pdo->prepare("SELECT * FROM student");
$query->execute();
$student = $query->fetchAll(PDO::FETCH_ASSOC);
//echo "<pre>"; 
//	print_r($student);
//echo "</pre>";
require_once("header.php");
?>
	<div class="container">
		<div class="row mt-5">	
			<div class="offset-md-2 col-md-8 ">
				<h1>STUDENTS</h1>
				
			</div>	
		</div>
		<div class="row mt-0">	
			<div class="offset-md-1 col-md-8 ">
				<a href="addstudent.php" class="btn btn-primary">+</a>
				
			</div>	
		</div>
		
		<div class="row mt-5">	
			<div class="offset-md-1 col-md-10 ">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>STUDENT</th>
							<th>NAME</th>
							<th>ADDRESS</th>
							<th>COURSE</th>
							<th>ACTION</th>
						</tr>
					</thead>
					<?php
						foreach($student as $id=>$val){
							echo "<tr>";
								echo "<td>".$id."</td>";
								echo "<td>".$val["name"]."</td>";
								echo "<td>".$val["address"]."</td>";
								echo "<td>".$val["course"]."</td>";
								echo "<td>";
									echo "<button class=\"btn btn-primary btn-sm\">EDIT</button>&nbsp;&nbsp;";
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