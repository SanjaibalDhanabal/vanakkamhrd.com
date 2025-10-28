<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            border-bottom: none;
            border-radius: 10px 10px 0 0;
        }
        .card-body {
            padding: 2rem;
        }
        .form-control {
            border-radius: 5px;
            border-color: #ced4da;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075), 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }
        .btn-primary {
            border-radius: 5px;
            padding: 0.75rem 1.25rem;
            font-size: 1.125rem;
        }
        .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Event Registration Form</h4>
                    </div>
                    <div class="card-body">
                        <form action="submit_registration.php" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="tel" class="form-control" id="contact" name="contact" placeholder="Contact" required>
                            </div>
                            <div class="form-group">
                                  <label for="designation">Designation</label>
                                 <select class="form-control" id="designation" name="designation" required>
                                         <option value="">--Select your designation--</option>
                                          <option value="Campus Recruiter">Campus Recruiter</option>
                                         <option value="Talent Acquisition">Talent Acquisition</option>
                                         <option value="Head HR">Head HR</option>
                                         <option value="Vice President">Vice President</option>
                                          <option value="HR Executive">HR Executive</option> <!-- Added option -->
    </select>
</div>

                            <div class="form-group">
                                <label for="linkedin">LinkedIn URL</label>
                                <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="LinkedIn URL" required>
                            </div>
                            <div class="form-group">
                                <label for="company">Company</label>
                                <input type="text" class="form-control" id="company" name="company" placeholder="Company" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location" placeholder="Location" required>
                            </div>
                           
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
