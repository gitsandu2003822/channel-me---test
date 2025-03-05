<?php
include '../connection.php'; // Ensure this file correctly initializes $conn

// Initialize connection
$connection = new Connection('localhost', 'root', '', 'channel_me_test');
$conn = $connection->getConnection(); 

// SQL query to fetch doctor details
$sql = "SELECT doctor_id, doctor_name, specialization, images FROM adddoctors";
$result = $conn->query($sql);

$doctors = [];

if ($result->num_rows > 0) {
    // Fetch doctor data
    while ($row = $result->fetch_assoc()) {
        $doctor = [
            'doctor_id' => $row['doctor_id'],
            'doctor_name' => $row['doctor_name'],
            'specialization' => $row['specialization'],
            'images' => explode(",", $row['images']) // Convert the comma-separated string to an array of image paths
        ];
        $doctors[] = $doctor;
    }
    // Return the data as JSON
    echo json_encode($doctors);
} else {
    echo json_encode([]);
}

$conn->close();
?>
