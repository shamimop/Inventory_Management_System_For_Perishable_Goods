<?php
include 'database.php'; // Database connection

if (isset($_GET['Farm_id'])) {
    $farmId = $_GET['Farm_id'];

    
    $sql = "DELETE FROM tblfarmsurvey WHERE Farm_id = ?";
    
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('s', $farmId); 
        
        
        if ($stmt->execute()) {
            echo "Record deleted successfully";
            header('Location: processform.php'); 
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
    $conn->close();
} else {
    echo "No Farm ID provided for deletion.";
}
?>