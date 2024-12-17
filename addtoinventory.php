<?php
include 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    
    $HarvestID = $_POST['HarvestID'];
    $harvestdate = $_POST['Date'];
    $Quantity = $_POST['Quantity'];
    $cropid = $_POST['crop_id'];
    $farm_id = $_POST['Farm_id'];
    $expireDate = $_POST['expireDate'];

    // Insert query
    $sql = "INSERT INTO harvest (`HarvestID`,`Date`,`Quantity`,`crop_id`,`Farm_id`,`expireDate`) 
            VALUES ('$HarvestID','$harvestdate',$Quantity,'$cropid','$farm_id','$expireDate' )";

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
        <input type="text" id="Farm_id" name="Farm_id" placeholder="Enter Farm ID" required>

        <label for="cropname">Crop id:</label>
        <input type="text" id="crop_id" name="crop_id" placeholder="Enter Crop Name" required>

        <label for="harvestdate">Harvest Date:</label>
        <input type="date" id="Date" name="Date" required>
        <label for="Expiredate">Expire Date:</label>
        <input type="date" id="expireDate" name="expireDate" required>

        <label for="harvestID">Harvest ID:</label>
        <input type="text" id="HarvestID" name="HarvestID" placeholder="Enter harvest ID" required>
        <label for="crop_id">Quantity:</label>
        <input type="number" id="Quantity" name="Quantity" placeholder="Quantity of harvest" required>

        <input type="submit" value="Add Record">
    </form>
</body>
</html>
