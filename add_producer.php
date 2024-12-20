<?php
// Include database connection
include '../php/db_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $producer_id = $_POST['producer_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_number = $_POST['contact_number'];

    // Insert into database
    $sql = "INSERT INTO producers (producer_id, first_name, last_name, contact_number) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $producer_id, $first_name, $last_name, $contact_number);

    if ($stmt->execute()) {
        echo "New producer added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
