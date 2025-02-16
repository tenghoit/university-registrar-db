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
    <title>Labs</title>
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
                    <h1>Labs</h1>
                </div>
            </div>
            <div class="row">
                <div class="col m-3">
                    <?php 
                    create_table_form(
                        mode: "delete",
                        action: "../includes/labs_delete.inc.php",
                        query: "SELECT * FROM labs_view",
                        column_names: [
                            "Primary Course ID", 
                            "Primary Course Discipline", 
                            "Primary Course Number", 
                            "Primary Course Name", 
                            "Parent Course ID", 
                            "Parent Course Discipline",
                            "Parent Course Number",
                            "Parent Course Name"
                        ],
                        field_names: [
                            "primary_course_id", 
                            "primary_course_discipline", 
                            "primary_course_number", 
                            "primary_course_name", 
                            "parent_course_id", 
                            "parent_course_discipline",
                            "parent_course_number",
                            "parent_course_name"
                        ],
                        has_edit: false
                    ); 
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col m-3">
                    <form action="../includes/labs_insert.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                        <div class="row">
                            <div class="col">
                                <h4>Add Lab</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?php
                                build_select_input(
                                    query: "SELECT * FROM courses_view",
                                    select_label: "Primary Course",
                                    select_id: "primary_course",
                                    required: true,
                                    option_label_formatting: ["course_discipline", " ", "course_number", " - ", "course_name"]
                                );
                                ?>
                            </div>
                            <div class="col">
                                <?php
                                build_select_input(
                                    query: "SELECT * FROM courses_view",
                                    select_label: "Parent Course",
                                    select_id: "parent_course",
                                    required: true,
                                    option_label_formatting: ["course_discipline", " ", "course_number", " - ", "course_name"]
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