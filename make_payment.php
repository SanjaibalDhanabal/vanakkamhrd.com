<?php
   
    require('vendor/razorpay-php/Razorpay.php');
    use Razorpay\Api\Api;
    $keyId = 'rzp_live_DOM3Tmx5uZ1Zpr';
    $keySecret = 'ZjL22tBuTG7fZ5981rdgASRS';

    $api = new Api($keyId, $keySecret);

    // Database configuration
    $host = 'localhost';
    $dbname = 'vana_test';
    $username = 'vana_test';
    $password = 'Admin@123###';

    $response = [];
    
    function isIOS() {
        if (!isset($_SERVER['HTTP_USER_AGENT'])) {
            return false;
        }
    
        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
    
        return (strpos($userAgent, 'iphone') !== false || strpos($userAgent, 'ipad') !== false || strpos($userAgent, 'ipod') !== false || strpos($userAgent, 'mac os') !== false);
    }

    if (isset($_REQUEST['donate'])) {

        try {
            // Create a new PDO instance
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            // Data to insert/update
            $name = $_REQUEST["name"];
            $email = $_REQUEST["email"];
            $contact = $_REQUEST["contact"];
            $company = $_REQUEST["company"];
            $designation = $_REQUEST["designation"];
            $options = $_REQUEST["options"];
            $order_id=rand(1,999).time();
        
            // Check if contact already exists
            $checkStmt = $pdo->prepare("SELECT id FROM event_registers WHERE contact = :contact AND email = :email AND payment_status=0");
            $checkStmt->execute([':contact' => $contact,':email' => $email]);
            $db_id = $checkStmt->fetchColumn();
        
            if ($db_id === false) {
                $stmt = $pdo->prepare("INSERT INTO event_registers (name, email, contact, company, designation, options,order_id) VALUES (:name, :email, :contact, :company, :designation, :options, :order_id)");
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':contact' => $contact,
                    ':company' => $company,
                    ':designation' => $designation,
                    ':options' => $options,
                    ':order_id' => $order_id,
                ]);
                $db_id = $pdo->lastInsertId();
            } else {
                $stmt = $pdo->prepare("UPDATE tn_hr_summit_2025 SET name = :name, email = :email, company = :company, designation = :designation, options = :options, order_id = :order_id WHERE contact = :contact AND id= :id");
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':contact' => $contact,
                    ':company' => $company,
                    ':designation' => $designation,
                    ':options' => $options,
                    ':order_id' => $order_id,
                    ':id' => $db_id
                ]);
            }

            $response = ['status' => true, 'message' => 'Data insert successfully!'];
            if(isset($_FILES['photo'])) {
                $uploadDir = 'event_register/';
                $file_extension = explode(".",basename($_FILES['photo']['name']));
                $targetPath = $uploadDir.$db_id.".".$file_extension[count($file_extension)-1];
    
                if(!file_exists($uploadDir)){
                    mkdir($uploadDir, 0777, true);
                }
        
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetPath)) {
                    // Save just the filename, not the path
                    $photo_filename = $db_id.".".$file_extension[count($file_extension)-1];
                    $stmt = $pdo->prepare("UPDATE event_registers SET photo = :photo WHERE id = :id");
                    $stmt->execute([':photo' => $photo_filename, ':id' => $db_id]);
                    $response = ['status' => true, 'message' => 'File uploaded successfully!'];
                } else {
                    $response = ['status' => false, 'message' => 'Failed to upload file!'];
                }
            }


            try {
                $amount=100;
                // Create an order
                $order = $api->order->create([
                    'receipt' => $order_id,
                    'amount' => $amount,
                    'currency' => 'INR',
                    'payment_capture' => 1 // Auto capture payment
                ]);
        
                $order_id = $order['id'];

                $data=array("key"=>"$keyId","amount"=>"$amount","currency"=>"INR","name"=>"$name","description"=>"Payment for Order Vanakkam HRD","order_id"=>"$order_id","prefill"=>array("name"=>"$name","email"=>"$email","contact"=>"$contact"),"readonly"=>array("name"=>true,"email"=>true,"contact"=>true));
                $data["callback_url"]="https://vanakkamhrd.com/success_payment.php";

                $response = ['status' => true, 'message' => 'Added successfully!',"order_id"=>$order_id,"data"=>$data];
            } catch (Exception $e) {
                $response = ['status' => false, 'message' => $e->getMessage()];
            }

            // order_id


        } catch (PDOException $e) {

            $response = ['status' => false, 'message' => $e->getMessage()];
        }
    }

    echo json_encode($response);
?>