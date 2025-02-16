<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $reload = true;
}

if (isset($_POST['edit']) && $_POST['edit'] == 1) {
    // Fetch values from the URL parameters
    $course_id = $_POST['course_id'];
    $course_discipline = $_POST['course_discipline'];
    $course_number = $_POST['course_number'];
    $course_name = $_POST['course_name'];
    $course_credits = $_POST['course_credits'];
    $course_description = $_POST['course_description'];
}else{
    $reload = true;
}

if($reload == true){
    header("Location: ../php/courses.php");
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
                    <h1>Courses</h1>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col m-3">
                    <form action="../includes/courses_update.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                        <h4>Edit Course:</h4><br>

                        <div class="row">
                            <div class="col">
                                <label for="course_id" class="form-label">Course ID</label>
                                <input type="text" class="form-control" id="course_id" name="course_id" value="<?php echo htmlspecialchars($course_id); ?>" readonly><br>
                            </div>
                            <div class="col">
                                <label for="course_discipline" class="form-label">Course Discipline</label>
                                <input type="text" class="form-control" id="course_discipline" name="course_discipline" value="<?php echo htmlspecialchars($course_discipline); ?>" required><br>
                            </div>
                            <div class="col">
                                <label for="course_number" class="form-label">Course Number</label>
                                <input type="text" class="form-control" id="course_number" name="course_number" value="<?php echo htmlspecialchars($course_number); ?>" required><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="course_name" class="form-label">Course Name</label>
                                <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo htmlspecialchars($course_name); ?>" required><br>
                            </div>
                            <div class="col-2">
                                <label for="course_credits" class="form-label">Course Credits</label>
                                <input type="number" class="form-control" id="course_credits" name="course_credits" value="<?php echo htmlspecialchars($course_credits); ?>" required><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="course_description" class="form-label">Course Description</label>
                                <input type="text" class="form-control" id="course_description" name="course_description" value="<?php echo htmlspecialchars($course_description); ?>" required><br>
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