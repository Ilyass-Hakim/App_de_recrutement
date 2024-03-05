<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['poste'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $nomFormation = isset($_POST['poste']) ? $_POST['poste'] : '';
        $date_debut = isset($_POST['date_debut']) ? $_POST['date_debut'] : '';
        $date_fin = isset($_POST['date_fin']) ? $_POST['date_fin'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $nom_entreprise = isset($_POST['nom_entreprise']) ? $_POST['nom_entreprise'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE experience SET  poste = ?, date_debut = ?, date_fin = ?, description = ?, nom_entreprise = ?');
        $stmt->execute([$poste, $date_debut, $date_fin, $description, $nom_entreprise, $_GET['poste']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the utilisateur table
    $stmt = $pdo->prepare('SELECT * FROM experience WHERE poste = ?');
    $stmt->execute([$_GET['poste']]);
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
                            <h2>Update User #<?=$contact['poste']?></h2>
                            <form action="update7.php?poste=<?=$contact['poste']?>" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="poste" class="text-muted">poste</label>
                                            <input name="poste" id="poste" type="text" class="form-control resume" placeholder="mon poste" value="<?=$contact['poste']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="date_debut" class="text-muted">date de debut</label>
                                            <input name="date_debut" id="date_debut" type="date" class="form-control resume" value="<?=$contact['date_debut']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="date_fin" class="text-muted">date de fin</label>
                                            <input name="date_fin" id="date_fin" type="date" class="form-control resume" value="<?=$contact['date_fin']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="description" class="text-muted">description</label>
                                            <input name="description" id="description" type="text" class="form-control resume" placeholder="ma description" value="<?=$contact['description']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="nom_entreprise" class="text-muted">Etablissement</label>
                                            <input name="nom_entreprise" id="nom_entreprise" type="text" class="form-control resume" placeholder="mon nom_entreprise" value="<?=$contact['nom_entreprise']?>">
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <input type="submit" id="submit" name="send" class="submitBnt btn btn-secondary mt-5" value="Update experience">
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