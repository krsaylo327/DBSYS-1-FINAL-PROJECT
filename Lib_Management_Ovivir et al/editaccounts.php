<?php
require_once("dbconnect.php");
$id = $_POST['editId'];
$username = $_POST['editUsername'];
$password = $_POST['editPassword']; 
$usertype = $_POST['editType'];

$query = $pdo->prepare("UPDATE users SET username=:username, password=:password, usertype=:usertype WHERE userid=:id");
$query->bindParam(":username", $username);
$query->bindParam(":password", $password);
$query->bindParam(":usertype", $usertype);
$query->bindParam(":id", $id);
$query->execute();
?>
<form action="editaccounts.php" method="post">
    <div class="container">
        <div class="row mt-5">	
            <div class="offset-md-2 col-md-8 ">
                <h1>EDIT USER ACCOUNT</h1>
            </div>	
        </div>
        <div class="row mt-2">   
            <div class="offset-md-2 col-md-8 ">
                <input type="hidden" name="editId" value="<?php echo $id; ?>" />
                <label>Username</label>
                <input type="text" name="editUsername" class="form-control" value="<?php echo $username; ?>" /><br>
                <label>Password</label>
                <input type="password" name="editPassword" class="form-control" value="<?php echo $password; ?>" /><br>
                <label>User Type</label>
                <select class="form-control" name="editType">;
                    <option value="admin" <?php if($usertype == "admin") echo "selected"; ?>>Admin</option>
                    <option value="staff" <?php if($usertype == "staff") echo "selected"; ?>>Staff</option>
                </select><br>
                <input type="submit" value="UPDATE" name="update" class="btn btn-primary" />						
            </div>	
        </div>
    </div>
</form>