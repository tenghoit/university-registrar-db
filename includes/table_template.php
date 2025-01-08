<form action="../includes/" method="post">
    <table>
        <thead>
            <tr>
                <th>Select</th>
                <!-- <th>Insert column names</th> -->
                 <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                require_once "../includes/dbh.inc.php";
                $query = "";
                $stmt = $pdo->prepare($query);    
                $stmt->execute();
                
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($result AS $row){
                    $row_data = htmlspecialchars(json_encode($row));
                    echo "<tr>";
                    echo "<td>
                            <input type='checkbox' name='selects[]' value='" . $row_data . "'>    
                        </td>";
                        
                    // echo "<td>" . htmlspecialchars($row['column_name']) . "</td>";

                    echo "<td>
                            <button type='submit' name='edit' value='" . htmlspecialchars(json_encode($row)) . "'>Edit</button>
                        </td>";
                    echo "</tr>";
                    
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