<?php
include 'database.php'; // Database connection

if (isset($_GET['HarvestID'])) {
    $harvestId = $_GET['HarvestID'];
    

    
    $sql = "DELETE FROM harvest WHERE HarvestID = ?";
    
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('s', $harvestId); 
        
        
        if ($stmt->execute()) {
            echo "Record deleted successfully";
            header('Location: getinventorydata.php'); 
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
    $conn->close();
} else {
    echo "No ID provided for deletion.";
}
?>