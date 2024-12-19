<?php
// Database connection
include 'database.php';

// Get the HarvestID from the query string
if (isset($_GET['HarvestID'])) {
    $HarvestID = $_GET['HarvestID'];

    // Fetch the record to edit
    $sql = "SELECT * FROM harvest WHERE HarvestID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $HarvestID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Record not found.");
    }
}

// Update the record after form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Farm_id = $_POST['Farm_id'];
    $crop_id = $_POST['crop_id'];
    $Date = $_POST['Date'];
    $expireDate = $_POST['expireDate'];
    $Quantity = $_POST['Quantity'];

    $sql = "UPDATE harvest SET Farm_id = ?, crop_id = ?, Date = ?, expireDate = ?, Quantity = ? WHERE HarvestID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssis", $Farm_id, $crop_id, $Date, $expireDate, $Quantity, $HarvestID);

    if ($stmt->execute()) {
        echo "<script>alert('Record updated successfully!'); window.location.href='getinventorydata.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventory</title>
   
</head>
<body>
    <h2 style="text-align: center;">Edit Record</h2>
    <div class="form-container">
        <form method="POST" action="">
            <label for="Farm_id">Farm ID:</label>
            <input type="number" name="Farm_id" id="Farm_id" value="<?php echo htmlspecialchars($row['Farm_id']); ?>" required>

            <label for="crop_id">Crop ID:</label>
            <input type="text" name="crop_id" id="crop_id" value="<?php echo htmlspecialchars($row['crop_id']); ?>" required>

            <label for="Date">Date:</label>
            <input type="date" name="Date" id="Date" value="<?php echo htmlspecialchars($row['Date']); ?>" required>

            <label for="expireDate">Expire Date:</label>
            <input type="date" name="expireDate" id="expireDate" value="<?php echo htmlspecialchars($row['expireDate']); ?>" required>

            <label for="Quantity">Quantity:</label>
            <input type="number" name="Quantity" id="Quantity" value="<?php echo htmlspecialchars($row['Quantity']); ?>" required>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
