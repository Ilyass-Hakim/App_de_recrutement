<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM langue ORDER BY nomLangue LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_contacts = $pdo->query('SELECT COUNT(*) FROM langue')->fetchColumn();
?>
<?=template_header('Read')?>

    <main>
        <div class="container">
            <table class="table">
                <caption>Liste des langues</caption>
                <thead>
                    <tr>
                        <th scope="col">nomlangue</th>
                        <th scope="col">niveau</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($users as $user): ?>
                            <th scope="row"><?=$user['nomLangue']?></th>
                            <td><?=$user['nomLangue']?></td>
                            <td><?=$user['niveau']?></td>
                            <td class="actions">
                                <a href="update3.php?nomLangue=<?=$user['nomLangue']?>" class="edit" style="padding: 20px;"><i class="bi bi-pencil-fill"></i></a>
                                <a href="delete3.php?nomLangue=<?=$user['nomLangue']?>" class="trash" style="padding: 20px;"><i class="bi bi-trash"></i></a>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
                <div class="pagination">
                    <?php if ($page > 1): ?>
                    <a href="read3.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
                    <?php endif; ?>
                    <?php if ($page*$records_per_page < $num_contacts): ?>
                    <a href="read3.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
                    <?php endif; ?>
                </div>
            </table>
        </div>
    </main>

<!--
<div class="content read">
	<h2>Read Contacts</h2>
	<a href="create.php" class="create-contact">Create Contact</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>prenom</td>
                <td>nom</td>
                <td>pays</td>
                <td>age</td>
                <td>sexe</td>
                <td>email</td>
                <td>login</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php // foreach ($users as $user): ?>
            <tr>
                <td><?php //$user['iduser']?></td>
                <td><?php //$user['prenom']?></td>
                <td><?php //$user['nom']?></td>
                <td><?php //$user['pays']?></td>
                <td><?php //$user['age']?></td>
                <td><?php //$user['sexe']?></td>
                <td><?php //['email']?></td>
                <td><?php //$user['login']?></td>
                <td class="actions">
                    <a href="update.php?id=<?php // user['iduser']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?php //$user['iduser']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php //endforeach; ?>
        </tbody>
    </table>
	
</div>
            -->

<?=template_footer()?>