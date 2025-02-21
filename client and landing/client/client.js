let selectedFiles = []; // Store selected images

document.getElementById('image-input').addEventListener('change', function(event) {
    const container = document.querySelector('.image-preview-container');
    const files = Array.from(event.target.files);

    // Combine previously selected and newly uploaded files
    selectedFiles = [...selectedFiles, ...files];

    // Ensure only up to 4 images are stored
    if (selectedFiles.length > 4) {
        alert('You can only upload up to 4 images.');
        selectedFiles = selectedFiles.slice(0, 4); // Keep only the first 4 images
    }

    container.innerHTML = ''; // Clear previous preview before displaying updated list

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
                selectedFiles.splice(index, 1); // Remove the image from the array
                updateImagePreview(); // Refresh preview
            };

            imgDiv.appendChild(img);
            imgDiv.appendChild(removeBtn);
            container.appendChild(imgDiv);
        };
        reader.readAsDataURL(file);
    });

    event.target.value = ''; // Reset file input so same image can be selected again if needed
});

// Function to update the image preview when an image is removed
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
