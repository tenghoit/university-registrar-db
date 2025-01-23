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
    <title>Student Class History</title>
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
                    <h1>Student Class History</h1>
                </div>
            </div>
            <div class="row">
                <div class="col m-3">
                    <?php 
                    create_table_form(
                        mode: "delete",
                        action: "../includes/student_class_history_delete.inc.php",
                        query: "SELECT * FROM student_class_history_view",
                        column_names: [
                            "Student ID", 
                            "Student Name", 
                            "Class ID", 
                            "Class Code",
                            "Course Name", 
                            "Term Name", 
                            "Grade"
                        ],
                        field_names: [
                            "student_id", 
                            "student_name", 
                            "class_id", 
                            "class_code", 
                            "course_name", 
                            "term_name",
                            "grade"
                        ],
                        has_edit: true
                    ); 
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col m-3">
                    <form action="../includes/student_class_history_insert.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                        <div class="row">
                            <div class="col">
                                <h4>Add Student Class</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?php
                                build_select_input(
                                    query: "SELECT * FROM students_view",
                                    select_label: "Student",
                                    select_id: "student",
                                    required: true,
                                    option_label_formatting: ["student_id", ": ", "student_name"]
                                );
                                ?>
                            </div>
                            <div class="col">
                                <?php
                                build_select_input(
                                    query: "SELECT * FROM classes_view",
                                    select_label: "Class",
                                    select_id: "class",
                                    required: true,
                                    option_label_formatting: ["class_id", ": ", "class_code", ", ", "course_name"]
                                );
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
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