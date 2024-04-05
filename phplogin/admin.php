<?php
include 'read.php';
// We need to use sessions, so you should always start sessions using the below code.
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Usuario no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
    header('Location: login.php');
    exit;
}

// Verificar si el ID de usuario está establecido en la sesión
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    // Ahora puedes usar $id como desees en esta página
} else {
    // El ID de usuario no está establecido en la sesión, manejar el caso según sea necesario
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Home Page</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </head>
    <body class="loggedin">
        <nav class="navtop">
            <div>
                <h1>Website Title</h1>
                <?php                
                if ($id == 1) {
                    ?>
                    <a href="admin.php"><i class="fas fa-address-book"></i>Admin</a>
                    <a href="home.php"><i class="fas fa-house"></i>Home</a>
                    <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                    <?php
                } else {
                    ?>
                    <a href="home.php"><i class="fas fa-house"></i>Home</a>
                    <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                    <?php
                }
                ?>
            </div>
        </nav>
        <div class="content">
            <h2>Home Page</h2>
            <p>Welcome back, <?=htmlspecialchars($_SESSION['name'], ENT_QUOTES)?>!</p>
        </div>
        <div class="content read">
	<h2>Users</h2>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>username</td>
                <td>Email</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accounts as $account):?>
            <tr>
                <td><?=$account['id']?></td>
                <td><?=$account['username']?></td>
                <td><?=$account['email']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$account['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$account['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_accounts): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>
    </body>
</html>