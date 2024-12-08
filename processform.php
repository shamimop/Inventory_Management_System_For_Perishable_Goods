<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $AgriOfficerId = $conn->real_escape_string($_POST['AgriOfficerId']);
    $idate = $conn->real_escape_string($_POST['visitdate']);
    $feedback = $conn->real_escape_string($_POST['feedback']);
    $cropQuality = $conn->real_escape_string($_POST['Quality']);
    $farmid = $conn->real_escape_string($_POST['fid']);

    
    
    
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