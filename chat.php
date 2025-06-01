<?php
session_start();

require_once('conn.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function retrieveChatEntries() {
                $.ajax({
                    type: "GET",
                    url: "getChatEntries.php",
                    success: function(entries) {
                        $("#chatArea").html(entries);
                        setTimeout(retrieveChatEntries, 5000);
                    }
                });
            }

            retrieveChatEntries();

            $("#sendButton").click(function() {
                var message = $("#message").val();

                $.ajax({
                    type: "POST",
                    url: "updateChatEntry.php",
                    data: { message: message },
                    success: function(response) {
                        alert(response);
                    }
                });
            });

            $("#message").keyup(function() {
                var message = $(this).val();
                var username = "<?php echo $_SESSION['username']; ?>";

                $.ajax({
                    type: "POST",
                    url: "checkCredentials.php",
                    data: { username: username },
                    success: function(response) {
                        if (response === 'invalid') {
                            $("#error").html("Error: Invalid credentials! Unable to submit chat message.");
                        } else {
                            $("#error").html("");
                        }
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div>
        <form id="nameForm" action="#">
            Enter Name: <input type="text" id="nameInput"><br>
            <input type="submit" value="Submit">
        </form>
        <div id="chatArea"></div>
    </div>

    <script>
        $(document).ready(function() {
            $("#nameForm").submit(function(e) {
                e.preventDefault();
                var name = $("#nameInput").val();

                $.ajax({
                    type: "GET",
                    url: "getChatEntries.php",
                    data: { name: name },
                    success: function(entries) {
                        $("#chatArea").html(entries);
                        setTimeout(retrieveChatEntries, 5000);
                    }
                });
            });
        });
    </script>

    <div>
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
        <div id="error"></div>
        <textarea id="message" placeholder="Type your message"></textarea><br>
        <button id="sendButton">Send</button>
    </div>
</body>
</html>
