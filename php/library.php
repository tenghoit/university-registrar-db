<?php

function create_table_form (
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
                <button type="submit" class='btn btn-danger' name="delete">Delete Selected</button>
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
                    require_once "../includes/dbh.inc.php";
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

function create_form (

){
    
}


function build_nav(

){ ?>
    <nav class="navbar navbar-expand-md navbar-body justify-content-end">
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
                        <a href="../php/users.php" class="nav-link">Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="../php/locations.php" class="nav-link">Locations</a>
                    </li>                 
                </ul>
            </div>
        </div>
    </nav>
<?php }

function build_vertical_nav(){ 
?>
    <nav class="navbar navbar-expand-md bg-primary flex-column col-auto">
        <a href="#" class="navbar-brand">
            <!-- <img src="../images/university_logo.webp" alt="University Logo" height="50"> -->
            University
        </a>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a href="" class="nav-link">Home</a>
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
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-label="Expand Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </nav>
<?php }

