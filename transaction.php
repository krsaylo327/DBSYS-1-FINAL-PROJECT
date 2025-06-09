<?php
require_once("dbconnect.php");
$sql = "select * from borrow inner join books on borrow.id = books.bookid inner join student on borrow.id != student_id;";
$result = $pdo->prepare($sql);
$result->execute();
$row= $result->fetchAll(PDO::FETCH_ASSOC);
//echo "<pre>"; 
//	print_r($users);
	//echo "</pre>";
require_once("header.php");
?>
	<div class="container">
		<div class="row mt-5">	
			<div class="offset-md-2 col-md-8 ">
				<h1>BORROW BOOKS</h1>
				<a href="borrow.php" class="btn btn-primary">BORROW BOOKS</a>
			</div>	
		</div>
		<div class="row mt-5">	
			<div class="offset-md-2 col-md-8 ">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>USERID</th>
							<th>STUDENTNAME</th>
							<th>STUDENTID</th>
							<th>TITLE</th>
							<th>DATE BORROWED</th>
                            <th>DATE RETURNED</th>
                            <th>ACTION</th>
						</tr>
					</thead>
					<?php
						foreach($row as $id=>$val){
							echo "<tr>";
								echo "<td>".$val["id"]."</td>";
								echo "<td>".$val["name"]."</td>";
								echo "<td>".$val["book_id"]."</td>";
								echo "<td>".$val["title"]."</td>";
                                echo "<td>".$val["date_borrowed"]."</td>";
                                echo "<td>".$val["date_returned"]."</td>";
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