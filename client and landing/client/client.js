document.getElementById('image-input').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const imagePreview = document.getElementById('image-preview');
    const previewImage = document.getElementById('preview-image');
    const removeImageButton = document.getElementById('remove-image');

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            previewImage.src = e.target.result;
            imagePreview.style.display = 'flex'; // Show the image preview
            removeImageButton.style.display = 'block'; // Show the close button
        };

        reader.readAsDataURL(file);
    }
});

// Remove the image and hide the preview and close button
document.getElementById('remove-image').addEventListener('click', function () {
    const imagePreview = document.getElementById('image-preview');
    const previewImage = document.getElementById('preview-image');
    const removeImageButton = document.getElementById('remove-image');

    previewImage.src = '';
    imagePreview.style.display = 'none'; // Hide the image preview
    removeImageButton.style.display = 'none'; // Hide the close button
    document.getElementById('image-input').value = ''; // Clear the input
});
