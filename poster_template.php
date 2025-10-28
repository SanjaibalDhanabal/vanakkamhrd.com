<?php
// poster_template.php

// Get parameters
$name = isset($_GET['name']) ? $_GET['name'] : '';
$designation = isset($_GET['designation']) ? $_GET['designation'] : '';
$company = isset($_GET['company']) ? $_GET['company'] : '';

// Optional: break company into multiple lines if too long
function break_long_text($text, $max = 28) {
    $words = explode(' ', $text);
    $lines = [];
    $current = '';
    foreach ($words as $word) {
        if (strlen($current . ' ' . $word) > $max) {
            $lines[] = trim($current);
            $current = $word;
        } else {
            $current .= ' ' . $word;
        }
    }
    $lines[] = trim($current);
    return implode('<br>', $lines);
}
$company = break_long_text($company, 28);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Poster - Annual TN HR Summit 2025</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 2000px;
            height: 2000px;
            background: url('assets/images/poster_bg.png') no-repeat center center;
            background-size: cover;
            font-family: 'Poppins', Arial, sans-serif;
            color: #fff;
            position: relative;
        }
        .logo {
            position: absolute;
            top: 80px;
            left: 120px;
            width: 400px;
        }
        .event-title {
            position: absolute;
            top: 220px;
            left: 120px;
            font-size: 70px;
            color: #ff9800;
            font-weight: bold;
        }
        .attending {
            position: absolute;
            top: 320px;
            right: 220px;
            font-size: 90px;
            color: #4a90e2;
            font-weight: bold;
            text-align: right;
        }
        .attending span {
            color: #ff9800;
            font-size: 70px;
            font-weight: bold;
        }
        .circle-photo {
            position: absolute;
            top: 600px;
            left: 300px;
            width: 700px;
            height: 700px;
            border-radius: 50%;
            border: 12px solid #ff9800;
            background: rgba(255,255,255,0.05);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .details {
            position: absolute;
            top: 1400px;
            left: 300px;
            width: 700px;
            text-align: center;
        }
        .details .name {
            font-size: 70px;
            font-weight: bold;
            color: #fff;
        }
        .details .designation {
            font-size: 48px;
            color: #ff9800;
            margin-top: 18px;
        }
        .details .company {
            font-size: 38px;
            color: #fff;
            margin-top: 10px;
            word-break: break-word;
        }
        .footer {
            position: absolute;
            bottom: 120px;
            left: 120px;
            font-size: 38px;
            color: #fff;
        }
    </style>
</head>
<body>
    <!--<img src="assets/images/logo.png" class="logo" alt="Vanakkam HRD">
    <div class="event-title">Annual TN HR Summit 2025</div>
    <div class="attending">I am<br><span>Attending</span></div> -->
    <div class="circle-photo">
        <!-- Optionally, you can overlay the user's photo here if you have it -->
    </div>
    <div class="details">
        <div class="name"><?= htmlspecialchars($name) ?></div>
        <div class="designation"><?= htmlspecialchars($designation) ?></div>
        <div class="company"><?= $company ?></div>
    </div>
   <!-- <div class="footer">
        20<sup>th</sup> Dec 2025<br>
        Hilton, Chennai
    </div> -->
</body>
</html>