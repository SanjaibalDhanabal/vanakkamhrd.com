<?php include('includes/header.php'); ?>
<?php
include('includes/db_connect.php'); // Correct path to your db_connect.php file

$category = isset($_GET['category']) ? $_GET['category'] : 'all';

// Prepare SQL query based on the selected category
if ($category === 'all') {
    $sql = "SELECT * FROM gallery";
    $stmt = $conn->prepare($sql);
} else {
    $sql = "SELECT * FROM gallery WHERE category = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $category);
}

$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.gal nav {
    display: flex;
    justify-content: center;
    padding: 0.5rem;
}

.gal nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

.gal nav ul li {
    margin: 0 1rem;
}

.gal nav ul li a {
    color: #12037f; /* Change to your desired text color */
    text-decoration: none;
    font-weight: bold;
    padding: 0.5rem 1rem;
    display: block;
    transition: color 0.3s, border-radius 0.3s, border-bottom 0.3s; /* Add smooth transition */
    border-bottom: 2px solid transparent; /* Default underline */
}

.gal nav ul li a:hover {
    color: #555; /* Color for active or hovered link */
}
.gal nav ul li a.active{
    border-bottom: 2px solid orangered;
}

.gallery-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding: 1rem;
}

.gallery-container img {
    margin: 0.5rem;
    transition: transform 0.5s; /* Add smooth scaling transition */
}

.gallery-container img:hover {
    transform: scale(1.1);
}





        
    </style>
</head>
<body>
<div class="gal">
<nav>
    <ul>
        <li><a href="gallery.php?category=all" class="<?php echo $category === 'all' ? 'active' : ''; ?>">All</a></li>
        <li><a href="gallery.php?category=hr_meet_2022" class="<?php echo $category === 'hr_meet_2022' ? 'active' : ''; ?>">HR Meet 2022</a></li>
        <li><a href="gallery.php?category=tpo_meet_2023" class="<?php echo $category === 'tpo_meet_2023' ? 'active' : ''; ?>">TPO Meet 2023</a></li>
        <li><a href="gallery.php?category=first_anniversary_awards_2024" class="<?php echo $category === 'first_anniversary_awards_2024' ? 'active' : ''; ?>">First Anniversary & Awards 2024</a></li>
        <li><a href="gallery.php?category=career_fair_2024" class="<?php echo $category === 'career_fair_2024' ? 'active' : ''; ?>">Career Fair 2024</a></li>
        <li><a href="gallery.php?category=tn_hr_summit_2024" class="<?php echo $category === 'tn_hr_summit_2024' ? 'active' : ''; ?>">TN HR Summit 2024</a></li>
    </ul>
</nav>

</div>
<div class="gallery-container">
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $imagePath = 'uploads/event_photos/'.$row['image'];
            if (file_exists($imagePath)) {
                echo '<img src="'.$imagePath.'" alt="'.$row['image'].'" style="width:300px; height:200px;">';
            } else {
                echo '<p>Image not found: '.$row['image'].'</p>';
            }
        }
    } else {
        echo "<p>No images found.</p>";
    }
    ?>
</div>
</body>
</html>

<?php include('includes/footer.php'); ?>
