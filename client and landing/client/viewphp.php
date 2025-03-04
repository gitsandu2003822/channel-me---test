<?php
header('Content-Type: application/json');

// Include the Connection class
require_once 'Connection.php';

// Database connection details
$host = 'localhost'; // Update with your DB host
$username = 'root'; // Update with your DB username
$password = ''; // Update with your DB password
$database = 'channel_me_test'; // Update with your database name

// Create a new connection instance
$conn = new Connection($host, $username, $password, $database);

// Get data from the request
$data = json_decode(file_get_contents("php://input"));
$specialization = $data->specialization;
$date = $data->date; // Currently, we are not using the date in the query, but you can expand functionality

// Prepare the query based on the specialization (you can add more filters if needed)
$query = "SELECT doctor_id, doctor_name, specialization, images 
FROM adddoctors 
WHERE specialization LIKE '%Cardiology%'";


if ($specialization) {
    $query .= " AND specialization LIKE '%$specialization%'";
}

// Execute the query
$result = $conn->getConnection()->query($query);

// Check if the query returned any results
$doctors = [];
while ($row = $result->fetch_assoc()) {
    $doctors[] = [
        'doctor_id' => $row['doctor_id'],
        'doctor_name' => $row['doctor_name'],
        'specialization' => $row['specialization'],
        'image_url' => $row['images'], // Assuming the image is stored as a URL
    ];
}

// Return the results as a JSON response
echo json_encode($doctors);
?>
