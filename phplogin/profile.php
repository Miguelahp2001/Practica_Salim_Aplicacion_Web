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
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions, so instead, we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();

?>

<html>
	<head>
		<meta charset="utf-8">
		<title>Perfiles</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body class="loggedin" id="imagen3">
		<nav class="navtop">
			<div>
				<h1>Perfiles</h1>
				<?php                
                if ($id == 1) {
                    ?>
                    <a href="admin.php"><i class="fas fa-address-book"></i>Admin</a>
                    <a href="home.php"><i class="fas fa-house"></i>Home</a>
					<a href="home.php"><i class="fas fa-user-circle"></i>Profile</a>
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
			<h2>Tu Perfil</h2>
			<div>
				<p>Los detalles de tu cuenta son:</p>
				<table>
					<tr>
						<td>Usuario:</td>
						<td><?=htmlspecialchars($_SESSION['name'], ENT_QUOTES)?></td>
					</tr>
					<tr>
						<td>Contraseña:</td>
						<td><?=htmlspecialchars($password, ENT_QUOTES)?></td>
					</tr>
					<tr>
						<td>Correo:</td>
						<td><?=htmlspecialchars($email, ENT_QUOTES)?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>