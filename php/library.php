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
                                    echo "<tr><td colspan='" . (count($column_names) + ($has_edit ? 1 : 0)) . "' class='text-center'>No records found</td></tr>";
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
    array $option_label_formatting
){
    try {
        require "../includes/dbh.inc.php";
        $stmt = $pdo->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<label for='" . $select_id . "' class='form-label'>" . $select_label . "</label>";
        echo "<select name='" . $select_id . "' id='" . $select_id . "' class='form-select'>";

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

            echo "<option value='" . $row_data . "'>" . $option_label . "</option>";
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
                    <li class="nav-item">
                        <a href="../php/courses.php" class="nav-link">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a href="../php/course_prerequisites.php" class="nav-link">Prerequisites</a>
                    </li>
                    <li class="nav-item">
                        <a href="../php/users.php" class="nav-link">Users</a>
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
                    <li class="nav-item">
                        <a href="../php/degrees.php" class="nav-link">Degrees</a>
                    </li>               
                    <li class="nav-item">
                        <a href="../php/degree_requirements.php" class="nav-link">Degree Requirements</a>
                    </li>   
                    <li class="nav-item">
                        <a href="../php/classes.php" class="nav-link">Classes</a>
                    </li>               
                </ul>
            </div>
        </div>
    </nav>
<?php }

