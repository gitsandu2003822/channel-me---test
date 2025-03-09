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
    const specialization = document.getElementById("specialization").value;

    fetch("display.php?specialization=" + encodeURIComponent(specialization))
        .then(response => response.json())
        .then(doctors => {
            const doctorsContainer = document.getElementById("doctorsContainer");
            doctorsContainer.innerHTML = ""; // Clear existing results

            if (doctors.length === 0) {
                doctorsContainer.innerHTML = "<p>No doctors found.</p>";
                return;
            }

            doctors.forEach(doctor => {
                const card = document.createElement("div");
                card.classList.add("doctor-card");
                card.innerHTML = `
                    <img src="${doctor.image}" alt="${doctor.name}" class="doctor-image">
                    <h3>${doctor.name}</h3>
                    <p>${doctor.specialization}</p>
                    <a href="channel.php?doctor_id=${doctor.id}" class="channel-btn">Channel</a>
                `;
                doctorsContainer.appendChild(card);
            });
        })
        .catch(error => console.error("Error fetching doctors:", error));
}
