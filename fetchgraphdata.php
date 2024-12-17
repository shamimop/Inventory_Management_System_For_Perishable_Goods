<?php
include 'database.php';

$sql = "SELECT Crop_Quality, COUNT(Farm_id) AS Total_Farms
        FROM tblfarmsurvey
        GROUP BY Crop_Quality
        ORDER BY Total_Farms DESC";

$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'Crop_Quality' => $row['Crop_Quality'],
            'Total_Farms' => $row['Total_Farms']
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($data);

$conn->close();



?>