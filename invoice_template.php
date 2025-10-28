<?php

$name = isset($_GET['name']) ? $_GET['name'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$company = isset($_GET['company']) ? $_GET['company'] : '';
$invoice_number = isset($_GET['invoice_number']) ? $_GET['invoice_number'] : '';
$ticket_id = isset($_GET['ticket_id']) ? $_GET['ticket_id'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice - Annual TN HR Summit 2025</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; color: #222; }
        .invoice-box {
            width: 700px;
            margin: 30px auto;
            border: 1px solid #888;
            background: #fff;
            position: relative;
            padding-bottom: 20px;
        }
        .header { text-align: left; padding: 20px 0 0 30px; }
        .header img { width: 190px; }
        .company-info {
            text-align: center;
            font-size: 15px;
            padding-bottom: 5px;
            line-height: 1.5;
        }
        .invoice-title {
            text-align: center;
            font-size: 20px;
            color: #003366;
            font-weight: bold;
            margin: 10px 0 10px 0;
            text-decoration: underline;
        }
        .details-table {
            width: 95%;
            margin: 0 auto 10px auto;
            border: 1px solid #888;
            border-collapse: collapse;
            font-size: 15px;
        }
        .details-table td {
            border: none;
            padding: 6px 8px;
        }
        .details-table .label {
            font-weight: bold;
            width: 18%;
        }
        .details-table .value {
            width: 32%;
        }
        .details-table .label2 {
            font-weight: bold;
            width: 19%;
            text-align: right;
        }
        .details-table .value2 {
            width: 32%;
        }
        .particulars-table {
            width: 95%;
            margin: 0 auto 0 auto;
            border: 1px solid #888;
            border-collapse: collapse;
            font-size: 15px;
            background: #fff;
        }
        .particulars-table th, .particulars-table td {
            border: 1px solid #888;
            padding: 10px;
            text-align: left;
        }
        .particulars-table th {
            background: #f8f8f8;
            text-align: center;
        }
        .particulars-table td:last-child, .particulars-table th:last-child {
            text-align: right;
        }
        .total-row td {
            font-weight: bold;
            background: #fff;
        }
        .footer-table {
            width: 95%;
            margin: 20px auto 0 auto;
            border: 1px solid #888;
            border-collapse: collapse;
            font-size: 15px;
        }
        .footer-table td {
            border: none;
            padding: 10px;
            vertical-align: top;
        }
        .footer-table .left {
            width: 60%;
        }
        .footer-table .right {
            width: 40%;
            text-align: center;
        }
        .sign-img {
            height: 40px;
        }
        .thankyou {
            text-align: right;
            color: #003366;
            font-weight: bold;
            font-size: 18px;
            margin: 10px 30px 0 0;
        }
        .watermark {
            position: absolute;
            top: 35%;
            left: 10%;
            font-size: 60px;
            color: #cccccc;
            opacity: 0.18;
            transform: rotate(-30deg);
            z-index: 0;
            pointer-events: none;
            width: 80%;
            text-align: center;
            user-select: none;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <img src="assets/images/logo.png" alt="Vanakkam HRD">
        </div>
        <div class="company-info">
            <b>VANAKKAM HRD</b><br>
            No 2, First Floor, Avvaiyar Street, Ekkatuthangal, Chennai - 600 032.<br>
            Phone: 82482 38229, Email: support@vanakkamhrd.com
        </div>
        <div class="invoice-title">INVOICE</div>
        <table class="details-table">
            <tr>
                <td class="label">Bill TO</td>
                <td class="value"></td>
                <td class="label2">Invoice Number:</td>
                <td class="value2"><?= htmlspecialchars($invoice_number) ?></td>
            </tr>
            <tr>
                <td class="label">Name:</td>
                <td class="value"><?= htmlspecialchars($name) ?></td>
                <td class="label2">Invoice Date:</td>
                <td class="value2"><?= date('d-m-Y') ?></td>
            </tr>
            <tr>
                <td class="label">Email:</td>
                <td class="value"><?= htmlspecialchars($email) ?></td>
                <td class="label2">Ticket ID:</td>
                <td class="value2"><?= htmlspecialchars($ticket_id) ?></td>
            </tr>
            <tr>
                <td class="label">Company:</td>
                <td class="value"><?= htmlspecialchars($company) ?></td>
                <td class="label2"></td>
                <td class="value2"></td>
            </tr>
            <tr>
                <td class="label">State Name:</td>
                <td class="value">Tamil Nadu</td>
                <td class="label2"></td>
                <td class="value2"></td>
            </tr>
        </table>
        <table class="particulars-table" style="margin-top:20px;">
            <tr>
                <th style="width:10%;">S.NO</th>
                <th style="width:60%;">Particulars</th>
                <th style="width:30%;">Amount (INR)</th>
            </tr>
            <tr>
                <td style="text-align:center;">1</td>
                <td>
                    <b>TN HR Summit 2025 - Delegate Fee</b><br>
                    (Hilton Hotel, Chennai)<br>
                    <br>
                    (Event Date – 20<sup>th</sup> December, 2025)
                </td>
                <td>Rs. 1999/-</td>
            </tr>
            <tr class="total-row">
                <td colspan="2" style="text-align:right;">Total (INR)</td>
                <td>Rs. 1999 /-</td>
            </tr>
        </table>
        <table class="footer-table" style="margin-top:20px;">
            <tr>
                <td class="left">
                    <b>Payment Method</b><br>
                    Account Name: Vanakkam HRD<br>
                    Account No: 18901080009996<br>
                    IFSC Code: ICIC0001898<br>
                    Bank: ICICI Bank<br>
                    PAN No: AAETV1952G
                </td>
                <td class="right">
                    <b>Authorized Signatory</b><br>
                    <img src="assets/images/Rajeshwaran_Sign.png" alt="Signature" class="sign-img"><br>
                    <b>Rajeshwaran P</b><br>
                    Founder
                </td>
            </tr>
        </table>
        <div class="thankyou">Thank You!</div>
        <div class="watermark">Vanakkam HRD</div>
    </div>
</body>
</html>