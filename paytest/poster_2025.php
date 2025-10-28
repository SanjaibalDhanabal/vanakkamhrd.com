<?php
// session_start();

// // Check if user data exists
// if (!isset($_SESSION['registered_user'])) {
//     die("No poster data found!");
// }

// Get user details from session
$user = $_SESSION['registered_user'];
$name = $user['name'];
$designation = $user['designation'];
$company = $user['company'];
$photo = $user['photo']; // Uploaded photo path

// Example: Display poster with user details
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Festival 2025</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

@import url('https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap');

         body {
            color: white;
            font-family: 'Arial', sans-serif;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            
            
        }
        .container{
    display: grid;
    grid-template-areas: 
    'poster-container thanknote';
    width: 100%;
    height: 100%;
    grid-template-columns: 535px 700px;  
        }
        .poster-container {
            padding: 175px 5px;
            background-color: #2c004a; /* Background color */
            background: url('assets/images/attenting\ poster.jpg');
            background-size: cover; /* Ensure the image covers the entire container */
            background-position: center; /* Center the image */
            background-blend-mode: overlay; /* Blend the background color and image */
            width: 100%;
            max-width: 800px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            margin-top: 130px;
            box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.3);
            position: relative; /* Allow positioning of children */
            margin-left: 20px;
            
        }
        .left-section, .right-section {
            flex: 1;
        }
        .left-section {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative; /* Allow positioning of website-info */
        }
        .profile-img-container {
    
            border-radius: 50%;
            overflow: hidden;
            width: 170px;
            height: 170px;
            margin-right: 78px;
            margin-bottom: 13px;
            position: relative;
            bottom: 90px;
            left: 40px;

            display: flex;
    justify-content: center;
    align-items: center;
    background-color: #fff; 
        }
        .profile-img-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        
    }

    






        .right-section {
            text-align: left;
        }
       


   
       
        .register-info {
            position: absolute;
            top: 70px; /* Adjust as needed */
            left: 54px; /* Adjust as needed */
            display: flex;
            align-items: center;
            padding: 5px;
            border-radius: 5px;
        
        }

        .register-info {
    text-align: center; /* Ensures text inside is centered */
    display: flex;
    flex-direction: column;
    align-items: center;
}
        .name {
            font-size: 26px;
            font-family: Georgia, serif;
            color: white;
            text-transform: capitalize;
            margin-top: 20px;
        }
        .designation {
            font-size: 22px;
            color: white;
            margin-bottom: 20px;
            text-transform: capitalize;
            font-family: "Trebuchet MS", Helvetica, sans-serif;
        }


    
        .thanknote{
            font-size: 20px;
            padding: 40px;
            width: 600px;
            position: relative;
            top: 200px;
            font-weight: 500;
        color: #12037f;
        font-family: Dosis, sans-serif;
        margin-bottom: 20px;
        text-align: center;
        }

        @media only screen and (max-width: 600px){
          .container{
            margin-top: 70px;
    
          }
        
          
            .thanknote{
                position: relative;
                top: 640px;
                right: 550px;
                font-size: 20px;

                
        font-weight: 500;
        color: #12037f;
        font-family: Dosis, sans-serif;
        margin-bottom: 20px;
        text-align: center;
            }
            #download-button{
                width: 230px;
                height: 60px;
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-left: 150px;
            }
            body {
            color: white;
            font-family: 'Arial', sans-serif;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            background: url(assets/images/Purple\ &\ \ white\ business\ profile\ presentation\ \(3\).png);
            
    }
}
       
    </style>
</head>
<body>
    <div class="container">
    <div class="poster-container">
        <div class="left-section">
            <div class="profile-img-container">
                <img src="<?php echo $photo; ?>" alt="Profile Image">
            </div>
            <!-- Add Website Info Section -->
            <div class="register-info">
            <div class="name text-center"><?php echo $name; ?></div>
            <div class="designation text-center"><?php echo $designation; ?><br><?php echo $company; ?></div>
            </div>
        </div>
        <div class="right-section"></div>
    </div>

    <!-- Centered download button -->
    
        <!-- This part will not be downloaded -->
        <div class="thanknote text-center text-black mt-4 pt-5">
            <p>Please download the poster and share it on your LinkedIn profile, tagging Vanakkam HRD.</p>

               <p>Let’s connect, collaborate, and celebrate the future of HR!</p> 

<p>Looking forward to meeting you all at the event on July 5th, 2025, at Chennai Trade Center. See you there! 🚀🎉</p>
            <div class="download-area" style="padding: 20px; cursor: pointer;">
                <a id="download-button" class="btn btn-primary" style="pointer-events: none;">Download Poster</a>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.download-area').addEventListener('click', function(event) {
        event.preventDefault();
        html2canvas(document.querySelector('.poster-container')).then(function(canvas) {
            var imgData = canvas.toDataURL('image/png');

            // Create a link and click it to trigger the download
            var link = document.createElement('a');
            link.href = imgData;
            link.download = 'poster.png';
            link.click();

            // Upload the image to the server
            uploadImage(imgData);
        });
    });
});

    </script>

    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>