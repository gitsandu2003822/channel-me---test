<?php
// Include your Connection class
require_once 'Connection.php';

// Instantiate the Connection class
$host = 'localhost'; // Database host
$username = 'root'; // Database username
$password = ''; // Database password
$database = 'channel_me_test'; // Your database name

// Create a new database connection
$connection = new Connection($host, $username, $password, $database);

// Get the PDO connection from your Connection class
$conn = $connection->getConnection(); // This will return the MySQLi connection object

// Get JSON input data from the frontend
$data = json_decode(file_get_contents('php://input'), true);
$specialization = $data['specialization'];
$date = $data['date'];  // Currently unused in query, but you can use it for additional filtering

// SQL query to fetch doctors based on specialization
$query = "SELECT * FROM adddoctors WHERE specialization LIKE ?";
$stmt = $connection->runquery($query); // Using your custom runquery method

// Bind the specialization parameter to the prepared statement
$specializationSearch = "%$specialization%";
$stmt->bind_param("s", $specializationSearch);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Fetch all the doctors from the result
$doctors = [];
while ($row = $result->fetch_assoc()) {
    $doctors[] = $row;
}

// Return the result as a JSON response to the frontend
echo json_encode($doctors);
?>
