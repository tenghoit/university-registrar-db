<?php

function create_table_form (
    string $action,
    string $query,
    array $column_names,
    array $field_names,
    bool $has_edit
) {
    ?>
    <form action="<?php echo $action; ?>" method="post">
    <table>
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
        <tbody>
            <?php
            try {
                require_once "../includes/dbh.inc.php";
                // $query_input = $query;
                $stmt = $pdo->prepare($query);    
                $stmt->execute();
                
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if(!empty($result)){

                    foreach($result AS $row){
                        $row_data = htmlspecialchars(json_encode($row));
                        echo "<tr>";
                        echo "<td><input type='checkbox' name='selects[]' value='" . $row_data . "'></td>";
                        
                        foreach($field_names AS $field_name){
                            echo "<td>" . htmlspecialchars($row[$field_name]) . "</td>";
                        }
    
                        if($has_edit == true){
                            echo "<td><button type='submit' name='edit' value='" . $row_data . "'>Edit</button></td>";
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
    <button type="submit" name="delete">Delete Selected</button>
</form>

<?php } ?>