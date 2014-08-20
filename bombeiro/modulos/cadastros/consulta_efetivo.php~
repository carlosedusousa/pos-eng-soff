<?
// echo "ok";exit;
    require './../../requires/loader.php';
    require_once 'lib/loader.php';

    $arquivo = "efetivo.php";
    $conn = new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
    if ($conn->get_status()==false) die($conn->get_msg());
    $sql = "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
    $conn->query($sql);
    $rows_rotina=$conn->num_rows();
    if ($rows_rotina>0) $rotina = $conn->fetch_row();

    $global_obj_sessao->load($rotina["ID_ROTINA"]);
    $perfil = $global_obj_sessao->is_perfiled_in();

    $NM_EFETIVO = $_GET["campo1"];
    $LOGIN = $_GET["campo2"];
   
    if ($NM_EFETIVO && $LOGIN) {

	$sql = "SELECT ID_EFETIVO, ID_CIDADE, LOGIN, PELOTAO, NM_EFETIVO, PERFIL, POSTO, BATALHAO, COMPANHIA, GRUPAMENTO, FONE, EMAIL, SENHA FROM ACESSOS.EFETIVO WHERE LOGIN = '$LOGIN' AND NM_EFETIVO = '$NM_EFETIVO'";
	echo "sql: $sql";//exit;
        $res = mysql_query($sql);
	if ($r = mysql_fetch_assoc($res)) {
	    $efetivo = $r;
	}

	//echo "<pre>"; print_r($edificacao); echo "</pre>";

    }

if ($efetivo) { ?>
	<script language="javascript" type="text/javascript">
		var frm = window.opener.document.frm_efetivo;
		frm.txt_usuario.value="<?=$efetivo['LOGIN']?>";
		frm.txt_login.value="<?=$efetivo['LOGIN']?>";
		frm.cmb_id_cidade.value="<?=$efetivo['ID_CIDADE']?>";
		frm.txt_pelotao.value="<?=$efetivo['PELOTAO']?>";
		frm.txt_nm_usuario.value="<?=$efetivo['NM_EFETIVO']?>";
		frm.txt_nome.value="<?=$efetivo['NM_EFETIVO']?>";
		frm.txt_email.value="<?=$efetivo['EMAIL']?>";
		frm.cmb_perfil.value="<?=$efetivo['PERFIL']?>";
		frm.cmb_posto.value="<?=$efetivo['POSTO']?>";
		frm.cmb_batalhao.value="<?=$efetivo['BATALHAO']?>";
		frm.txt_compania.value="<?=$efetivo['COMPANHIA']?>";
		frm.txt_grupamento.value="<?=$efetivo['GRUPAMENTO']?>";
		frm.txt_fone.value="<?=$efetivo['FONE']?>";
		frm.senha.value="<?=$efetivo['SENHA']?>";
		frm.hdn_id_efetivo.value="<?=$efetivo['ID_EFETIVO']?>";

		frm.btn_enviar.value="Alterar";
 		frm.btn_excluir.value="Exclui";
 		window.close();
	</script>	
<? } else { ?>
	<script language="javascript" type="text/javascript">
		var frm = window.opener.document.frm_efetivo;
		frm.btn_enviar.value="Inserir";
		frm.reset();
		window.opener.alert('Registro não encontrado');
// 		window.close();
	</script>	
<? } ?>
