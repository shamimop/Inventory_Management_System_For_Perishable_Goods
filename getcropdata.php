<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and fetch input values
    $cropID = $conn->real_escape_string($_POST['cropID']);
    $cropName = $conn->real_escape_string($_POST['cropName']);
    $minimumTemperature = $conn->real_escape_string($_POST['minimum Temperature']);
    $minimumHumidity = $conn->real_escape_string($_POST['minimumHumidity']);
    $cropSeason = $conn->real_escape_string($_POST['cropSeason']);

    // Insert data into the database
    $sql = "INSERT INTO crop_t (cropID, cropName, minimum Temperature, minimumHumidity, cropSeason) 
            VALUES ('$cropID', '$cropName', '$minimumTemperature', '$minimumHumidity', '$cropSeason')";

    if ($conn->query($sql) === TRUE) {
        echo "New crop added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
