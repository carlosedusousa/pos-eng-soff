<?

	require_once 'lib/loader.php';

	if (@$_POST["txt_login"] != "" && @$_POST["psw_senha"] != "") {

		$userlogin = $_POST["txt_login"];
		$passwd = $_POST["psw_senha"];
		$rotina = 5;

		if (true) {
	
			$ses = $global_obj_sessao->authenticate($userlogin, $passwd,$rotina);
	
		} else {
	
			$ses = false;
	
		}
	
		if ($ses) header("Location: index.php");
	
	} else {

		if (isset($_GET["l"])) {

			$global_obj_sessao->logout();
			header("Location: index.php");

		}
	}

	$mesg['erro'] = null;
	if (trim(@$erro_ldap) != "") $mesg['erro'] = $erro_ldap;
	if ($global_obj_sessao->get_erro() != "") $mesg['erro'] = $global_obj_sessao->get_erro();
	if (@$_GET['x'] == 'sessao_expirou') $mesg['erro'] = 'Sess&atilde;o Expirou';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<table align="center" width="80%" cellpading="0" cellspacing="0" border="0">
<head>
	<title>CBMSC - Ebombeiro</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<meta name="author" content="Luana Becker, Carlos Eduardo Sousa">
	<link rel="stylesheet" type="text/css" href="./css/menu.css">
	<link type="text/css" rel="stylesheet" href="./css/calendario.css" />
	<link rel="stylesheet" type="text/css" href="./css/ebombeiro.css">
	<script type="text/javascript"  src="js/calendario.js"></script>
</head>

<body>

<form target="_self" enctype="multipart/form-data" method="post" name="frm_login">

	<tr>
		<td align="center">

		<? include './templates/cabecalho.php'; ?>
		</td>
	</tr>

		<tr>
		<td>


		<table cellspacing="3" cellpadding="2" align="center" border="0"><br><br><br><br><br><br><br>
			<tr>
			<th colspan="2"><font color="#990000">
			    &Aacute;REA RESTRITA</font>
			</th>
			</tr>

			<tr>
				<td align="right">Usu&aacute;rio</td>
				<td><input type="text" class="campo" name="txt_login" value="" size="21" maxlength="20" style="text-transform : none;"></td>
			</tr>
			<tr>
				<td align="right">Senha</td>
				<td><input type="password" class="campo" name="psw_senha" value="" size="21" maxlength="20" style="text-transform : none;"></td>
			</tr>
		</table>
		<table cellspacing="0" cellpadding="5" align="center" border="0">
			<tr>
			<td align="center">&nbsp;</td>
			  <td>
				  <input name="btn_entrar" value="Entrar" type="submit" class="botao">
			  </td>
			</tr>
		</table>
		<table align="center" width="100%" cellpading="0" cellspacing="0" border="0">
		    <br><br><br>
		    </td>
		    </tr>
			    <? if ($mesg['erro']) { ?>
				    <tr style="color : #ff0000;">
					    <td  height="200" colspan="2" align="center">
						    ERRO!!!!!<br>
						    <?=$mesg['erro']?>
					    </td>
				    </tr>
			    <? } else { ?>
				    <td height="200">&nbsp;</td></tr>
			    <? } ?>
			    <? require './templates/rodape.php'; ?>
			    <tr>
		</table>
	</table>
</form>
