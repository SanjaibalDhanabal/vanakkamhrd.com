<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />

<style>
    .partner-img {
        width: 70%; 
        height: 150px; 
        object-fit: contain; 
        border-radius: 10px; 
    }
    .partnerr-img {
        width: 70%; 
        height: 50px; 
        object-fit: contain; 
        border-radius: 10px;
    }
    .partner-imgg {
        width: 85%; 
        height: 150px; 
        object-fit: contain; 
        border-radius: 10px; 
    }
    .partner-imggg {
        width: 60%; 
        height: 100px; 
        object-fit: contain; 
        border-radius: 10px; 
    }
    .partner-section {
        margin-bottom: 10px; 
        width: 90%;
        max-width: 1000px;
    }
    .partner-section .col-lg-3 {
        flex: 0 0 25%; 
        max-width: 25%; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
    }
    
     .partner-title {
        font-weight: 600;
        font-size: 28px;
        
    }
    
    @media (max-width: 567.98px) { 
        .partner-section .col-6 {
            flex: 0 0 50%; 
            max-width: 50%; 
            max-height: 75px;
            height: 100%;
        }
        .partner-img {
        width: 85%; 
        height: 150px; 
        object-fit: contain; 
        border-radius: 10px; 
    }
    .partner-imgg {
        width: 90%; 
        height: 150px; 
        object-fit: contain; 
        border-radius: 10px; 
    }
    .partner-imggg {
        width: 60%; 
        height: 100px; 
        object-fit: contain; 
        border-radius: 10px; 
    }
    .partnerr-img {
        width: 70%; 
        height: 100px; 
        object-fit: contain; 
        border-radius: 10px; 
    }
    
     .partner-title{
        font-weight: 700;
        font-size: 18px;
    }
   
    }
   

     /* Modal Content */
     .modal-content {
        background-color: #12037f;
        width: 90vw; 
        max-width: 600px; 
        margin: auto; 
    }

    /* Form Labels */
    .card-body label {
        color: white;
    }

    /* Form Inputs */
    .card-body .form-control, .form-control-file {
        background-color: #12037f;
        color: lightgrey;
        height: 50px;
    }

    /* Placeholder Text */
    ::placeholder {
        color: lightgrey !important;
    }

    /* Modal Header */
    .modal-header {
        display: flex;
        justify-content: center; 
        align-items: center; 
        border-bottom: none; 
        position: relative; 
    }

    .modal-header img {
        max-width: 50%; 
        height: auto;
    }

    .modal-body {
        position: relative;
        bottom: 20px;
    }

    .btn-close {
        position: absolute;
        right: 0; 
        top: -5px; 
        transform: translateY(-50%);
    }

    .btn-close:hover {
        border: 1px solid black;
        background-color: whitesmoke;
    }
 
    .form-group .btn{
        background-color: #12037f;
        color: lightgrey;
        border: 1px solid lightgray;
    }
   
    .form-control.selected {
    background-color: 
    color: black; 
}

.btn-clicked {
    background-color: white !important;
    color: #12037f !important; 
    border-color: #12037f !important; 


    /* Mobile Responsiveness */
    @media (max-width: 576px) {
        .modal-content {
            width: 100vw; 
            padding: 20px; 
        }

        .modal-header img {
            max-width: 70%; 
        }

        .card-body .form-control, .form-control-file {
            height: 50px;
        }

        .btn-close {
            top: 10px; 
            right: 10px;
        }
    }
</style>

<div id="partner" class="partner section">

<div class="row mt-3 mx-4" style="background-color: rgb(237, 237, 237);border-radius: 40px;">
        <div class="button1 text-center">
            <a href="#collaborateModal" data-bs-toggle="modal" class="btn btn-primary mb-3 mt-3" style="color: white;">Let's Collaborate!!</a>
            <p class="mb-3">Can you provide me with some details about your company,<br> such as what it does, its mission, and any unique aspects?</p>
        </div>
    </div>
    <!-- Collaborate Modal -->
<div class="modal fade" id="collaborateModal" tabindex="-1" aria-labelledby="collaborateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <img src="assets/images/whitelogo.png">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    
      <div class="card-body">
        <form action="submit_form_collaborate.php" method="post">
                <div class="form-group">
                    
                    <input type="text" class="form-control" id="company" name="company" placeholder="Company name" required>
                </div>
                <div class="form-group">
                    
                    <textarea class="form-control" style="height: 100px;" id="overview" name="overview" placeholder="Company overview" rows="4" required></textarea>
                </div>
                <div class="form-group">
                  
                    <input type="url" class="form-control" id="website" name="website" placeholder="Website link" required>
                </div>

                <div class="row">
                            <div class="col-md-6">
                <div class="form-group">
                    
                    <input type="text" class="form-control" id="name" name="name" placeholder="Contact name" required>
                </div>
                            </div>
                           
                            <div class="col-md-6">
                <div class="form-group">
                   
                    <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact number" required>
                </div>
                            </div>
                </div>
                <div class="form-group">
                   
                    <input type="email" class="form-control" id="email" name="email" placeholder="Business email" required>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="privacy" name="privacy" required>
                    <label class="form-check-label" for="privacy">By checking this box, you agree that Vanakkam HRD may contact you to provide you with more information about their products, events and offers, you can Unsubscribe at any time. <a href="terms.php">Privacy Policy</a></label>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <button type="submit" name="submit_button" class="btn mt-3" >Submit</button>
                </div>
            </form>
      </div>
      </div>
    </div>
  </div>
</div>


    <!-- Institution Partners Section -->
    <div class="container partner-section">
        <h2 class="partner-title text-center mt-3 pb-3 pt-3">Institution Partners</h2>
        <div class="row">
            <div class="col-6 col-lg-3 col-md-3 col-sm-6 mb-4">
                <img src="assets/images/newprince.jpeg" class="partner-imgg" data-aos="zoom-in" alt="Institution Partner 1">
            </div>
            <div class="col-6 col-lg-3 col-md-3 col-sm-6 mb-4">
                <img src="assets/images/in-2.jpeg" class="partner-img" data-aos="zoom-in" alt="Institution Partner 2">
            </div>
            <div class="col-6 col-lg-3 col-md-3 col-sm-6 mb-4">
                <img src="assets/images/in-5.jpeg" class="partner-img" data-aos="zoom-in" alt="Institution Partner 3">
            </div>
            <div class="col-6 col-lg-3 col-md-3 col-sm-6 mb-4">
                <img src="assets/images/in-4.jpeg" class="partner-img" data-aos="zoom-in" alt="Institution Partner 4">
            </div>
            <div class="col-6 col-lg-3 col-md-3 col-sm-6 mb-4">
                <img src="assets/images/in-1.jpeg" class="partner-imggg" data-aos="zoom-in" alt="Institution Partner 5">
            </div>
            <div class="col-6 col-lg-3 col-md-3 col-sm-6 mb-4">
                <img src="assets/images/in-3.jpeg" class="partner-imggg" data-aos="zoom-in" alt="Institution Partner 6">
            </div>
            
        </div>
    </div>

    <!-- Corporate Partners Section -->
    <div class="container partner-section">
        <h2 class="partner-title text-center mb-2 pb-3 pt-3">Corporate Partners</h2>
        <div class="row">
            <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="assets/images/p1.png" class="partner-img" data-aos="zoom-in" alt="Corporate Partner 1">
            </div>
            <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="assets/images/p2-removebg-preview.png" class="partner-img" data-aos="zoom-in" alt="Corporate Partner 2">
            </div>
            <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="assets/images/p4.jpeg" class="partner-imgg" data-aos="zoom-in" alt="Corporate Partner 3">
            </div>
            <div class="col-6 col-lg-3 col-md-4 col-sm-6">
                <img src="assets/images/p5.jpeg" class="partner-imgg" data-aos="zoom-in" alt="Corporate Partner 4">
            </div>
            <div class="col-6 col-lg-3 col-md-4 col-sm-6">
                <img src="assets/images/Inypeople Logo.png" class="partnerr-img" data-aos="zoom-in"alt="Corporate Partner 5">
            </div>
            <div class="col-6 col-lg-3 col-md-4 col-sm-6">
                <img src="assets/images/idea.png" class="partner-img" data-aos="zoom-in"alt="Corporate Partner 6">
            </div>
            
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script>
  AOS.init();
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const submitButton = document.querySelector('button[name="submit_button"]');
    
    submitButton.addEventListener('click', function() {
        this.classList.add('btn-clicked');
    });
});
    </script>


<?php include('includes/footer.php'); ?>
