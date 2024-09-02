<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $fileTmpPath = $_FILES["fileToUpload"]["tmp_name"];
        $fileName = $_FILES["fileToUpload"]["name"];
        $fileSize = $_FILES["fileToUpload"]["size"];
        $fileType = $_FILES["fileToUpload"]["type"];

        // Set up email
        $to = 'your-email@example.com'; // Replace with your email address
        $subject = 'New File Upload';
        $message = 'A new file has been uploaded.';
        $headers = "From: no-reply@example.com\r\n"; // Replace with your domain or email address

        // Read the file content
        $fileContent = file_get_contents($fileTmpPath);
        $fileContent = chunk_split(base64_encode($fileContent));
        
        // Create email headers and body
        $boundary = md5(uniqid(time()));
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
        $message = "--$boundary\r\n";
        $message .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
        $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $message .= "$message\r\n";
        $message .= "--$boundary\r\n";
        $message .= "Content-Type: application/octet-stream; name=\"$fileName\"\r\n";
        $message .= "Content-Transfer-Encoding: base64\r\n";
        $message .= "Content-Disposition: attachment; filename=\"$fileName\"\r\n\r\n";
        $message .= "$fileContent\r\n";
        $message .= "--$boundary--";

        // Send email
        if (mail($to, $subject, $message, $headers)) {
            echo "File successfully sent via email.";
        } else {
            echo "Error sending the file via email.";
        }
    } else {
        echo "No file uploaded or there was an error.";
    }
} else {
    echo "Invalid request method.";
}
?>
