<?php
include '../connection.php'; // Ensure this file correctly initializes $conn

$connection = new Connection('localhost', 'root', '', 'channel_me_test');
$conn = $connection->getConnection();

$sql = "SELECT * FROM adddoctors";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .doctor-card {
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            background-color: #fff;
            transition: transform 0.3s ease-in-out;
            text-align: center;
        }
        .doctor-card:hover {
            transform: scale(1.05);
        }
        .doctor-img {
            width: 100%;
            height: 250px;
            object-fit: contain; /* Ensures the image fits well inside the container */
            border-radius: 10px;
            background-color: #f8f9fa; /* Light background to handle transparency */
            padding: 10px;
        }
        .channel-btn {
            margin-top: 10px;
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .channel-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="text-center mb-4">Doctors List</h2>
        <div class="row">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-4 mb-4">
                    <div class="doctor-card p-3">
                        <?php 
                        $images = explode(',', $row['images']); 
                        $firstImage = !empty($images[0]) ? $images[0] : 'default.png'; 
                        ?>
                        <img src="<?php echo $firstImage; ?>" class="doctor-img" alt="Doctor Image">
                        <h5 class="mt-3">Dr. <?php echo $row['doctor_name']; ?></h5>
                        <p><strong>Specialization:</strong> <?php echo $row['specialization']; ?></p>
                        <p><strong>ID:</strong> <?php echo $row['doctor_id']; ?></p>
                        <a href="channel.php?doctor_id=<?php echo $row['doctor_id']; ?>" class="channel-btn">Channel Now</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
