<?php
session_start();

require_once('conn.php');
$username = $_SESSION['username'];

$sql = "SELECT CHAT_CONTENT FROM chat_data WHERE Name='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo nl2br($row['CHAT_CONTENT']);
    }
} else {
    echo "Empty chat...";
}

$conn->close();
?>
