<?

//echo "<pre>"; print_r($_REQUEST); echo "</pre>";

  require_once 'lib/loader.php';

  $arquivo = "index.php";
  $conn = new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) die($conn->get_msg());
  $sql = "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) $rotina = $conn->fetch_row();

  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $perfil = $global_obj_sessao->is_perfiled_in();

  if (!$_SESSION['ID_USUARIO'] or !$_SESSION['ID_USUARIO']) header("Location: login.php");

  $pagina_titulo = null;

          
  switch ($_POST['op_menu']) {

    case 'inicial' : $modulo = 'inicial.php'; break;
    case 'cad_edificacao' : $modulo = './modulos/cadastros/edificacoes.php'; $pagina_titulo = 'Cadastro de Edificações'; break;
    case 'exclusao' : $modulo = './modulos/gerencial/excluir.php'; $pagina_titulo = 'Exclusão'; break;
    case 'vist_func_pendent' : $modulo = './modulos/processos/protocolo/pend_funcionamento.php'; $pagina_titulo = 'Protocolo de Funcionamento Pendente'; break;
    case 'vist_func_anual' : $modulo = './modulos/funcionamento/pen_funcionamento.php'; $pagina_titulo = 'Vistoria de Funcionamento'; break;
    case 'vist_func_alt' : $modulo = './modulos/funcionamento/vist_funcionamento.php'; $pagina_titulo = 'Vistoria de Funcionamento Alteração'; break;
    case 'vist_func_anali_pend' : $modulo = './modulos/funcionamento/pen_an_func.php'; $pagina_titulo = 'Vistoria de Funcionamento Análise Pendente'; break;
    case 'vist_soli_anual' : $modulo = './modulos/processos/solicitacoes/solic_funcionamento_local.php'; $pagina_titulo = 'Solicitação de Funcionamento'; break;
    case 'pendenteFuncionamentoChama' : $modulo = './modulos/funcionamento/prot_funcionamento.php'; $pagina_titulo = 'Funcionamento Protocolo Pendente'; break;
    case 'vistoriaPendenteFuncionamento' : $modulo = './modulos/funcionamento/vist_funcionamento.php'; $pagina_titulo = 'Vistoria de Funcionamento Anual'; break;
    case 'efetivo' : $modulo = './modulos/cadastros/efetivo.php'; $pagina_titulo = 'Cadastro de Efetivo'; break;
    //LU>
    case 'solic_habitese' : $modulo = './modulos/habitese/solic_habitese.php'; $pagina_titulo = 'Solicitação de Habite-se'; break;
    case 'vist_habitese' : $modulo = './modulos/habitese/solic_habitese_pend.php'; $pagina_titulo = 'Vistoria de Habite-se'; break;
    case 'vist_habitese2' : $modulo = './modulos/habitese/vist_habitese.php'; $pagina_titulo = 'Vistoria de Habite-se'; break;
    case 'solic_projeto' : $modulo = './modulos/projeto/solic_projeto.php'; $pagina_titulo = 'Solicitação de Projeto'; break;
    case 'analise' : $modulo = './modulos/projeto/solic_pendente.php'; $pagina_titulo = 'Análise'; break;
    case 'analise2' : $modulo = './modulos/projeto/analise.php'; $pagina_titulo = 'Análise'; break;
    case 'cons_analise' : $modulo = './modulos/projeto/cons_analise.php'; $pagina_titulo = ' Consulta Edificação'; break;
    case 'cons_habitese' : $modulo = './modulos/projeto/cons_habitese.php'; $pagina_titulo = ' Consulta Edificação'; break;
    //LU<
    case 'logout' : require 'logout.php'; break;
    default : $modulo = 'inicial.php'; break;

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">


<table align="center" width="80%" cellpading="0" cellspacing="0" border="0">
        <head>
	<title>CBMSC - Ebombeiro</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<meta name="author" content="Luana Becker,Carlos Eduardo Passos de Sousa">
	<link rel="stylesheet" type="text/css" href="./css/menu.css">
	<link rel="stylesheet" type="text/css" href="./css/ebombeiro.css">
        <script type="text/javascript"  src="./js/calendario.js"></script>
       	<script type="text/javascript"  src="./js/sigat_div.js"></script>
       	<script type="text/javascript"  src="./js/menu.js"></script>
       	<script type="text/javascript"  src="./js/editcombo.js"></script>
        </head>
<body>
	<tr>
		<td align="center">

		<? include './templates/cabecalho.php'; ?>
		<? include './templates/menu.php'; ?>

		</td>
			</tr>
			<tr>
				<td align="right">
					<?=$_SESSION['ID_USUARIO']?> | <a href="logout.php"><b>Sair</b></a>&nbsp;
                                        
				</td>
			</tr>
			<tr>
				<td align="center" height="400" valign="top">
					<table align="center" width="100%" border="0">
						<tr>
							<td align="center">
								<? if ($modulo) require $modulo; ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
                        
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td align="center">

					<? require './templates/rodape.php'; ?>
				</td>
			</tr>
			<tr><td height="200">&nbsp;</td></tr>
		</table>
	</body>
</html>

