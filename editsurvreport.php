<?php
// Database connection
include 'database.php';

// Get the HarvestID from the query string
if (isset($_GET['Inspection_Date'])&& isset($_GET['Farm_id'])) {
    $InsDate = $_GET['Inspection_Date'];
    $Farm_id= $_GET['Farm_id'];

    // Fetch the record to edit
    $sql = "SELECT * FROM tblfarmsurvey WHERE Inspection_Date = ? AND Farm_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $InsDate,$Farm_id);
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
    $Ag_id = $_POST['AgriOfficerId'];
    $InsDate = $_POST['Inspection_Date'];

    $feedback= $_POST['Feedback'];
   
    $Quality = $_POST['Crop_Quality'];
    $Farm_id = $_POST['Farm_id'];

    $sql = "UPDATE tblfarmsurvey SET AgriOfficerId = ?,Inspection_Date =?, Feedback = ?, Crop_Quality = ?,Farm_id = ? WHERE Inspection_Date = ? AND Farm_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $Ag_id,$InsDate, $feedback, $Quality, $Farm_id);

    if ($stmt->execute()) {
        echo "<script>alert('Record updated successfully!'); window.location.href='Farmvisitreport.html';</script>";
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
            <label for="AgriOfficerId">Ag ID:</label>
            <input type="text" name="AgriOfficerId" id="AgriOfficerId" value="<?php echo htmlspecialchars($row['AgriOfficerId']); ?>" required>

            <label for="Inspection_Date">Inspection_Date:</label>
            <input type="date" name="Inspection_Date" id="Inspection_Date" value="<?php echo htmlspecialchars($row['Inspection_Date']); ?>" required>

            <label for="Feedback">Feedback</label>
            <input type="text" name="Feedback" id="Feedback" value="<?php echo htmlspecialchars($row['Feedback']); ?>" required>

            <label for="Crop_Quality">Crop_Quality</label>
            <input type="text" name="Crop_Quality" id="Crop_Quality" value="<?php echo htmlspecialchars($row['Crop_Quality']); ?>" required>

            <label for="Farm_id">Farm id</label>
            <input type="text" name="Farm_id" id="Farm_id" value="<?php echo htmlspecialchars($row['Farm_id']); ?>" required>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
