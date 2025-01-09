<?php
require "library.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Courses</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <header>
        <?php build_nav(); ?>
    </header>

    <main class="text-bg-white">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Courses</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>Add, Edit, Remove Courses</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    

    <?php
    if (isset($_POST['edit']) && $_POST['edit'] == 1) {
        echo 'echo';
        // Fetch values from the URL parameters
        $course_id = $_POST['course_id'];
        $course_discipline = $_POST['course_discipline'];
        $course_number = $_POST['course_number'];
        $course_name = $_POST['course_name'];
        $course_credits = $_POST['course_credits'];
        $course_description = $_POST['course_description'];

        ?>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3>Edit Course:</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form action="../includes/courses_update.inc.php" method="post">

                            <label for="course_id" class="form-label">Course ID</label><br>
                            <input type="text" class="form-control" id="course_id" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>" readonly><br><br>

                            <label for="course_discipline" class="form-label">Course Discipline</label><br>
                            <input type="text" class="form-control" id="course_discipline" name="course_discipline" value="<?php echo htmlspecialchars($course_discipline); ?>"><br><br>

                            <label for="course_number" class="form-label">Course Number</label><br>
                            <input type="text" class="form-control" id="course_number" name="course_number" value="<?php echo htmlspecialchars($course_number); ?>"><br><br>

                            <label for="course_name" class="form-label">Course Name</label><br>
                            <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo htmlspecialchars($course_name); ?>"><br><br>

                            <label for="course_credits" class="form-label">Course Credits</label><br>
                            <input type="number" class="form-control" id="course_credits" name="course_credits" value="<?php echo htmlspecialchars($course_credits); ?>"><br><br>

                            <label for="course_description" class="form-label">Course Description</label><br>
                            <input type="text" class="form-control" id="course_description" name="course_description" value="<?php echo htmlspecialchars($course_description); ?>"><br><br>

                            <button type="submit" class="btn btn-warning">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
        
    <?php
    }else{
        ?>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?php 
                        create_table_form(
                            action: "../includes/courses_delete.inc.php",
                            query: "SELECT * FROM courses_view",
                            column_names: ["Course ID", "Course Discipline", "Course Number", "Course Name", "Course Credits", "Course Description"],
                            field_names: ["course_id", "course_discipline", "course_number", "course_name", "course_credits", "course_description"],
                            has_edit: true
                        ); 
                        ?>
                    </div>
                </div>
            </div>
        </section>
        
        <section>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3>Add Course:</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form action="../includes/courses_insert.inc.php" method="post">
                            <label for="course_discipline" class="form-label">Course Discipline</label><br>
                            <input type="text" class="form-control" id="course_discipline" name="course_discipline"><br><br>

                            <label for="course_number" class="form-label">Course Number</label><br>
                            <input type="text" class="form-control" id="course_number" name="course_number"><br><br>

                            <label for="course_name" class="form-label">Course Name</label><br>
                            <input type="text" class="form-control" id="course_name" name="course_name"><br><br>

                            <label for="course_credits" class="form-label">Course Credits</label><br>
                            <input type="number" class="form-control" id="course_credits" name="course_credits"><br><br>

                            <label for="course_description" class="form-label">Course Description</label><br>
                            <input type="text" class="form-control" id="course_description" name="course_description"><br><br>

                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
    <?php } ?>

    <footer class="text-bg-dark text-center mt-auto">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="p-2">&copy; 2025 University. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>