<?php
require("dbconnect.php");
$student = 1;
$book = 1;
$borrowed = "20250609";
$returned = "20250609";


$student_query = $pdo->prepare("SELECT * FROM student");
$student_query->execute();
$students = $student_query->fetchAll(PDO::FETCH_ASSOC);

$book = $pdo->prepare("SELECT * FROM books");
$book->execute();
$books = $student_query->fetchAll(PDO::FETCH_ASSOC);

$borrow_query = $pdo->prepare("INSERT INTO borrow(date_borrowed, date_returned) VALUES(:borrowed, :returned)");
$borrow_query->bindParam(":borrowed", $borrowed);
$borrow_query->bindParam(":returned", $returned);
$borrow_query->execute();
?>

<head>
    <link href="bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <form action="/borrow.php" method="post" class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="mb-3 button group">
                <label for="borrow-student" class="form-label">Student</label>
                <select name="student" id="borrow-student" class="form-control" name="student">
                    <option>--SELECT--</option>
                    <?php
                    foreach ($students as $student) {
                        echo "<option value=" . $student["id"] . ">" . $student["name"] . "</option>";
                    }
                    ?>
                </select>

            </div>

            <div class="mb-3 button-group">
                <label for="borrow-book" class="form-label" name="book">Book</label>
                <select name="book" id="borrow-book" class="form-control">
                    <option>--SELECT--</option>
                    <option value="1">Book A</option>
                    <option value="2">Javascript for Dummies</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">BORROW BOOK</button>
        </div>
        <div class="col-4"></div>
    </form>
</body>