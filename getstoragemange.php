<?php
// Check and include database connection
if (!file_exists('database.php')) {
    die("Error: database.php file not found!");
}

include 'database.php';

if (!isset($conn)) {
    die("Error: Database connection not established!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and fetch input values
    $type = $conn->real_escape_string($_POST['type']);
    $crop = $conn->real_escape_string($_POST['crop']);
    $humidity = intval($_POST['humidity']);
    $temperature = intval($_POST['temperature']);

    // Insert data into the database
    $sql = "INSERT INTO storage_manage (type, crop, humidity, temperature) 
            VALUES ('$type', '$crop', '$humidity', '$temperature')";

    if ($conn->query($sql) === TRUE) {
        echo "New data added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

