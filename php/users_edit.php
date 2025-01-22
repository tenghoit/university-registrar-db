<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $reload = true;
}

if (isset($_POST['edit']) && $_POST['edit'] == 1) {
    // Fetch values from the URL parameters
    $user_id = $_POST['user_id'];
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_email = $_POST['user_email'];
    $user_phone_number = $_POST['user_phone_number'];
    $user_address = $_POST['user_address'];
    $user_city = $_POST['user_city'];
    $user_state = $_POST['user_state'];
    $user_zip_code = $_POST['user_zip_code'];
}else{
    $reload = true;
}

if($reload == true){
    header("Location: ../php/users.php");
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
                    <h1>Users</h1>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col m-3">
                    <form action="../includes/users_update.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                        <div class="row">
                            <div class="col">
                                <h4>Edit User:</h4><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="user_id" class="form-label">User ID</label>
                                <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>" readonly><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="user_first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="user_first_name" name="user_first_name" value="<?php echo htmlspecialchars($user_first_name); ?>" required><br>
                            </div>
                            <div class="col">
                                <label for="user_last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="user_last_name" name="user_last_name" value="<?php echo htmlspecialchars($user_last_name); ?>" required><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="user_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo htmlspecialchars($user_email); ?>" required><br>
                            </div>
                            <div class="col">
                                <label for="user_phone_number" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="user_phone_number" name="user_phone_number" value="<?php echo htmlspecialchars($user_phone_number); ?>" required><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="user_address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="user_address" name="user_address" value="<?php echo htmlspecialchars($user_address); ?>" required><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="user_city" class="form-label">City</label>
                                <input type="text" class="form-control" id="user_city" name="user_city" value="<?php echo htmlspecialchars($user_city); ?>" required><br>
                            </div>
                            <div class="col">
                                <label for="user_state" class="form-label">State</label>
                                <select class="form-select" id="user_state" name="user_state" required>
                                    <?php 
                                    $states = [
                                        "AL", "AK", "AR", "AZ", "CA", "CO", "CT", "DC", "DE", "FL",
                                        "GA", "HI", "IA", "ID", "IL", "IN", "KS", "KY", "LA", "MA",
                                        "MD", "ME", "MI", "MN", "MO", "MS", "MT", "NC", "NE", "NH",
                                        "NJ", "NM", "NV", "NY", "ND", "OH", "OK", "OR", "PA", "RI",
                                        "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WI", "WV", "WY"
                                    ];
                                    foreach ($states as $state) {
                                        $selected = ($user_state === $state) ? "selected" : "";
                                        echo "<option value='$state' $selected>$state</option>";
                                    }
                                    ?>
                                </select><br>
                            </div>
                            <div class="col">
                                <label for="user_zip_code" class="form-label">ZIP Code</label>
                                <input type="text" class="form-control" id="user_zip_code" name="user_zip_code" value="<?php echo htmlspecialchars($user_zip_code); ?>" required><br>
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