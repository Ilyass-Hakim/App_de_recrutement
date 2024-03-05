<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['nomFormation'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $nomFormation = isset($_POST['nomFormation']) ? $_POST['nomFormation'] : '';
        $date_debut = isset($_POST['date_debut']) ? $_POST['date_debut'] : '';
        $date_fin = isset($_POST['date_fin']) ? $_POST['date_fin'] : '';
        $diplome = isset($_POST['diplome']) ? $_POST['diplome'] : '';
        $pays = isset($_POST['pays']) ? $_POST['pays'] : '';
        $ville = isset($_POST['ville']) ? $_POST['ville'] : '';
        $etablissement = isset($_POST['etablissement']) ? $_POST['etablissement'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE formation SET  nomFormation = ?, date_debut = ?, date_fin = ?, diplome = ?, pays = ?, ville = ?, etablissement = ? WHERE nomFormation = ?');
        $stmt->execute([$nomFormation, $date_debut, $date_fin, $diplome, $pays, $ville, $etablissement, $_GET['nomformation']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the utilisateur table
    $stmt = $pdo->prepare('SELECT * FROM formation WHERE nomFormation = ?');
    $stmt->execute([$_GET['nomFormation']]);
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
                            <h2>Update User #<?=$contact['nomFormation']?></h2>
                            <form action="update1.php?nomFormation=<?=$contact['nomFormation']?>" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="nomFormation" class="text-muted">nomFormation</label>
                                            <input name="nomFormation" id="nomFormation" type="text" class="form-control resume" placeholder="ma formation" value="<?=$contact['nomFormation']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="date_debut" class="text-muted">date_debut</label>
                                            <input name="date_debut" id="date_debut" type="date" class="form-control resume" value="<?=$contact['date_debut']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="date_fin" class="text-muted">date_fin</label>
                                            <input name="date_fin" id="date_fin" type="date" class="form-control resume" value="<?=$contact['date_fin']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="diplome" class="text-muted">Diplome</label>
                                            <input name="diplome" id="diplome" type="text" class="form-control resume" placeholder="mon diplome" value="<?=$contact['diplome']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="pays" class="text-muted">pays</label>
                                            <select name="pays" id="pays" class="form-control resume" >
                                                <option value="France">France</option>
                                                <option value="Maroc">Maroc</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="ville" class="text-muted">ville</label>
                                            <select name="ville" id="ville" class="form-control resume">
                                                <option value="Casablanca">Casablanca</option>
                                                <option value="Marrakech">Marrakech</option>
                                                <option value="Rabat">Rabat</option>
                                                <option value="Tanger">Tanger</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="etablissement" class="text-muted">Etablissement</label>
                                            <input name="etablissement" id="etablissement" type="text" class="form-control resume" placeholder="mon etablissement" value="<?=$contact['etablissement']?>">
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <input type="submit" id="submit" name="send" class="submitBnt btn btn-secondary mt-5" value="Update formation">
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