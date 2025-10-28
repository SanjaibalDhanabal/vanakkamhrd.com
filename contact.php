<?php include('includes/header.php'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />

<style>
  /* Your existing styles */
  .contact-us i {
    color: #12037f;
    font-size: 20px;
  }

  .heading h5 {
    font-weight: 600;
  }

  .heading p {
    margin-top: 5px;
  }

  .form-section {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .form-section h5 {
    font-weight: bold;
    color: #12037f;
  }

  .form-label {
    font-weight: 500;
  }

  .form-control {
    border-radius: 4px;
  }

  .btn-primary {
    background-color: #12037f;
    border: none;
    border-radius: 4px;
  }

  .btn-primary:hover {
    background-color: #0d026d;
  }


  .map-container {
    display: flex;
    justify-content: center; /* Center the map horizontally */
    margin: 40px 0px;
  }

  .map-container iframe {
    border: 0;
    border-radius: 8px;
    width: 100%; /* Adjust width to fit the container */
    max-width: 1400px; /* Limit max-width to prevent it from getting too wide */
    height: 500px; /* Height of the map */
    max-height: 100%; /* Ensure it doesn't overflow its container */
  
  }
  @media (max-width: 768px){
  .map-container iframe{
    width: 90%;
    height: 300px;
  } 
  }
  #con1{
  padding: 40px;
  background-color: #f5f4f4;
  border-radius: 30px;
}
</style>

<div id="contact-us" class="contact-us section" data-aos="fade-up" data-aos-duration="1000">
  <h3 class="text-center mb-3 pb-3 pt-3" style="color: #12037f;">Contact Us</h3>
  <div class="container" id="con1" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1200">
    <div class="row">
      <div class="col-md-4" data-aos="fade-right" data-aos-delay="200" data-aos-duration="1300">
        <h5 class="mt-3 text-start">GET IN TOUCH</h5>
        <h3 class="text-start mt-4"><b>Reach Us</b></h3>
        <hr>
        <div class="d-flex align-items-start mb-4 mt-4 pt-3">
          <i class="fas fa-map-marker-alt me-3 mt-1"></i>
          <div class="heading">
            <h5>Address</h5>
            <p>No 2, First Floor, Avvaiyar Street, Ekkattuthangal, Chennai - 32.</p>
          </div>
        </div>
        <div class="d-flex align-items-start mb-4 pt-1">
          <i class="fas fa-phone me-3 mt-1"></i>
          <div class="heading">
            <h5>Call Us</h5>
            <p>82482 38229</p>
          </div>
        </div>
        <div class="d-flex align-items-start mb-4 pt-1">
          <i class="fas fa-envelope me-3 mt-1"></i>
          <div class="heading">
            <h5>Email Us</h5>
            <p>info@vanakkamhrd.com</p>
          </div>
        </div>
        <div class="d-flex align-items-start mb-4 pt-1">
          <i class="fas fa-briefcase me-3 mt-1"></i>
          <div class="heading">
            <h5>Working Hours</h5>
            <p>Mon - Fri: 9.30 AM to 6:00 PM</p>
          </div>
        </div>
      </div>

      <div class="col-md-8" data-aos="fade-left" data-aos-delay="300" data-aos-duration="1400">
        <div class="form-section">
          <form action="#" method="post">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Your name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
              <label for="contact" class="form-label">Contact</label>
              <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact" required>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" name="message" rows="4" placeholder="Message" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <div class="container">
    <div class="map-container" data-aos="fade-up" data-aos-delay="500 data-aos-duration="1000">
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7774.541836923163!2d80.205241!3d13.018412000000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a52673c134fc9ff%3A0xaa9ae093531c5457!2sVanakkam%20Human%20Development%20Corporation!5e0!3m2!1sen!2sin!4v1682926176352!5m2!1sen!2sin" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script>
  AOS.init();
</script>

<?php include('includes/footer.php'); ?>
