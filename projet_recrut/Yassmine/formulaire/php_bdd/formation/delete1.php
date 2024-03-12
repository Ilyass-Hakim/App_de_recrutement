<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['nomFormation'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM formation WHERE nomFormation = ?');
    $stmt->execute([$_GET['nomFormation']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM formation WHERE nomFormation = ?');
            $stmt->execute([$_GET['nomFormation']]);
            $msg = 'Formation supprimée!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read1.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete formation #<?=$contact['nomFormation']?></h2>
    <?php if ($msg): ?>nomFormation
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete contact #<?=$contact['nomFormation']?>?</p>
    <div class="yesno">
        <a href="delete1.php?nomFormation=<?=$contact['nomFormation']?>&confirm=yes">Yes</a>
        <a href="delete1.php?nomFormation=<?=$contact['nomFormation']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>