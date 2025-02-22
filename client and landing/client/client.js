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
