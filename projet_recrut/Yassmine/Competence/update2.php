<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['nomCompetence'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $nomCompetence = isset($_POST['nomCompetence']) ? $_POST['nomCompetence'] : '';
        $niveau = isset($_POST['niveau']) ? $_POST['niveau'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE competence SET  nomCompetence = ?, niveau = ? WHERE nomCompetence = ?');
        $stmt->execute([$nomCompetence, $niveau, $_GET['nomCompetence']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the utilisateur table
    $stmt = $pdo->prepare('SELECT * FROM competence WHERE nomCompetence = ?');
    $stmt->execute([$_GET['nomCompetence']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>



    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="job-detail mt-2 p-4">
                        <div class="custom-form">
                            <h2>Update competence #<?=$contact['nomCompetence']?></h2>
                            <form action="update2.php?nomCompetence=<?=$contact['nomCompetence']?>" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="nomCompetence" class="text-muted">Nom de la competence</label>
                                            <input name="nomCompetence" id="nomCompetence" type="text" class="form-control resume" placeholder="ma competence" value="<?=$contact['nomCompetence']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="niveau" class="text-muted">niveau</label>
                                            <input name="niveau" id="niveau" type="text" class="form-control resume" placeholder="mon niveau" value="<?=$contact['niveau']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <input type="submit" id="submit" name="send" class="submitBnt btn btn-secondary mt-5" value="Update competence">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php if ($msg): ?>
                            <p><?=$msg?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?=template_footer()?>