<?php
include 'connection.php'; // Ensure the database connection is properly included

$connection = new Connection('localhost', 'root', '', 'channel_me_test');
$conn = $connection->getConnection();

$sql = "SELECT doctor_id, doctor_name, specialization, images FROM adddoctors";
$result = $conn->query($sql);

$doctors = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Get images (assuming stored as comma-separated values)
        $images = explode(",", $row["images"]);
        $image_url = !empty($images[0]) ? $images[0] : "d1.webp";

        $doctors[] = [
            "id" => $row["doctor_id"],
            "name" => $row["doctor_name"],
            "specialization" => $row["specialization"],
            "image" => $image_url
        ];
    }
}

$conn->close();
echo json_encode($doctors);
?>
