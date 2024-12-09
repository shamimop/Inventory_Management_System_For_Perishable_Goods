<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CropID = $conn->real_escape_string($_POST['CropID']);
    $CropName = $conn->real_escape_string($_POST['CropName']);
    $MinimumTemperature = $conn->real_escape_string($_POST['MinimumTemperature']);
    $MinimumHumidity = $conn->real_escape_string($_POST['MinimumHumidity']);
    $CropSeason = $conn->real_escape_string($_POST['CropSeason']);

    
    
    
    $sql = "INSERT INTO `tblfarmsurvey` (`AgriOfficerId`, `Inspection_Date`, `Feedback`, `Crop_Quality`, `Farm_id`) 
        VALUES ('$AgriOfficerId', '$idate', '$feedback', '$cropQuality', '$farmid')";

if ($conn->query($sql) === TRUE) {
    echo "Data saved successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
}
?>