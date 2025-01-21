<?php
require_once "library.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Class Schedules</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <header>
        <?php build_nav(); ?>
    </header>
    <main class="container">
        <section>
            <div class="row">
                <div class="col m-3">
                    <h1>Class Schedules</h1>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col m-3">
                    <?php 
                    create_table_form(
                        mode: "delete",
                        action: "../includes/class_schedules_delete.inc.php",
                        query: "SELECT * FROM class_schedules_view",
                        column_names: [
                            "Class ID", 
                            "Course ID", 
                            "Course Discipline", 
                            "Course Number", 
                            "Section", 
                            "Course Name", 
                            "Term ID", 
                            "Term Name", 
                            "Professor ID", 
                            "Professor First Name", 
                            "Professor Last Name", 
                            "Building Name", 
                            "Room Number", 
                            "Day",
                            "Start Time",
                            "End Time"
                        ],
                        field_names: [
                            "class_id", 
                            "course_id", 
                            "course_discipline", 
                            "course_number", 
                            "section", 
                            "course_name", 
                            "term_id", 
                            "term_name", 
                            "professor_id", 
                            "professor_first_name", 
                            "professor_last_name", 
                            "building_name", 
                            "room_number",
                            "day_letter",
                            "start_time",
                            "end_time"],
                        has_edit: true
                    ); 
                    ?>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <?php build_footer(); ?>
    </footer>
</body>
</html>