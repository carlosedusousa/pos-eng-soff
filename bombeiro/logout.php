<?

	session_start();

	unset($_SESSION['ID_USUARIO']);
	unset($_SESSION['ID_PERFIL']);

	header("Location: login.php");

?>