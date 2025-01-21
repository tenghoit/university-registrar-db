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
    <title>Locations</title>
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
                    <h1>Buildings</h1>
                </div>
            </div>
            <div class="row">
                <div class="col m-3">
                    <?php
                    create_table_form(
                        mode: "delete",
                        action: '../includes/buildings_delete.inc.php',
                        query: "SELECT * FROM buildings_view",
                        column_names: ['Building Name'],
                        field_names: ['building_name'],
                        has_edit: false
                    );
                    ?>
                </div>
                <div class="col m-3">
                    <form action="../includes/buildings_insert.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                        <div class="row">
                            <div class="col">
                                <h4>Add Building:</h4><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="building_name" class="form-label">Building Name</label>
                                <input type="text" class="form-control" name="building_name" id="building_name" required><br>
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
        <section>
            <div class="row">
                <div class="col m-3">
                    <h1>Locations</h1>
                </div>
            </div>
            <div class="row">
                <div class="col m-3">
                    <?php
                    create_table_form(
                        mode: "delete",
                        action: "../includes/locations_delete.inc.php",
                        query: "SELECT * FROM locations_view",
                        column_names: ['Building Name', 'Room Number', 'Room Capacity'],
                        field_names: ['building_name', 'room_number', 'room_capacity'],
                        has_edit: true
                    );
                    ?>
                </div>
                <div class="col m-3">
                    <form action="../includes/locations_insert.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                        <div class="row">
                            <div class="col">
                                <h4>Add Location:</h4><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?php
                                build_select_input(
                                    query: "SELECT * FROM buildings_view",
                                    select_label: "Building",
                                    select_id: "building",
                                    required: true,
                                    option_label_formatting: ["building_name"]
                                );
                                ?>
                            </div>
                            <div class="col">
                                <label for="room_number" class="form-label">Room Number</label>
                                <input type="text" class="form-control" name="room_number" id="room_number" required><br>
                            </div>
                            <div class="col">
                                <label for="room_capacity" class="form-label">Room Capacity</label>
                                <input type="number" class="form-control" name="room_capacity" id="room_capacity" required><br>
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