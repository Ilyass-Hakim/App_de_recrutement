<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['nomCompetence'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM competence WHERE nomcompetence = ?');
    $stmt->execute([$_GET['nomCompetence']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM competence WHERE nomCompetence = ?');
            $stmt->execute([$_GET['nomCompetence']]);
            $msg = 'You have deleted the contact!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read2.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete competence #<?=$contact['nomCompetence']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete contact #<?=$contact['nomCompetence']?>?</p>
    <div class="yesno">
        <a href="delete2.php?nomCompetence=<?=$contact['nomCompetence']?>&confirm=yes">Yes</a>
        <a href="delete2.php?nomCompetence=<?=$contact['nomCompetence']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>