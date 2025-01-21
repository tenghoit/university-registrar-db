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
    <title>Degree Requirements</title>
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
                    <h1>Degree Requirements</h1>
                </div>
            </div>
            <div class="row">
                <div class="col m-3">
                    <?php 
                    create_table_form(
                        mode: "delete",
                        action: "../includes/degree_requirements_delete.inc.php",
                        query: "SELECT * FROM degree_requirements_view",
                        column_names: [
                            "Degree ID", 
                            "Degree Name", 
                            "Degree Type", 
                            "Course ID", 
                            "Course Discipline",
                            "Course Number",
                            "Course Name"
                        ],
                        field_names: [
                            "degree_id", 
                            "degree_name", 
                            "degree_type", 
                            "course_id", 
                            "course_discipline", 
                            "course_number",
                            "course_name"
                        ],
                        has_edit: false
                    ); 
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col m-3">
                    <form action="../includes/degree_requirements_insert.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                        <div class="row">
                            <div class="col">
                                <h4>Add Degree Requirement</h4><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <?php
                                build_select_input(
                                    query: "SELECT * FROM degrees_view",
                                    select_label: "Degree",
                                    select_id: "degree",
                                    required: true,
                                    option_label_formatting: ["degree_name", " ", "degree_type"]
                                );
                            ?>
                            </div>
                            <div class="col">
                            <?php
                                build_select_input(
                                    query: "SELECT * FROM courses_view",
                                    select_label: "Course",
                                    select_id: "course",
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