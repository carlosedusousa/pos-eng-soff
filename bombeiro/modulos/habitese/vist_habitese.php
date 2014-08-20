<?	//echo "<pre>"; print_r($_POST); echo "</pre>";

$erro = "";
  require_once 'lib/loader.php';

  $arquivo = "solic_funcionamento.php";
  $conn = new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) die($conn->get_msg());

  $sql = "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  $res = $conn->query($sql);
  $rows_rotina = $conn->num_rows();
  if ($rows_rotina>0) $rotina = $conn->fetch_row();

  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();


  	$NM_SOLICITANTE  	=	($_POST["txt_nm_solicitante"]);
	$FONE			=	($_POST["txt_fone"]);
	$EMAIL			=	($_POST["txt_email"]);
	$NM_EDIFICACAO		=	($_POST["txt_nm_edificacao"]);
	$NM_LOGRADOURO		=	($_POST["txt_nm_logradouro"]);
	$NR_CEP			=	($_POST["txt_cep"]);
	$NM_BAIRRO		=	($_POST["txt_bairro"]);
	$NR			=	($_POST["txt_nr"]);
	$AREA_TOTAL		=	($_POST["txt_area"]);
	$PARECER		=	($_POST["cmb_parecer"]);
	$VISTORIADOR		=	($_POST["txt_nm_vist"]);
	$DESC    		=	($_POST["txa_desc"]);
	$STATUS                 = 	'V';
	$AREA_TOTAL		=	($_POST["txt_area"]);
        $AREA_PARCIAL           =       ($_POST["txt_area_parcial"]);
// 	$PARECER		=	'DEFERIDO'; 

if (($_POST["hdn_id_solic_habitese"]!="") && ($_POST["hdn_id_cidade"]!="") ){

  $CIDADE= $_POST["hdn_id_cidade"];
  $SOLICITACAO= $_POST["hdn_id_solic_habitese"];

// 	$conn2 = new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
      $sql = "SELECT ".
	TBL_SOL_HABITESE.".NM_SOLICITANTE, ".
	TBL_SOL_HABITESE.".ID_SOLIC_HABITESE, ".
	TBL_SOL_HABITESE.".EMAIL_SOLICITANTE, ".
	TBL_SOL_HABITESE.".FONE_SOLICITANTE, ".
	TBL_SOL_HABITESE.".CPF_CNPJ_SOLICITANTE, ".
	TBL_SOL_HABITESE.".NM_EDIFICACAO, ".
	TBL_SOL_HABITESE.".NM_FANTASIA, ".
	TBL_SOL_HABITESE.".NM_LOGRADOURO, ".
	TBL_SOL_HABITESE.".NR, ".
	TBL_SOL_HABITESE.".NR_CEP, ".
	TBL_SOL_HABITESE.".AREA_TOTAL, ".
	TBL_SOL_HABITESE.".AREA_PARCIAL, ".
	TBL_SOL_HABITESE.".NM_BAIRRO, ".
	TBL_SOL_HABITESE.".STATUS, ".
	TBL_SOL_HABITESE.".DATA, ".
	TBL_CIDADE.".ID_CIDADE, ".
	TBL_CIDADE.".NM_CIDADE ".
      "FROM ".TBL_SOL_HABITESE." ".
	"JOIN ".TBL_CIDADE." USING (ID_CIDADE) ".
      "WHERE ".
	TBL_SOL_HABITESE.".ID_SOLIC_HABITESE = '$SOLICITACAO' AND ".
	TBL_SOL_HABITESE.".ID_CIDADE = '$CIDADE' ".
      ";"; 

      $conn->query($sql);
      if ($r = $conn->fetch_row()) $solicitacao = $r;

//FALTA ARRUMAR AEXIBIÇÃO DOSQL

}
if($_POST["btn_enviar"] and $_POST["txt_re"]){
	$sql= "UPDATE SOLICITACAO.SOLIC_HABITESE SET PARECER='$PARECER',`DESC`='$DESC', VISTORIADOR='$VISTORIADOR',STATUS='$STATUS' WHERE ID_SOLIC_HABITESE='$SOLICITACAO' AND ID_CIDADE='$CIDADE'";
// 	echo "$sql";
 	$res = mysql_query($sql);

$sql = "UPDATE EDIFICACOES.EDIFICACOES SET NM_EDIFICACAO='$NM_EDIFICACAO', NM_LOGRADOURO= '$NM_LOGRADOURO', NR_CEP= '$NR_CEP', NM_BAIRRO= '$NM_BAIRRO', NR= '$NR', AREA_TOTAL= '$AREA_TOTAL' WHERE EDIFICACOES.ID_EDIFICACAO= '$RE' AND EDIFICACOES.ID_CIDADE= '$CIDADE'";
//  		echo "sql: $sql";exit;
		$res = mysql_query($sql);
?>
<script language="javascript" type="text/javascript">
	alert('Análise enviada com sucesso');
</script>
<meta http-equiv="refresh" content="0; index.php">
<?}?>
<script language="javascript" type="text/javascript">
function cons_edif_vist_habitese(cidade,edificacao,arq) {
var frm=document.frm_habitese;
  if ((cidade.value!="") && (edificacao.value!="")) {
 window.open(arq+"?cidade="+cidade.value+"&edificacao="+edificacao.value,"consulrot","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
       }
     }
</script>

     <form target="_self" enctype="multipart/form-data" method="post" name="frm_habitese">
  	<input type="hidden" name="hdn_id_solic_habitese" value="<?=$_POST["hdn_id_solic_habitese"]?>">
	<input type="hidden" name="hdn_id_cidade" value="<?=$_POST["hdn_id_cidade"]?>">
        <input type="hidden" name="op_menu" value="vist_habitese2">
      <table style="width: 100%; text-align: left;" border="0" cellpadding="2" cellspacing="0">
     <tr>
      <td>
        <fieldset>
          <legend>Vistoria de habite-se</legend>
          <table border="0" width="58%" cellpadding="2">
            <tr>
              <td align ="right">Nº Solicita&ccedil;&atilde;o</td>
              <td><input type="text" name="txt_solic" size="20" maxlength="100" ></td>
              <td align ="right">Cidade</td>
              <td><input type="text" name="txt_cidade" size="20" maxlength="18"  value=""></td>
            </tr>
   	  </table>
        </fieldset>
      </td>
    </tr>    
    <tr>
      <td>
        <fieldset>
          <legend>Solicitante</legend>
          <table border="0" cellspacing="0"  width="90%"  align="center" cellpadding="2">
            <tr>
              <td align ="right">Nome</td>
              <td><input type="text" name="txt_nm_solicitante" size="50" maxlength="100" ></td>
              <td align ="right">CNPJ/CPF</td>
              <td><input type="text" name="txt_cpf" size="20" maxlength="18"  value=""></td>
            </tr>
             <tr>
             <td align ="right">E-mail</td>
              <td><input type="text" name="txt_email" size="50" maxlength="100"  style="text-transform : none;"></td>
	      <td align ="right">Fone</td>
              <td><input type="text" name="txt_fone" size="13" maxlength="12" ></td>            </tr>
          </table>
        </fieldset>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="vertical-align: top;">
        <fieldset>
          <legend>Edifica&ccedil;&atilde;o</legend>
          <TABLE width="90%" cellspacing="0" border="0" cellpadding="2">
            <tr>
              <TD align="right">Nome</TD>
              <TD><INPUT type="text" name="txt_nm_edificacao" size="30" maxlength="100" ></td>
              <TD align="right">RE</TD>
              <TD><INPUT type="text" name="txt_re" size="20" maxlength="50"></TD>
	     <td>
              <input type="button" name="btn_enviar" value="Pesquisar" align="middle" onclick="cons_edif_vist_habitese(document.frm_habitese.hdn_id_cidade,document.frm_habitese.txt_nm_edificacao,'modulos/habitese/cons_habitese.php')">
            </td>        
            </tr>
            <tr>
              <td  align="right" width="100">
		Logradouro
	      	  </td>
              <td>
                <input type="text" name="txt_nm_logradouro" size="50" maxlength="100" >
              </td>
              <td align="right">Nº</td>
              <td>
                <input type="text" name="txt_nr" size="5" maxlength="6" >
              </td>
            </tr>
            <tr>
	          		<td align="right">CEP</td>
				<td><input type="text" name="txt_cep" size="9" maxlength="10" ></td>
          			<td align="right">Bairro</td>
				<td><input type="text" name="txt_bairro" size="20" maxlength="50" ></td>
             <tr>    
		  <td align="right">&Aacute;rea Total Construida</td>
                  <td><input type="text" name="txt_area" size="11" maxlength="12" align="right" ><em>(m²)</em>
                  </td>
		
		  <td align="right">&Aacute;rea Parcial</td>
                  <td><input type="text" name="txt_area_parcial" size="11" maxlength="12" align="right" ><em>(m²)</em>
                  </td>
		</tr>
	   </tr>
          </table>
          </fieldset>
	   <fieldset>
                    <legend>Vistoria</legend>
                    <table width="90%" cellspacing="0" cellpadding="2"  border="0" align="center">
			<tr>
  			    <td align="right">Parecer</td>
	                    <td><select name="cmb_parecer">
                            <option value="0">--------</option>
                            <option value="Deferido">Deferido</option>
                            <option value="Indeferido">Indeferido</option>
                       </tr>
			   </select>
                  	   </td>
		       <tr>
			<td align="right">Nome vistoriador</td>                        
			<td><input type="text" name="txt_nm_vist" size="50" maxlength="100"></td>
                     </tr>
                      <tr>
			<td align="right">Observa&ccedil;&atilde;o</td>
			<td><textarea name="txa_desc" cols="70" rows="6" ></textarea></td>
		    </tr>
                    </tr>
                  </td>
              </tr>
            </table>
	</fieldset>
	</fieldset>
        </fieldset>
      </tr>
    </tr>
    <tr valign="top" align="center">
      <td>
        <table width="50%" cellspacing="0" border="0" cellpadding="0" align="center">
          <tr align="center" valign="center">
            <td>
              <input type="submit" name="btn_enviar" value="Enviar" align="middle" title="Confirma a Solicita&ccedil;&atilde;o de projeto">
            </td>
            <td>
              <input type="reset" name="btn_limpar" value="Limpar" align="middle" title="Limpa o formul&aacute;rio">
            </td>
          </tr>
        </table>
    </tr>
  </table>
  </form>
<? if ($solicitacao) { ?>

	<script language="javascript" type="text/javascript">
		var frm = document.frm_habitese;
		frm.txt_solic.value="<?=$solicitacao['ID_SOLIC_HABITESE']?>";
		frm.txt_cidade.value="<?=$solicitacao['NM_CIDADE']?>";
		frm.txt_cpf.value="<?=$solicitacao['CPF_CNPJ_SOLICITANTE']?>";
		frm.txt_nm_solicitante.value="<?=$solicitacao['NM_SOLICITANTE']?>";
		frm.txt_fone.value="<?=$solicitacao['FONE_SOLICITANTE']?>";
		frm.txt_email.value="<?=$solicitacao['EMAIL_SOLICITANTE']?>";
		frm.txt_nm_edificacao.value="<?=$solicitacao['NM_EDIFICACAO']?>";
		frm.txt_nm_logradouro.value="<?=$solicitacao['NM_LOGRADOURO']?>";
		frm.txt_nr.value="<?=$solicitacao['NR']?>";
		frm.txt_bairro.value="<?=$solicitacao['NM_BAIRRO']?>";
		frm.txt_cep.value="<?=$solicitacao['NR_CEP']?>";
		frm.txt_area_total.value="<?=$solicitacao['AREA_TOTAL']?>";
		frm.txt_area_parcial.value="<?=$solicitacao['AREA_PARCIAL']?>";
		window.close();
	</script>	
<? } else { ?>
	<script language="javascript" type="text/javascript">
		alert('Nenhuma Análise pendente');
 </script>	
<? } ?>

