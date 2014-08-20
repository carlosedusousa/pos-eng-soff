<?
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

$data =  date("Y-m-d");
$status = "P";
$parecer= "";

$campos_preenchidos = true;
foreach ($_POST as $indice => $valor){
    if ($valor == null and $indice != 'txt_nm_engenheiro2' and $indice != 'txt_nr_crea2' and $indice != 'txt_nm_engenheiro3' and $indice != 'txt_nr_crea3' and $indice != 'txt_parcial' and $indice != 'txt_nm_area' ) {
      
      $campos_preenchidos = false;
    }
}
if ($campos_preenchidos) {
	
	$NM_SOLICITANTE                    = ($_POST["txt_nm_solicitante"]);
	$CPF_CNPJ_SOLICITANTE              = ($_POST["txt_cpf"]); 
	$FONE_SOLICITANTE                  = ($_POST["txt_fone_solicitante"]);
	$EMAIL_SOLICITANTE                 = ($_POST["txt_de_email_solicitante"]);
	$NM_EDIFICACAO                     = ($_POST["txt_nm_edificacao"]);
	$NM_FANTASIA                       = ($_POST["txt_nm_fantasia"]);
	$NM_LOGRADOURO                     = ($_POST["txt_nm_logradouro"]);
	$NR                                = ($_POST["txt_nr"]);
	$ID_CIDADE                         = ($_POST["cmb_id_cidade"]);
	$NR_CEP                            = ($_POST["txt_cep"]);
	$NM_BAIRRO                         = ($_POST["txt_nm_bairro"]);
	$AREA_TOTAL                        = ($_POST["txt_nr_area_tot_const"]);
	$NM_ENGENHEIRO1                    = ($_POST["txt_nm_engenheiro"]);
	$CREA1                             = ($_POST["txt_nr_crea1"]);
	$NM_ENGENHEIRO2                    = ($_POST["txt_nm_engenheiro2"]);
 	$CREA2                             = ($_POST["txt_nr_crea2"]);
	$NM_ENGENHEIRO3                    = ($_POST["txt_nm_engenheiro3"]);
 	$CREA3                             = ($_POST["txt_nr_crea3"]);
	$TIPO_AREA_VIST                    = ($_POST["cbm_tipo_vist"]);
	$NM_AREA                           = ($_POST["txt_nm_area"]);
	$AREA_PARCIAL                      = ($_POST["txt_parcial"]);
        $STATUS                            = $status;
	$DATA                              = $data;
	$PARECER                           = $parecer;


	if($_POST["btn_enviar"]){
		
		$sql = "INSERT INTO SOLICITACAO.SOLIC_HABITESE (NM_SOLICITANTE, EMAIL_SOLICITANTE, FONE_SOLICITANTE, CPF_CNPJ_SOLICITANTE, NM_EDIFICACAO, NM_FANTASIA, NM_LOGRADOURO, NR, ID_CIDADE, NR_CEP, NM_BAIRRO, AREA_TOTAL, NM_ENGENHEIRO1, NM_ENGENHEIRO2, NM_ENGENHEIRO3, CREA1, CREA2, CREA3, TIPO_AREA_VIST, NM_AREA, AREA_PARCIAL, STATUS, DATA, PARECER) VALUES ('$NM_SOLICITANTE', '$EMAIL_SOLICITANTE', '$FONE_SOLICITANTE', '$CPF_CNPJ_SOLICITANTE', '$NM_EDIFICACAO', '$NM_FANTASIA', '$NM_LOGRADOURO', '$NR','$ID_CIDADE', '$NR_CEP', '$NM_BAIRRO', '$AREA_TOTAL', '$NM_ENGENHEIRO1', '$NM_ENGENHEIRO2', '$NM_ENGENHEIRO3', '$CREA1', '$CREA2', '$CREA3', '$TIPO_AREA_VIST', '$NM_AREA', '$AREA_PARCIAL', '$STATUS', '$DATA', '$PARECER')";
			
		
				//echo "sql: $sql";exit;
					$res = mysql_query($sql);
				echo "Solicitação criada ";
				?><meta http-equiv="refresh" content="0; index.php"><?
				
	}

}else{
  echo "Favor preencher todos os campos.";

}

?>

<form target="_self" enctype="multipart/form-data" method="post" name="frm_solicitacao">
 <input type="hidden" name="op_menu" value="solic_habitese"> 
 <table style="width: 100%; text-align: left;" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <td colspan="2" rowspan="1" style="vertical-align: top;">
        <fieldset>
          <legend>Solicitante</legend>
          <table>
            <tr>
              <td>Nome</td>
              <td><input type="text" name="txt_nm_solicitante" size="50" maxlength="100" class="campo_obr"></td>
              <td>CNPJ/CPF</td>
              <td><input type="text" name="txt_cpf" size="20" maxlength="18" class="campo_obr" value=""></td>
            </tr>
          </table>
          <table>
            <tr>
              <td width="30">Fone</td>
              <td><input type="text" name="txt_fone_solicitante" size="13" maxlength="12" class="campo_obr"></td>
              <td>E-mail</td>
              <td><input type="text" name="txt_de_email_solicitante" size="61" maxlength="100" class="campo_obr" style="text-transform : none;"></td>
            </tr>
          </table>
        </fieldset>
      </td>
    </tr>
    <tr>
      <td colspan="2" style="vertical-align: top;">
        <fieldset>
          <legend>Edifica&ccedil;&atilde;o</legend>
          <TABLE width="90%" cellspacing="0" border="0" cellpadding="0">
            <tr>
              <TD>Nome</TD>
              <TD><INPUT type="text" name="txt_nm_edificacao" size="30" maxlength="100" class="campo_obr"></td>
              <TD>Nome Fantasia</TD>
              <TD><INPUT type="text" name="txt_nm_fantasia" size="30" maxlength="100" class="campo"></TD>
            </tr>
          </TABLE>
          <fieldset>
          <legend>Endere&ccedil;o</legend>
          <table cellspacing="0" border="0" cellpadding="2" width="80%">
            <tr>
              <td  align="right" width="100">
		Logradouro
             </td>
              <td>
                <input type="text" name="txt_nm_logradouro" size="50">
              </td>
              <td align="right">Nº</td>
              <td>
                <input type="text" name="txt_nr" size="5" >
              </td>
            </tr>
            <tr>
	      <td align="right">Cidade</td>
              <td><select name="cmb_id_cidade">
		   <option value="">-------</option>
                   <?
		    $sql= "select CADASTROS.CIDADE.ID_CIDADE, CADASTROS.CIDADE.NM_CIDADE from CADASTROS.CIDADE ";
		    $res = mysql_query($sql);
 		    while ($r = mysql_fetch_assoc($res)) {
                        ?><option value="<?=$r["ID_CIDADE"]?>"><?=$r["NM_CIDADE"]?></option><?
                    }
		    ?>
                 </select>
             </td>
 	      <td align="right">Cep</td>
              <td><input type="text" name="txt_cep" size="11">
              </td>
           </tr>
		   <tr>
				<td align="right">Bairro</td>
				<td><input type="text" name="txt_nm_bairro" size="20" maxlength="50" class="campo_obr"></td>
                  <td align="right">&Aacute;rea Total Construida</td>
                  <td><input type="text" name="txt_nr_area_tot_const" size="11" maxlength="12" align="right" class="campo_obr"><em>(m²)</em>
                  </td>
	   </tr>
          </table>
</fieldset>
          </fieldset>
                  <fieldset>
                    <legend>Respons&aacute;vel T&eacute;cnico Projeto</legend>
                    <table width="50%" cellspacing="0" cellpadding="1"  border="0" align="center">
                      <tr align="center">
                        <td align="left">Nome</td>
                        <td>CREA</td>
                      </tr>
                      <tr>
                        <td><input type="text" name="txt_nm_engenheiro" size="50" maxlength="100" class="campo_obr"></td>
                        <td><input type="text" name="txt_nr_crea1" size="7" maxlength="8" class="campo_obr"></td>
                      </tr>
                      <tr>
                        <td><input type="text" name="txt_nm_engenheiro2" size="50" maxlength="100" class="campo"></td>
                        <td><input type="text" name="txt_nr_crea2" size="7" maxlength="8" class="campo"></td>
                      </tr>
                      <tr>
                        <td><input type="text" name="txt_nm_engenheiro3" size="50" maxlength="100" class="campo"></td>
                        <td><input type="text" name="txt_nr_crea3" size="7" maxlength="8" class="campo"></td>
                      </tr>
                    </table>
                </fieldset>
                  <fieldset>
                    <legend>&Aacute;rea de vistoria</legend>
                    <table width="50%" cellspacing="0" cellpadding="2"  border="0" align="center">
			<tr>
                            <td align="right">Tipo de &aacute;rea a ser vistoriada(habite-se)</td>
	                    <td><select name="cbm_tipo_vist" class="campo_obr">
                            <option value="">--------</option>
			    <option value="Total">Total</option>
			   <option value="Parcial">Parcial</option>
                       </tr>
			   </select>
                  	   </td>
		       <tr>
			<td align="right">Nome </td>                        
			<td><input type="text" name="txt_nm_area" size="50" maxlength="100" class="campo"></td>
                     </tr>
                      <tr>
			<td align="right">&Aacute;rea parcial </td>                        
			<td><input type="text" name="txt_parcial" size="20" maxlength="100" class="campo"></td>
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

