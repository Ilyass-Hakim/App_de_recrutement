<?php
$conn = mysqli_connect('localhost', 'root', '', 'workable');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// from Auth
$userId = 1;
$user_role = "recruiter"; // User role
$url = $_SERVER['HTTP_REFERER'];
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
$conversationId = isset($params['chat']) ? $params['chat'] : 0;



// Fetch conversation messages function
function fetchMessagesByConversation($conn, $conversationId)
{
    $messages = array();

    $query = "SELECT id, sender, content, created_at FROM Messages WHERE conversation = $conversationId ORDER BY created_at ASC";
    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($message = mysqli_fetch_assoc($result)) {
            $messages[] = $message;
        }
    }

    return $messages;
}
$conversationMessages = fetchMessagesByConversation($conn, $conversationId);


?>
    <?php

    foreach ($conversationMessages as $message) {
        if ($userId == $message["sender"]) {
            echo "
                      <div class='message own'>"
                . $message['content'] . "<span>" . $message['created_at'] . "</span>
                      </div>
                      ";
        } else {
            echo "
                      <div class='message not-own'>"
                . $message['content'] . "<span>" . $message['created_at'] . "</span>
                      </div>
                      ";
        }
    }
    ?>
