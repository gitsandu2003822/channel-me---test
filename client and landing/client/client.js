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
    console.log("Search button clicked");

    const specialization = document.getElementById("specialization").value;
    const appointmentDate = document.getElementById("appointment-date").value;
    console.log("Specialization selected:", specialization);
    
    fetch("viewphp.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then(doctors => {
            console.log("Doctors fetched:", doctors);

            const doctorList = document.getElementById("doctorList");
            doctorList.innerHTML = ""; // Clear previous results

            if (doctors.length === 0) {
                doctorList.innerHTML = "<p>No doctors found for the selected criteria.</p>";
                return;
            }

            // Filter doctors based on specialization if selected
            const filteredDoctors = specialization
                ? doctors.filter(doc => doc.specialization === specialization)
                : doctors;

            if (filteredDoctors.length === 0) {
                doctorList.innerHTML = "<p>No doctors found for the selected criteria.</p>";
                return;
            }

            // Display doctors
            filteredDoctors.forEach(doctor => {
                const doctorCard = document.createElement("div");
                doctorCard.classList.add("doctor-card");

                // Add images dynamically
                const imagesHTML = doctor.images.map(image => `
                    <img src="${image}" alt="${doctor.doctor_name}" class="doctor-image">
                `).join('');

                doctorCard.innerHTML = `
                    <div class="doctor-card-content">
                        <h3>${doctor.doctor_name}</h3>
                        <p>Specialization: ${doctor.specialization}</p>
                        <div class="doctor-images">${imagesHTML}</div>
                    </div>
                `;

                doctorList.appendChild(doctorCard);
            });

            // Show the doctor list only after search
            doctorList.style.display = "flex";
        })
        .catch(error => {
            console.error("Error fetching doctors:", error);
        });
}
