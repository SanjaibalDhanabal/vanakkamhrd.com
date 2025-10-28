




<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["selected_ids"])) {
    $selected_ids = implode(",", $_POST["selected_ids"]);
    $email_type = $_POST["email_type"];

    if ($email_type == "confirm") {
        header("Location: final_confirmation.php?ids=$selected_ids");
    } elseif ($email_type == "reject") {
        header("Location: send_rejection.php?ids=$selected_ids");
    }
    exit();
} else {
    echo "No users selected.";
}
?>
