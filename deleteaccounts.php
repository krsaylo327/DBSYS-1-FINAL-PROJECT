<?php
require_once("dbconnect.php");
$idX = $_POST['deleteId'];

$query = $pdo->prepare("DELETE FROM users WHERE userid=:id");
$query->bindParam(":id", $idX);
if (!$query) {
    die("Query preparation failed: " . $pdo->errorInfo());
}
$query->execute();
?>

<script>
    setTimeout(() => {
        window.location.href = "users.php"
    }, 100);
</script>