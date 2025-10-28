<?php

    include('includes/header.php');
    $keyId = 'rzp_live_DOM3Tmx5uZ1Zpr';
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="assets/css/event_form.css">
<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
<style>
body { background: #f6f7fb; font-family: 'Poppins', sans-serif; }

/* Hero Banner Styles */
.back-image {
    width: 100%;
    min-height: 320px;
    background-image: url(assets/images/registration_bg.png);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}
.back-image .content {
    width: 100%;
    text-align: center;
    color: #fff;
    padding: 0;
    background: rgba(18,3,127,0.60);
    min-height: 320px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.back-image .content p {
    color: #ffdb4d;
    font-size: 1.2rem;
    font-family: 'Dosis', sans-serif;
    font-weight: 700;
    margin-bottom: 10px;
    letter-spacing: 1px;
}
.back-image .content h3 {
    color: #fff;
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 2.5rem;
    margin: 0;
    letter-spacing: 1px;
}

/* Centered Card Form Styles */
.wrapper.event-form {
    min-height: 60vh;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    margin-top: -100px;
    z-index: 2;
    position: relative;
}
.event-form .container {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #fff;
    border-radius: 18px;
    max-width: 650px;
    width: 100%;
    min-height: auto;
    box-shadow: 0 4px 24px rgba(18,3,127,0.10);
    padding: 48px 48px 40px 48px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}
.event-form .right-side {
    width: 100%;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: stretch;
}
.event-form .right-side form {
    width: 100%;
}
.event-form .right-side .form-label {
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    margin-bottom: 6px;
    color: #222;
}
.event-form .right-side .form-control,
.event-form .right-side .form-select {
    font-family: 'Poppins', sans-serif;
    font-size: 1rem;
    border-radius: 10px;
    background: #f7f8fa;
    border: 1px solid #e5e7eb;
    margin-bottom: 18px;
    padding: 12px 16px;
}
.event-form .right-side .form-control:focus,
.event-form .right-side .form-select:focus {
    background: #fff;
    border-color: #12037f;
    box-shadow: 0 0 0 2px #12037f22;
}
.event-form .right-side .form-text {
    font-size: 0.95em;
    color: #888;
    font-family: 'Poppins', sans-serif;
    margin-bottom: 12px;
}
.event-form .right-side .note {
    font-size: 15px;
    margin-top: 20px;
    color: #555;
}
.sold-in-btn {
    background: #12037f !important;
    color: #fff !important;
    font-weight: 600;
    font-size: 1rem;
    border-radius: 24px;
    padding: 10px 0;
    transition: background 0.2s, transform 0.2s;
    box-shadow: 0 4px 24px rgba(18,3,127,0.13);
    border: none;
    width: 40%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
}
.sold-in-btn:hover {
    background: #ffb300 !important;
    color: #fff !important;
    transform: translateY(-2px);
}
.d-flex.justify-content-center {
    display: flex !important;
    justify-content: center !important;
}
.event-form .form-title {
    text-align: center;
    color: #1a1a4b;
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 2.2rem;
    margin-bottom: 28px;
    margin-top: 0;
    letter-spacing: 1px;
}
@media (max-width: 900px) {
    .back-image, .back-image .content { min-height: 160px; }
    .back-image .content h3 { font-size: 1.3rem; }
    .event-form .container { max-width: 98vw; padding: 18px 4px 12px 4px; }
    .wrapper.event-form { margin-top: -40px; }
    .event-form .form-title { font-size: 1.1rem; }
}
@media (max-width: 600px) {
    .back-image, .back-image .content { min-height: 170px; }
    .back-image .content { padding: 0 4px; }
    .back-image .content h3 { font-size: 1.1rem; }
    .event-form .form-title { font-size: 1rem; margin-bottom: 18px; }
    .event-form .container {
        max-width: 100vw;
        border-radius: 0;
        box-shadow: none;
        padding: 8px 12px; /* <-- Add horizontal padding here */
        box-sizing: border-box; /* <-- Ensure padding is included in width */
    }
    .sold-in-btn {
        width: 55%; /* Make button almost full width */
        font-size: 1rem;
        padding: 12px 0;
        margin-top: 16px;
        justify-content: center;
    }
}

.arrow-bg {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  background: #fff;
  color: #12037f;
  border-radius: 50%;
  width: 28px;
  height: 28px;
  font-size: 1.2em;
  font-weight: bold;
  margin-left: 5px;
  box-shadow: 0 2px 8px rgba(18,3,127,0.10);
  transition: background 0.2s, color 0.2s;
}
.sold-in-btn:hover .arrow-bg {
  background: #ffb300;
  color: #fff;
}
</style>

<div id="event" class="section">

    <section id="upcoming" class="mt-1">
        <div class="row">
            <div class="col-12">
                <div class="new_eventside">
                    <div class="back-image">
                        <div class="content">
                            <p data-aos="fade-up">Edition 03</p>
                            <h3 data-aos="fade-up">Annual TN HR Summit 2025</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="wrapper event-form">
        <div class="container">
            <div class="right-side">
                <div class="form-title">Registration Form</div>
                <form id="registerForm" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="" placeholder="Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" value="" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact No <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="contact" name="contact" value="" placeholder="Contact No" required>
                    </div>
                    <div class="mb-3">
                        <label for="company" class="form-label">Company Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="company" name="company" value="" placeholder="Company Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="designation" name="designation" value="" placeholder="Designation" required>
                    </div>
                    <div class="mb-3">
                        <label for="options" class="form-label">How did you know?<span class="text-danger">*</span></label>
                        <select class="form-select" id="options" name="options" required>
                            <option value="">--Select the Option--</option>
                            <option value="Social Media">Social Media</option>
                            <option value="referral">Referral</option>
                            <option value="website">Website</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Upload Your Photo (JPG, PNG Format), For Your Social Media Poster<span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="photo" name="photo" required>
                    </div>
                    <p class="note text-secondary"><strong>Note:</strong> Follow all our social media pages to unlock exclusive updates and exciting opportunities.</p>
                    <p id="followMessage" class="text-danger" style="display: none;">
                        Please follow all our social media pages before proceeding.
                    </p>
                    <div class="d-flex justify-content-center">
                        <input type="hidden" name="donate" value="donate">
                        <button type="submit" class="sold-in-btn text-center mt-4 mb-3" id="submitBtn">
                            Submit and Pay <span class="arrow-bg">&gt;</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.getElementById("registerForm").addEventListener("submit",async function(e){
        e.preventDefault();
        var formData = new FormData(this);

        try {
            var response = await fetch('make_payment.php', {
                method: 'POST',
                body: formData
            });

            var result = await response.json();
            if(result['status'] && typeof(result["order_id"])!='undefined'){
                var options=result["data"];
                options["handler"]='function (response){\
                        alert("Payment Successful! Payment ID: " + response.razorpay_payment_id);\
                        // window.location.href = "success.php?payment_id=" + response.razorpay_payment_id;\
                    }';
                var rzp = new Razorpay(options);
                rzp.open();
            }else{
                alert(result["message"]);
            }
        } catch (error) {

        }
        
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
</script>
<?php include('includes/footer.php'); ?>