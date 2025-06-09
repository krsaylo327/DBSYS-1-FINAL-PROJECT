<?php
require("dbconnect.php");
$firstname = $_POST["firstname"] ?? null;
$middlename = $_POST["middlename"] ?? null;
$lastname = $_POST["lastname"] ?? null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $query = $pdo->prepare("INSERT INTO authors(firstname, middlename, lastname) VALUES(:firstname, :middlename, :lastname)");
    $query->bindParam(":firstname", $firstname);
    $query->bindParam(":middlename", $middlename);
    $query->bindParam(":lastname", $lastname);

    if ($query->execute()) {
        echo "<div class='alert alert-success'>Author created successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error creating author.</div>";
    }
} else {
     echo "<div class='alert alert-warning'>You need to fill out this form</div>";
}
?>

<head>
    <link href="bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
</head>
<div class="row no-gutter">
    <div class="col-4"></div>
    <div class="col-4">
        <form action="/addauthor.php" method="post" class="row">
            <div class="mb-3">
                <label for="author-firstname" class="form-label">Firstname</label>
                <input type="text" id="author-firstname" name="firstname" class="form-control">
            </div>
            <div class="mb-3">
                <label for="author-middlename" class="form-label">Middlename</label>
                <input type="text" id="author-middlename" name="middlename" class="form-control">
            </div>
            <div class="mb-3">
                <label for="author-lastname" class="form-label">Lastname</label>
                <input type="text" id="author-lastname" name="lastname" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Create now</button>
        </form>
    </div>
    <div class="col-4"></div>
</div>