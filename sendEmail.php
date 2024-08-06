<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $name = htmlspecialchars(trim($_POST['uname']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));
    $message = htmlspecialchars(trim($_POST['msg']));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.html?error=invalid_email"); // Redirect with error query parameter
        exit();
    }

    // Email address where you want to receive the emails
    $to = "contact@aidenmackey.com";
    
    // Subject of the email
    $subject = "New Contact Form Submission";

    // Compose the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n\n";
    $email_content .= "Message:\n$message";

    // Headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/plain; charset=utf-8\r\n";

    // Send the email
    if (mail($to, $subject, $email_content, $headers)) {
        // Redirect to feedback sent page
        header("Location: feedback-sent.html");
        exit();
    } else {
        // If sending fails, redirect back to the contact form with an error message
        header("Location: index.html?error=mail_error"); // Redirect with error query parameter
        exit();
    }
} else {
    // If accessed directly, redirect back to the contact form page
    header("Location: index.html"); // Change to your contact form page
    exit();
}
?>

