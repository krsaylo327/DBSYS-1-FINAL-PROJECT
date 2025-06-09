<?php
require_once("dbconnect.php");
if(isset($_GET["id"])){
	$id=$_GET["id"];
	$sql = "SELECT * FROM course WHERE courseid='$id'";
	$result= mysqli_query($con, $sql);
	while($row = mysqli_fetch_array($result)){
		$id = $row["courseid"];
		$code = $row["code"];
		$name = $row["coursename"];
		$dept = $row["department"];
	}	
}
if(isset($_POST["edit"])){
	$id=$_POST["cid"];
	$c=$_POST["code"];
	$cn=$_POST["name"];
	$d=$_POST["dept"];
	$sql ="UPDATE course ".
			"SET code='$c', ".
			"coursename = '$cn', ".
			"department='$d' ".
			"WHERE courseid='$id'";
	mysqli_query($con,$sql);
	header("Location:course.php");
}


require_once("header.php");
?>
	<div class="container">
		<div class="row mt-5">	
			<div class="offset-md-2 col-md-8 ">
				<h1>EDIT COURSE</h1>
				
			</div>	
		</div>
		<div class="row mt-2">   
			<div class="offset-md-2 col-md-8 ">
				<form method="post" action="editcourse.php" >
					<input type="hidden" name="cid" value="<?php echo $id; ?>" />
					<label>Course Code</label>
					<input type="text" name="code" class="form-control" value="<?php echo $code; ?>" /><br>
					<label>Course Name</label>
					<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" /><br>
					<label>Department</label>
					<select class="form-control" name="dept">
						<option value="#">--SELECT--</option>
						<option value="CAS" <?php if($dept=="CAS"){ echo "selected"; } ?> >College of Arts & Sciences</option>
						<option value="CBA" <?php if($dept=="CBA"){ echo "selected"; } ?>>College of Business & Accountancy</option>
						<option value="CCJE" <?php if($dept=="CCJE"){ echo "selected"; } ?>>College of Criminal Justice Education</option>
						<option value="CCS" <?php if($dept=="CCS"){ echo "selected"; } ?> >College of Computer Studies</option>
						<option value="CEA" <?php if($dept=="CEA"){ echo "selected"; } ?>>College of Engineering & Architecture</option>
						<option value="CIT" <?php if($dept=="CIT"){ echo "selected"; } ?>>College of Industrial Technology</option>
						<option value="CMS" <?php if($dept=="CMS"){ echo "selected"; } ?>>College of Maritime Studies</option>
						<option value="CTE" <?php if($dept=="CTE"){ echo "selected"; } ?>>College of Teacher Education</option>
					</select>
					<br>
					<input type="submit" value="EDIT" name="edit" class="btn btn-primary" />						
				</form>
			</div>	
		</div>
	</div>
	
<?php
require_once("footer.php");
?>