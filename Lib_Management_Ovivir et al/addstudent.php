<?php
require_once("dbconnect.php");

$student_name = $_POST["name"] ?? null;
$student_id = $_POST["student-id"] ?? null;
$student_address = $_POST["address"] ?? null;

$course=array();
$sqlcourse="SELECT * FROM course ORDER BY coursename ASC";
$resultc = $pdo->prepare($sqlcourse);
$resultc->execute();
while($rowc= $resultc->fetch(PDO::FETCH_ASSOC)){
	$course[$rowc['courseid']] = $rowc['coursename'];
}

$student_query = $pdo->prepare("INSERT INTO student VALUES(0, :studentname, :studentaddress, 0, :studentcourse, 0)");
$student_query->bindParam(":studentname", $student_name);
$student_query->bindParam(":studentaddress", $student_address);
$student_query->bindParam(":studentid", $student_id);
$student_query->execute();

//print_r($course);
require_once("header.php");
?>
	<div class="container">
		<div class="row mt-5">	
			<div class="offset-md-2 col-md-8 ">
				<h1>ADD STUDENT</h1>
				
			</div>	
		</div>
		<div class="row mt-2">   
			<div class="offset-md-2 col-md-8 ">
				<form method="post" action="addstudent.php" >
					<label for="name">Name</label>
					<input type="text" id="name" name="name" class="form-control" /><br>
					<label for="student_id">STUDENT ID</label>
					<input type="text" id="student_id" name="student_id" class="form-control" /><br>
					<label for="address">ADDRESS</label>
					<input type="text" id="address" name="address" class="form-control" /><br>
					<label>COURSE</label>
					<select class="form-control"  name="course">
						<option value="#">--SELECT--</option>
						<?php foreach($course as $id =>$val){ ?>
						<option value="<?php echo $id; ?>"><?php echo $val; ?></option>
						<?php } ?>
					</select>
					<br/>	
					<button type="submit" class="btn btn-primary">ADD STUDENT</button>					
				</form>
			</div>	
		</div>
	</div>
	
<?php
require_once("footer.php");
?>