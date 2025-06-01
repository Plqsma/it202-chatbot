<?php
include_once('conn.php');

$sql = "SELECT Name FROM chat_data";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row['Name'] . "</li>";
    }
} else {
    echo "<li>No users found.</li>";
}

$conn->close();
?>
