<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $AgriOfficerId = $conn->real_escape_string($_POST['AgriOfficerId']);
    $idate = $conn->real_escape_string($_POST['visitdate']);
    $feedback = $conn->real_escape_string($_POST['feedback']);
    $cropQuality = $conn->real_escape_string($_POST['Quality']);
    $farmid = $conn->real_escape_string($_POST['fid']);

    
    $idate = $_POST['visitdate'];

    // Get today's date
    $currentDate = date('Y-m-d');
    
    // Check if the submitted date is after today
    if ($idate > $currentDate) {
        die("Error: The inspection date cannot be in the future.");
    }   else{
    
    $sql = "INSERT INTO `tblfarmsurvey` (`AgriOfficerId`, `Inspection_Date`, `Feedback`, `Crop_Quality`, `Farm_id`) 
        VALUES ('$AgriOfficerId', '$idate', '$feedback', '$cropQuality', '$farmid')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Survey added successfully!');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


$sql = "SELECT Farm_id, Inspection_Date, Crop_Quality,  Feedback FROM tblfarmsurvey";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm Survey Table</title>
    <link rel="stylesheet" href="tablestyle.css">
</head>
<body>
    <header>
        <h1>Survey Data</h1>
        <?php if (isset($message)) echo "<p>$message</p>"; ?>
    </header>
    
    
    
        <thead>
            <table>
            <tr>
                <th>Farm ID</th>
                <th>Inspection Date</th>
                <th>Crop Quality</th>
                
                <th>Feedback</th>
            </tr>
        </thead>
        <tbody>
        
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['Farm_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Inspection_Date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Crop_Quality']) . "</td>";
                   
                    echo "<td>" . htmlspecialchars($row['Feedback']) . "</td>";
                    echo "<td>
                <a href='editreport.php?Inspection_Date=" . $row['Inspection_Date'] . "&Farm_id=" . urlencode($row['Farm_id']) ."'>Edit</a> |
                <a href='deletesreport.php?Inspection_Date=" . $row['Inspection_Date'] ."&Farm_id=" . urlencode($row['Farm_id']) . "' onclick='return confirm(\"Are you sure you want to delete this farm?\");'>Delete</a>
              </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No data available</td></tr>";
            }
            ?>
        </tbody>
    </table>
    
    <a href="agriofficerdashboard.html">Go Back to Homefeed</a>
</body>
</html>