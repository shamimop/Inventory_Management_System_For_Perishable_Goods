<?php
// Include the database connection
include 'database.php';

// Handle Form Submission for Inserting Data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $nutritionist_id = $_POST['nutritionistID'];
    $harvest_id = $_POST['harvestID'];
    $quality = $_POST['quality'];
    $min_temp = $_POST['minTemp'];
    $max_temp = $_POST['maxTemp'];
    $expiry_date = $_POST['expiryDate'];

    // Insert the data into the 'crops' table
    $sql = "INSERT INTO crops (nutritionist_id, harvest_id, quality, min_temp, max_temp, expiry_date)
            VALUES ('$nutritionist_id', '$harvest_id', '$quality', '$min_temp', '$max_temp', '$expiry_date')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data successfully recorded!'); window.location.href='getnutritionistdata.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch Data to Display in the Table
$result = $conn->query("SELECT * FROM crops ORDER BY id DESC");
?>