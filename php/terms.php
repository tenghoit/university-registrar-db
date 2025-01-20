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
    <title>Terms</title>
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
                    <?php 
                    create_table_form(
                        mode: "delete",
                        action: "../includes/terms_delete.inc.php",
                        query: "SELECT * FROM terms_view",
                        column_names: ["Term ID", "Start Date", "End Date"],
                        field_names: ["term_id", "term_start_date", "term_end_date"],
                        has_edit: true
                    ); 
                    ?>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col m-3">
                    <form action="../includes/terms_insert.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                        <h4>Add Term</h4><br>

                        <div class="row">
                            <div class="col">
                                <label for="term_start_date" class="form-label">Start Date</label>
                                <input type="date" name="term_start_date" id="term_start_date" class="form-control" required><br>
                            </div>
                            <div class="col">
                                <label for="term_end_date" class="form-label">End Date</label>
                                <input type="date" name="term_end_date" id="term_end_date" class="form-control" required><br>
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