<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['adresse'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : '';
        $niveau = isset($_POST['niveau']) ? $_POST['niveau'] : '';
        $tel = isset($_POST['tel']) ? $_POST['tel'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE contact SET  adresse = ?, niveau = ?, tel = ? WHERE adresse = ?');
        $stmt->execute([$adresse, $niveau, $tel, $_GET['adresse']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the utilisateur table
    $stmt = $pdo->prepare('SELECT * FROM contact WHERE adresse = ?');
    $stmt->execute([$_GET['adresse']]);
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
                            <h2>Update contact #<?=$contact['adresse']?></h2>
                            <form action="update4.php?adresse=<?=$contact['adresse']?>" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="adresse" class="text-muted">Adresse</label>
                                            <input name="adresse" id="adresse" type="text" class="form-control resume" placeholder="mon adresse" value="<?=$contact['adresse']?>">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="niveau" class="text-muted">Niveau</label>
                                            <input name="niveau" id="niveau" type="text" class="form-control resume" placeholder="mon niveau" value="<?=$contact['niveau']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="tel" class="text-muted">Telephone</label>
                                            <input name="tel" id="tel" type="number" class="form-control resume" placeholder="0656-281566" value="<?=$contact['tel']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <input type="submit" id="submit" name="send" class="submitBnt btn btn-secondary mt-5" value="Update contact">
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