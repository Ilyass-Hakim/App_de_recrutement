<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['nomLangue'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM langue WHERE nomLangue = ?');
    $stmt->execute([$_GET['nomLangue']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM langue WHERE nomLangue = ?');
            $stmt->execute([$_GET['nomLangue']]);
            $msg = 'You have deleted the contact!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read3.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete langue #<?=$contact['nomLangue']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete contact #<?=$contact['nomLangue']?>?</p>
    <div class="yesno">
        <a href="delete3.php?nomLangue=<?=$contact['nomLangue']?>&confirm=yes">Yes</a>
        <a href="delete3.php?nomLangue=<?=$contact['nomLangue']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>