<?php
include 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $farm_id = $_POST['farm_id'];
    $cropname = $_POST['cropname'];
    $harvestdate = $_POST['harvestdate'];
    $storageID = $_POST['storageID'];
    $cropID = $_POST['crop_id'];

    // Insert query
    $sql = "INSERT INTO inventory_track (Farm_id, cropname, harvestdate, storageID,crop_id) 
            VALUES ('$farm_id', '$cropname', '$harvestdate', '$storageID','$cropID')";

    // Execute query and check result
    if ($conn->query($sql) === TRUE) {
        $message = "Record added successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inventory</title>
    <link rel="stylesheet" href="inventoryadd.css">
</head>
<body>
    <h2>Add to Inventory</h2>
    <?php if (!empty($message)): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="farm_id">Farm ID:</label>
        <input type="text" id="farm_id" name="farm_id" placeholder="Enter Farm ID" required>

        <label for="cropname">Crop Name:</label>
        <input type="text" id="cropname" name="cropname" placeholder="Enter Crop Name" required>

        <label for="harvestdate">Harvest Date:</label>
        <input type="date" id="harvestdate" name="harvestdate" required>

        <label for="storageID">Storage ID:</label>
        <input type="text" id="storageID" name="storageID" placeholder="Enter Storage ID" required>
        <label for="crop_id">crop ID:</label>
        <input type="text" id="crop_id" name="crop_id" placeholder="Enter Storage ID" required>

        <input type="submit" value="Add Record">
    </form>
</body>
</html>
