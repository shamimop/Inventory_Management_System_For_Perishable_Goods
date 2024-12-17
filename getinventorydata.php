<?php
include 'database.php';
$sql = "SELECT Farm_id, cropname, harvestdate, storageID FROM inventory_track"; // Replace 'your_table_name' with your table name
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm Data Table</title>
    <link rel="stylesheet" href="tablestyle.css">
</head>
<body>
    <h2 style="text-align: center;">Inventory Data</h2>
    <table>
        <tr>
            <th>Farm ID</th>
            <th>Crop Name</th>
            <th>Harvest Date</th>
            <th>Storage ID</th>
        </tr>
        <?php
        // Display data in table rows
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Farm_id"] . "</td>";
                echo "<td>" . $row["cropname"] . "</td>";
                echo "<td>" . $row["harvestdate"] . "</td>";
                echo "<td>" . $row["storageID"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>

