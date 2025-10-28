<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="assets/images/favicon-removebg-preview.png" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <title>Vanakkam HRD</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">

    <style>
        #nav2 .join-btn {
            background-color: #01257b;
            color: white;
        }

        @media (max-width: 767.98px) {
            .navbar-nav {
                flex-direction: column;
            }

            #jbtn {
                margin-top: 10px;
            }
        }

        .navbar-nav .nav-item {
            flex-shrink: 0;
        }

        .dropdown-menu {
            border: 1px solid black;
        }

        #navbarNav.show {
    display: block;
}

        

        /* Initially hide the menu content on smaller screens */
@media (max-width: 767.98px) {
    #navbarNav {
        display: none;
    }
    #navbarNav.show {
        display: block;
    }
}

/* Optional: Add a transition for smooth toggling */




    </style>
</head>

<body>

    <!-- ***** Header Area Start ***** -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="index.php">
            <img src="assets/images/logo (2).png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto" id="nav1">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        About Us
                    </a>
                    <div class="dropdown-menu" aria-labelledby="aboutDropdown">
                        <a class="dropdown-item" href="wwd.php">What We Do</a>
                        <a class="dropdown-item" href="ourteam.php">Our Team</a>
                        <a class="dropdown-item" href="advisory.php">Advisory Team</a>
                        <a class="dropdown-item" href="core.php">Core Team</a>
                        <a class="dropdown-item" href="partners.php">Our Partners</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="initiative.php">Our Initiative</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="events.php">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gallery.php">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                </li>
            </ul>
            <!--<ul class="navbar-nav ml-auto" id="jbtn">
                <li class="nav-item" id="nav2">
                    <a class="nav-link btn join-btn" href="join.php"><i class="fa-solid fa-users-rays"></i> Join the Community</a>
                </li>
            </ul>
-->
        </div>
    </nav>

    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    

</body>

</html>
