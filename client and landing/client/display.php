<?php
include 'connection.php';
include '../addDoctors.php';

$conn = new Connection('localhost', 'root', '', 'channel_me_test');
$db = $conn->getConnection();

$specialization = isset($_GET['specialization']) && $_GET['specialization'] !== "" ? $_GET['specialization'] : null;

$sql = "SELECT doctor_id, doctor_name, specialization, images FROM adddoctors";
if ($specialization) {
    $sql .= " WHERE specialization = ?";
}

$stmt = $db->prepare($sql);
if ($specialization) {
    $stmt->bind_param("s", $specialization);
}
$stmt->execute();
$result = $stmt->get_result();

$doctors = [];

while ($row = $result->fetch_assoc()) {
    $images = explode(",", $row["images"]);
    $image_url = !empty($images[0]) ? $images[0] : "d1.webp";

    $doctors[] = [
        "id" => $row["doctor_id"],
        "name" => $row["doctor_name"],
        "specialization" => $row["specialization"],
        "image" => $image_url
    ];
}

echo json_encode($doctors);
?>
