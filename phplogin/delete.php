<?php
include 'funciones.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$account) {
        exit('accounts doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM accounts WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the User!';
            header('Location: admin.php');
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: admin.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Update</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <link href="register.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="content delete">
	        <h2>Delete Contact #<?=$account['id']?></h2>
            <?php if ($msg): ?>
            <p><?=$msg?></p>
            <?php else: ?>
	        <p>Are you sure you want to delete contact #<?=$account['id']?>?</p>
            <div class="yesno">
                <a href="delete.php?id=<?=$account['id']?>&confirm=yes">Yes</a>
                <a href="delete.php?id=<?=$account['id']?>&confirm=no">No</a>
            </div>
                <?php endif; ?>
        </div>
    </body>
</html>