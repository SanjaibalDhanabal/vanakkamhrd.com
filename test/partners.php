<?php include('includes/header.php'); ?>

<style>
    .partner-img {
        width: 50%; /* Make the image take up the full width of its container */
        height: auto; /* Maintain aspect ratio */
        object-fit: cover; /* Ensure the image covers the specified width and height */
        border-radius: 10px; /* Optional: Adds rounded corners */
    }
    .partner-section {
        margin-bottom: 30px; /* Add space between sections */
    }
    .partner-section .col-lg-3 {
        flex: 0 0 25%; /* Adjust the column width to make them smaller */
        max-width: 25%; /* Ensure columns don't exceed the desired width */
        display: flex; /* Enable Flexbox layout */
        justify-content: center; /* Center content horizontally */
        align-items: center; /* Center content vertically */
    }
    @media (max-width: 767.98px) { /* For mobile devices */
        .partner-section .col-6 {
            flex: 0 0 50%; /* Make columns take up half the width */
            max-width: 50%; /* Ensure columns don't exceed half the width */
        }
    }
    .partner-title {
        margin-bottom: 20px; /* Add space below the title */
    }
</style>

<div id="partner" class="partner section">
    <div class="row mt-3 mx-4" style="background-color: rgb(237, 237, 237);border-radius: 40px;">
        <div class="button1 text-center">
            <a href="collaborate_form.php" class="btn btn-primary mb-3 mt-3" style="color: white;">Let's Collaborate!!</a>
            <p class="mb-3">Can you provide me with some details about your company,<br> such as what it does, its mission, and any unique aspects?</p>
        </div>
    </div>

    <!-- Institution Partners Section -->
    <div class="container partner-section">
        <h2 class="partner-title text-center mt-3 mb-4 pb-3 pt-3" style="color: #12037f;">Institution Partners</h2>
        <div class="row">
            <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="assets/images/in-6.jpeg" class="partner-img" alt="Institution Partner 1">
            </div>
            <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="assets/images/in-2.jpeg" class="partner-img" alt="Institution Partner 2">
            </div>
            <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="assets/images/in-5.jpeg" class="partner-img" alt="Institution Partner 3">
            </div>
            <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="assets/images/in-4.jpeg" class="partner-img" alt="Institution Partner 4">
            </div>
            <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="assets/images/in-3.jpeg" class="partner-img" alt="Institution Partner 5">
            </div>
            <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="assets/images/in-1.jpeg" class="partner-img" alt="Institution Partner 6">
            </div>
        </div>
    </div>

    <!-- Corporate Partners Section -->
    <div class="container partner-section">
        <h2 class="partner-title text-center mt-3 mb-4" style="color: #12037f;">Corporate Partners</h2>
        <div class="row">
            <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="assets/images/p1.png" class="partner-img" alt="Corporate Partner 1">
            </div>
            <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="assets/images/p2-removebg-preview.png" class="partner-img" alt="Corporate Partner 2">
            </div>
            <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="assets/images/p3-removebg-preview.png" class="partner-img" alt="Corporate Partner 3">
            </div>
            <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="assets/images/p4.jpeg" class="partner-img" alt="Corporate Partner 4">
            </div>
            <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="assets/images/p5.jpeg" class="partner-img" alt="Corporate Partner 5">
            </div>
            <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="assets/images/Inypeople Logo.png" class="partner-img" alt="Corporate Partner 6">
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
