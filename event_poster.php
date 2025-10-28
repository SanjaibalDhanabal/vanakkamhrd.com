
<?php
    $name=$_REQUEST["name"];
    $designation=$_REQUEST["designation"];
    $company=$_REQUEST["company"];
    $image="event_register/".$_REQUEST["id"];
    if(file_exists($image."."."jpg")){
        $image=$image."."."jpg";
    } else if(file_exists($image."."."png")){
        $image=$image."."."png";
    } else if(file_exists($image."."."jpeg")){
        $image=$image."."."jpeg";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HR Festival Badge</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .badge {
            width: 700px;
            height: 700px;
            background: url("assets/poster.jpg");
            color: #fff;
            position: relative;
        }
        /*.badge .info {*/
        /*    margin-top: 30px;*/
        /*    margin-left: 90px;*/
        /*    font-size: 16px;*/
        /*    line-height: 1;*/
        /*}*/
        
         
        .register-info {
             position: absolute;
             top: 306px; /* Adjust as needed */
             right: 105px; /* Adjust as needed */
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
            font-size: 20px;
            font-family: Georgia, serif;
            color: white;
            text-transform: capitalize;
            margin-top: 30px;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .designation {
            font-size: 18px;
            color: white;
            margin-bottom: 10px;
            text-transform: capitalize;
            font-family: "Trebuchet MS", Helvetica, sans-serif;
        }
        .company {
            font-size: 18px;
            color: white;
            margin-bottom: 10px;
            text-transform: capitalize;
            font-family: "Trebuchet MS", Helvetica, sans-serif;
        }


        .badge .date-time {
            margin-top: 20px;
            font-size: 16px;
            color: #ffcc00;
            position: absolute;
            top: 290px;
            right: 30px;
        }
        .badge .qr-code {
            position: absolute;
            bottom: 10px;
            left: 25px;
            width: 120px;
            height: 120px;
        }
        .badge .qr-code img {
            height: 120px;
        }
        

        .date-time .title {
            /*color: #ea3f40;*/
            color: rgb(244, 121, 44);
            font-weight: bold;
            font-size: 20px;
        }
        .date-time .content {
            color: white;
            font-size: 16px;
        }
        .profile-image {
            width: 250px;
            height: 250px;
            border-radius: 50%;
            border: 4px solid #ea3f40;
            object-fit: cover;
            margin-top: 265px;
            margin-left: 30px;
        }
    </style>
</head>
<body>

<div class="badge">
    <img src="<?php echo $image; ?>" class="profile-image" alt="">
    
    <div class="register-info">
            <div class="name text-center"><?php echo $name; ?></div>
            <div class="designation text-center"><?php echo $designation; ?></div>
            <div class="company text-center"><?php echo $company; ?></div>
    </div>
    
</div>

</body>
</html>
