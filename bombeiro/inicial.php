<br><br><br>
<h1>
    Seja Bem Vindo</h1><br>
    Voc&ecirc; est&aacute; logado com o usu&aacute;rio(a) <b><?=$_SESSION['ID_USUARIO'] ?><br></b>
    Seu perfilamento &eacute; <b><i><?

switch ($_SESSION['ID_PERFIL']) {

      case '1' : echo("Administrador"); break;
      case '2' : echo("Gerente");       break;
      case '3' : echo("Analista");      break;
      case '4' : echo("Usuario");       break;
}?>