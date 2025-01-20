<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $reload = true;
}

if (isset($_POST['edit']) && $_POST['edit'] == 1) {
    // Fetch values from the URL parameters
    $building_name = $_POST['building_name'];
    $room_number = $_POST['room_number'];
    $room_capacity = $_POST['room_capacity'];
}else{
    $reload = true;
}

if($reload == true){
    header("Location: ../php/locations.php");
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
                    <h1>Locations</h1>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col m-3">
                    <form action="../includes/locations_update.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                        <div class="row">
                            <div class="col">
                                <h4>Edit Location:</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="building_name" class="form-label">Building Name</label>
                                <input type="text" class="form-control" id="building_name" name="building_name" value="<?php echo htmlspecialchars($building_name); ?>" readonly><br>
                            </div>
                            <div class="col">
                                <label for="room_number" class="form-label">Room Number</label>
                                <input type="text" class="form-control" id="room_number" name="room_number" value="<?php echo htmlspecialchars($room_number); ?>" readonly><br>
                            </div>
                            <div class="col">
                                <label for="room_capacity" class="form-label">Room Capacity</label>
                                <input type="number" class="form-control" id="room_capacity" name="room_capacity" value="<?php echo htmlspecialchars($room_capacity); ?>" required><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-warning">Submit</button>
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