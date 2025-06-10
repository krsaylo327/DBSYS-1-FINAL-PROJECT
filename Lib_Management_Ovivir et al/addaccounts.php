<?php
require_once("dbconnect.php");
$query = $pdo->prepare("INSERT INTO users (username, password, usertype) VALUES (:username, :password, :usertype)");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['addUsername'];
    $password = $_POST['addPassword'];
    $usertype = $_POST['addType'];

    // Hash the password before storing it

    $query->bindParam(":username", $username);
    $query->bindParam(":password", $password);
    $query->bindParam(":usertype", $usertype);

    if ($query->execute()) {
        echo "<div class='alert alert-success'>Account created successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error creating account.</div>";
    }
} else {
    echo "<div class='alert alert-warning'>Please fill out the form to create an account.</div>";
}
?>

<head>
    <link href="bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
</head>
<div class="row">
    <div class="col-3"></div>
    <div class="col-4">
        <form id="add-account" action="/addaccounts.php" method="post" class="row">
            <div class="mb-3 col-12">
                <label for="addUsername" class="form-label">Username</label>
                <input type="text" id="addUsername" name="addUsername" class="form-control"
                    placeholder="Enter username">
            </div>
            <div class="mb-3 col-12">
                <label for="addPassword" class="form-label">Password</label>
                <input type="password" id="addPassword" name="addPassword" class="form-control"
                    placeholder="Enter password">
            </div>
            <div class="mb-3 col-12">
                <select class="form-control" name="addType">
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                    <option value="student">Student</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary col-12">Create account</button>
        </form>
    </div>
    <div class="col-4"></div>
</div>

<script>
    let addAccount = document.querySelector("#add-account");

    addAccount.addEventListener("submit", () => {
        setTimeout(() => {
            window.location.href = "/users.php";
        }, 100);
    })
</script>