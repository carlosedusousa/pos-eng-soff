<?
// echo "<pre>"; print_r($_POST); echo "</pre>";


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

// echo $usuario;
 
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
	$RE    		=	($_POST["txt_re"]);
	$STATUS                 = 'V';

// $PARECER		=	'DEFERIDO';





if (($_POST["hdn_id_solic_projeto"]!="") && ($_POST["hdn_id_cidade"]!="") ){
  $CIDADE= $_POST["hdn_id_cidade"];
  $SOLICITACAO= $_POST["hdn_id_solic_projeto"];

	$sql="SELECT ".TBL_SOLICITACAO.".NM_SOLICITANTE, ".TBL_SOLICITACAO.".ID_SOLIC_PROJETO, ".TBL_SOLICITACAO.".ID_CIDADE, CADASTROS.CIDADE.NM_CIDADE, ".TBL_SOLICITACAO.".EMAIL_SOLICITANTE, ".TBL_SOLICITACAO.".FONE_SOLICITANTE, ".TBL_SOLICITACAO.".CPF_CNPJ_SOLICITANTE, ".TBL_SOLICITACAO.".NM_EDIFICACAO, ".TBL_SOLICITACAO.".NM_FANTASIA, ".TBL_SOLICITACAO.".NM_LOGRADOURO, ".TBL_SOLICITACAO.".NR, ".TBL_SOLICITACAO.".NR_CEP, ".TBL_SOLICITACAO.".AREA_TOTAL, ".TBL_SOLICITACAO.".AREA_PAVIMENTO, ".TBL_SOLICITACAO.".NR_ALTURA, ".TBL_SOLICITACAO.".OCUPACAO, ".TBL_SOLICITACAO.".RISCO, ".TBL_SOLICITACAO.".SITUACAO, ".TBL_SOLICITACAO.".TIPO, ".TBL_SOLICITACAO.".NR_PAVIMENTO, ".TBL_SOLICITACAO.".NR_BLOCO, ".TBL_SOLICITACAO.".TP_ADUCAO, ".TBL_SOLICITACAO.".PREVENTIVO_EXTINTOR, ".TBL_SOLICITACAO.".NM_ENGENHEIRO1, ".TBL_SOLICITACAO.".NM_ENGENHEIRO2, ".TBL_SOLICITACAO.".NM_ENGENHEIRO3, ".TBL_SOLICITACAO.".CREA1, ".TBL_SOLICITACAO.".CREA2, ".TBL_SOLICITACAO.".CREA3, ".TBL_SOLICITACAO.".NR_ESCADA_COMUM, ".TBL_SOLICITACAO.".NR_ESCADA_PROTEGIDA, ".TBL_SOLICITACAO.".NR_ESCADA_ENCLAUSURADA, ".TBL_SOLICITACAO.".NR_ESCADA_PROVA, ".TBL_SOLICITACAO.".NR_PASSARELA, ".TBL_SOLICITACAO.".NR_ESCADA_PRESSU, ".TBL_SOLICITACAO.".NR_RAMPA, ".TBL_SOLICITACAO.".NR_ELEVADOR, ".TBL_SOLICITACAO.".NR_LOCAL, ".TBL_SOLICITACAO.".SISTEMA_ALARME, ".TBL_SOLICITACAO.".ILUMINACAO_EMERGENCIA, ".TBL_SOLICITACAO.".PROTECAO_DESCARGA, ".TBL_SOLICITACAO.".RECIPIENTE, ".TBL_SOLICITACAO.".TIPO_INSTALACAO, ".TBL_SOLICITACAO.".OUTROS, ".TBL_SOLICITACAO.".NM_BAIRRO, ".TBL_SOLICITACAO.".STATUS, ".TBL_SOLICITACAO.".DATA FROM ".TBL_SOLICITACAO." JOIN CADASTROS.CIDADE USING (ID_CIDADE) WHERE ".TBL_SOLICITACAO.".ID_SOLIC_PROJETO = '$SOLICITACAO' AND ".TBL_SOLICITACAO.".ID_CIDADE = '$CIDADE'"; 
// 	     echo "sql: ".$sql;
	$res = mysql_query($sql);
	if ($r = mysql_fetch_assoc($res)) {
	    $solicitacao = $r;
	}

// echo "<pre>"; print_r($solicitacao); echo "</pre>";

    }
if($_POST["btn_enviar"] and $_POST["txt_re"]){
	$sql= "UPDATE SOLICITACAO.SOLIC_PROJETO SET PARECER='$PARECER',`DESC`='$DESC', NM_BAIRRO='$NM_BAIRRO',VISTORIADOR='$VISTORIADOR',STATUS='$STATUS' WHERE ID_SOLIC_PROJETO='$SOLICITACAO' AND ID_CIDADE='$CIDADE'";
//   	echo "$sql";exit;
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
function cons_edif_vist(cidade,edificacao,arq) {
var frm=document.frm_vist;
  if ((cidade.value!="") && (edificacao.value!="")) {
 window.open(arq+"?cidade="+cidade.value+"&edificacao="+edificacao.value,"consulrot","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
       }
     }
</script>

<form target="_self" enctype="multipart/form-data" method="post" name="frm_vist">
  <table style="width: 100%; text-align: left;" border="0" cellpadding="2" cellspacing="0">
  	<input type="hidden" name="hdn_id_solic_projeto" value="<?=$_POST["hdn_id_solic_projeto"]?>">
	<input type="hidden" name="hdn_id_cidade" value="<?=$_POST["hdn_id_cidade"]?>">
        <input type="hidden" name="op_menu" value="analise2">
    <tr>
      <td>
        <fieldset>
          <legend>Análise de projeto</legend>
          <table border="0" width="58%" cellpadding="2">
            <tr>
              <td align ="right">Nº Solicita&ccedil;&atilde;o</td>
              <td><input type="text" name="txt_solic" size="20" maxlength="100"></td>
              <td align="right">Cidade</td>
                <td><input type="text" name="txt_cidade"></td>
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
              <td><input type="text" name="txt_nm_solicitante" size="50" maxlength="100"></td>
              <td align ="right">CNPJ/CPF</td>
              <td><input type="text" name="txt_cpf" size="20" maxlength="18"   value=""></td>
            </tr>
             <tr>
             <td align ="right">E-mail</td>
              <td><input type="text" name="txt_email" size="50" maxlength="100"   style="text-transform : none;"></td>
	      <td align ="right">Fone</td>
              <td><input type="text" name="txt_fone" size="13" maxlength="12"  ></td> 
	  </tr>
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
              <TD><INPUT type="text" name="txt_nm_edificacao" size="30" maxlength="100"></td>
              <TD align="right">RE</TD>
              <TD><INPUT type="text" name="txt_re" size="20" maxlength="50"></TD>
	   <td>
              <input type="submit" name="btn_enviar" value="Pesquisar" align="middle" onclick="cons_edif_vist(document.frm_vist.hdn_id_cidade,document.frm_vist.txt_nm_edificacao,'modulos/projeto/cons_analise.php')">
            </td>        
    </tr>
            <tr>
              <td  align="right" width="100">
		Logradouro
	     </td>
              <td>
                <input type="text" name="txt_nm_logradouro" size="50" maxlength="100"  >
              </td>
              <td align="right">Nº</td>
              <td>
                <input type="text" name="txt_nr" size="5" maxlength="6">
             </td>
            </tr>
            <tr>
	  	<td align="right">CEP</td>
		<td><input type="text" name="txt_cep" size="9" maxlength="10" ></td>
           </tr>
	   <tr>
		<td align="right">Bairro</td>
		<td><input type="text" name="txt_bairro" size="20" maxlength="50"  ></td>
                <td align="right">&Aacute;rea Total Construida</td>
                <td><input type="text" name="txt_area" size="11" maxlength="12" align="right"><em>(m²)</em>
                </td>
	   </tr>
          </table>
        </fieldset>
                  <fieldset>
                    <legend>An&aacute;lise</legend>
                    <table width="90%" cellspacing="0" cellpadding="2"  border="0" align="center">
			<tr>
                            <td align="right">Parecer</td>
	                    <td><select name="cmb_parecer">
                            <option value="">--------</option>
                            <option value="DEFERIDO">Deferido</option>
                            <option value="INDEFERIDO">Indeferido</option>
                       </tr>
			   </select>
                  	   </td>
		       <tr>
			<td align="right">Nome vistoriador</td>                        
			<td><input type="text" name="txt_nm_vist" size="50" maxlength="100"></td>
                     </tr>
                      <tr>
			<td align="right">Observa&ccedil;&atilde;o</td>
			<td><textarea name="txa_desc" cols="70" rows="6"></textarea></td>
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
              <input type="submit" name="btn_enviar" value="Enviar" align="middle" >
            </td>
            <td>
              <input type="reset" name="btn_limpar" value="Limpar" align="middle" title="Limpa o formul&aacute;rio">
            </td>
          </tr>
        </table>
    </tr>
  </table>
  </form>
<?
if ($solicitacao) { ?>
	<script language="javascript" type="text/javascript">
		var frm = document.frm_vist;
		frm.txt_solic.value="<?=$solicitacao['ID_SOLIC_PROJETO']?>";
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
		frm.txt_area.value="<?=$solicitacao['AREA_TOTAL']?>";
		window.close();
	</script>	
<? } else { ?>
	<script language="javascript" type="text/javascript">
		alert('Nenhuma Análise pendente');
 </script>	
<? } ?>




