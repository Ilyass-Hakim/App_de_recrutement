<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nomLoisir = isset($_POST['nomLoisir']) ? $_POST['nomLoisir'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO loisir VALUES (?)');
    $stmt->execute([$nomLoisir]);

    var_dump($stmt);


    
    // Output message
    $msg = 'Created Successfully!';
}
?>
<?=template_header('Create')?>

    <main>
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="job-detail mt-2 p-4">
                        <div class="custom-form">
                            <form action="create6.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group app-label">
                                            <label for="nomLoisir" class="text-muted">Loisir</label>
                                            <input name="nomLoisir" id="nomLoisir" type="text" class="form-control resume" placeholder="mon loisir">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <input type="submit" id="submit" name="send" class="submitBnt btn btn-secondary mt-5" value="Create loisir">
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




<!--
<div class="content update">
	<h2>Create Contact</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="name" placeholder="John Doe" id="name">
        <label for="email">Email</label>
        <label for="phone">Phone</label>
        <input type="text" name="email" placeholder="johndoe@example.com" id="email">
        <input type="text" name="phone" placeholder="2025550143" id="phone">
        <label for="title">Title</label>
        <label for="created">Created</label>
        <input type="text" name="title" placeholder="Employee" id="title">
        <input type="datetime-local" name="created" value="<?php//date('Y-m-d\TH:i')?>" id="created">
        <input type="submit" value="Create">
    </form>
                            -->
    <?php //if ($msg): ?>
    <p><?php//$msg?></p>
    <?php //endif; ?>
<!--</div>-->

<?=template_footer()?>