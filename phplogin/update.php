<?php
include 'read.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE accounts SET id = ?, username = ?, email = ? WHERE id = ?');
        $stmt->execute([$id, $username, $email, $_GET['id']]);
        $msg = 'Updated Successfully!';
        header('Location: admin.php');
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$account) {
        exit('Users doesn\'t exist with that ID!');
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
        <div class="register">
            <h2>Update User #<?=$account['id']?></h2>
            <form action="update.php?id=<?=$account['id']?>" method="post">
            <label for="id">ID</label>
                <input type="text" name="id" placeholder="1" value="<?=$account['id']?>" id="id">
                <label for="username">Name</label>
                <input type="text" name="username" placeholder="John Doe" value="<?=$account['username']?>" id="username">
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="johndoe@example.com" value="<?=$account['email']?>" id="email">
                <input type="submit" value="Update">
            </form>
            <?php if ($msg): ?>
            <p><?=$msg?></p>
            <?php endif; ?>
        </div>
    </body>
</html>