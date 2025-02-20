document.getElementById('image-input').addEventListener('change', function(event) {
    const imagePreview = document.getElementById('image-preview');
    const previewImage = document.getElementById('preview-image');
    
    // Check if a file was selected
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Set the source of the image preview
            previewImage.src = e.target.result;
            imagePreview.style.display = 'flex'; // Show the preview box
        };
        reader.readAsDataURL(file); // Convert the file to a data URL
    } else {
        // Hide the preview box if no file is selected
        imagePreview.style.display = 'none';
    }
});

// Remove the image preview when the close button is clicked
document.getElementById('remove-image').addEventListener('click', function() {
    document.getElementById('image-input').value = ''; // Clear the file input
    document.getElementById('image-preview').style.display = 'none'; // Hide the image preview
    document.getElementById('preview-image').src = ''; // Clear the image source
});
