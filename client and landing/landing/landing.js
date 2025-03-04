function toggleDescription(targetId) {
    const description = document.getElementById(`${targetId}-paragraph`);
    const button = document.querySelector(`[onclick="toggleDescription('${targetId}')"]`);
    
    description.classList.toggle('expanded');
    button.textContent = description.classList.contains('expanded') ? 'Show Less' : 'Learn More';
}
function toggleDescription(serviceType) {
    var shortDescription = document.querySelector(`.${serviceType}-service .short-description`);
    var fullDescription = document.querySelector(`.${serviceType}-service .full-description`);
    var button = document.querySelector(`.${serviceType}-service .learn-more-btn`);

    if (fullDescription.style.display === "none") {
        fullDescription.style.display = "block";  // Show the full description
        button.textContent = "Show Less";         // Change button text to "Show Less"
    } else {
        fullDescription.style.display = "none";   // Hide the full description
        button.textContent = "Learn More";        // Change button text back to "Learn More"
    }
}
function toggleDescription(service) {
    var fullDescription = document.querySelector(`#${service}-services .full-description`);
    var shortDescription = document.querySelector(`#${service}-services .short-description`);

    if (fullDescription.style.display === "none") {
        fullDescription.style.display = "block";
        shortDescription.style.display = "none";
    } else {
        fullDescription.style.display = "none";
        shortDescription.style.display = "block";
    }
}


// Function to update the images and create the animation effect
function changeImage() {
    // Reset all images' left position to move them off the screen
    images.forEach((img, index) => {
        img.style.left = `${(index - currentImageIndex) * 100}%`;
    });

    // Update the current image index for the next animation
    currentImageIndex = (currentImageIndex + 1) % images.length;
}

// Initialize the image slider to change every 3 seconds
setInterval(changeImage, 3000);

// Initialize the first change
changeImage();
const menuToggle = document.querySelector('.menu-toggle');
const nav = document.querySelector('nav');

menuToggle.addEventListener('click', () => {
    nav.classList.toggle('show-menu');
});
