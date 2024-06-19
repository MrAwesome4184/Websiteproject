<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $satisfy = $_POST['satisfy'];
    $message = $_POST['msg'];

    // Email address where you want to receive the emails
    $to = "your-email@example.com";
    
    // Subject of the email
    $subject = "New Contact Form Submission";

    // Compose the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Satisfaction: $satisfy\n\n";
    $email_content .= "Message:\n$message";

    // Headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/plain; charset=utf-8\r\n";

    // Send the email
    if (mail($to, $subject, $email_content, $headers)) {
        echo "<script>alert('Your message has been sent. We will contact you shortly.'); window.location.replace('index.html');</script>";
    } else {
        echo "<script>alert('Failed to send your message. Please try again later.'); window.location.replace('index.html');</script>";
    }
} else {
    // If accessed directly, redirect back to index.html
    header("Location: index.html");
    exit();
}
?>
