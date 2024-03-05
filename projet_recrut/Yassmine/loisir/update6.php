<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['nomLoisir'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $nomLoisir = isset($_POST['nomLoisir']) ? $_POST['nomLoisir'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE loisir SET  nomLoisir = ?, niveau = ? WHERE nomLoisir = ?');
        $stmt->execute([$nomLoisir, $_GET['nomLoisir']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the utilisateur table
    $stmt = $pdo->prepare('SELECT * FROM loisir WHERE nomLoisir = ?');
    $stmt->execute([$_GET['nomLoisir']]);
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
                            <h2>Update profil #<?=$contact['nomLoisir']?></h2>
                            <form action="update6.php?nomLoisir=<?=$contact['nomLoisir']?>" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="nomLoisir" class="text-muted">Loisir</label>
                                            <input name="nomLoisir" id="nomLoisir" type="text" class="form-control resume" placeholder="mon loisir" value="<?=$contact['nomLoisir']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <input type="submit" id="submit" name="send" class="submitBnt btn btn-secondary mt-5" value="Update profil">
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