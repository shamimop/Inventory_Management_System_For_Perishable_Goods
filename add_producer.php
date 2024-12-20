<?php
// Include database connection
include 'database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $producer_id = $_POST['Producer_ID'];
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $contact_number = $_POST['contact'];

    // Insert into database
   // Correctly construct the SQL query with placeholders
$sql = "INSERT INTO producer_tbl (Producer_ID, `firstname`, `lastname`, contact) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);


if ($stmt) {
    // Bind parameters to the placeholders
    $stmt->bind_param("ssss", $producer_id, $first_name, $last_name, $contact_number);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Producer added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

// Close the connection
$conn->close();

}
?>
