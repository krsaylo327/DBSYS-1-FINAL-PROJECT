<?php
require_once("dbconnect.php");
$id = $_POST['id'];

$query = $pdo->prepare("DELETE FROM users WHERE userid=:id");
$query->bindParam(":id", $id);
if (!$query) {
    die("Query preparation failed: " . $pdo->errorInfo());
}
$query->execute();
?>

<script>
    setTimeout(() => {
        window.location.href = "author.php"
    }, 100);
</script>