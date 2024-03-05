<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['iduser'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
        $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
        $pays = isset($_POST['pays']) ? $_POST['pays'] : '';
        $ville = isset($_POST['ville']) ? $_POST['ville'] : '';
        $age = isset($_POST['age']) ? $_POST['age'] : '';
        $sexe = isset($_POST['sexe']) ? $_POST['sexe'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $login = isset($_POST['login']) ? $_POST['login'] : '';
        $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE utilisateur SET  prenom = ?, nom = ?, pays = ?, ville = ?, age = ?, sexe = ?, email = ?, login = ?, mdp = ? WHERE iduser = ?');
        $stmt->execute([$prenom, $nom, $pays, $ville, $age, $sexe, $email, $login, $mdp, $_GET['iduser']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the utilisateur table
    $stmt = $pdo->prepare('SELECT * FROM utilisateur WHERE iduser = ?');
    $stmt->execute([$_GET['iduser']]);
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
                            <h2>Update User #<?=$contact['iduser']?></h2>
                            <form action="update.php?iduser=<?=$contact['iduser']?>" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="prenom" class="text-muted">prenom</label>
                                            <input name="prenom" id="prenom" type="text" class="form-control resume" placeholder="mon prenom" value="<?=$contact['prenom']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="nom" class="text-muted">nom</label>
                                            <input name="nom" id="nom" type="text" class="form-control resume" placeholder="mon nom" value="<?=$contact['nom']?>">
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
                                            <label for="age" class="text-muted">age</label>
                                            <input name="age" id="age" type="number" class="form-control resume" placeholder="mon age" value="<?=$contact['age']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="sexe" class="text-muted">sexe</label>
                                            <select name="sexe" id="sexe" class="form-control resume">
                                                <option value="Homme">Homme</option>
                                                <option value="Femme">Femme</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="email" class="text-muted">email</label>
                                            <input name="email" id="email" type="text" class="form-control resume" placeholder="mon email" value="<?=$contact['email']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="login" class="text-muted">nom d'utilisateur</label>
                                            <input name="login" id="login" type="text" class="form-control resume" placeholder="nom_d'utilisateur" value="<?=$contact['login']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="mdp" class="text-muted">mot de passe</label>
                                            <input name="mdp" id="mdp" type="password" class="form-control resume" placeholder="votre mot de passe" value="<?=$contact['mdp']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <input type="submit" id="submit" name="send" class="submitBnt btn btn-secondary mt-5" value="Update User">
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