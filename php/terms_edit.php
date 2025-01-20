<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $reload = true;
}

if (isset($_POST['edit']) && $_POST['edit'] == 1) {
    // Fetch values from the URL parameters
    $term_id = $_POST['term_id'];
    $term_start_date = $_POST['term_start_date'];
    $term_end_date = $_POST['term_end_date'];
}else{
    $reload = true;
}

if($reload == true){
    header("Location: ../php/terms.php");
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
    <title>Terms Edit</title>
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
                    <h1>Terms</h1>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col m-3">
                    <form action="../includes/terms_update.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                        <h4>Edit Term:</h4><br>

                        <div class="row">
                            <div class="col">
                                <label for="term_id" class="form-label">Term ID</label>
                                <input type="text" class="form-control" id="term_id" name="term_id" value="<?php echo htmlspecialchars($term_id); ?>" readonly><br>
                            </div>
                            <div class="col">
                                <label for="term_start_date" class="form-label">Start Date</label>
                                <input type="date" name="term_start_date" id="term_start_date" class="form-control" value="<?php echo htmlspecialchars($term_start_date); ?>" required><br>
                            </div>
                            <div class="col">
                                <label for="term_end_date" class="form-label">End Date</label>
                                <input type="date" name="term_end_date" id="term_end_date" class="form-control" value="<?php echo htmlspecialchars($term_end_date); ?>" required><br>
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