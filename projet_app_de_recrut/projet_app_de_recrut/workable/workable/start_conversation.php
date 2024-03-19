<?php
$userId = 1;

// Fetch database and get the receiver id based on their profile page
$receiverId = 2;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Create Conversation</title>
</head>

<body>

    <button id="createConversationButton">Create Conversation</button>

    <script>
        $(document).ready(function() {
            $("#createConversationButton").on("click", function() {
                // Pass PHP variables to the AJAX request
                const senderId = <?php echo $userId; ?>;
                const receiverId = <?php echo $receiverId; ?>;

                $.ajax({
                    type: "POST",
                    url: "routes/create_conv.php",
                    data: {
                        senderId: senderId,
                        receiverId: receiverId
                    },
                    success: function(response) {
                        alert(response);
                        // Redirect the user to the conv
                        // return window.location.replace(`/chat/${response}`)
                    },
                    error: function() {
                        alert("Error in AJAX request.");
                    }
                });
            });
        });
    </script>

</body>

</html>