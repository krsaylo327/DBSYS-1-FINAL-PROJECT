<?php
require_once("dbconnect.php");
if(isset($_POST["add"])){
	$c=$_POST["code"];
	$cn=$_POST["name"];
	$d=$_POST["dept"];
	$sql="INSERT INTO course ".
		"(`code`,`coursename`,`department`) ".
		"VALUES ".
		"('$c','$cn','$d')";
	mysqli_query($con, $sql);
	header("Location:course.php");
}

require_once("header.php");
?>
	<div class="container">
		<div class="row mt-5">	
			<div class="offset-md-2 col-md-8 ">
				<h1>ADD COURSE</h1>
				
			</div>	
		</div>
		<div class="row mt-2">	
			<div class="offset-md-2 col-md-8 ">
				<form method="post" action="addcourse.php" >
					<label>Course Code</label>
					<input type="text" name="code" class="form-control" /><br>
					<label>Course Name</label>
					<input type="text" name="name" class="form-control" /><br>
					<label>Department</label>
					<select class="form-control" name="dept">
						<option value="#">--SELECT--</option>
						<option value="CAS">College of Arts & Sciences</option>
						<option value="CBA">College of Business & Accountancy</option>
						<option value="CCJE">College of Criminal Justice Education</option>
						<option value="CCS">College of Computer Studies</option>
						<option value="CEA">College of Engineering & Architecture</option>
						<option value="CIT">College of Industrial Technology</option>
						<option value="CMS">College of Maritime Studies</option>
						<option value="CTE">College of Teacher Education</option>
					</select>
					<br>
					<input type="submit" value="ADD" name="add" class="btn btn-primary" />						
				</form>
			</div>	
		</div>
	</div>
	
<?php
require_once("footer.php");
?>