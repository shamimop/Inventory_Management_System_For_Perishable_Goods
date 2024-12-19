<?php
// Database credentials
$host = "localhost";
$user = "root";
$password = "";
$dbname = "inventory_management_sys";

// Create a connection to the database
$conn = new mysqli($host, $user, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from POST request
    $ProducerID = $_POST['Producer_ID'] ?? null;
    $FarmID = $_POST['Farm_id'] ?? null;
    $farmname = $_POST['farmname'] ?? null;
    $plotno = $_POST['plotno'] ?? null;
    $road = $_POST['road'] ?? null;
    $districtname = $_POST['districtname'] ?? null;

    // Debugging: Log the received data
    echo "<pre>";
    echo "Received Data:\n";
    print_r($_POST);
    echo "</pre>";

    // Validate the data
    if ($ProducerID && $FarmID && $farmname && $plotno && $road && $districtname) {
        // SQL query to insert data into the 'farm' table
        $sql = "INSERT INTO farm (Producer_ID, Farm_id, farmname, plotno, road, districtname) 
                VALUES ('$ProducerID', '$FarmID', '$farmname', '$plotno', '$road', '$districtname')";

        if ($conn->query($sql) === TRUE) {
            echo "New farm record added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Missing required fields.";
    }
}

// Close the database connection
$conn->close();
?>