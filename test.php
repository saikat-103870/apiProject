
<?php
include ("config.php");
// Sample data to insert
$name = 'fec9d0ed-4a4f-41e6-ace7-3d871aa00c50';
$matchType = 'St Kitts and Nevis Patriots vs Saint Lucia Kings, 5th Match';
$status = 'Saint Lucia Kings won by 5 wkts';

// Prepare the SQL query
$sql = "INSERT INTO match (name, matchType, status) VALUES ('$name', '$matchType', '$status')";

// Execute the query
if (mysqli_query($conn, $sql)) {
echo "New record created successfully ";
} else {
echo "Error: " ;
}


?>