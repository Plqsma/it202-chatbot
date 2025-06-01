<?php
session_start();

require_once('conn.php');

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM chat_data WHERE Name='$username' AND Password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username; 
        header("Location: chat.php"); 
    } else {
        echo "Invalid username or password. Please try again.";
    }

    $conn->close();
}
?>
