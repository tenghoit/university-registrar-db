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
            <div class="row">
                <div class="col">
                    <h1>Welcome to my website!</h1>
                </div>
            </div>
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