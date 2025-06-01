<?php
session_start();
require_once('conn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    $message = $_POST['message'];
    $username = $_SESSION['username'];

    
    $sqlSelect = "SELECT CHAT_CONTENT FROM chat_data WHERE Name='$username'";
    $resultSelect = $conn->query($sqlSelect);

    if ($resultSelect->num_rows > 0) {
        $row = $resultSelect->fetch_assoc();
        $existingChatContent = $row['CHAT_CONTENT'];

        $updatedChatContent = $existingChatContent . "\n" . $username . ": " . $message;

        $sqlUpdate = "UPDATE chat_data SET CHAT_CONTENT='$updatedChatContent' WHERE Name='$username'";

        if ($conn->query($sqlUpdate) === TRUE) {
            echo "Message sent successfully!";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "No user found or error in fetching chat content.";
    }

    $conn->close();
}
?>