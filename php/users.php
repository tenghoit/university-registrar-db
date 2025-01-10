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
    <title>Document</title>
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
                        <h1>Users</h1>
                    </div>
                </div>
            </section>
            <section>
                <div class="row">
                    <div class="col">
                        <?php 
                        create_table_form(
                            action: "../includes/users_delete.inc.php",
                            query: "SELECT * FROM users_view",
                            column_names: ['User ID', 'First Name', 'Last Name', 'Email', 'Phone Number', 'Street', 'City', 'State', 'ZIP Code'],
                            field_names: ["user_id", "user_first_name", "user_last_name", "user_email", "user_phone_number", "user_street", "user_city", "user_state", "user_zip_code"],
                            has_edit: true
                        ); 
                        ?>
                    </div>
                </div>
            </section>
            <section>
                <div class="row">
                    <div class="col">
                        <form action="../includes/users_insert.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                            <h4>Add User:</h4><br>

                            <label for="user_first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="user_first_name" name="user_first_name" required><br>

                            <label for="user_last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="user_last_name" name="user_last_name" required><br>

                            <label for="user_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="user_email" name="user_email" required><br>

                            <label for="user_phone_number" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="user_phone_number" name="user_phone_number" required><br>

                            <label for="user_street" class="form-label">Street</label>
                            <input type="text" class="form-control" id="user_street" name="user_street" required><br>

                            <label for="user_city" class="form-label">City</label>
                            <input type="text" class="form-control" id="user_city" name="user_city" required><br>

                            <label for="user_state" class="form-label">State</label>
                            <select class="form-select" id="user_state" name="user_state" required>
                                <option value="AL">AL</option>
                                <option value="AK">AK</option>
                                <option value="AR">AR</option>
                                <option value="AZ">AZ</option>
                                <option value="CA">CA</option>
                                <option value="CO">CO</option>
                                <option value="CT">CT</option>
                                <option value="DC">DC</option>
                                <option value="DE">DE</option>
                                <option value="FL">FL</option>
                                <option value="GA">GA</option>
                                <option value="HI">HI</option>
                                <option value="IA">IA</option>
                                <option value="ID">ID</option>
                                <option value="IL">IL</option>
                                <option value="IN">IN</option>
                                <option value="KS">KS</option>
                                <option value="KY">KY</option>
                                <option value="LA">LA</option>
                                <option value="MA">MA</option>
                                <option value="MD">MD</option>
                                <option value="ME">ME</option>
                                <option value="MI">MI</option>
                                <option value="MN">MN</option>
                                <option value="MO">MO</option>
                                <option value="MS">MS</option>
                                <option value="MT">MT</option>
                                <option value="NC">NC</option>
                                <option value="NE">NE</option>
                                <option value="NH">NH</option>
                                <option value="NJ">NJ</option>
                                <option value="NM">NM</option>
                                <option value="NV">NV</option>
                                <option value="NY">NY</option>
                                <option value="ND">ND</option>
                                <option value="OH">OH</option>
                                <option value="OK">OK</option>
                                <option value="OR">OR</option>
                                <option value="PA">PA</option>
                                <option value="RI">RI</option>
                                <option value="SC">SC</option>
                                <option value="SD">SD</option>
                                <option value="TN">TN</option>
                                <option value="TX">TX</option>
                                <option value="UT">UT</option>
                                <option value="VT">VT</option>
                                <option value="VA">VA</option>
                                <option value="WA">WA</option>
                                <option value="WI">WI</option>
                                <option value="WV">WV</option>
                                <option value="WY">WY</option>
                            </select><br>

                            <label for="user_zip_code" class="form-label">ZIP Code</label>
                            <input type="text" class="form-control" id="user_zip_code" name="user_zip_code" required><br>

                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>

                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer class="text-bg-dark text-center mt-auto">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="p-3">&copy; 2025 University. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>