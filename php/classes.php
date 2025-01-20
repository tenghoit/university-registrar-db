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
    <title>Classes</title>
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
                    <h1>Classes</h1>
                </div>
            </div>
        </section>

        <section>
            <div class="row">
                <div class="col m-3">
                    <?php 
                    create_table_form(
                        mode: "delete",
                        action: "../includes/classes_delete.inc.php",
                        query: "SELECT * FROM classes_view",
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
                            "Class Current Capacity", 
                            "Class Max Capacity", 
                            "Schedule", 
                            "Prerequisites"
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
                            "class_current_capacity", 
                            "class_max_capacity", 
                            "schedule", 
                            "prerequisites"
                        ],
                        has_edit: true
                    ); 
                    ?>

                </div>
            </div>
        </section>
            
        <section>
            <div class="row">
                <div class="col m-3">
                    <form action="../includes/classes_insert.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                        <h4>Add Class:</h4><br>

                        <div class="row">
                            <div class="col">
                                <?php
                                build_select_input(
                                    query: "SELECT * FROM courses_view",
                                    select_label: "Course",
                                    select_id: "course",
                                    option_label_formatting: ["course_discipline", " ", "course_number", " - ", "course_name"]
                                );
                                ?>
                            </div>
                            <div class="col">
                                <label for="section" class="form-label">Section</label>
                                <input type="text" class="form-control" id="section" name="section" required><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?php
                                build_select_input(
                                    query: "SELECT * FROM terms_view",
                                    select_label: "Term",
                                    select_id: "term",
                                    option_label_formatting: ["term_name"]
                                );
                                ?>
                            </div>
                            <div class="col">
                                <?php
                                build_select_input(
                                    query: "SELECT * FROM professors_view",
                                    select_label: "Professor",
                                    select_id: "professor",
                                    option_label_formatting: ["professor_first_name", " ", "professor_first_name"]
                                );
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?php
                                build_select_input(
                                    query: "SELECT * FROM locations_view",
                                    select_label: "Location",
                                    select_id: "location",
                                    option_label_formatting: ["building_name", " ", "room_number"]
                                );
                                ?>
                            </div>
                            <div class="col">
                                <label for="class_max_capacity" class="form-label">Class Max Capacity</label>
                                <input type="number" class="form-control" id="class_max_capacity" name="class_max_capacity" required><br>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <?php build_footer(); ?>
    </footer>
</body>
</html>