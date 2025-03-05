<?php
include("connection.php"); 

header("Content-Type: application/json");

$dbobject = new Connection("localhost", "root", "", "channel_me_test");
$dbobject->getConnection();

$sql = "SELECT * FROM adddoctors";
$result = $dbobject->runquery($sql);

$doctors = [];

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $doctors[] = $row;
        }
    }
}

echo json_encode($doctors);
?>
