<?php

function create_table_form (
    string $mode,
    string $action,
    string $query,
    array $column_names,
    array $field_names,
    bool $has_edit
) { ?>
    <form action="<?php echo $action; ?>" method="post" class="text-bg-light p-3 rounded-3">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <?php
                                foreach($column_names AS $column_name){
                                    echo "<th>" . $column_name . "</th>";
                                }

                                if($has_edit == true){
                                    echo "<th>Action</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            try {
                                require "../includes/dbh.inc.php";
                                $stmt = $pdo->prepare($query);  
                                $stmt->execute();
                                
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
                                if(!empty($result)){

                                    foreach($result AS $row){
                                        $row_data = htmlspecialchars(json_encode($row));
                                        echo "<tr>";
                                        echo "<td><input type='checkbox' class='form-check-input' name='selects[]' value='" . $row_data . "'></td>";
                                        
                                        foreach($field_names AS $field_name){
                                            echo "<td>" . htmlspecialchars($row[$field_name]) . "</td>";
                                        }
                    
                                        if($has_edit == true){
                                            echo "<td><button type='submit' class='btn btn-warning' name='edit' value='" . $row_data . "'>Edit</button></td>";
                                        }
                                        
                                        echo "</tr>";
                                    }
                                    
                                }else{
                                    echo "<tr><td colspan='" . (count($column_names) + 1 + ($has_edit ? 1 : 0)) . "' class='text-center'>No records found</td></tr>";
                                }

                                $pdo = null;
                                $stmt = null;
                            
                            } catch (PDOException $e) {
                                die("Query Failed: " . $e->getMessage());
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php
                if($mode == 'delete'){
                    echo "<button type='submit' class='btn btn-danger' name='delete'>Delete Selected</button>";
                }elseif($mode == 'add'){
                    echo "<button type='submit' class='btn btn-success' name='add'>Add Selected</button>";
                }
                ?>
            </div>
        </div>
    </form>

<?php }


function create_table_from_query(
    string $query,
    array $column_names,
    array $field_names,
){
    ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <?php
                    foreach($column_names AS $column_name){
                        echo "<th>" . $column_name . "</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                try {
                    require "../includes/dbh.inc.php";
                    // $query_input = $query;
                    $stmt = $pdo->prepare($query);    
                    $stmt->execute();
                    
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if(!empty($result)){
    
                        foreach($result AS $row){
                            echo "<tr>";
                            
                            foreach($field_names AS $field_name){
                                echo "<td>" . htmlspecialchars($row[$field_name]) . "</td>";
                            }

                            echo "</tr>";
                        }
                        
                    }

                    $pdo = null;
                    $stmt = null;
                
                } catch (PDOException $e) {
                    die("Query Failed: " . $e->getMessage());
                }
                ?>
            </tbody>
        </table>
    </div>

<?php }

function build_select_input(
    string $query,
    string $select_label,
    string $select_id,
    bool $required,
    array $option_label_formatting,
    ?array $existing_value = null
){
    $required_label = $required ? "required" : "";

    try {
        require "../includes/dbh.inc.php";
        $stmt = $pdo->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<label for='" . $select_id . "' class='form-label'>" . $select_label . "</label>";
        echo "<select name='" . $select_id . "' id='" . $select_id . "' class='form-select' " . $required_label . ">";

        if($existing_value == null){
            echo "<option value='' disabled selected>Select Option</option>";
        }

        foreach($result AS $row){

            $row_data = htmlspecialchars(json_encode($row));

            $option_label = "";

            foreach ($option_label_formatting as $label) {
                if (preg_match('/[a-zA-Z]/', $label) && isset($row[$label])) {
                    $option_label .= htmlspecialchars($row[$label]); // Append formatted value
                } else {
                    $option_label .= htmlspecialchars($label); // Append static character (e.g., a space or delimiter)
                }
            }

            $selected = "";
            if ($existing_value) {
                foreach ($existing_value as $key => $value) {
                    if (isset($row[$key]) && $row[$key] == $value) {
                        $selected = "selected";
                    }else{
                        $selected = "";
                        break;
                    }
                }
            }


            echo "<option value='" . $row_data . "' " . $selected . ">" . $option_label . "</option>";
        }

        echo "</select><br>";

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}

function build_footer(){
    ?>
    <div class="container-fluid text-bg-dark text-center mt-auto">
        <div class="row">
            <div class="col">
                <p class="p-3">&copy; 2025 University. All rights reserved.</p>
            </div>
        </div>
    </div>
    <?php
}

function build_nav(){ ?>
    <nav class="navbar navbar-expand-md navbar-primary justify-content-end border-bottom">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <!-- <img src="../images/university_logo.webp" alt="University Logo" height="50"> -->
                University
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-label="Expand Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Courses</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../php/courses.php">Courses</a>
                            <a class="dropdown-item" href="../php/labs.php">Labs</a>
                            <a class="dropdown-item" href="../php/course_prerequisites.php">Prerequisites</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Users</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../php/users.php">Users</a>
                            <a class="dropdown-item" href="../php/students.php">Students</a>
                            <a class="dropdown-item" href="../php/student_advisors.php">Student Advisors</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="../php/locations.php" class="nav-link">Locations</a>
                    </li>  
                    <li class="nav-item">
                        <a href="../php/terms.php" class="nav-link">Terms</a>
                    </li>    
                    <li class="nav-item">
                        <a href="../php/time_blocks.php" class="nav-link">Time Blocks</a>
                    </li>               
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Degrees</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../php/degrees.php">Degrees</a>
                            <a class="dropdown-item" href="../php/degree_requirements.php">Degree Requirements</a>
                            <a class="dropdown-item" href="../php/student_degrees.php">Student Degrees</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Classes</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="../php/classes.php">Classes</a>
                            <a class="dropdown-item" href="../php/class_schedules.php">Class Schedules</a>
                            <a class="dropdown-item" href="../php/student_class_history.php">Student Class History</a>
                            <a class="dropdown-item" href="../php/classes_waitlist.php">Classes Waitlist</a>
                        </div>
                    </li>       
                </ul>
            </div>
        </div>
    </nav>
<?php }

