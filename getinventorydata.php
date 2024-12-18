<?php
include 'database.php';
$sql = "SELECT HarvestID, 'Date' ,Quantity,crop_id,Farm_id,`expireDate`  FROM harvest"; // Replace 'your_table_name' with your table name
$result = $conn->query($sql);



$sql_expiry = "SELECT crop_id, Quantity, `expireDate`
               FROM harvest
               WHERE `expireDate` BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 DAY)";

$result_expiry = $conn->query($sql_expiry);

$alerts = []; // Array to store alert messages
$rows = [];   // Array to store all rows for display

// Process expiring crops
if ($result_expiry->num_rows > 0) {
    while ($row = $result_expiry->fetch_assoc()) {
        $alerts[] = "Crop: " . $row['crop_id'] . " (Quantity: " . $row['Quantity'] . ") is expiring on " . $row['expireDate'];
    }
}
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
    <?php if (!empty($alerts)): ?>
        <div class="alert-box">
            <strong>⚠ Soon to Expire Crops:</strong><br>
            <?php
                foreach ($alerts as $alert) {
                    echo $alert . "<br>";
                }
            ?>
            <button onclick="this.parentElement.style.display='none'">Close</button>
        </div>
    <?php endif; ?>
    <table>
        <tr>
            <th>Farm ID</th>
            <th>Crop ID</th>
            <th>Harvest Date</th>
            <th>Expire Date</th>
            <th>Quantity</th>
            <th>HarvestID</th>
        </tr>
        <?php
        // Display data in table rows
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Farm_id"] . "</td>";
                echo "<td>" . $row["crop_id"] . "</td>";
                echo "<td>" . $row["Date"] . "</td>";
                echo "<td>" . $row["expireDate"] . "</td>";
                echo "<td>" . $row["Quantity"] . "</td>";
                echo "<td>" . $row["HarvestID"] . "</td>";
                echo "<td>";
        echo "<a href='edit.php?HarvestID=" . $row["HarvestID"] . "' class='btn-edit'>Edit</a> ";
        echo "<a href='delfrominvent.php?HarvestID=" . $row["HarvestID"] . "' class='btn-delete' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>";
        echo "</td>";
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

