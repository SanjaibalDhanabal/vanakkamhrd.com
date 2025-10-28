<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Community</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #community {
            max-width: 700px;
            margin: auto;
            background: linear-gradient(135deg, #22b8fe, #002e98);
            height: auto;
        }

        #community .form-container {
            max-width: 600px;
            margin: auto;
            height: auto;
        }

        #community .form-container h2 {
            color: #002e98;
        }

        #community .form-group label {
            color: white;
        }
        #community form button{
            width: 200px;
        }
    </style>
</head>
<body>
    <div id="community" class="container mt-5 mb-5">
        <div class="form-container">
            <h2 class="text-center mt-4 pt-4">Join Community</h2>
            <form action="submit_form_community.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact Number" required>
                </div>
                <div class="form-group">
                    <label for="designation">Designation</label>
                    <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation" required>
                </div>
                <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" class="form-control" id="company" name="company" placeholder="Company" required>
                </div>
                <div class="form-group">
                    <label for="linkedin">LinkedIn URL</label>
                    <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="LinkedIn URL" required>
                </div>
                <div class="form-group">
                    <label for="image">Upload Your Image</label>
                    <input type="file" class="form-control-file" id="image" name="image" required>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Location" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-3 mb-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
