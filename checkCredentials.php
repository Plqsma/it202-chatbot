<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = $_POST['username'];
    $sessionUsername = $_SESSION['username'];

    if ($username !== $sessionUsername) {
        echo 'invalid';
    } else {
        echo 'valid';
    }
}
?>
