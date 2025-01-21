<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $reload = true;
}

if (isset($_POST['edit']) && $_POST['edit'] == 1) {
    // Fetch values from the URL parameters
    $class_id = $_POST['class_id'];
    $course_id = $_POST['course_id'];
    $section = $_POST['section'];
    $term_id = $_POST['term_id'];
    $professor_id = $_POST['professor_id'];
    $building_name = $_POST['building_name'];
    $room_number = $_POST['room_number'];
    $class_max_capacity = $_POST['class_max_capacity'];
}else{
    $reload = true;
}

if($reload == true){
    header("Location: ../php/classes.php");
    exit();
}

require_once "library.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Course Edit</title>
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
                    <form action="../includes/classes_update.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                        <h4>Edit Class:</h4><br>

                        <div class="row">
                            <div class="col">
                                <label for="class_id" class="form-label">Class ID</label>
                                <input type="text" class="form-control" id="class_id" name="class_id" value="<?php echo htmlspecialchars($class_id); ?>" readonly><br>
                            </div>
                            <div class="col">
                                <?php
                                build_select_input(
                                    query: "SELECT * FROM courses_view",
                                    select_label: "Course",
                                    select_id: "course",
                                    required: true,
                                    option_label_formatting: ["course_discipline", " ", "course_number", " - ", "course_name"],
                                    existing_value: ['course_id' => $course_id]
                                );
                                ?>
                            </div>
                            <div class="col-2">
                                <label for="section" class="form-label">Section</label>
                                <input type="text" class="form-control" id="section" name="section" value="<?php echo htmlspecialchars($section); ?>" required><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?php
                                build_select_input(
                                    query: "SELECT * FROM terms_view",
                                    select_label: "Term",
                                    select_id: "term",
                                    required: true,
                                    option_label_formatting: ["term_name"],
                                    existing_value: ['term_id' => $term_id]
                                );
                                ?>
                            </div>
                            <div class="col">
                                <?php
                                build_select_input(
                                    query: "SELECT * FROM professors_view",
                                    select_label: "Professor",
                                    select_id: "professor",
                                    required: true,
                                    option_label_formatting: ["professor_first_name", " ", "professor_first_name"],
                                    existing_value: ['professor_id' => $professor_id]
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
                                    required: true,
                                    option_label_formatting: ["building_name", " ", "room_number"],
                                    existing_value: ['building_name' => $building_name, 'room_number' => $room_number]
                                );
                                ?>
                            </div>
                            <div class="col">
                                <label for="class_max_capacity" class="form-label">Class Max Capacity</label>
                                <input type="number" class="form-control" id="class_max_capacity" name="class_max_capacity" value="<?php echo htmlspecialchars($class_max_capacity); ?>" required><br>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning">Submit</button>
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