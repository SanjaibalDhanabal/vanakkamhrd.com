<?php

    include('includes/header.php');
    $keyId = 'rzp_live_DOM3Tmx5uZ1Zpr';
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
<style>
body { background: #f6f7fb; font-family: 'Poppins', sans-serif; }

/* Hero Banner Styles */
.summit-hero-banner {
    width: 100%;
    min-height: 380px; /* Increased height */
    background: url('assets/images/registration_bg.png') center center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}
.summit-hero-content {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #fff;
    padding: 0;
    background: rgba(18,3,127,0.60); /* blue overlay for text readability */
    min-height: 380px; /* Match parent for perfect centering */
}
.summit-hero-edition {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 18px;
    margin-top: -50px;
    color: #fff;
    letter-spacing: 1px;
    text-align: center;
}
.summit-hero-title {
    font-size: 3rem;
    font-weight: 700;
    color: #fff;
    font-family: 'Poppins', sans-serif;
    margin: 0;
    letter-spacing: 1px;
    text-align: center;
}

/* Form Card Centering */
.summit-form-wrapper {
    min-height: 60vh;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    margin-top: -120px; /* Pull up under hero */
    z-index: 2;
    position: relative;
}
.summit-form-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(18,3,127,0.10);
    max-width: 650px; /* Increased width */
    width: 100%;
    padding: 48px 48px 40px 48px; /* More padding for wider card */
    margin: 0 auto;
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    align-items: stretch;
}
.summit-form-title {
    text-align: center;
    color: #1a1a4b;
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 2.2rem;
    margin-bottom: 28px;
    margin-top: 0;
    letter-spacing: 1px;
}
.summit-form-card label {
    font-weight: 600;
    font-family: 'Poppins', sans-serif;
    margin-bottom: 6px;
    color: #222;
}
.summit-form-card .form-control,
.summit-form-card .form-select {
    font-family: 'Poppins', sans-serif;
    font-size: 1rem;
    border-radius: 10px;
    background: #f7f8fa;
    border: 1px solid #e5e7eb;
    margin-bottom: 18px;
    padding: 12px 16px;
}
.summit-form-card .form-control:focus,
.summit-form-card .form-select:focus {
    background: #fff;
    border-color: #12037f;
    box-shadow: 0 0 0 2px #12037f22;
}
.summit-form-card .form-text {
    font-size: 0.95em;
    color: #888;
    font-family: 'Poppins', sans-serif;
    margin-bottom: 12px;
}
.summit-form-card .btn-submit {
    background: #12037f;
    color: #fff;
    font-weight: 600;
    font-size: 1rem;
    border-radius: 24px;
    padding: 10px 0;
    transition: background 0.2s, transform 0.2s;
    box-shadow: 0 4px 24px rgba(18,3,127,0.13);
    border: none;
    width: 35%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
}
.summit-form-card .btn-submit:hover {
    background: #ffb300;
    color: #fff;
    transform: translateY(-2px);
}
.submit-icon-bg {
    background: #fff;
    color: #12037f;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 8px;
    font-size: 1.2rem;
    box-shadow: 0 2px 8px rgba(18,3,127,0.10);
    transition: background 0.2s, color 0.2s;
}
.btn-submit:hover .submit-icon-bg {
    background: #fff;
    color: #222;
}
.summit-form-card .note {
    font-size: 15px;
    margin-top: 20px;
    color: #555;
}
@media (max-width: 900px) {
    .summit-hero-title { font-size: 1.3rem; }
    .summit-form-title { font-size: 1.1rem; }
    .summit-form-wrapper { margin-top: -40px; }
    .summit-form-card { max-width: 98vw; padding: 18px 4px 12px 4px; }
    .summit-hero-banner, .summit-hero-content { min-height: 160px; }
    .summit-hero-edition { font-size: 1rem; margin-bottom: 10px; }
}
@media (max-width: 600px) {
    .summit-hero-banner { min-height: 120px; }
    .summit-hero-content { min-height: 120px; padding: 0 4px; }
    .summit-hero-title { font-size: 1.1rem; margin: 0; }
    .summit-hero-edition { font-size: 0.95rem; margin-bottom: 6px; }
    .summit-form-title { font-size: 1rem; margin-bottom: 18px; }
    .summit-form-card {
        max-width: 100vw;
        border-radius: 0;
        box-shadow: none;
        padding: 8px 2px;
    }
    .summit-form-card .btn-submit {
        width: 45%;
        font-size: 1rem;
        padding: 8px 0;
        margin-top: 16px;
        justify-content: center;
    }
    .submit-icon-bg {
        width: 28px;
        height: 28px;
        font-size: 1rem;
        margin-left: 6px;
    }
}
</style>

<!-- Hero Banner Section -->
<div class="summit-hero-banner">
  <div class="summit-hero-content">
    <div class="summit-hero-edition">Edition 03</div>
    <h1 class="summit-hero-title">Annual TN HR Summit 2025</h1>
  </div>
</div>

<div class="summit-form-wrapper">
    <div class="summit-form-card">
        <div class="summit-form-title">Registration Form</div>
        <form id="registerForm" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" value="" placeholder="Full name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email ID <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" value="" placeholder="Email ID" required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact Number <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="contact" name="contact" value="" placeholder="Contact Number" required>
            </div>
            <div class="mb-3">
                <label for="company" class="form-label">Company <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="company" name="company" value="" placeholder="Company" required>
            </div>
            <div class="mb-3">
                <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="designation" name="designation" value="" placeholder="Designation" required>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Upload Your Image <span class="text-danger">*</span> <span style="font-size:0.9em;color:#888;">(JPG and PDF)</span></label>
                <input type="file" class="form-control" id="photo" name="photo" accept=".jpg,.jpeg,.pdf" required>
                <small class="form-text">Regarding Social Media Poster</small>
            </div>
            <div class="mb-3">
                <label for="options" class="form-label">How did you know <span class="text-danger">*</span></label>
                <select class="form-select" id="options" name="options" required>
                    <option value="">-Select-</option>
                    <option value="Social Media">Social Media</option>
                    <option value="Referral">Referral</option>
                    <option value="Website">Website</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <p class="note"><strong>Note:</strong> Follow all our social media pages to unlock exclusive updates and exciting opportunities.</p>
            <p id="followMessage" class="text-danger" style="display: none;">
                Please follow all our social media pages before proceeding.
            </p>
            <button type="submit" class="btn btn-submit" id="submitBtn">
                Submit & Pay
                <span class="submit-icon-bg">
                    <i class="fa-solid fa-angle-right"></i>
                </span>
            </button>
        </form>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.getElementById("registerForm").addEventListener("submit", async function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    try {
        var response = await fetch('make_payment.php', {
            method: 'POST',
            body: formData
        });

        var result = await response.json();

        if (result['status'] && typeof(result["order_id"]) != 'undefined') {
            var options = result["data"];
            options.handler = function (response) {
                alert("Payment Successful! Payment ID: " + response.razorpay_payment_id);
                // You can redirect to success page here if needed:
                // window.location.href = "success.php?payment_id=" + response.razorpay_payment_id;
            };

            var rzp = new Razorpay(options);
            rzp.open();
        } else {
            alert(result["message"]);
        }
    } catch (error) {
        console.error(error);
        alert("Something went wrong. Please try again later.");
    }
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
</script>
<?php include('includes/footer.php'); ?>