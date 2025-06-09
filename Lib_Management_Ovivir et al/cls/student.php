<?php
require_once("dbconnect.php");
$sql = "SELECT * ";
       "FROM student s,course c, users u ",
	   "WHERE s.courseid=c.courseid ",
	   "AND s.userid = u.userid";
$result = mysqli_query($con, $sql);
$users = array();
while($row=mysqli_fetch_array($result)){
	$student[$row["studentid"]] = array(
				"name"=>$row["name"],
				"address"=>$row["address"],
				"course"=>$row["coursename"],
				"studentID"=>$row["studentID"]
				"uname"=>$row["username"]
				"pass"=>$row["password"]
			);
}
//echo "<pre>"; 
//	print_r($student);
	//echo "</pre>";
require_once("header.php");
?>
	<div class="container">
		<div class="row mt-5">	
			<div class="offset-md-2 col-md-8 ">
				<h1>USER ACCOUNTS</h1>
				
			</div>	
		</div>
		<div class="row mt-5">	
			<div class="offset-md-2 col-md-8 ">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>STUDENT</th>
							<th>NAME</th>
							<th>ADDRESS</th>
							<th>COURSE</th>
							<th>USERNAME</th>
							<th>PASSWORD</th>
							<th>USERTYPE</th>
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
								echo "<td>".$val["uname"]."</td>";
								echo "<td>".$val["pass"]."</td>";
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