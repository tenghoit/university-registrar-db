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
                            "Class Code", 
                            "Course Name", 
                            "Term Name", 
                            "Professor Name", 
                            "Location",  
                            "Day",
                            "Start Time",
                            "End Time"
                        ],
                        field_names: [
                            "class_id", 
                            "class_code", 
                            "course_name", 
                            "term_name", 
                            "professor_name", 
                            "location",
                            "day_letter",
                            "start_time",
                            "end_time"],
                        has_edit: true
                    ); 
                    ?>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col m-3">
                    <form action="../includes/class_schedules_insert.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                        <h4>Add Class Schedule:</h4><br>

                        <div class="row">
                            <div class="col">
                                <?php
                                build_select_input(
                                    query: "SELECT * FROM classes_view",
                                    select_label: "Class",
                                    select_id: "class",
                                    required: true,
                                    option_label_formatting: ["class_code", ": ", "course_name", ", ", "term_name"]
                                );
                                ?>
                            </div>
                            <div class="col">
                                <?php
                                build_select_input(
                                    query: "SELECT * FROM days_view",
                                    select_label: "Day",
                                    select_id: "day",
                                    required: true,
                                    option_label_formatting: ["day_name"]
                                );
                                ?>
                            </div>
                            <div class="col">
                                <?php
                                build_select_input(
                                    query: "SELECT * FROM time_blocks_view",
                                    select_label: "Time Block",
                                    select_id: "time_block",
                                    required: true,
                                    option_label_formatting: ["start_time", " - ", "end_time"]
                                );
                                ?>
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