<?php
include '../../connection.php';

$connection = new Connection('localhost', 'root', '', 'channel_me_test');
$conn = $connection->getConnection();

// Get all doctors
$sql = "SELECT * FROM adddoctors";
$result = $conn->query($sql);

// Get unique specializations for dropdown
$specializations = $conn->query("SELECT DISTINCT specialization FROM adddoctors ORDER BY specialization");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Channel Your Doctor</title>
    <link rel="stylesheet" href="clientStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
   
    <style>
      .container {
    display: flex;
    flex-wrap: nowrap; /* Prevents wrapping */
    justify-content: center;
    overflow-x: auto; /* Enables horizontal scrolling if necessary */
    gap: 20px;
    padding: 20px;
    margin-top: 40px;
}

.row {
    display: flex;
    flex-wrap: nowrap; /* Keeps all cards in a single row */
    justify-content: center;
    gap: 20px;
}

.doctor-card {
    flex: 0 0 700px; /* Prevents shrinking and ensures equal width */
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}


.doctor-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
}

.doctor-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 15px;
}

h5 {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-bottom: 8px;
}
h3{
    font-size: 35px;
    margin-bottom: 500px;
}

p {
    font-size: 14px;
    color: #555;
    margin-bottom: 5px;
}

.channel-btn {
    display: block;
    width: 100%;
    background-color: #007bff;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    text-decoration: none;
    transition: background 0.3s;
    font-weight: bold;
}

.channel-btn:hover {
    background-color: #0056b3;
}



    </style>
</head>
<body>

    <nav>

    <img src="/client and landing/landing/Elements/image/logo.png" alt="Logo" class="logo">
        <ul>
            <li><a href="/client and landing/landing/landing.html">Home</a></li>
            <li><a href="/client and landing/landing/landing.html#container">About us</a></li>
            <li><a href="/client and landing/client/client.html">Client</a></li>
            <li><a href="/client and landing/landing/landing.html#service_container">Services</a></li>
            <li><a href="/client and landing/landing/landing.html#contact-section">Contact us</a></li>
        </ul>


        <div class="search-container">
            <input type="text" placeholder="Search..." class="search-bar">
            <button class="search-btn">Search</button>
        </div>

        <button class="sign-in-btn">Sign In</button>
    </nav>



    <header>
        <div class="logo">
            <h1>Channel Your Doctor</h1>
        </div>

       
    </header>

    
    <div class="container py-5">
    <!-- Search Filter -->
    <div class="specialization-filter">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="filter-group">
                    <select class="specialization-select" id="specializationFilter">
                        <option value="">All Specializations</option>
                        <?php while($spec = $specializations->fetch_assoc()): ?>
                            <option value="<?= $spec['specialization'] ?>">
                                <?= $spec['specialization'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    <button class="filter-button" type="button" onclick="filterDoctors()">
                        Search
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
    .specialization-filter {
        margin: 30px 0;
    }

    .filter-group {
        display: flex;
        gap: 10px;
        max-width: 600px;
        margin: 0 auto;
    }

    .specialization-select {
        flex: 1;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px 15px;
        font-size: 16px;
        color: #333;
    }

    .filter-button {
        background: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 10px 25px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .filter-button:hover {
        background: #0056b3;
    }

    @media (max-width: 768px) {
        .filter-group {
            flex-direction: column;
        }
        
        .filter-button {
            width: 100%;
        }
    }
    </style>
</div>
        <h2 class="text-center mb-4">Doctors List</h2>
        <div class="row" id="doctorContainer">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="doctor-card p-3">
                        <?php 
                        $images = explode(',', $row['images']); 
                        $firstImage = !empty($images[0]) ? $images[0] : 'default.png'; 
                        ?>
                        <img src="<?= $firstImage ?>" class="doctor-img" alt="Doctor Image">
                        <h5 class="mt-3">Dr. <?= $row['doctor_name'] ?></h5>
                        <p><strong>Specialization:</strong> <?= $row['specialization'] ?></p>
                        <p><strong>ID:</strong> <?= $row['doctor_id'] ?></p>
                        <a href="appointment.php?doctor_id=<?= $row['doctor_id'] ?>" class="channel-btn">
                            Channel Now
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script>
    function filterDoctors() {
        const specialization = document.getElementById('specializationFilter').value.toLowerCase();
        const doctorCards = document.querySelectorAll('.col-md-4');
        
        doctorCards.forEach(card => {
            const cardSpecialization = card.querySelector('p:nth-of-type(1)').textContent
                .split(':')[1]
                .trim()
                .toLowerCase();
            
            if (specialization === '' || cardSpecialization === specialization) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
    </script>
  
   
    <div class="inquiry-box" id="inquiry-box">
        <h3>Send an Inquiry</h3>
        <p class="inquiry-description">If you have any questions or inquiries, feel free to reach out.</p>
    
       
        <input type="text" placeholder="Enter your name" required>
        <input type="tel" placeholder="Enter subject" required>
        <input type="date" placeholder="Select a date" required>
        <input type="file" accept="image/*" id="image-input" required>
        <div class="image-preview-container">
            <div class="image-preview" id="image-preview" style="display: none;">
                <img id="preview-image" src="" alt="Image Preview">
            </div>
            <span id="remove-image" class="close-btn" style="display: none;">&times;</span> <!-- Initially hidden -->
        </div>
        <textarea placeholder="Enter your message" required></textarea>
        <button type="submit">Send Message</button>
    
     
       
    </div>
    
    <script src="client.js"></script>
    
 
    <footer>
        <p>&copy; 2025 Channel Your Doctor. All rights reserved.</p>
    </footer>

</body>
</html>
<?php
$conn->close();
?>

