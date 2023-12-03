<?php

include '../Control/billmanagement.php';
include '../Model/billinfo.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPEmail/PHPMailer/src/Exception.php';
require '../PHPEmail/PHPMailer/src/PHPMailer.php';
require '../PHPEmail/PHPMailer/src/SMTP.php';

//changes

$b = new BillManagement();

if (isset($_POST["id_patient"])) {
    if (!empty($_POST['id_patient'])) {
        $id_patient = $_POST['id_patient'];

        
        if (is_numeric($id_patient)) {
            $b->addBill($id_patient);
        } else {
            $error = "Invalid patient ID format";
        }
    } else {
        $error = "Patient ID is required";
    }
}
$enablemail = 0;
if($enablemail == 1){

$row=$b->getMailAndName($id_patient);

$mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'haroun.zriba@esprit.tn';
    $mail->Password = 'ooqezbdnhikqvsmn';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';

    $mail->isHTML(true);
    $mail->setFrom('haroun.zriba@esprit.tn', "Freud Clinic");
    $mail->addAddress($row['email_address'], $row['first_name']);
    $mail->Subject = "A new bill has been issued to your account";
    $mail->Body = "Mr {$row['first_name']} {$row['family_name']} you have a new bill, please check it out on our Freud Clinic website at http://localhost/View/payment.html where you can pay online.";

// Send
if ($mail->send()) {
    header('Location: listBills.php');
} else {
    echo 'Error sending email: ' . $mail->ErrorInfo;
}
}
else{
    header('Location: listBills.php');
}
?>