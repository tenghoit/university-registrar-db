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
    <title>Locations</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <header>
        <?php build_nav(); ?>
    </header>
    <main class="text-bg-white my-3">
        <div class="container d-grid gap-3">
            <section>
                <div class="row">
                    <div class="col">
                        <h1>Buildings</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?php
                        create_table_form(
                            action: '../includes/buildings_delete.inc.php',
                            query: "SELECT * FROM buildings_view",
                            column_names: ['Building Name'],
                            field_names: ['building_name'],
                            has_edit: false
                        );
                        ?>
                    </div>
                    <div class="col">
                        <form action="../includes/buildings_insert.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                            <div class="row">
                                <div class="col">
                                    <h4>Add Building:</h4><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="building_name" class="form-label">Building Name</label>
                                    <input type="text" class="form-control" name="building_name" id="building_name"><br>
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
                    <div class="col">
                        <h1>Locations</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?php
                        create_table_form(
                            action: "../includes/locations_delete.inc.php",
                            query: "SELECT * FROM locations_view",
                            column_names: ['Building Name', 'Room Number', 'Room Capacity'],
                            field_names: ['building_name', 'room_number', 'room_capacity'],
                            has_edit: true
                        );
                        ?>
                    </div>
                    <div class="col">
                        <form action="../includes/locations_insert.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                            <div class="row">
                                <div class="col">
                                    <h4>Add Location:</h4><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <?php
                                    try {
                                        require "../includes/dbh.inc.php";
                                        $query = "SELECT * FROM buildings_view";
                                        $stmt = $pdo->prepare($query);

                                        $stmt->execute();

                                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        echo "<label for='building_name' class='form-label'>Building Name</label>";
                                        echo "<select name='building_name' id='building_name' class='form-select'>";

                                        foreach($result AS $row){
                                            echo "<option value='" . $row['building_name'] . "'>" . $row['building_name'] . "</option>";
                                        }

                                        echo "</select><br>";

                                        $pdo = null;
                                        $stmt = null;

                                    } catch (PDOException $e) {
                                        die("Query Failed: " . $e->getMessage());
                                    }
                                    ?>
                                </div>
                                <div class="col">
                                    <label for="room_number" class="form-label">Room Number</label>
                                    <input type="text" class="form-control" name="room_number" id="room_number"><br>
                                </div>
                                <div class="col">
                                    <label for="room_capacity" class="form-label">Room Capacity</label>
                                    <input type="number" class="form-control" name="room_capacity" id="room_capacity"><br>
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
        </div>
    </main>
    <footer>
        <?php build_footer(); ?>
    </footer>
</body>
</html>