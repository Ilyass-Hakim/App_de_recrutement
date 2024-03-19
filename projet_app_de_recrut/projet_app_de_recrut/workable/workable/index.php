<?php
$conn = mysqli_connect('localhost', 'root', '', 'workable');

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// from Auth
$userId = 1;
$user_role = "recruiter"; // User role
$conversationId = isset($_GET['chat']) ? $_GET['chat'] : 0;


function fetchConversationById($conn, $conversationId)
{
  $conversation = array();

  $query = "SELECT c.id, c.recruiter, c.candidate, c.createdAt, 
                     r.name AS recruiter_name, r.avatar AS recruiter_avatar, 
                     d.name AS candidate_name, d.avatar AS candidate_avatar
              FROM conversations c
              INNER JOIN users r ON c.recruiter = r.id
              INNER JOIN users d ON c.candidate = d.id
              WHERE c.id = $conversationId";

  $result = mysqli_query($conn, $query);

  if ($result) {
    $conversation = mysqli_fetch_assoc($result);
  }

  return $conversation;
}

$conversationInfo =  fetchConversationById($conn, $conversationId);

if ($conversationId != 0) {
  if ($userId != $conversationInfo['recruiter'] && $userId != $conversationInfo['candidate']) {
    die("Unauthorized Access! ");
  }
}



$user = fetchUserById($conn, $userId);

function fetchUserById($conn, $userId)
{
  $user = array();

  $query = "SELECT id, name, role, avatar FROM users WHERE id = $userId";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $user = mysqli_fetch_assoc($result);
  }

  return $user;
}

function fetchConversationsRecruiter($conn, $userId, $user_role)
{

  // Fetch conversations related to the user
  $conversationsQuery = "SELECT conversations.id, users.id as participant_id, users.name, users.avatar
                           FROM conversations
                           INNER JOIN users ON conversations.candidate = users.id
                           WHERE conversations.recruiter = $userId 
                           ";


  $conversationsResult = mysqli_query($conn, $conversationsQuery);


  if ($conversationsResult) {
    $conversations = array();

    while ($conversation = mysqli_fetch_assoc($conversationsResult)) {

      // Determine the other participant in the conversation
      $participantName = $conversation['name'];
      $participantAvatar = $conversation['avatar'];
      $conversationId = $conversation["id"];

      // Generate HTML structure for each conversation
      $conversations[] = "
                <li>
                    <a href='?chat=$conversationId'>
                    <div class='infos'>
                    <img src='$participantAvatar' alt='Avatar' /> 
                    <p>$participantName</p>
                    </div>
                    <div class='status online'></div>
                    </a>
                </li>
            ";
    }
  }

  return $conversations;
}
function fetchConversationsCandidate($conn, $userId, $user_role)
{

  // Fetch conversations related to the user
  $conversationsQuery = "SELECT conversations.id, users.id as participant_id, users.name, users.avatar
                           FROM conversations
                           INNER JOIN users ON conversations.recruiter = users.id
                           WHERE conversations.candidate = $userId
                           ";


  $conversationsResult = mysqli_query($conn, $conversationsQuery);


  if ($conversationsResult) {
    $conversations = array();

    while ($conversation = mysqli_fetch_assoc($conversationsResult)) {

      // Determine the other participant in the conversation
      $participantName = $conversation['name'];
      $participantAvatar = $conversation['avatar'];
      $conversationId = $conversation["id"];

      // Generate HTML structure for each conversation
      $conversations[] = "
                <li>
                    <a href='?chat=$conversationId'>
                    <div class='infos'>
                    <img src='$participantAvatar' alt='Avatar' /> 
                    <p>$participantName</p>
                    </div>
                    <div class='status'></div>
                    </a>
                </li>
            ";
    }
  }

  return $conversations;
}

// Fetch conversations related to the user
$conversations = $user_role === "recruiter" ? fetchConversationsRecruiter($conn, $userId, $user_role) : fetchConversationsCandidate($conn, $userId, $user_role);




?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chat System</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <nav>This is navbar</nav>

  <!-- Start Chat System -->
  <div class="chat-system">
    <div class="container chat-container">
      <!-- Contacts -->
      <div class="contacts">
        <ul id="conversations">

          <?php
          // Output the generated conversation HTML
          foreach ($conversations as $conversation) {
            echo $conversation;
          }
          ?>


        </ul>
      </div>
      <!-- Chat -->
      <div class="chat">
        <!-- No Chat selected -->
        <?php
        if ($conversationId == 0) {
          return;
        }
        ?>
        <div class="chat-selected">
          <div class="nav">
            <img src='<?php echo $conversationInfo['recruiter'] == $userId ? $conversationInfo['candidate_avatar'] : $conversationInfo['recruiter_avatar'] ?>' />
            <p style="text-transform: capitalize;"><?php echo $conversationInfo['recruiter'] == $userId ? $conversationInfo['candidate_name'] : $conversationInfo['recruiter_name'] ?></p>

          </div>
          <div class="messages">
            <div class="messages_wrapper" id="messages_wrapper">


            </div>




            <div class="send-message" id="sendMessageContainer">
              <form id="sendMessageForm">
                <input type="text" id="send-message" name="send-message" placeholder="Your message" />
                <button type="submit">
                  <i class="fa fa-paper-plane"></i>
                </button>
              </form>
              <div id="errorMessage"></div>
            </div>

          </div>
        </div>
        <!-- Chat selected -->

      </div>
    </div>
    <!-- End Chat System -->
    <!-- Send Message Script -->
    <script defer>
      $(document).ready(function() {
        $("#sendMessageForm").submit(function(e) {
          e.preventDefault();

          let messageContent = $("#send-message").val();

          if (messageContent.trim() !== "") {
            $.ajax({
              type: "POST",
              url: "routes/send_message.php", // Replace with the actual path to your PHP script for sending messages
              data: {
                senderId: <?php echo $userId; ?>,
                conversationId: <?php echo $conversationId; ?>,
                content: messageContent
              },
              success: function(response) {
                if (response === "success") {
                  // Clear the input field
                  $("#send-message").val("");

                  // Fetch and display new messages
                  // fetchAndDisplayMessages();
                } else {
                  $("#errorMessage").html("Failed to send message.");
                }
              },
              error: function() {
                $("#errorMessage").html("Error in AJAX request.");
              }
            });
          } else {
            $("#errorMessage").html("Message cannot be empty.");
          }
        });





      });
    </script>

    <!-- Realtime data script -->
    <script defer>
      function loadXMLDoc() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("messages_wrapper").innerHTML =
              this.responseText;
          }
        };
        xhttp.open("GET", "routes/fetch_messages.php", true);
        xhttp.send();
        document.querySelector(".chat").scrollTo(0, document.querySelector(".chat").scrollHeight);

      }
      setInterval(function() {
        loadXMLDoc();
        // 1sec
      }, 1000);

      window.onload = loadXMLDoc;
    </script>
</body>

</html>