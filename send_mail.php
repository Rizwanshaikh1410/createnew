<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../frontpage/phpmailer/vendor/autoload.php'; // Composer autoload

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // फॉर्म से डेटा प्राप्त करना
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $options = $_POST['options'];

    // PHPMailer सेटअप
    $mail = new PHPMailer(true);

    try {
        // SMTP सर्वर सेटिंग्स
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Gmail का SMTP सर्वर
        $mail->SMTPAuth = true;
        $mail->Username = 'rockstargamingr2@gmail.com'; // अपना Gmail ईमेल डालें
        $mail->Password = 'lopmvwxqzmyharso'; // यहाँ Gmail ऐप पासवर्ड डालें
        $mail->SMTPSecure = 'tls'; // STARTTLS का उपयोग करें
        $mail->Port = 587; // SMTP पोर्ट

        // सर्टिफिकेट वेरिफिकेशन को बायपास करना
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // प्राप्तकर्ता की जानकारी
        $mail->setFrom($email, $username);
        $mail->addAddress('rockstargamingr2@gmail.com'); // जहाँ ईमेल भेजना है

        // ईमेल सामग्री
        $mail->isHTML(true); 
        $mail->Subject = "Contact Form Submission from " . $username;
        $mail->Body    = "Username: " . $username . "<br>Mobile: " . $mobile .  "<br>Email: " . $email . "<br>Course: " . $options . "<br>Message: " . $message;

        // ईमेल भेजना
        $mail->send();
        echo 'Message Send Successfull';
    } catch (Exception $e) {
        echo 'Please Check The Fill Details Mailer Error: ', $mail->ErrorInfo;
    }
}

?>
