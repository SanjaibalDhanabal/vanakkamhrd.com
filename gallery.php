<?php include('includes/header.php'); ?>
<?php include('includes/db_connect.php'); // Correct path to your db_connect.php file

$category = isset($_GET['category']) ? $_GET['category'] : 'all';

// Prepare SQL query based on the selected category, ordering by id in descending order
if ($category === 'all') {
    $sql = "SELECT * FROM gallery ORDER BY id DESC"; // Order by id in descending order
    $stmt = $conn->prepare($sql);
} else {
    $sql = "SELECT * FROM gallery WHERE category = ? "; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $category);
}


$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <!-- Bootstrap CSS -->
    
    <style>
        .gal nav {
            display: flex;
            justify-content: center;
            padding: 0.5rem;
        }

        .gal nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .gal nav ul li {
            margin: 0.5rem;
        }

        .gal nav ul li a {
            color: #12037f;
            text-decoration: none;
            font-weight: bold;
            padding: 0.5rem 1rem;
            display: block;
            transition: color 0.3s, border-radius 0.3s, border-bottom 0.3s;
            border-bottom: 2px solid transparent;
        }

        .gal nav ul li a:hover {
            color: #555;
        }

        .gal nav ul li a.active {
            border-bottom: 2px solid orangered;
        }

        /* Media query for mobile devices */
        @media (max-width: 600px) {
            .gal nav ul {
                font-size: 0.9rem;
            }

            .gal nav ul li {
                margin: 0.25rem;
            }

            .gallery-container img {
                width: 100%;
                height: auto;
            }
        }


.galleryy {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin: 20px;
}

.galleryy img {
    flex: 1 1 calc(25% - 1rem); /* 25% width minus gap for 4 columns */

    transition: transform 0.5s;
    cursor: pointer;

   
}

.galleryy img:hover {
    transform: scale(1.1);
}
@media (max-width: 600px) {
.galleryy img {
    flex: 1 1 calc(100% - 1rem); /* 25% width minus gap for 4 columns */

    transition: transform 0.5s;
    cursor: pointer;
}
}




        .gallery-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            
        }

        .gallery-container img {
            margin: 0.5rem;
            transition: transform 0.5s;
            cursor: pointer;
        }

        .gallery-container img:hover {
            transform: scale(1.1);
        }
        .modal{
    overflow: hidden;
}
        .custom-modal-dialog {
    max-width: 100%; /* Adjust as needed */
    

   

}

.custom-modal-content {
    height: 100vh; /* Adjust height as needed */
    max-width: 100%;
    border-radius: 0; /* Optional: remove rounded corners */
    background-color: rgba(0, 0, 0, 0.7);
}

.modal-body {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative; /* Ensure positioning is relative to this container */
    padding: 0; /* Remove any padding */
    height: 100vh;
}


.modal-body img {
    max-width: 100%;
    max-height: 80vh; /* Adjust to ensure image fits */
    object-fit: contain;
    display: block; /* Ensure image block-level */
    margin: 0; /* Remove margin */
    cursor: pointer;
}

.modal-body .prev, .modal-body .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 15px;
    color: white;
    background-color: rgba(0, 0, 0, 0.5); /* Slightly transparent background */
    border: none;
    cursor: pointer;
    padding: 0; /* Remove padding */
    width: 40px; /* Adjust width */
    height: 40px; /* Adjust height */
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-body .prev {
    left: 0; /* Align with the left edge */
}

.modal-body .next {
    right: 0; /* Align with the right edge */
}

      

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem; /* Adjust as needed */
    opacity: 1; /* Ensure buttons are visible */

    z-index: 10; 
    transition: background-color 0.3s ease; /* Smooth transition for background changes */

}


.zoomed-in .modal-header {
    background-color: rgba(0, 0, 0, 0.7); /* Darker background when zoomed in */
}


.modal-title {
    margin: 0;
}

.modal-header-buttons {
    display: flex;
    gap: 7px; /* Adjust the gap between icons as needed */
}

.modal-header-buttons .btn {
    background: none;
    border: none;
    color: rgba(255, 255, 255, 0.7);/* Adjust color as needed */
    font-size: 15px; /* Adjust size as needed */
    cursor: pointer;
}

.modal-header-buttons .btn:focus {
    outline: none;
}

.modal-header .close {
    font-size: 24px; /* Adjust size as needed */
    color: rgba(255, 255, 255, 0.7);
}
.modal-header .close:hover{
    color: white;
}


        .modal-header h5{
            color: white;
            font-size: 12px;
        }
        .modal-header button:hover{
            color: white;
        }


        .share-button {
            font-size: 15px;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.7);;
            background: none;
            border: none;
        }
        .modal-header-buttons .btn, .close, .share-button {
             opacity: 1; /* Ensure buttons are visible */
             z-index: 10;
        }
        .modal-header h5 {
            opacity: 1; /* Ensure buttons are visible */
            z-index: 10;
        }
        
        #prevImage, #nextImage {
              background-color: transparent; /* Default background color */
    transition: background-color 0.3s ease;
}

/* Mobile-specific styles */
@media (max-width: 768px) { /* Adjust the max-width as needed */
    #nextImage {
        background-color: rgba(0, 0, 0, 0.7); /* Background color for mobile */
         width: 40px;
         height: 40px;
         
    }
    #prevImage{
         background-color: rgba(0, 0, 0, 0.7); /* Background color for mobile */
         width: 40px;
         height: 40px;
         
        
    }
    
}
    </style>
</head>
<body>
<div class="gal">
    <nav>
        <ul>
             <li><a href="gallery.php?category=all" class="<?php echo $category === 'all' ? 'active' : ''; ?>" style="font-size: 15px;">All</a></li>
             <li><a href="gallery.php?category=hr_confluence_2025" class="<?php echo $category === 'hr_confluence_2025' ? 'active' : ''; ?>" style="font-size: 15px;">HR Confluence 2025</a></li>
             <li><a href="gallery.php?category=hr_festival_2025" class="<?php echo $category === 'hr_festival_2025' ? 'active' : ''; ?>" style="font-size: 15px;">HR Festival 2025</a></li>
             <li><a href="gallery.php?category=hr_conference_2025" class="<?php echo $category === 'hr_conference_2025' ? 'active' : ''; ?>" style="font-size: 15px;">HR Conference 2025</a></li>
            <li><a href="gallery.php?category=second_annual_awards_2024" class="<?php echo $category === 'second_annual_awards_2024' ? 'active' : ''; ?>" style="font-size: 15px;">Second Annual Conference & Awards 2024</a></li>
            <!-- <li><a href="gallery.php?category=hr_meet_2024" class="<?php echo $category === 'hr_meet_2024' ? 'active' : ''; ?>" style="font-size: 15px;">HR Meet 2024</a></li> -->
            <!-- <li><a href="gallery.php?category=campus_recruiters_2024" class="<?php echo $category === 'campus_recruiters_2024' ? 'active' : ''; ?>" style="font-size: 15px;">Campus Recruiters Confluence 2024</a></li> -->
            <!-- <li><a href="gallery.php?category=tn_hr_summit_2024" class="<?php echo $category === 'tn_hr_summit_2024' ? 'active' : ''; ?>" style="font-size: 15px;">TN HR Summit 2024</a></li> -->
            <!-- <li><a href="gallery.php?category=career_fair_2024" class="<?php echo $category === 'career_fair_2024' ? 'active' : ''; ?>" style="font-size: 15px;">Career Fair 2024</a></li> -->
        </ul>
    </nav>
</div>

<div class="gallery-container">
    <?php
    if ($result->num_rows > 0) {
        $imageCount = 0;
        $totalImages = $result->num_rows;
        while($row = $result->fetch_assoc()) {
            $imageCount++;
            $imagePath = 'uploads/event_photos/'.$row['image'];
            if (file_exists($imagePath)) {
                echo '<img src="'.$imagePath.'" alt="'.$row['image'].'" data-index="'.$imageCount.'" style="width:300px; height:200px;" onclick="openModal(this, '.$imageCount.', '.$totalImages.')">';
            } else {
                echo '<p>Image not found: '.$row['image'].'</p>';
            }
        }
    } else {
        echo "<p>No images found.</p>";
    }
    ?>
</div>



<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-dialog m-0">
        <div class="modal-content custom-modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title" id="imageModalLabel"><span id="currentImage">1</span> / <span id="totalImages">1</span></h5>
                <div class="modal-header-buttons">
                    <button type="button" class="btn" id="fullscreenImage"><i class="fas fa-expand"></i></button>
                    <button type="button" class="btn" id="zoomImage"><i class="fas fa-search-plus"></i></button>
                    <button type="button" class="share-button" id="downloadImage"><i class="fas fa-download"></i></button>
                    <button type="button" class="close" aria-label="Close" onclick="closeModal()">
                        <span>&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Image" class="img-fluid">
                <button type="button" class="prev" id="prevImage"><i class="fas fa-chevron-left"></i></button>
                <button type="button" class="next" id="nextImage"><i class="fas fa-chevron-right"></i></button>
            </div>
            <div class="modal-footer" style="border-top: none;">
                <!-- Add footer content here if needed -->
            </div>
        </div>
    </div>
</div>



<!-- Custom Script -->
<script>
var currentIndex = 1;
var totalImages = <?php echo $totalImages; ?>;
var currentImageURL = '';
var isZoomedIn = false; // Track the zoom state

// Open the modal with the selected image
function openModal(img, index, total) {
    currentIndex = index;
    totalImages = total;
    currentImageURL = img.src;
    updateModalImage();
    $('#imageModal').modal('show');

    // Check if the screen width is less than or equal to 768px
    if (window.innerWidth <= 768) {
        document.getElementById('prevImage').classList.add('mobile-bg');
        document.getElementById('nextImage').classList.add('mobile-bg');
    } else {
        document.getElementById('prevImage').classList.remove('mobile-bg');
        document.getElementById('nextImage').classList.remove('mobile-bg');
    }
}

// Update the window resize event listener to handle changes dynamically
window.addEventListener('resize', function() {
    if (document.getElementById('imageModal').classList.contains('show')) {
        if (window.innerWidth <= 768) {
            document.getElementById('prevImage').classList.add('mobile-bg');
            document.getElementById('nextImage').classList.add('mobile-bg');
        } else {
            document.getElementById('prevImage').classList.remove('mobile-bg');
            document.getElementById('nextImage').classList.remove('mobile-bg');
        }
    }
});

// Close the modal
function closeModal() {
    $('#imageModal').modal('hide');
}

// Update the image in the modal
function updateModalImage() {
    var imgElements = document.querySelectorAll('.gallery-container img');
    var imgSrc = imgElements[currentIndex - 1].src;
    document.getElementById('modalImage').src = imgSrc;
    document.getElementById('currentImage').innerText = currentIndex;
    document.getElementById('totalImages').innerText = totalImages;
}

// Navigate to the previous image
document.getElementById('prevImage').onclick = function() {
    prevImage();
};

// Navigate to the next image
document.getElementById('nextImage').onclick = function() {
    nextImage();
};

// Navigate to the previous image function
function prevImage() {
    if (currentIndex > 1) {
        currentIndex--;
        updateModalImage();
    }
}

// Navigate to the next image function
function nextImage() {
    if (currentIndex < totalImages) {
        currentIndex++;
        updateModalImage();
    }
}

// Zoom in and out with panning support
document.getElementById('zoomImage').onclick = function() {
    toggleZoom(); // Call the toggleZoom function on click
};

// Pan the image while zoomed in based on cursor position (for desktop)
document.getElementById('modalImage').onmousemove = function(e) {
    var modalImage = document.getElementById('modalImage');
    if (modalImage.classList.contains('zoomed-in')) {
        panImage(e.clientX, e.clientY, modalImage);
    }
};

// Pan the image while zoomed in based on touch position (for mobile)
document.getElementById('modalImage').ontouchmove = function(e) {
    var modalImage = document.getElementById('modalImage');
    if (modalImage.classList.contains('zoomed-in')) {
        var touch = e.touches[0];
        panImage(touch.clientX, touch.clientY, modalImage);
    }
};

// Double-click to zoom in/out (for desktop)
document.getElementById('modalImage').ondblclick = function() {
    toggleZoom(); // Call the toggleZoom function on double-click
};

// Double-tap to zoom in/out (for mobile)
document.getElementById('modalImage').ontouchend = function(e) {
    var modalImage = document.getElementById('modalImage');

    var now = new Date().getTime();
    var lastTouch = modalImage.dataset.lastTouch || now + 1;
    var delta = now - lastTouch;

    if (delta < timeBetweenTaps && delta > 0) {
        toggleZoom(); // Call the toggleZoom function on double-tap
    }

    modalImage.dataset.lastTouch = now;
};

// Function to toggle zoom in and zoom out
function toggleZoom() {
    var modalImage = document.getElementById('modalImage');
    var zoomIcon = document.getElementById('zoomImage').querySelector('i');
    var modalHeader = document.querySelector('.modal-header');
    isZoomedIn = !isZoomedIn;

    if (isZoomedIn) {
        // Zoom in
        modalImage.classList.add('zoomed-in');
        zoomIcon.classList.remove('fa-search-plus');
        zoomIcon.classList.add('fa-search-minus');
        modalImage.style.transform = 'scale(2)'; // Zoom in the image
        modalImage.style.cursor = 'move'; // Change cursor to indicate zoom-out
        modalHeader.style.backgroundColor = 'rgba(0, 0, 0, 0.5)'; // Semi-transparent black background
    } else {
        // Zoom out
        modalImage.classList.remove('zoomed-in');
        zoomIcon.classList.remove('fa-search-minus');
        zoomIcon.classList.add('fa-search-plus');
        modalImage.style.transform = ''; // Reset transformation
        modalImage.style.cursor = ''; // Reset cursor
        modalImage.style.transformOrigin = 'center'; // Reset transform origin
        modalHeader.style.backgroundColor = ''; // Reset to original or transparent
    }
}

// Function to pan the image based on cursor or touch position
function panImage(x, y, modalImage) {
    var rect = modalImage.getBoundingClientRect();
    var xPercent = ((x - rect.left) / rect.width) * 100;
    var yPercent = ((y - rect.top) / rect.height) * 100;

    // Set the transform-origin based on the cursor or touch position
    modalImage.style.transformOrigin = `${xPercent}% ${yPercent}%`;
}

// Reset modal state on close
document.querySelector('.close').onclick = function() {
    var fullscreenIcon = document.getElementById('fullscreenImage').querySelector('i');

    if (document.fullscreenElement) {
        document.exitFullscreen();
    }

    // Reset the icon to fullscreen mode icon
    fullscreenIcon.classList.remove('fa-compress');
    fullscreenIcon.classList.add('fa-expand');

    closeModal();
};

// Toggle fullscreen mode (Fullscreen button)
document.getElementById('fullscreenImage').onclick = function() {
    var modalContent = document.querySelector('.custom-modal-content');
    var fullscreenIcon = document.getElementById('fullscreenImage').querySelector('i');

    if (!document.fullscreenElement) {
        // Enter fullscreen mode
        if (modalContent.requestFullscreen) {
            modalContent.requestFullscreen();
        } else if (modalContent.mozRequestFullScreen) { /* Firefox */
            modalContent.mozRequestFullScreen();
        } else if (modalContent.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
            modalContent.webkitRequestFullscreen();
        } else if (modalContent.msRequestFullscreen) { /* IE/Edge */
            modalContent.msRequestFullscreen();
        }

        // Change the fullscreen icon to the exit icon
        fullscreenIcon.classList.remove('fa-expand');
        fullscreenIcon.classList.add('fa-compress');
    } else {
        // Exit fullscreen mode
        document.exitFullscreen();

        // Change the exit icon back to the fullscreen icon
        fullscreenIcon.classList.remove('fa-compress');
        fullscreenIcon.classList.add('fa-expand');
    }
};

// Download functionality
document.getElementById('downloadImage').addEventListener("click", function () {
    var modalImage = document.getElementById("modalImage");
    var link = document.createElement('a');
    link.href = modalImage.src;
    link.download = modalImage.src.split('/').pop(); // Use the image name as the download name
    link.click();
});

// Add keyboard support for next and previous
document.addEventListener('keydown', function(event) {
    if (event.key === 'ArrowLeft') {
        prevImage();
    } else if (event.key === 'ArrowRight') {
        nextImage();
    }
});

// Handle swipe gestures
var touchStartX = 0;
var touchEndX = 0;

document.querySelector('.modal-body').addEventListener('touchstart', function(event) {
    touchStartX = event.changedTouches[0].screenX;
});

document.querySelector('.modal-body').addEventListener('touchend', function(event) {
    touchEndX = event.changedTouches[0].screenX;
    handleSwipe();
});

function handleSwipe() {
    if (touchStartX > touchEndX + 50) {
        // Swiped left
        nextImage();
    } else if (touchStartX < touchEndX - 50) {
        // Swiped right
        prevImage();
    }
}

// Reset modal state on close
document.querySelector('.close').onclick = function() {
    var fullscreenIcon = document.getElementById('fullscreenImage').querySelector('i');

    if (document.fullscreenElement) {
        document.exitFullscreen();
    }

    // Reset the icon to fullscreen mode icon
    fullscreenIcon.classList.remove('fa-compress');
    fullscreenIcon.classList.add('fa-expand');

    closeModal();
};


</script>
</body>
</html>
<?php include('includes/footer.php'); ?>