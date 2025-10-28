<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partner with Us</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #collaborate {
            max-width: 700px;
            margin: auto;
            background: linear-gradient(135deg, #22b8fe, #002e98);
            height: auto;
        }

        .form-group label, .form-check label {
            color: white;
        }

        #collaborate .form-container {
            max-width: 600px;
            margin: auto;
            height: auto;
        }

        #collaborate .form-container h2 {
            color: white;
        }

        #collaborate form button{
            width: 200px;
        }

    </style>
</head>
<body>
    <div id="collaborate" class="container mt-5 mb-5">
        <div class="form-container">
            <h2 class="text-center mt-4 pt-4">Partner with Us</h2>
            <form action="submit_form_collaborate.php" method="post">
                <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" class="form-control" id="company" name="company" placeholder="company name" required>
                </div>
                <div class="form-group">
                    <label for="overview">Company Overview</label>
                    <textarea class="form-control" id="overview" name="overview" placeholder="company overview" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" class="form-control" id="website" name="website" placeholder="website link" required>
                </div>
                <div class="form-group">
                    <label for="name">Contact Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="contact name" required>
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input type="text" class="form-control" id="contact" name="contact" placeholder="contact number" required>
                </div>
                <div class="form-group">
                    <label for="email">Business Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="business email" required>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="privacy" name="privacy" required>
                    <label class="form-check-label" for="privacy">By checking this box, you agree that Vanakkam HRD may contact you to provide you with more information about their products, events and offers, you can Unsubscribe at any time. <a href="terms.php">Privacy Policy</a></label>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary mt-3 mb-3 " >Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
