<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

if (isset($_REQUEST['submit1'])) {
  
  //echo 1;exit;
    include('../includes/db_connect.php');

    $target_dir = "../uploads/event_photos/";
    $uploadOk = 1;
    $fileNames = [];
    $errors = [];
    $category = $_POST['category']; // Get selected category
	//echo 1;exit;
    // Loop through each file
    foreach ($_FILES["fileToUpload"]["name"] as $key => $name) {
        $target_file = $target_dir . basename($name);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
        $fileNames[] = basename($name);
      } else {
        $errors[] = "There was an error uploading file $name.";
      }
    }

    // Insert file names into the database with category
    foreach ($fileNames as $fileName) {
        $sql = "INSERT INTO gallery (image, category) VALUES ('$fileName', '$category')";
        if ($conn->query($sql) !== TRUE) {
            $errors[] = "There was an error saving $fileName to the database.";
        }
    }

    // Display success or error messages
    if (empty($errors)) {
        $success = "All files have been uploaded and saved to the gallery.";
    } else {
        $error = implode('<br>', $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Event Photos</title>
   <link href="../assets/images/favicon-removebg-preview.png" rel="icon">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        #upload {
            background: linear-gradient(135deg, #22b8fe, #002e98);
            max-width: 500px;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        form {
            max-width: 400px;
        }
        .text-success {
            color: #28a745;
        }
        .text-danger {
            color: #dc3545;
        }
    </style>
</head>
<body>
<div class="container">
    <div id="upload">
        <h1 class="my-4 text-white">Upload Event Photos</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="category" class="text-white">Select category:</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="all">All</option>
                    <option value="hr_confluence_2025">HR Confluence 2025</option>
                    <option value="hr_festival_2025">HR Festival 2025</option>
                    <option value="hr_conference_2025">HR Conference 2025</option>
                    <option value="second_annual_awards_2024">Second Annual Conference & Awards 2024</option>
                    <!-- <option value="hr_meet_2024">HR Meet 2024</option> -->
                    <!-- <option value="campus_recruiters_2024">Campus Recruiters Confluence 2024</option> -->
                    <!-- <option value="tn_hr_summit_2024">TN HR Summit 2024</option> -->
                    <!-- <option value="career_fair_2024">Career Fair 2024</option> -->
         
                    
                    
                   
                
                    
                    
                    
                </select>
            </div>
            <div class="form-group">
                <label for="fileToUpload" class="text-white">Select images to upload:</label>
                <input type="file" name="fileToUpload[]" id="fileToUpload" class="form-control-file" multiple required>
            </div>
          	<input type="hidden" name="submit1" value="submit1">
            <button type="submit" class="btn btn-primary">Upload Images</button>
        </form>
        <?php if (isset($success)) echo "<p class='text-success mt-3'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='text-danger mt-3'>$error</p>"; ?>
    </div>
</div>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
