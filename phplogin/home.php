<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
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
		<title>Inicio</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body class="loggedin" id="imagen2">
		<nav class="navtop">
			<div>
				<h1>Pagina Web</h1>
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
			<h2>Inicio</h2>
			<p>Bienvenido de vuelta, <?=htmlspecialchars($_SESSION['name'], ENT_QUOTES)?>!</p>
		</div>
	</body>
</html>