<?

 //echo "<pre>"; print_r($_POST); echo "</pre>";

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


$campos_preenchidos = true;
foreach ($_POST as $indice => $valor){
    if ($valor == null and $indice != 'hdn_id_efetivo' and $indice!='txt_usuario' and $indice!='txt_nm_usuario') {
	$campos_nao_preenchidos[] = $indice;
        $campos_preenchidos = false;
    }
}

if (isset($_POST["btn_enviar"])) {

    if (!$campos_preenchidos) {

	echo "campos nao preenchidos<br>";	
	foreach ($campos_nao_preenchidos as $i => $v) echo "<b>$v</b><br>";

    } else {

// 	$LOGIN		        =	($_POST["txt_usuario"]);
	$ID_CIDADE              =       ($_POST["cmb_id_cidade"]);
	$PELOTAO                =       ($_POST["txt_pelotao"]);
// 	$NM_EFETIVO		=	($_POST["txt_nm_usuario"]);
	$PERFIL   		=	$_POST["cmb_perfil"];
	$POSTO  		=	($_POST["cmb_posto"]);
        $SENHA                  =       md5($_POST['senha']);
        $CONFIRME               =       md5($_POST['senha_confirma']);
	$BATALHAO      		=	($_POST["cmb_batalhao"]);
	$COMPANHIA      	=       ($_POST["txt_compania"]);
	$GRUPAMENTO  		=	($_POST["txt_grupamento"]);
	$FONE      		=	($_POST["txt_fone"]);
	$EMAIL      		=	($_POST["txt_email"]);
	$ID_EFETIVO             =       ($_POST["hdn_id_efetivo"]);
	$LOGIN		        =	($_POST["txt_login"]);
	$NM_EFETIVO		=	($_POST["txt_nome"]);
	
	If($SENHA != $CONFIRME) {

		echo "confirmação da senha incorreta";

	} elseIf($_POST["btn_enviar"] == 'Inserir') {
		
	$sql = "INSERT INTO EFETIVO (ID_CIDADE, LOGIN, PELOTAO, NM_EFETIVO, FONE, EMAIL, PERFIL, POSTO, SENHA, BATALHAO, COMPANHIA, GRUPAMENTO) VALUES ('$ID_CIDADE', '$LOGIN', '$PELOTAO', '$NM_EFETIVO', '$FONE', '$EMAIL', '$PERFIL', '$POSTO', '$SENHA', '$BATALHAO', '$COMPANHIA', '$GRUPAMENTO')";
// 		echo "sql: $sql";exit;
		$res = mysql_query($sql);
	?>
	<script language="javascript" type="text/javascript">
	alert("Registro inserido com sucesso");
	</script>
	 <meta http-equiv="refresh" content="0; index.php"><?
	} elseif($_POST["btn_enviar"] == 'Alterar') {
// echo "ok"; exit;
	$sql ="UPDATE EFETIVO SET ID_CIDADE= '$ID_CIDADE', LOGIN= '$LOGIN', FONE= '$FONE', EMAIL= '$EMAIL',  PELOTAO='$PELOTAO', NM_EFETIVO= '$NM_EFETIVO', PERFIL= '$PERFIL', POSTO= '$POSTO', SENHA= '$SENHA', BATALHAO= '$BATALHAO', COMPANHIA= '$COMPANHIA', GRUPAMENTO= '$GRUPAMENTO' WHERE EFETIVO.ID_EFETIVO= '$ID_EFETIVO' AND EFETIVO.ID_CIDADE= '$ID_CIDADE'";
//  		echo "sql: $sql";exit;
		$res = mysql_query($sql);
	?>
	<script language="javascript" type="text/javascript">
	alert("Registro alterado com sucesso");
	</script>
	<?
	?><meta http-equiv="refresh" content="0; index.php"><?
	}

    }

}
   if($_POST["btn_excluir"] == 'Exclui') {
	$ID_CIDADE              =       ($_POST["cmb_id_cidade"]);
	$PELOTAO                =       ($_POST["txt_pelotao"]);
// 	$NM_EFETIVO		=	($_POST["txt_nm_usuario"]);
	$PERFIL   		=	$_POST["cmb_perfil"];
	$POSTO  		=	($_POST["cmb_posto"]);
        $SENHA                  =       md5($_POST['senha']);
        $CONFIRME               =       md5($_POST['senha_confirma']);
	$BATALHAO      		=	($_POST["cmb_batalhao"]);
	$COMPANHIA      	=       ($_POST["txt_compania"]);
	$GRUPAMENTO  		=	($_POST["txt_grupamento"]);
	$FONE      		=	($_POST["txt_fone"]);
	$EMAIL      		=	($_POST["txt_email"]);
	$ID_EFETIVO             =       ($_POST["hdn_id_efetivo"]);
	$LOGIN		        =	($_POST["txt_login"]);
	$NM_EFETIVO		=	($_POST["txt_nome"]);

	$sql ="DELETE FROM EFETIVO WHERE EFETIVO.ID_EFETIVO= '$ID_EFETIVO' AND EFETIVO.ID_CIDADE= '$ID_CIDADE'";
	$res = mysql_query($sql);
	?>
	<script language="javascript" type="text/javascript">
	alert("Registro excluído com sucesso");
	</script>
	<?
	?><meta http-equiv="refresh" content="0; index.php"><?
	}
	
?>
<script language="javascript" type="text/javascript">

    function consultaReg(campo1,campo2,arq) {
	var frm=document.frm_efetivo;
            if ((campo1.value!="") && (campo2.value!="")) {
		window.open(arq+"?campo1="+campo1.value+"&campo2="+campo2.value,"janela","top=5000,left=5000,screenY= 5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }
</script>


<form target="_self" enctype="multipart/form-data" method="post" name="frm_efetivo">
  <input type="hidden" name="op_menu" value="efetivo">
  <table style="width: 100%; text-align: left;" border="0" cellpadding="2" cellspacing="0">
     <tr>
      <td>
        <fieldset>
          <legend>Pesquisa de Efetivos</legend>
          <table border="0" width="100%" cellpadding="2">
             <tr>
                <td>Login</td>
                <td><input type="text" name="txt_usuario" size="21" maxlength="20"></td>
                <td align="right">Nome</td>
                <td><input type="text" name="txt_nm_usuario" size="50" maxlength="100" onblur="consultaReg(this,document.frm_efetivo.txt_usuario,'modulos/cadastros/consulta_efetivo.php')"></td>
            </tr>
</table>
</fieldset>
<fieldset>
          <legend>Cadastro de Efetivos</legend>
 <table cellpadding="2" cellspacing="0">
	     <tr>
                <td>Login</td>
                <td><input type="text" name="txt_login" size="21" maxlength="20"></td>
                <td align="right">Nome</td>
                <td><input type="text" name="txt_nome" size="50" maxlength="100"></td>
            </tr>
   	   <tr>
         <td>Perfil de Acesso</td>
         <td>
           <select name="cmb_perfil">
            <option value="">------------</option>
	    <option value="Analista">Analista</option>
            <option value="Vistoriador">Vistoriador</option>
           </select>
         </td>
          <td align="right">Posto</td>
          <td>
           <select name="cmb_posto">
           <option value="">------------</option>
	   <option value="">Coronel</option>
	   <option value="Tenente Coronel">Tenente Coronel</option>
	   <option value="Major">Major</option>
	   <option value="Capitão">Capitão</option>
	   <option value="1º Tenente">1º Tenente</option>
	   <option value="2º Tenente">2º Tenente</option>
	   <option value="Aspirante">Aspirante</option>
	   <option value="Cadete">Cadete</option>
	   <option value="Sub-tenente">Sub-tenente</option>
	   <option value="1ºSargento">1ºSargento</option>
	   <option value="2ºSargento">2ºSargento</option>
	   <option value="3ºSargento">3ºSargento</option>
	   <option value="Cabo">Cabo</option>
	   <option value="Soldado">Soldado</option>
           <option value="Civil">Civil</option>
	   </select>
          </td>
              </tr>
              <tr>
                <td>Batalhão</td>
                <td>
                <select name="cmb_batalhao">
                  <option value="">-------</option>
                  <option value="1º BBM">1º BBM</option>
                </select>
                </td>
                <td align="right">Compania</td>
                <td>
                <input type="text" name="txt_compania">
               </select>
                </td>
              </tr>
              <tr>
	         <td>Pelotão</td>
                 <td>
   		  <input type="text" name="txt_pelotao">
                </td>
                 <td align="right">Grupamento</td>
                 <td>
                  <input type="text" name="txt_grupamento">
                </td>
              </tr>
  	      <tr>          
      		<td>Cidade Lotação</td>
          	<td><select name="cmb_id_cidade">
		   <option value="">-------</option>
                   <?
		    $sql= "select ID_CIDADE, NM_CIDADE from CADASTROS.CIDADE ";
		    $res = mysql_query($sql);
 		    while ($r = mysql_fetch_assoc($res)) {
                        ?><option value="<?=$r["ID_CIDADE"]?>"><?=$r["NM_CIDADE"]?></option><?
                    }
		    ?>
                 </select>
             </td>
		<td align ="right">Fone</td>
                <td><input type="text" name="txt_fone" size="13" maxlength="12"></td>
	      </tr>  
              <tr>
                <td>Senha</td>
                <td><input type="password" name="senha"></td>
                <td align="right">Confirme</td>
                <td><input type="password" name="senha_confirma"></td>
              </tr>
	      <tr>
              	<td>E-mail</td>
              	<td colspan="2"><input type="text" name="txt_email" size="50"></td>
 	       	<td colspan="2"><input type="hidden" name="hdn_id_efetivo"></td> 
	     </tr>
        </fieldset>
      	</td>
     </tr>
</table>
 <tr valign="top" align="center">
      <td>
        <table width="50%" cellspacing="0" border="0" cellpadding="0" align="center">
          <tr align="center" valign="center">
            <td>
             	<input type="submit" name="btn_enviar" value="Inserir" align="middle">
            </td>
            <td>
              <input type="reset" name="btn_limpar" value="Limpar" align="middle" title="Limpa o formul&aacute;rio">
	    <td>
              <input type="submit" name="btn_excluir" value="Excluir" align="middle">
            </td>
            </td>
          </tr>
        </table>
    </tr>
  </form>
