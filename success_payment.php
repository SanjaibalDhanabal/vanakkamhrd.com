<?php

    $payment_status=false;
    require('vendor/razorpay-php/Razorpay.php');
    use Razorpay\Api\Api;
    $keyId = 'rzp_live_DOM3Tmx5uZ1Zpr';
    $keySecret = 'ZjL22tBuTG7fZ5981rdgASRS';

    $api = new Api($keyId, $keySecret);

    if(isset($_REQUEST["razorpay_payment_id"],$_REQUEST["razorpay_order_id"],$_REQUEST["razorpay_signature"]) && $_REQUEST["razorpay_payment_id"]!="" && $_REQUEST["razorpay_order_id"]!="" && $_REQUEST["razorpay_signature"]!=""){

        $razorpayOrderId=$_REQUEST["razorpay_order_id"];
        $razorpayPaymentId=$_REQUEST["razorpay_payment_id"];
        $razorpaySignature=$_REQUEST["razorpay_signature"];
        try {
            $api->utility->verifyPaymentSignature(array('razorpay_order_id' => $razorpayOrderId, 'razorpay_payment_id' => $razorpayPaymentId, 'razorpay_signature' => $razorpaySignature));
            try {
                $payment = $api->payment->fetch($razorpayPaymentId);
                if(isset($payment["status"]) && $payment["status"]=="captured"){
                    $payment_status=true;
                }
            } catch (Exception $e) {
                echo "<h2>Payment Failed!</h2>";
                echo 'Error: ' . $e->getMessage();
            }
        }
        catch (\Exception $e) {
            echo "<h2>Payment Failed!</h2>";
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    }else{
        echo "Payment Failed";
    }
?>

<?php
    if($payment_status){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Success</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
        }
        .success-icon {
            font-size: 60px;
            color: #28a745;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="success-icon">
                    ✅
                </div>
                <h2 class="text-success">Payment Successful!</h2>
                <p class="mt-3">Thank you for your payment.</p>
                <p><br>You will be recieve the details in mail within 5 minuts. If not please contact us will ping you. </p>
                <!-- Payment Details -->
                <div class="mt-4">
                    <div class="mb-2"><strong>Amount:</strong> ₹<span id="amount"><?php echo ($payment["amount"]/100); ?></span></div>
                    <div class="mb-2"><strong>Status:</strong> <span id="status" class="text-success">Success</span></div>
                </div>

                <!-- Back to Home Button -->
                <div class="mt-4">
                    <a href="https://vanakkamhrd.com" class="btn btn-success">Go to Homepage</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
}else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Failed</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
        }
        .failure-icon {
            font-size: 60px;
            color: #dc3545;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="failure-icon">
                    ❌
                </div>
                <h2 class="text-danger">Payment Failed!</h2>
                <p class="mt-3">Unfortunately, your payment could not be processed. Please contact Admin if payment debited from your account</p>

                <!-- Payment Details -->
                <div class="mt-4">
                    <div class="mb-2"><strong>Status:</strong> <span id="status" class="text-danger">Failed</span></div>
                </div>

                <!-- Retry and Home Buttons -->
                <div class="mt-4">
                    <a href="https://vanakkamhrd.com/events.php" class="btn btn-danger me-2">Retry Payment</a>
                    <a href="https://vanakkamhrd.com" class="btn btn-secondary">Go to Homepage</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
}?>