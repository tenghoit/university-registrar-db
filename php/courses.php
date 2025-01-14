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
    <title>Courses</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <header>
        <nav class="navbar navbar-dark bg-dark justify-content-end ">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">
                    <!-- <img src="../images/university_logo.webp" alt="University Logo" height="50"> -->
                    University
                </a>
                <form action="#" method="post">
                    <input type="search" class="form-control" name="search" id="search" placeholder="Search...">
                </form>
                <button class="navbar-toggler d-lg-none" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-label="Expand Navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="../php/courses.php" class="nav-link">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a href="../php/users.php" class="nav-link">Users</a>
                        </li>
                        <li class="nav-item">
                            <a href="../php/locations.php" class="nav-link">Locations</a>
                        </li>                 
                    </ul>
                </div>
                
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-auto text-bg-dark text-center collapse d-lg-block">
                <div class="d-flex flex-column p-3">
                    <h3>Menu</h3>
                    <div class="collapse show" id="menuItems">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="col p-3 gap-3">
                    <section>
                        <div class="row">
                            <div class="col">
                                <h1>Courses</h1>
                            </div>
                        </div>
                    </section>

                    <section>
                        <div class="row">
                            <div class="col">
                                <?php 
                                create_table_form(
                                    action: "../includes/courses_delete.inc.php",
                                    query: "SELECT * FROM courses_view",
                                    column_names: ["Course ID", "Course Discipline", "Course Number", "Course Name", "Course Credits", "Course Description"],
                                    field_names: ["course_id", "course_discipline", "course_number", "course_name", "course_credits", "course_description"],
                                    has_edit: true
                                ); 
                                ?>
                            </div>
                        </div>
                    </section>
                        
                    <section>
                        <div class="row">
                            <div class="col">
                                <form action="../includes/courses_insert.inc.php" method="post" class="text-bg-light p-3 rounded-3">
                                    <h4>Add Course:</h4><br>

                                    <label for="course_discipline" class="form-label">Course Discipline</label>
                                    <input type="text" class="form-control" id="course_discipline" name="course_discipline" required><br>

                                    <label for="course_number" class="form-label">Course Number</label>
                                    <input type="text" class="form-control" id="course_number" name="course_number" required><br>

                                    <label for="course_name" class="form-label">Course Name</label>
                                    <input type="text" class="form-control" id="course_name" name="course_name" required><br>

                                    <label for="course_credits" class="form-label">Course Credits</label>
                                    <input type="number" class="form-control" id="course_credits" name="course_credits" required><br>

                                    <label for="course_description" class="form-label">Course Description</label>
                                    <input type="text" class="form-control" id="course_description" name="course_description" required><br>

                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>
                        </div>
                    </section>
                </main>
        </div>
    </div>

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