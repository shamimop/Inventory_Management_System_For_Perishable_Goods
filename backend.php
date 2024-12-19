<?php
// Database credentials
$host = "localhost";       // Your database host (e.g., localhost)
$user = "root";            // Your database username (default root in XAMPP)
$password = "";            // Your database password (default blank in XAMPP)
$dbname = "inventory_management_sys";          // Your database name (farm)

// Create a connection to the database
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch farm data
$sql = "SELECT ProducerID, FarmID, farmname, plotno, road, districtname FROM farm";


$stmt = $conn->prepare($sql);
$result = $conn->query($sql);

// Check if data exists
if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Add each row to the data array
    }
    // Return data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Return an empty JSON array if no data
    echo json_encode([]);
}

// Close the database connection
$conn->close();
?>
