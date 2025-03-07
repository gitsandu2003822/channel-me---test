<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../connection.php';

$connection = new Connection('localhost', 'root', '', 'channel_me_test');
$conn = $connection->getConnection();

// Fetch doctors from the database
$sql = "SELECT doctor_id, doctor_name, specialization, images FROM adddoctors";
$result = $conn->query($sql);

if ($result->num_rows > 0) { // Fixed typo: num_rows (not num_tows)
    while ($row = $result->fetch_assoc()) {
        $images = explode(",", $row['images']); // Fixed syntax
        $imageSrc = !empty($images[0]) ? "doc-images/" . $images[0] : 'default.png'; // Added image path

        echo '
        <div class="doctor-card">
            <img src="' . $imageSrc . '" class="doctor-image" alt="Doctor Image">
            <p class="doctor-specialization">' . htmlspecialchars($row['specialization']) . '</p>
            <h3 class="doctor-name">' . htmlspecialchars($row['doctor_name']) . '</h3>
            <button class="channel-now">Channel Now</button>
        </div>';
    }
} else {
    echo '<p>No doctors found.</p>';
}

$conn->close();
?>