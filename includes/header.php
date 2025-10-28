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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    
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
        .navbar-brand img {
            height: 80px;
            width: auto;
            margin-left: 100px;
        }

        .navbar-nav .nav-item {
            margin: 0px 10px;
        }
        .navbar-toggler {
            font-size: 15px;
        }
        .navbar-toggler-icon {
            font-weight: 1000;
        }
        .navbar-nav .nav-item .nav-link, .dropdown-item {
            font-weight: 600;
            color: black;
        }
        .navbar-nav .nav-item .nav-link:hover {
            color: #01257b;
        }
        .dropdown-menu {
            border: transparent;
            background-color: white;
        }
        .dropdown-menu .dropdown-item {
            text-align: center;
        }
        @media (min-width: 768px) {
            .nav-item.dropdown:hover .dropdown-menu {
                display: block;
            }
            #navbarNav {
                margin-right: 150px;
            }
        }
        @media (max-width: 768px) {
            .navbar-brand img {
                height: 60px;
                margin-left: 40px;
                
            }
            .navbar-nav .nav-item {
                margin: 0px;
                text-align: end;
            }
            .dropdown-menu {
                width: 100%;
            }
            .dropdown-menu .dropdown-item {
                text-align: end;
            }
            .dropdown-menu .dropdown-item:last-child {
                border-bottom: 1px solid #dee2e6;
            }
        }

         /* Pre loader style Start */

  #preloader {
  position: fixed;
  left: 0; top: 0; width: 100vw; height: 100vh;
  background: linear-gradient(135deg, rgb(80, 77, 119) 0%, #e6e6fa 100%);
  z-index: 99999;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: opacity 0.4s;
}
.preloader-circle {
  position: relative;
  width: 100px;
  height: 100px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.preloader-svg {
  width: 100px;
  height: 100px;
  position: absolute;
  left: 0; top: 0;
  z-index: 1;
  pointer-events: none;
  display: block;
}
.preloader-svg text {
  font-size: 11px;
  font-family: 'Poppins', Arial, sans-serif;
  text-transform: uppercase;
  fill: #fff;
}
.preloader-svg textPath {
  animation: preloader-text-rotate 2.2s linear infinite;
  transform-origin: 50% 50%;
}
@keyframes preloader-text-rotate {
  100% { transform: rotate(360deg);}
}
#preloader-icon {
  width: 44px;
  height: 44px;
  position: absolute;
  left: 50%; top: 50%;
  transform: translate(-50%, -50%);
  animation: preloader-spin 1.2s linear infinite;
  z-index: 2;
}
@keyframes preloader-spin {
  100% { transform: translate(-50%, -50%) rotate(360deg);}
}
#preloader.hide {
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.4s;
}

    /* Pre Loader style End */

    </style>
</head>
<body>
    
<!-- Place this inside your <body> tag, before your main content -->
<!--<div id="preloader">-->
<!--  <div class="preloader-circle">-->
<!--    <svg class="preloader-svg" width="100" height="100">-->
<!--      <defs>-->
<!--        <path id="circlePath" d="M50,50 m-36,0 a36,36 0 1,1 72,0 a36,36 0 1,1 -72,0"/>-->
<!--      </defs>-->
<!--      <text id="preloader-text" font-size="11" font-weight="bold" fill="#fff" letter-spacing="2">-->
<!--        <textPath xlink:href="#circlePath" startOffset="0%"></textPath>-->
<!--      </text>-->
<!--    </svg>-->
<!--    <img src="assets/images/favicon-removebg-preview.png" alt="Loading..." id="preloader-icon">-->
<!--  </div>-->
<!--</div>-->


    <nav class="navbar navbar-expand-lg navbar-light shadow" style="background-color: white;">
        <a class="navbar-brand" href="index.php">
            <img src="assets/images/VHRD Logo.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="aboutUsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        About Us
                    </a>
                    <div class="dropdown-menu" aria-labelledby="aboutUsDropdown">
                        <a class="dropdown-item" href="wwd.php">What We Do</a>
                        <!--<a class="dropdown-item" href="ourteam.php">Our Team</a>-->
                        <!--<a class="dropdown-item" href="advisory.php">Advisory Team</a>
                        <a class="dropdown-item" href="core.php">Core Team</a>-->
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
        </div>
    </nav>

    <!-- Pre Loader Script Start -->

<script>
(function() {
  var preloader = document.getElementById('preloader');
  var text = "VANAKKAM HRD • VANAKKAM HRD •";
  var textPath = document.querySelector('#preloader-text textPath');
  var typingInterval = 70; // ms per letter
  var idx = 0;
  var typingTimeout = null;
  var preloaderHidden = false;

  // Typing effect for SVG text
  function typeText() {
    if (preloaderHidden) return; // Stop if preloader is hidden
    let html = '';
    for (let i = 0; i < idx; i++) {
      html += `<tspan>${text[i]}</tspan>`;
    }
    textPath.innerHTML = html;
    if (idx < text.length) {
      idx++;
      typingTimeout = setTimeout(typeText, typingInterval);
    } else {
      idx = 0; // Reset to start typing again
      typingTimeout = setTimeout(typeText, typingInterval);
    }
  }
  typeText();

  // Hide preloader and stop typing animation
  function hidePreloader() {
    if (preloaderHidden) return;
    preloaderHidden = true;
    clearTimeout(typingTimeout);
    preloader.classList.add('hide');
    setTimeout(function() {
      preloader.style.display = 'none';
    }, 500);
  }

  // Preloader show/hide logic
  if (!sessionStorage.getItem('preloaderShown')) {
    sessionStorage.setItem('preloaderShown', 'yes');
    preloader.style.display = 'flex';
    window.addEventListener('load', hidePreloader);
  } else {
    preloader.style.display = 'none';
    var slowLoadTimeout = setTimeout(function() {
      preloader.style.display = 'flex';
    }, 400);

    window.addEventListener('load', function() {
      clearTimeout(slowLoadTimeout);
      hidePreloader();
    });
  }

  // Failsafe: always hide preloader after 10 seconds
  setTimeout(hidePreloader, 10000);
})();
</script>
<!-- Pre Loader Script End -->

</body>
</html>
