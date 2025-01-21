<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $reload = true;
}

if (isset($_POST['edit']) && $_POST['edit'] == 1) {
    // Fetch values from the URL parameters
    $class_id = $_POST['class_id'];
    $old_day_letter = $_POST['day_letter'];
    $old_start_time = $_POST['start_time'];
    $old_end_time = $_POST['end_time'];
}else{
    $reload = true;
}

if($reload == true){
    header("Location: ../php/class_schedules.php");
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
                    <form action="../includes/class_schedules_update.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                        <h4>Edit Class Schedule:</h4><br>

                        <div class="row">
                            <div class="col">
                                <label for="class_id" class="form-label">Class ID</label>
                                <input type="text" class="form-control" id="class_id" name="class_id" value="<?php echo htmlspecialchars($class_id); ?>" readonly><br>
                            </div>
                            <div class="col">
                                <?php
                                build_select_input(
                                    query: "SELECT * FROM days_view",
                                    select_label: "Day",
                                    select_id: "day",
                                    required: true,
                                    option_label_formatting: ["day_name"],
                                    existing_value: ['day_letter' => $old_day_letter]
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
                                    option_label_formatting: ["start_time", " - ", "end_time"],
                                    existing_value: ['start_time' => $old_start_time, 'end_time' => $old_end_time]
                                );
                                ?>
                            </div>
                        </div>

                        <input type="hidden" name="old_day_letter" value="<?php echo htmlspecialchars($old_day_letter); ?>">
                        <input type="hidden" name="old_start_time" value="<?php echo htmlspecialchars($old_start_time); ?>">
                        <input type="hidden" name="old_end_time" value="<?php echo htmlspecialchars($old_end_time); ?>">

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