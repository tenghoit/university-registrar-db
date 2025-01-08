<?php
require "library.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
</head>
<body>
    <h2>Courses</h2>

    <?php
        create_table_form(
            action: "../includes/courses_delete_update.inc.php",
            query: "SELECT * FROM courses_view",
            column_names: ["Course ID", "Course Discipline", "Course Number", "Course Name", "Course Credits", "Course Description"],
            field_names: ["course_id", "course_discipline", "course_number", "course_name", "course_credits", "course_description"],
            has_edit: true
        );
    ?>

    <h3>Add:</h3>
    <form action="../includes/courses_insert.inc.php" method="post">
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

</body>
</html>