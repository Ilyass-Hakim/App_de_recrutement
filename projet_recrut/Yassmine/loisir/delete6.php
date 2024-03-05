<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['nomLoisir'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM profil WHERE nomLoisir = ?');
    $stmt->execute([$_GET['nomLoisir']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM loisir WHERE nomLoisir = ?');
            $stmt->execute([$_GET['nomLoisir']]);
            $msg = 'You have deleted the contact!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read6.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete competence #<?=$contact['nomLoisir']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete contact #<?=$contact['nomLoisir']?>?</p>
    <div class="yesno">
        <a href="delete6.php?nomLoisir=<?=$contact['nomLoisir']?>&confirm=yes">Yes</a>
        <a href="delete6.php?nomLoisir=<?=$contact['nomLoisir']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>