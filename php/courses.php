<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Courses</title>
</head>
<body>
    <h2>Courses</h2>

    <form action="../includes/courses_delete_update.inc.php" method="post">
        <table>
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Course ID</th>
                    <th>Course Discipline</th>
                    <th>Course Number</th>
                    <th>Course Name</th>
                    <th>Course Credits</th>
                    <th>Course Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    require_once "../includes/dbh.inc.php";
                    $query = "SELECT * FROM courses_view;";
                    $stmt = $pdo->prepare($query);    
                    $stmt->execute();
                    
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach($result AS $row){
                        echo "<tr>";
                        echo "<td>
                                <input type='checkbox' name='selects[]' value='" . $row['course_id'] . "'>    
                            </td>";
                            
                        echo "<td>" . htmlspecialchars($row['course_id']) . "</td>";    
                        echo "<td>" . htmlspecialchars($row['course_discipline']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['course_number']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['course_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['course_credits']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['course_description']) . "</td>";

                        echo "<td>
                                <button type='submit' name='edit' value='" . htmlspecialchars(json_encode($row)) . "'>Edit</button>
                            </td>";
                        echo "</tr>";
                        
                    }

                    $pdo = null;
                    $stmt = null;
                
                } catch (PDOException $e) {
                    die("Query Failed: " . $e->getMessage());
                }
                ?>
            </tbody>
        </table>
        <button type="submit" name="delete">Delete Selected</button>
    </form>


    <h3>Add:</h3>
    <form action="../includes/formhandler.inc.php" method="post">
        <label for="course_discipline">Course Discipline</label><br>
        <input type="text" id="course_discipline" name="course_discipline"><br><br>

        <label for="course_number">Course Number</label><br>
        <input type="text" id="course_number" name="course_number"><br><br>

        <label for="course_name">Course Name</label><br>
        <input type="text" id="course_name" name="course_name"><br><br>

        <label for="course_credits">Course Credits</label><br>
        <input type="number" id="course_credits" name="course_credits"><br><br>

        <label for="course_description">Course Description</label><br>
        <input type="text" id="course_description" name="course_description"><br><br>

        <button type="submit">Submit</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>