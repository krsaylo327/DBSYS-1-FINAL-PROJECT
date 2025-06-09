<?php
require_once("dbconnect.php");
$query = $pdo->prepare("SELECT * FROM authors");
$query->execute();
$users = $query->fetchAll(PDO::FETCH_ASSOC);
//echo "<pre>"; 
//	print_r($users);
//echo "</pre>";
require_once("header.php");
?>
<div id="delete-author" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<div class="modal-title">
					<h4>Delete author?</h4>
				</div>
			</div>

			<form action="/deleteauthor.php" method="post">
				<div class="modal-body">
					<p>Are you sure do you want to delete this author?</p>
					<input type="text" id="deleteAuthId" name="deleteId">
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="container">
	<div class="row mt-5">
		<div class="offset-md-2 col-md-8 ">
			<h1>AUTHORS</h1>
			<a href="/addauthor.php" class="btn btn-primary">ADD AUTHOR</a>
		</div>
	</div>
	<div class="row mt-5">
		<div class="offset-md-2 col-md-8 ">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>FIRSTNAME</th>
						<th>MIDDLENAME</th>
						<th>LASTNAME</th>
						<th>ACTION</th>
					</tr>
				</thead>
				<?php
				foreach ($users as $id => $val) {
					echo "<tr>";
					echo "<td class='author-id'>"."<input type=\"text\" id=\"authorId\" value=".$val["id"]."></td>";
					echo "<td>" . $val["firstname"] . "</td>";
					echo "<td>" . $val["middlename"] . "</td>";
					echo "<td>" . $val["lastname"] . "</td>";
					echo "<td>";
					echo "<button class=\"btn btn-primary btn-sm\">EDIT</button>&nbsp;&nbsp;";
					echo "<button class=\"btn btn-danger btn-sm author-action-delete\" data-bs-toggle='modal' data-bs-target='#delete-author' onclick=\"deleteAuthId.value=authorId.value\">DELETE</button>";
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