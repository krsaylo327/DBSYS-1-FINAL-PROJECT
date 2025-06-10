<?php
require_once("dbconnect.php");
	if(isset($_POST["log"])){
		$u = $_POST["uname"];
		$p = $_POST["pass"];
		$query = $pdo->prepare("SELECT * FROM users WHERE username=:u AND password=:p");
		$query->bindParam(":u", $u);
		$query->bindParam(":p", $p);
		$query->execute();
		$num = $query->fetchAll(PDO::FETCH_ASSOC);
		if($num>0){
			//echo "matched";
			header("Location:index.php");
		}else{
			echo "not matched";
		}
	}
?>

<!doctype html>
<html>
	<head>
		<title>CCS Library System</title>
		<link href="bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div class="container">
			<div class="row mt-5">	
				<div class="offset-md-2 col-md-8" class="form-group">
					<form method="post" action="login.php" >
						<label>Username</label>
						<input type="text" name="uname" class="form-control" /><br>
						<label>Password</label>
						<input type="password" name="pass" class="form-control" /><br>
						<input type="submit" value="LOGIN" name="log" class="btn btn-primary" />						
					</form>
				</div>	
			</div>
		</div>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/jquery-3.7.1.min.js"></script>
	</body>
</html>