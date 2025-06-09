<?php
require_once("dbconnect.php");
$query = $pdo->prepare("SELECT * FROM books");
$query->execute();
$books = $query->fetchAll(PDO::FETCH_ASSOC);
//echo "<pre>"; 
//	print_r($student);
//echo "</pre>";
require_once("header.php");
?>
<div class="container">
    <div class="row mt-5">
        <div class="offset-md-2 col-md-8 ">
            <h1>BOOKS</h1>

        </div>
    </div>
    <div class="row mt-0">
        <div class="offset-md-1 col-md-8 ">
            <a href="addstudent.php" class="btn btn-primary">+</a>

        </div>
    </div>

    <div class="row mt-5">
        <div class="offset-md-1 col-md-10 ">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th>DESCRIPTION</th>
                        <th>ISBN</th>
                        <th>AUTHOR</th>
                    </tr>
                </thead>
                <?php
                foreach ($books as $book) {
                    echo "<tr>";
                    echo "<td>" . $id . "</td>";
                    echo "<td>" . $val["title"] . "</td>";
                    echo "<td>" . $val["description"] . "</td>";
                    echo "<td>" . $val["isbn"] . "</td>";
                    echo "<td>" . $val["author"] . "</td>";
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