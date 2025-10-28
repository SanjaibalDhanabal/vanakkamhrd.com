<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
include('../includes/db_connect.php');

// Handle delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM gallery WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        $success = "Record deleted successfully";
    } else {
        $error = "Error deleting record: " . $conn->error;
    }
}

// Handle edit form submission
if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $category = $conn->real_escape_string($_POST['category']);
    $new_image = $_FILES['image']['name'];
    
    if ($new_image) {
        // Process new image upload
        $target_dir = "../uploads/event_photos/";
        $target_file = $target_dir . basename($new_image);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check === false) {
            $error = "File is not an image.";
        } else {
            // Check file size (limit to 5MB)
            if ($_FILES['image']['size'] > 5000000) {
                $error = "Sorry, your file is too large.";
            }
            
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
            
            // Check if $error is set to an error message
            if (!isset($error)) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    // Delete the old image
                    $old_image_result = $conn->query("SELECT image FROM gallery WHERE id=$id");
                    $old_image_row = $old_image_result->fetch_assoc();
                    $old_image = $old_image_row['image'];
                    if ($old_image) {
                        unlink($target_dir . $old_image);
                    }

                    // Update record with new image
                    $sql = "UPDATE gallery SET category='$category', image='$new_image' WHERE id=$id";
                    if ($conn->query($sql) === TRUE) {
                        $success = "Record updated successfully with new image";
                    } else {
                        $error = "Error updating record: " . $conn->error;
                    }
                } else {
                    $error = "Sorry, there was an error uploading your file.";
                }
            }
        }
    } else {
        // Update record without changing the image
        $sql = "UPDATE gallery SET category='$category' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            $success = "Record updated successfully";
        } else {
            $error = "Error updating record: " . $conn->error;
        }
    }
}

// Fetch gallery data
$result = $conn->query("SELECT * FROM gallery");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Gallery</title>
    <link href="../assets/images/favicon-removebg-preview.png" rel="icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        h1 {
            text-align: center;
            padding: 1rem;
            background-color: #333;
            color: #fff;
            margin: 0;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 2rem 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 1rem;
            text-align: center;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .form-container {
            margin: 2rem;
            padding: 1rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-container input, .form-container select {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-container button {
            background-color: blue;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<h1>Manage Gallery</h1>

<?php if (isset($success)) echo "<p>$success</p>"; ?>
<?php if (isset($error)) echo "<p>$error</p>"; ?>

<!-- Edit Form -->
<?php if (isset($_GET['edit'])): ?>
    <?php
    $edit_id = intval($_GET['edit']);
    $edit_result = $conn->query("SELECT * FROM gallery WHERE id=$edit_id");
    $edit_row = $edit_result->fetch_assoc();
    ?>
    <div class="form-container">
        <h2>Edit Image</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $edit_row['id']; ?>">
            <label for="category">Category:</label>
            <select name="category" id="category" required>
                
                <option value="career_fair_2024" <?php echo $edit_row['category'] == 'career_fair_2024' ? 'selected' : ''; ?>>Career Fair 2024</option>
                <option value="tn_hr_summit_2024" <?php echo $edit_row['category'] == 'tn_hr_summit_2024' ? 'selected' : ''; ?>>TN HR Summit 2024</option>
                <option value="campus_recruiters_2024" <?php echo $edit_row['category'] == 'campus_recruiters_2024' ? 'selected' : ''; ?>>Campus Recruiters Confluence 2024</option>
                 <option value="hr_meet_2024" <?php echo $edit_row['category'] == 'hr_meet_2024' ? 'selected' : ''; ?>>HR Meet 2024</option>
                 <option value="second_annual_awards_2024" <?php echo $edit_row['category'] == 'second_annual_awards_2024' ? 'selected' : ''; ?>>Second Annual Conference & Awards 2024</option>
                 <option value="hr_conference_2025" <?php echo $edit_row['category'] == 'hr_conference_2025' ? 'selected' : ''; ?>>HR Conference 2025</option>
                <option value="all" <?php echo $edit_row['category'] == 'all' ? 'selected' : ''; ?>>All</option>
            </select>
            <label for="image">Change Image:</label>
            <input type="file" name="image" id="image">
            <button type="submit" name="edit">Update Category and Image</button>
        </form>
    </div>
<?php endif; ?>

<!-- Gallery Table -->
<table>
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Category</th>
        <th>Action</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><img src="../uploads/event_photos/<?php echo $row['image']; ?>" width="100" alt="Image"></td>
        <td><?php echo htmlspecialchars($row['category']); ?></td>
        <td>
            <a href="?edit=<?php echo $row['id']; ?>">Edit</a> | 
            <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
