<?php
include '../../connection.php'; // Ensure this file correctly initializes $conn

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
    <title>Channel Your Doctor</title>
    <link rel="stylesheet" href="clientStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
   
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
        .row {
    display: flex;
    flex-direction: column; /* Stack the cards vertically */
    gap: 20px; /* Add space between each card */
}

.col-md-4 {
    width: 50%; /* Ensure the card takes the full width */
    max-width: none; /* Remove any width constraints */
}

    </style>
</head>
<body>

    <nav>

        <img src="/client and landing/landing/Elements/images/logo.png" alt="Logo" class="logo">

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

    
    <div class="Dsearch-container">
        <h2>Find Your Doctor</h2>
        <p class="search-description">Search for doctors based on specialization, hospital, or location.</p>
    
        <div class="search-form">
            <!-- Specialization Selection -->
            <label for="specialization">Select Specialization</label>
            <select id="specialization">
                <option value="">Any Specialization</option>
                <option value="General Practitioner">General Practitioner</option>
                <option value="Cardiology">Cardiology</option>
                <option value="Dermatology">Dermatology</option>
                <option value="Neurology">Neurology</option>
                <option value="Psychiatry">Psychiatry</option>
                <option value="Pulmonologist">Pulmonologist</option>
                <option value="Dermatologist">Dermatologist</option>
                <option value="Emergency Medicine">Emergency Medicine</option>
            </select>
    
            <!-- Date Selection -->
            <label for="appointment-date">Select Date</label>
            <input id="appointment-date" type="date">
    
            <!-- Search Button -->
            <button onclick="searchDoctors()">🔍 Search</button>
        </div>
    </div>
    
    <!-- Div to display the search results below the search form -->
    <div id="searchResults" class="search-results-container"></div>
    
  

        <!-- ... (rest of the HTML remains unchanged) ... -->
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
        <!-- Single Channel Now button -->
        <a href="appointment.php?doctor_id=<?php echo $row['doctor_id']; ?>" class="channel-btn">Channel Now</a>
    </div>
</div>
            <?php } ?>
        </div>
    </div>
  
   
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

