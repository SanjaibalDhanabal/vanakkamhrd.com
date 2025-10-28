<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include('includes/db_connect.php'); // Correct path to your db_connect.php file

// Function to get image files from the database for a given category
function getImagesFromDb($conn, $category) {
    $sql = "SELECT * FROM gallery WHERE category = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $images = [];
    while ($row = $result->fetch_assoc()) {
        $images[] = $row['image'];
    }
    return $images;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link href="assets/images/favicon-removebg-preview.png" rel="icon">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            text-decoration: none;
            color: #000;
        }
        .gallery-section {
            display: none;
        }
        .gallery-section.active {
            display: block;
        }
        .gallery-section h2 {
            margin-bottom: 10px;
        }
        .gallery-section img {
            width: 200px;
            height: 200px;
            margin: 5px;
            object-fit: cover;
        }
    </style>
    <script>
        function showSection(section) {
            const sections = document.querySelectorAll('.gallery-section');
            sections.forEach(s => s.classList.remove('active'));
            document.getElementById(section).classList.add('active');
        }

        document.addEventListener('DOMContentLoaded', () => {
            showSection('all'); // Show the 'All' section by default
        });
    </script>
</head>
<body>
<h1>Gallery</h1>
<nav>
    <ul>
        <li><a href="#" onclick="showSection('all')">All</a></li>
        <li><a href="#" onclick="showSection('hr_festival_2025')">HR Confluence 2025</a></li>
        <li><a href="#" onclick="showSection('hr_festival_2025')">HR Festival 2025</a></li>
        <li><a href="#" onclick="showSection('hr_conference_2024')">HR Conference 2025</a></li>
         <li><a href="#" onclick="showSection('second_annual_awards_2024')">Second Annual Conference & Awards 2024</a></li>
         <!-- <li><a href="#" onclick="showSection('hr_meet_2024')">HR Meet 2024</a></li> -->
        <!-- <li><a href="#" onclick="showSection('campus_recruiters_2024')">Campus Recruiters Confluence 2024</a></li> -->
        <!-- <li><a href="#" onclick="showSection('tn_hr_summit_2024')">TN HR Summit 2024</a></li> -->
        <!-- <li><a href="#" onclick="showSection('career_fair_2024')">Career Fair 2024</a></li> -->

        
       
        
       
        
    </ul>
</nav>

<div id="all" class="gallery-section">
    <h2>All</h2>
    <div>
        <?php
        $all_categories = ['career_fair_2024', 'tn_hr_summit_2024', 'campus_recruiters_2024', 'second_annual_awards_2024', 'hr_conference_2025', 'hr_festival_2025'];
        $all_images = [];
        foreach ($all_categories as $category) {
            $all_images = array_merge($all_images, getImagesFromDb($conn, $category));
        }
        if (empty($all_images)) {
            echo '<p>No images found in All category.</p>';
        } else {
            foreach ($all_images as $image) {
                echo '<img src="uploads/event_photos/' . htmlspecialchars($image) . '" alt="Image">';
            }
        }
        ?>
    </div>
</div>



<div id="career_fair_2024" class="gallery-section">
    <h2>Career Fair 2024</h2>
    <div>
        <?php
        $career_fair_files = getImagesFromDb($conn, 'career_fair_2024');
        if (empty($career_fair_files)) {
            echo '<p>No images found in Career Fair 2024.</p>';
        } else {
            foreach ($career_fair_files as $file) {
                echo '<img src="uploads/event_photos/' . htmlspecialchars($file) . '" alt="Image">';
            }
        }
        ?>
    </div>
</div>

<div id="tn_hr_summit_2024" class="gallery-section">
    <h2>TN HR Summit 2024</h2>
    <div>
        <?php
        $tn_hr_summit_files = getImagesFromDb($conn, 'tn_hr_summit_2024');
        if (empty($tn_hr_summit_files)) {
            echo '<p>No images found in TN HR Summit 2024.</p>';
        } else {
            foreach ($tn_hr_summit_files as $file) {
                echo '<img src="uploads/event_photos/' . htmlspecialchars($file) . '" alt="Image">';
            }
        }
        ?>
    </div>
</div>

<div id="campus_recruiters_2024" class="gallery-section">
    <h2>Campus Recruiters Confluence 2024</h2>
    <div>
        <?php
        $campus_recruiters_files = getImagesFromDb($conn, 'campus_recruiters_2024');
        if (empty($campus_recruiters_files)) {
            echo '<p>No images found in HR Meet 2022.</p>';
        } else {
            foreach ($campus_recruiters_files as $file) {
                echo '<img src="uploads/event_photos/' . htmlspecialchars($file) . '" alt="Image">';
            }
        }
        ?>
    </div>
</div>
<div id="hr_meet_2024" class="gallery-section">
    <h2>HR Meet 2024</h2>
    <div>
        <?php
        $hr_meet_files = getImagesFromDb($conn, 'hr_meet_2024');
        if (empty($hr_meet_files)) {
            echo '<p>No images found in HR Meet 2024.</p>';
        } else {
            foreach ($hr_meet_files as $file) {
                echo '<img src="uploads/event_photos/' . htmlspecialchars($file) . '" alt="Image">';
            }
        }
        ?>
    </div>
</div>
<div id="second_annual_awards_2024" class="gallery-section">
    <h2>Second Annual Conference & Awards 2024</h2>
    <div>
        <?php
        $second_annual_files = getImagesFromDb($conn, 'second_annual_awards_2024');
        if (empty($second_annual_files)) {
            echo '<p>No images found in Second Annual Conference & Awards 2024.</p>';
        } else {
            foreach ($second_annual_files as $file) {
                echo '<img src="uploads/event_photos/' . htmlspecialchars($file) . '" alt="Image">';
            }
        }
        ?>
    </div>
</div>

<div id="hr_conference_2025" class="gallery-section">
    <h2>HR Conference 2025</h2>
    <div>
        <?php
        $hr_conference_2025_files = getImagesFromDb($conn, 'hr_conference_2025');
        if (empty($hr_conference_2025_files)) {
            echo '<p>No images found in HR Conference 2025.</p>';
        } else {
            foreach ($hr_conference_2025_files as $file) {
                echo '<img src="uploads/event_photos/' . htmlspecialchars($file) . '" alt="Image">';
            }
        }
        ?>
    </div>
</div>

<div id="hr_festival_2025" class="gallery-section">
    <h2>HR Festival 2025</h2>
    <div>
        <?php
        $hr_festival_2025_files = getImagesFromDb($conn, 'hr_festival_2025');
        if (empty($hr_festival_2025_files)) {
            echo '<p>No images found in HR Festival 2025.</p>';
        } else {
            foreach ($hr_festival_2025_files as $file) {
                echo '<img src="uploads/event_photos/' . htmlspecialchars($file) . '" alt="Image">';
            }
        }
        ?>
    </div>
</div>

</body>
</html>
