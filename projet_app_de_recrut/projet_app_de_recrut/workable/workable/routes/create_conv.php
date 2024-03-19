<?php
$conn = mysqli_connect('localhost', 'root', '', 'workable');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$senderId = 1; // Replace with the actual sender's user id
$receiverId = 2; // Replace with the actual receiver's user id


function createConversation($senderId, $receiverId)
{
    global $conn;

    // Check if the sender is a recruiter
    $senderRoleQuery = "SELECT role FROM users WHERE id = $senderId";
    $senderRoleResult = mysqli_query($conn, $senderRoleQuery);
    $senderRole = mysqli_fetch_assoc($senderRoleResult)['role'];

    if ($senderRole !== 'recruiter') {
        return "Unauthorized: Only recruiters can create conversations.";
    }

    // Check if the receiver is a candidate
    $receiverRoleQuery = "SELECT role FROM users WHERE id = $receiverId";
    $receiverRoleResult = mysqli_query($conn, $receiverRoleQuery);
    $receiverRole = mysqli_fetch_assoc($receiverRoleResult)['role'];

    if ($receiverRole !== 'candidate') {
        return "Unauthorized: Conversations can only be created with candidates.";
    }

    // Check if a conversation already exists
    $conversationQuery = "SELECT id FROM conversations WHERE recruiter = $senderId AND candidate = $receiverId";
    $conversationResult = mysqli_query($conn, $conversationQuery);

    if ($conversationRow = mysqli_fetch_assoc($conversationResult)) {
        // Conversation already exists, retrieve its id
        $conversationId = $conversationRow['id'];
    } else {
        // Conversation does not exist, create a new conversation
        $createConversationQuery = "INSERT INTO conversations (recruiter, candidate) VALUES ($senderId, $receiverId)";
        mysqli_query($conn, $createConversationQuery);

        // Retrieve the id of the newly created conversation
        $conversationId = mysqli_insert_id($conn);
    }

    return $conversationId;
}

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senderId = $_POST['senderId'] ?? null;
    $receiverId = $_POST['receiverId'] ?? null;

    if ($senderId !== null && $receiverId !== null) {
        $result = createConversation($senderId, $receiverId);
        echo $result;
    } else {
        echo "Invalid request parameters.";
    }
}

// Close the connection
mysqli_close($conn);
