<?php
$conn = mysqli_connect('localhost', 'root', '', 'workable');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $senderId = $_POST["senderId"];
    $conversationId = $_POST["conversationId"];
    $content = $_POST["content"];

    // Validate and sanitize input as needed

    // Insert the new message into the Messages table
    $insertQuery = "INSERT INTO Messages (sender, conversation, content) VALUES ($senderId, $conversationId, '$content')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
        echo "success";
    } else {
        echo "error";
    }
}
