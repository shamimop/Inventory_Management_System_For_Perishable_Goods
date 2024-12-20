<?php
// Include the database connection file
include 'database.php';


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nutritionistID = isset($_POST['NutritionistID']) ? $_POST['NutritionistID'] : '';
    $harvestID = isset($_POST['HarvestID']) ? $_POST['HarvestID'] : '';
    $quality = isset($_POST['Quality']) ? $_POST['Quality'] : '';
    $minTemp = isset($_POST['MinTemp']) ? $_POST['Min Temp'] : '';
    $maxTemp = isset($_POST['MaxTemp']) ? $_POST['Max Temp'] : '';
    $expiryDate = isset($_POST['ExpiryDate']) ? $_POST['Expiry Date'] : '';

    // Ensure all fields are filled
    if ($nutritionistID && $harvestID && $quality && $minTemp && $maxTemp && $expiryDate) {
        // SQL query (use backticks for column names with spaces)
        $sql = "INSERT INTO harvestinspectiontbl (NutritionistID, `HarvestID`, `Quality`, `Min Temp`, `Max Temp`, `Expiry Date`) 
                VALUES ('$nutritionistID', '$harvestID', '$quality', '$minTemp', '$maxTemp', '$expiryDate')";


        // Execute the statement
        if ($sql->execute()) {
            $message = "Record inserted successfully!";
        } else {
            $message = "Error: " . $sql->error;
        }

        // Close the statement
        $sql->close();
    } else {
        $message = "All fields are required.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="css/add-nutritionistStyles.css">
</head>
<body>
    <div class="container">
        <h1>Inventory Management System for Perishable Goods</h1>
        <h2>Record Data for Store</h2>
        <form>
            <label for="nutritionistID">Nutritionist ID:</label>
            <input type="text" id="nutritionistID" name="nutritionistID" placeholder="Enter Nutritionist ID">

            <label for="harvestID">Harvest ID:</label>
            <input type="text" id="harvestID" name="harvestID" placeholder="Enter Harvest ID">

            <label for="quality">Quality:</label>
            <select id="quality" name="quality">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
            </select>

            <label for="minTemp">Minimum Temp (°C):</label>
            <input type="number" id="minTemp" name="minTemp" placeholder="Enter Min Temp">

            <label for="maxTemp">Maximum Temp (°C):</label>
            <input type="number" id="maxTemp" name="maxTemp" placeholder="Enter Max Temp">

            <label for="expiryDate">Expiry Date:</label>
            <input type="date" id="expiryDate" name="expiryDate">

            <div class="button-container">
                <button type="submit" class="record-button">Record Update</button>
                <button type="button" class="home-button" onclick="window.location.href='add-nutritionist.html';">Back to Home</button>
            </div>
        </form>

        <!-- Display message if any -->
        <?php if ($message) { echo "<p>$message</p>"; } ?>

        <h2>Survey Data</h2>
        <table>
            <thead>
                <tr>
                    <th>Nutritionist ID</th>
                    <th>Harvest ID</th>
                    <th>Quality</th>
                    <th>Min Temp</th>
                    <th>Max Temp</th>
                    <th>Expiry Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Reopen connection for displaying data
                include 'database.php';

                // Fetch data from the database
                $result = $conn->query("SELECT * FROM harvestinspectiontbl");

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['NutritionistID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['HarvestID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Quality']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Min Temp']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Max Temp']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Expiry Date']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No data available</td></tr>";
                }

                // Close connection after fetching data
                $conn->close();
                ?>
            </tbody>
        </table>
    

    </div>
    
</body>
</html>
                