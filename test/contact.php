<?php include('includes/header.php'); ?>
<div id="contact-us" class="contact-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3" style="height: 130px;">
          <div class="section-heading wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
            <h3 class="mb-4">Contact Us</h3>
            <h6><b>Get In Touch With Us</b></h6>
          </div>
        </div>
        <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
          <form id="contact" action="admin/contact_us_process.php" method="post">
            <div class="row flex-lg-row-reverse">
  
          
              <div class="col-lg-7">
                <div class="fill-form">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="info-post">
                        <div class="icon">
                          <img src="assets/images/phone-icon.png" alt="">
                          <a href="#">82482 38229</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="info-post">
                        <div class="icon">
                          <img src="assets/images/email-icon.png" alt="">
                          <a href="#">info@vanakkamhrd.com</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="info-post">
                        <div class="icon">
                          <img src="assets/images/location-icon.png" alt="">
                          <a href="#">NO 2,FIRST FLOOR, AVVAIYAR STREET, EKKADUTHANGAL, GUINDY, CHENNAI - 600 032</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <fieldset>
                        <input type="name" name="name" id="name" placeholder="Name" autocomplete="on" required>
                      </fieldset>
                      <fieldset>
                        <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email" required="">
                      </fieldset>
                      <fieldset>
                        <input type="integer" name="number" id="integer" placeholder="Phone No" required>
                      </fieldset>
                    </div>
                    <div class="col-lg-12">
                      <fieldset>
                        <textarea name="message" type="text" class="form-control" id="message" placeholder="Message" required=""></textarea>  
                      </fieldset>
                    </div>
                    <div class="col-lg-12">
                      <fieldset>
                        <button type="submit" id="form-submit" class="main-button ">Send Message Now</button>
                      </fieldset>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-lg-5">
                <div id="map">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7774.541836923163!2d80.205241!3d13.018412000000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a52673c134fc9ff%3A0xaa9ae093531c5457!2sVanakkam%20Human%20Development%20Corporation!5e0!3m2!1sen!2sin!4v1682926176352!5m2!1sen!2sin" width="100%" height="900" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php include('includes/footer.php'); ?>
