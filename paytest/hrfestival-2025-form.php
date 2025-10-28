<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="assets/css/event_form.css">
<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;700&display=swap" rel="stylesheet">

<div id="event" class="event section">

    <section id="upcoming" class="mt-1">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="new_event">
                    <p style="color: rgb(222, 185, 0); " data-aos="fade-up">INDIA'S LARGEST</p>
                    <h3 data-aos="fade-up">HR FESTIVAL 2025</h3>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <form id="registerForm" action="submit-2025.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@gmail.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="contact" name="contact" placeholder="+91 8123456789" required>
                    </div>
                    <div class="mb-3">
                        <label for="company" class="form-label">Company Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="company" name="company" placeholder="Company Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation" required>
                    </div>
                    <div class="mb-3">
                        <label for="options" class="form-label">How did you know <span class="text-danger">*</span></label>
                        <select class="form-select" id="options" name="options" required>
                            <option value="">Select an Option</option>
                            <option value="Social Media">Social Media</option>
                            <option value="referral">Referral</option>
                            <option value="website">Website</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Upload Your Photo <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="photo" name="photo" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="socialMediaCheck" required>
                        <label class="form-check-label" for="socialMediaCheck">
                            I confirm that I have followed the page on:
                            <a href="https://www.linkedin.com/company/vanakkam-hrd/posts/?feedView=all" target="_blank">
                                <i class="fab fa-linkedin fa-lg text-primary"></i>
                            </a>
                            <a href="https://www.instagram.com/vanakkam_hrd/" target="_blank">
                                <i class="fab fa-instagram fa-lg text-danger"></i>
                            </a>
                            <a href="https://www.facebook.com/vanakkamhrd" target="_blank">
                                <i class="fab fa-facebook fa-lg text-primary"></i>
                            </a>
                        </label>
                    </div>
                    <p class="text-secondary"><strong>Note:</strong> Follow our social media pages to unlock exclusive updates.</p>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-40 text-center" id="submitBtn">Submit & Pay Now</button>
                    </div>
                </form>
            </div>
        </div>
    </section>


</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script>
    AOS.init();

    document.addEventListener("DOMContentLoaded", function() {
        let eventSection = document.querySelector(".new_event");
        let images = [
            "assets/images/background111.jpeg",
            "assets/images/background2.jpeg"
        ];
        let currentIndex = 0;

        setInterval(() => {
            currentIndex = (currentIndex + 1) % images.length;
            eventSection.style.backgroundImage = `url('${images[currentIndex]}')`;
        }, 3000); // Change background every 3 seconds
    });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"></script>
<script src="https://fonts.googleapis.com/css2?family=Dosis:wght@400;700&display=swap"></script>

<?php include('includes/footer.php'); ?>