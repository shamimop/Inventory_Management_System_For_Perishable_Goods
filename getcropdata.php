<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CropID = $conn->real_escape_string($_POST['CropID']);
    $CropName = $conn->real_escape_string($_POST['CropName']);
    $MinimumTemperature = $conn->real_escape_string($_POST['MinimumTemperature']);
    $MinimumHumidity = $conn->real_escape_string($_POST['MinimumHumidity']);
    $CropSeason = $conn->real_escape_string($_POST['CropSeason']);

    
    
    
    $sql = "INSERT INTO crops (cropID, cropName, minimumTemperature, minimumHumidity, cropSeason) 
            VALUES ('$cropID', '$cropName', '$minimumTemperature', '$minimumHumidity', '$cropSeason')";


if ($conn->query($sql) === TRUE) {
    echo "Data saved successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
}
?>