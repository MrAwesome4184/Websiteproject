<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['uname'], $_POST['email'], $_POST['phone'], $_POST['msg'])) {
        $name = htmlspecialchars(trim($_POST['uname']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $phone = htmlspecialchars(trim($_POST['phone']));
        $message = htmlspecialchars(trim($_POST['msg']));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit();
        }

        $to = "contact@aidenmackey.com";
        $subject = "New Contact Form Submission";
        $email_content = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
        $headers = "From: $name <$email>\r\nReply-To: $email\r\nMIME-Version: 1.0\r\nContent-type: text/plain; charset=utf-8\r\n";

        if (mail($to, $subject, $email_content, $headers)) {
            echo "Email sent successfully.";
        } else {
            echo "Failed to send email.";
        }
    } else {
        echo "Required fields are missing.";
    }
} else {
    echo "Invalid request method.";
}
?>
