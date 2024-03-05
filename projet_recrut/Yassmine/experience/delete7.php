<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['poste'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM experience WHERE poste = ?');
    $stmt->execute([$_GET['poste']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM experience WHERE poste = ?');
            $stmt->execute([$_GET['poste']]);
            $msg = 'experience supprimée!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read7.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete formation #<?=$contact['poste']?></h2>
    <?php if ($msg): ?>poste
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete contact #<?=$contact['poste']?>?</p>
    <div class="yesno">
        <a href="delete7.php?poste=<?=$contact['poste']?>&confirm=yes">Yes</a>
        <a href="delete7.php?poste=<?=$contact['poste']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>