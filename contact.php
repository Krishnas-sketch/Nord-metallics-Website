<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: contact.html");
  exit;
}

function clean_input($value) {
  return trim(strip_tags($value));
}

$name = clean_input($_POST["name"] ?? "");
$email = filter_var(trim($_POST["email"] ?? ""), FILTER_SANITIZE_EMAIL);
$phone = clean_input($_POST["phone"] ?? "");
$subject = clean_input($_POST["subject"] ?? "");
$message = clean_input($_POST["message"] ?? "");

if ($name === "" || $email === "" || $subject === "" || $message === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "Please go back and complete all required fields with a valid email address.";
  exit;
}

$to = "info@nordmetallics.com";
$email_subject = "Website Inquiry: " . $subject;
$email_body = "New inquiry from the Nord Metallics website:\n\n";
$email_body .= "Name: " . $name . "\n";
$email_body .= "Email: " . $email . "\n";
$email_body .= "Phone: " . $phone . "\n";
$email_body .= "Subject: " . $subject . "\n\n";
$email_body .= "Information:\n" . $message . "\n";

$headers = "From: Nord Metallics Website <info@nordmetallics.com>\r\n";
$headers .= "Reply-To: " . $email . "\r\n";

if (mail($to, $email_subject, $email_body, $headers)) {
  echo "Thank you. Your message has been sent to Nord Metallics.";
} else {
  echo "Sorry, your message could not be sent. Please email info@nordmetallics.com directly.";
}
?>
