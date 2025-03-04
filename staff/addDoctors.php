<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../connection.php'; // Ensure this file correctly initializes $conn

    // Retrieve form data
    $doctor_id = $_POST['doctorId'];
    $doctor_name = $_POST['doctorName'];
    $specialization = $_POST['specialization'];


    $connection = new Connection('localhost', 'root', '', 'channel_me_test');

// Get the connection object
    $conn = $connection->getConnection(); 
    // Handle multiple image uploads
    $image_paths = [];
    if (!empty($_FILES['doctorImages']['name'][0])) {
        $upload_dir = "uploads/doctors/";

        // Create the directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        foreach ($_FILES['doctorImages']['tmp_name'] as $key => $tmp_name) {
            $file_name = time() . "_" . basename($_FILES['doctorImages']['name'][$key]);
            $target_path = $upload_dir . $file_name;

            if (move_uploaded_file($tmp_name, $target_path)) {
                $image_paths[] = $target_path;
            }
        }
    }

    // Convert image paths array to a comma-separated string
    $image_paths_str = implode(",", $image_paths);

    // Insert data into database
    $sql = "INSERT INTO adddoctors (doctor_id, doctor_name, specialization, images) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql); // Fix: Correct variable name ($conn instead of $Seom)
    $stmt->bind_param("ssss", $doctor_id, $doctor_name, $specialization, $image_paths_str);

    if ($stmt->execute()) {
        echo "<h4>Doctor Added Successfully!</h4>";
        echo "<p><strong>ID:</strong> $doctor_id</p>";
        echo "<p><strong>Name:</strong> $doctor_name</p>";
        echo "<p><strong>Specialization:</strong> $specialization</p>";

        // Display uploaded images
        if (!empty($image_paths)) {
            echo "<h5>Uploaded Images:</h5>";
            foreach ($image_paths as $image) {
                echo "<img src='$image' width='150' height='150' style='margin: 5px; border-radius: 10px;'>";
            }
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>