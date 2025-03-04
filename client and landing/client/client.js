let selectedFiles = []; 

document.getElementById('image-input').addEventListener('change', function(event) {
    const container = document.querySelector('.image-preview-container');
    const files = Array.from(event.target.files);

    
    selectedFiles = [...selectedFiles, ...files];

    
    if (selectedFiles.length > 4) {
        alert('You can only upload up to 4 images.');
        selectedFiles = selectedFiles.slice(0, 4); 
    }

    container.innerHTML = ''; 

    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imgDiv = document.createElement('div');
            imgDiv.className = 'image-preview';

            const img = document.createElement('img');
            img.src = e.target.result;

            const removeBtn = document.createElement('button');
            removeBtn.className = 'remove-image-btn';
            removeBtn.innerHTML = '×';
            removeBtn.onclick = function() {
                selectedFiles.splice(index, 1); 
                updateImagePreview(); 
            };

            imgDiv.appendChild(img);
            imgDiv.appendChild(removeBtn);
            container.appendChild(imgDiv);
        };
        reader.readAsDataURL(file);
    });

    event.target.value = ''; 
});


function updateImagePreview() {
    const container = document.querySelector('.image-preview-container');
    container.innerHTML = '';

    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imgDiv = document.createElement('div');
            imgDiv.className = 'image-preview';

            const img = document.createElement('img');
            img.src = e.target.result;

            const removeBtn = document.createElement('button');
            removeBtn.className = 'remove-image-btn';
            removeBtn.innerHTML = '×';
            removeBtn.onclick = function() {
                selectedFiles.splice(index, 1);
                updateImagePreview();
            };

            imgDiv.appendChild(img);
            imgDiv.appendChild(removeBtn);
            container.appendChild(imgDiv);
        };
        reader.readAsDataURL(file);
    });
}
// Function to perform the search when the search button is clicked
// Function to perform the search when the search button is clicked
// Function to perform the search when the search button is clicked
function searchDoctors() {
    const specialization = document.getElementById('specialization').value;  // Get value from the select dropdown
    const appointmentDate = document.getElementById('appointment-date').value; // Get the date value

    // Prepare the data to send to the backend
    const data = { 
        specialization: specialization, 
        date: appointmentDate 
    };

    // Make the request to the server
    fetch('searchDoctors.php', {  // Your PHP script that processes the search
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
        let resultHtml = '';

        // Check if there are any results
        if (data.length > 0) {
            // Loop through each doctor and display their info
            data.forEach(doctor => {
                resultHtml += `
                    <div class="doctor-card">
                        <img src="${doctor.image_url}" alt="${doctor.doctor_name}">
                        <h3>${doctor.doctor_name}</h3>
                        <p>Specialization: ${doctor.specialization}</p>
                        <p>Hospital: Hospital (Static Info, you can add hospital in the database if needed)</p>
                        <button>Book now</button>
                    </div>
                `;
            });
        } else {
            // Display a message if no doctors are found
            resultHtml = '<p>No doctors found based on your search criteria.</p>';
        }

        // Display the search results in the 'doctorList' section
        document.getElementById('doctorList').innerHTML = resultHtml;
    })
    .catch(error => console.error('Error:', error));
}
