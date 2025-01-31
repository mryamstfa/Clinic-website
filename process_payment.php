<?php
require 'db_config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $email = $_POST['email'];
    $cardNumber = $_POST['cardNumber'];
    $expiryDate = $_POST['expiryDate'];
    $cvv = $_POST['cvv'];

    $stmt = $conn->prepare("INSERT INTO Payment (P_Email, CardNo, EXD, Cvv) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $cardNumber, $expiryDate, $cvv);

    if ($stmt->execute()) {
        try {
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'androws55remon@gmail.com';
            $mail->Password = 'esww nwvw aoxp shoc';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('androws55remon@gmail.com', 'GoodClinic');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Payment Confirmation';
            $mail->Body = "
                <h1>Thank You for Your Payment!</h1>
                <p>We have successfully received your payment.</p>
                <p>Here are the details of your payment:</p>
                <ul>
                    <li><strong>Email:</strong> $email</li>
                    <li><strong>Card Number:</strong> **** **** **** " . substr($cardNumber, -4) . "</li>
                    <li><strong>Expiry Date:</strong> $expiryDate</li>
                </ul>
                <p>If you have any questions, feel free to contact us.</p>
            ";

            $mail->send();
            header("Location: checkout.php?message=Payment processed and confirmation email sent successfully!");
            exit;
        } catch (Exception $e) {
            header("Location: checkout.php?message=Payment processed, but email could not be sent.");
            exit;
        }
    } else {
        header("Location: checkout.php?message=Error: " . $stmt->error);
        exit;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: checkout.php?message=Invalid request method.");
    exit;
}
?>
