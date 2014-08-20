<?
// echo "<pre>";print_r($POST); echo "</pre>"; 

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
    if ($valor == null and $indice != 'chk_ch_extintor' and $indice != 'cmd_id_aducao' and $indice != 'txt_nm_engenheiro2' and $indice != 'txt_nr_crea2' and $indice != 'txt_nm_engenheiro3' and $indice != 'txt_nr_crea3' and $indice != 'cmb_nr_escada_comum' and $indice != 'cmb_nr_pressurizada' and $indice != 'cmb_nr_protegida' and $indice != 'cmb_nr_rampa' and $indice != 'cmb_nr_enclausurada' and $indice != 'cmb_nr_elev_emerg' and $indice != 'cmb_nr_esc_fumaca' and $indice != 'cmb_nr_reg_aereo' and $indice != 'cmb_nr_passarela' and $indice != 'cmb_id_tp_detc_incendio' and $indice != 'cmb_id_iluminacao_emergencia' and $indice != 'cmb_id_recipiente' and $indice != 'cmb_id_tp_instalacao' and $indice != 'cmb_id_raio' and $indice != 'txt_outros') {
      
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
	$NR_CEP                            = ($_POST["txt_nr_cep"]);
	$NM_BAIRRO                         = ($_POST["txt_nm_bairro"]);
	$AREA_TOTAL                        = ($_POST["txt_nr_area_tot_const"]);
	$NR_ALTURA                         = ($_POST["txt_nr_altura"]);
	$AREA_PAVIMENTO                    = ($_POST["txt_nr_area_pavimento"]);
	$OCUPACAO                          = ($_POST["cbm_ocupacao"]);
	$RISCO                             = ($_POST["cmb_risco"]);
	$SITUACAO                          = ($_POST["cmb_situacao"]);
	$TIPO                              = ($_POST["cmb_construcao"]);
	$NR_PAVIMENTO                      = ($_POST["cmb_nr_pavimentos"]);
	$NR_BLOCO                          = ($_POST["cmb_nr_blocos"]);
	$PREVENTIVO_EXTINTOR               = ($_POST["chk_ch_extintor"]);
	$TP_ADUCAO                         = ($_POST["cmd_id_aducao"]);
	$NM_ENGENHEIRO1                    = ($_POST["txt_nm_engenheiro"]);
	$CREA1                             = ($_POST["txt_nr_crea1"]);
	$NM_ENGENHEIRO2                    = ($_POST["txt_nm_engenheiro2"]);
 	$CREA2                             = ($_POST["txt_nr_crea2"]);
	$NM_ENGENHEIRO3                    = ($_POST["txt_nm_engenheiro3"]);
 	$CREA3                             = ($_POST["txt_nr_crea3"]);
 	$NR_ESCADA_COMUM                   = ($_POST["cmb_nr_escada_comum"]);
 	$NR_ESCADA_PRESSU                  = ($_POST["cmb_nr_pressurizada"]);
 	$NR_ESCADA_PROTEGIDA               = ($_POST["cmb_nr_protegida"]);
 	$NR_RAMPA                          = ($_POST["cmb_nr_rampa"]);
 	$NR_ESCADA_ENCLAUSURADA            = ($_POST["cmb_nr_enclausurada"]);
 	$NR_ELEVADOR                       = ($_POST["cmb_nr_elev_emerg"]);
 	$NR_ESCADA_PROVA                   = ($_POST["cmb_nr_esc_fumaca"]);
 	$NR_LOCAL                          = ($_POST["cmb_nr_reg_aereo"]);
 	$NR_PASSARELA                      = ($_POST["cmb_nr_passarela"]);
 	$SISTEMA_ALARME                    = ($_POST["cmb_id_tp_detc_incendio"]);
 	$ILUMINACAO_EMERGENCIA             = ($_POST["cmb_id_iluminacao_emergencia"]);
 	$RECIPIENTE                        = ($_POST["cmb_id_recipiente"]);
 	$TIPO_INSTALACAO                   = ($_POST["cmb_id_tp_instalacao"]);
 	$PROTECAO_DESCARGA                 = ($_POST["cmb_id_raio"]);
 	$OUTROS                            = ($_POST["txt_outros"]);
	$STATUS                            = $status;
 	$DATA                              = $data;
	$PARECER                           = $parecer;

	if($_POST["btn_enviar"]){
	
		$sql = "INSERT INTO SOLICITACAO.SOLIC_PROJETO (NM_SOLICITANTE, EMAIL_SOLICITANTE, FONE_SOLICITANTE, CPF_CNPJ_SOLICITANTE, NM_EDIFICACAO, NM_FANTASIA, NM_LOGRADOURO, NR, ID_CIDADE, NR_CEP, AREA_TOTAL, AREA_PAVIMENTO, NR_ALTURA, OCUPACAO, RISCO, SITUACAO, TIPO, NR_PAVIMENTO,  NR_BLOCO, TP_ADUCAO, PREVENTIVO_EXTINTOR, NM_ENGENHEIRO1, NM_ENGENHEIRO2, NM_ENGENHEIRO3, CREA1, CREA2, CREA3, NR_ESCADA_COMUM, NR_ESCADA_PROTEGIDA, NR_ESCADA_ENCLAUSURADA, NR_ESCADA_PROVA, NR_PASSARELA, NR_ESCADA_PRESSU, NR_RAMPA, NR_ELEVADOR, NR_LOCAL, SISTEMA_ALARME, ILUMINACAO_EMERGENCIA, PROTECAO_DESCARGA, RECIPIENTE, TIPO_INSTALACAO, OUTROS, NM_BAIRRO, STATUS, DATA, PARECER) VALUES ('$NM_SOLICITANTE', '$EMAIL_SOLICITANTE', '$FONE_SOLICITANTE', '$CPF_CNPJ_SOLICITANTE', '$NM_EDIFICACAO', '$NM_FANTASIA', '$NM_LOGRADOURO', '$NR', '$ID_CIDADE', '$NR_CEP', '$AREA_TOTAL', '$AREA_PAVIMENTO', '$NR_ALTURA', '$OCUPACAO', '$RISCO', '$SITUACAO', '$TIPO', '$NR_PAVIMENTO', '$NR_BLOCO', '$TP_ADUCAO', '$PREVENTIVO_EXTINTOR', '$NM_ENGENHEIRO1', '$NM_ENGENHEIRO2', '$NM_ENGENHEIRO3', '$CREA1', '$CREA2', '$CREA3', '$NR_ESCADA_COMUM', '$NR_ESCADA_PROTEGIDA', '$NR_ESCADA_ENCLAUSURADA', '$NR_ESCADA_PROVA', '$NR_PASSARELA', '$NR_ESCADA_PRESSU', '$NR_RAMPA', '$NR_ELEVADOR', '$NR_LOCAL', '$SISTEMA_ALARME', '$ILUMINACAO_EMERGENCIA', '$PROTECAO_DESCARGA', '$RECIPIENTE', '$TIPO_INSTALACAO', '$OUTROS', '$NM_BAIRRO', '$STATUS', '$DATA', '$PARECER')";
		
	
// 			echo "sql: $sql";exit;
			$res = mysql_query($sql);
			?>
				<script language="javascript" type="text/javascript">
				alert("Registro inserido com sucesso");
				</script>
			<?
			?><meta http-equiv="refresh" content="0; index.php"><?
			
		}

}else{
  echo "Favor preencher todos os campos.";

}

?>
     <form target="_self" enctype="multipart/form-data" method="post" name="frm_solicitacao">
 <input type="hidden" name="op_menu" value="solic_projeto">
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
                <input type="text" name="txt_nm_logradouro" size="50" maxlength="100" class="campo_obr">
              </td>
              <td align="right">Nº</td>
              <td>
                <input type="text" name="txt_nr" size="5" maxlength="6" class="campo">
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
	     <td align="right">CEP</td>
	      <td><input type="text" name="txt_nr_cep" size="9" maxlength="10" class="campo"></td>
           </tr>
	   <tr>
	     <td align="right">Bairro</td>
	     <td colspan="3"><input type="text" name="txt_nm_bairro" size="20" maxlength="50" class="campo_obr"></td>
	  </tr>
          </table>
          </fieldset>
          <fieldset>
            <legend>Caracter&iacute;sticas</legend>
              <table width="95%" cellspacing="0" border="0" cellpadding="2">
                <tr>
                  <td>&Aacute;rea Total Construida</td>
                  <td nowrap="true">
                    <input type="text" name="txt_nr_area_tot_const" size="11" maxlength="12" align="right" class="campo_obr"><em>(m²)</em>
                  </td>
                  <td>Altura</td>
                  <td nowrap="true"><input type="text" name="txt_nr_altura" size="8" maxlength="9" align="right" class="campo_obr"><em>(m)</em></td>
                  <td>&Aacute;rea do Pavimento Tipo</td>
                  <td nowrap="true"> <input type="text" name="txt_nr_area_pavimento" size="9" maxlength="10" align="right" class="campo_obr" ><em>(m²)</em></td>
                </tr>
              </table>
              <table width="65%" cellspacing="0" border="0" cellpadding="2">
                <tr>
                  <td align="right">Ocupa&ccedil;&atilde;o</td>
                  <td><select name="cbm_ocupacao" class="campo_obr">
                        <option value="">--------</option>
			<option value="Residencial privativa multifamiliar">Residencial privativa multifamiliar</option>
			<option value="Residencial privativa unifamiliar">Residencial privativa unifamiliar</option>
			<option value="Residencial coletiva">Residencial coletiva</option>
			<option value="Residencial transitória">Residencial transitória</option>
			<option value="Comercial">Comercial</option>
			<option value="Industrial">Industrial</option>
			<option value="Mista">Mista</option>
			<option value="P&uacute;blica">P&uacute;blica</option>
			<option value="Escolar">Escolar</option>
			<option value="Hospital e laboratorial">Hospital e laboratorial</option>
			<option value="Garagens">Garagens</option>
			<option value="Reuni&atilde;o de p&uacute;blico">Reuni&atilde;o de p&uacute;blico</option>
			<option value="Edifica&ccedil;&otilde;es especiais">Edifica&ccedil;&otilde;es especiais</option>
			<option value="Dep&oacute;sitos de inflam&aacute;veis">Dep&oacute;sitos de inflam&aacute;veis</option>
			<option value="Dep&oacute;sitos de explosivos e muni&ccedil;&otilde;es">Dep&oacute;sitos de explosivos e muni&ccedil;&otilde;es</option>
                      </select>
                  </td>
                  <td align="right">Risco</td>
                  <td>
                    <select name="cmb_risco" class="campo_obr">
                      <option value="">-------</option>
			<option value="Leve">Leve</option>
			<option value="M&eacute;dio">M&eacute;dio</option>
			<option value="Elevado">Elevado</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td align="right">Situa&ccedil;&atilde;o</td>
                  <td>
                    <select name="cmb_situacao" class="campo_obr">
                      <option value="">--------</option>
                        <option value="Existente">Existente</option>
			<option value="Nova">Nova</option>
			<option value="Em constru&ccedil;&atilde;o">Em constru&ccedil;&atilde;o</option>
		   </select>
                  </td>
                  <td align="right">Tipo</td>
                  <td>
                    <select name="cmb_construcao" class="campo_obr">
                      <option value="">--------</option>
			<option value="Alvenaria">Alvenaria</option>
			<option value="Madeira">Madeira</option>
			<option value="Mista">Mista</option>
			<option value="Met&aacute;lica">Met&aacute;lica</option>
                    </select>
                  </td>
                </tr>
                <tr>
                <tr>
                  <td align="right">Nº Pavimentos</td>
                  <td>
                    <select name="cmb_nr_pavimentos" class="campo_obr">
                     <?
                        for ($i=1;$i<=50;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
		  </select>
                  </td>
                  <td align="right">Nº Blocos</td>
                  <td>
                    <select name="cmb_nr_blocos" class="campo_obr">
                      <?
                        for ($i=1;$i<=50;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
                    </select>
                  </td>
                </tr>
              </table>
          </fieldset>
          <fieldset>
          <legend>Sistema de Seguran&ccedil;a Contra Inc&ecirc;ndios</legend>
          <label title="Marque a op&ccedil;&atilde;o se possuir o sistema">
            <input type="checkbox" name="chk_ch_extintor" value="S">Sistema Preventivo por Extintor</label>
            <table width="100%" cellspacing="0" border="0" cellpadding="0">
             <tr> 
                <td valign="top"><br>
                  <fieldset>
                    <legend><label>Sistema Hidraulico Preventivo</label></legend>
                    Tipo de Adu&ccedil;&atilde;o
                    <select name="cmd_id_aducao">
                      <option value="">----------</option>
   		      <option value="Gravitacional">Gravitacional</option>
		      <option value="Por bombas">Por bombas</option>
                    </select>
                    <br><br><br><br>
                  </fieldset>
                </td>
	     <td>
                  <fieldset>
                    <legend>Respons&aacute;vel T&eacute;cnico Projeto</legend>
                    <table width="90%" cellspacing="0" cellpadding="1" align="center">
                      <tr align="center">
                        <td>Nome</td>
                        <td>CREA</td>
                      </tr>
                      <tr>
                        <td><input type="text" name="txt_nm_engenheiro" size="30" maxlength="100" class="campo_obr"></td>
                        <td><input type="text" name="txt_nr_crea1" size="7" maxlength="8" class="campo_obr"></td>
                      </tr>
                      <tr>
                        <td><input type="text" name="txt_nm_engenheiro2" size="30" maxlength="100" class="campo"></td>
                        <td><input type="text" name="txt_nr_crea2" size="7" maxlength="8" class="campo"></td>
                      </tr>
                      <tr>
                        <td><input type="text" name="txt_nm_engenheiro3" size="30" maxlength="100" class="campo"></td>
                        <td><input type="text" name="txt_nr_crea3" size="7" maxlength="8" class="campo"></td>
                      </tr>
                    </table>
                </fieldset>
                </td>
              </tr>
            </table>
            <fieldset>
              <legend>
                <label>
                  Sa&iacute;da de Emerg&ecirc;ncia
                </label>
              </legend>
              <table width="90%" cellspacing="1" border="0" cellpadding="2" align="center">
                <tr>
                  <td>
                    <label>
                     Escada Comum
                    </label>
                  </td>
                  <td>
                    <select name="cmb_nr_escada_comum" class="campo">
                      <?
                        for ($i=0;$i<=50;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
                    </select>                   
                  </td>
                  <td>
                    <label>
                     Escada Pressurizada
                    </label>
                  </td>
                  <td>
                    <select name="cmb_nr_pressurizada">
			<?
                        for ($i=0;$i<=50;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>                    
		</select>
                  </td>
                </tr>
                <tr>
                  <td><label> Escada Protegida</label></td>
                  <td>
                    <select name="cmb_nr_protegida" >
		<?
			for ($i=0;$i<=50;$i++) {
			 echo "<option value=\"".$i."\">".$i."</option>\n";
			}
		?>                
	     </select>
                  </td>
                  <td>
                    <label>
                      Rampa
                    </label>
                  </td>
                  <td>
                    <select name="cmb_nr_rampa" >
                   <?
                        for ($i=0;$i<=50;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
	         </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>
                      Escada Enclausurada
                    </label>
                  </td>
                  <td>
                   <select name="cmb_nr_enclausurada">
                     <?
                        for ($i=0;$i<=50;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>   
		   </select>
                  </td>
                  <td>
                    <label>
                      Elevador de Emerg&ecirc;ncia
                    </label>
                  </td>
                  <td>
                    <select name="cmb_nr_elev_emerg" >
                      <?
                        for ($i=0;$i<=50;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>                    
		    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>
                      Escada Enclausurada a<br>
                      prova de fuma&ccedil;a</label>
                  </td>
                  <td>
                    <select name="cmb_nr_esc_fumaca" >
                       <?
                        for ($i=0;$i<=50;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
		    </select>
                  </td>
                  <td>
                  <label>
                    Local para Resgate A&eacute;reo</label></td>
                  <td>
                    <select name="cmb_nr_reg_aereo">
                      <?
                        for ($i=0;$i<=50;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
		    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                   <label>  
			Passarela</label></td>
		   <td>
                    <select name="cmb_nr_passarela">
                      <?
                        for ($i=0;$i<=50;$i++) {
                          echo "<option value=\"".$i."\">".$i."</option>\n";
                        }
                      ?>
		   </select>
                  </td>
                </tr>
              </table>
            </fieldset>
            <table width="100%" cellspacing="0" cellpadding="2" border="0">
              <tr>
                <td>
                  <fieldset>
                    <legend><label>
                     Sistema de Alarme de Detec&ccedil;&atilde;o de Inc&ecirc;ndios</label>
                    </legend>
                    <table width="80%" cellspacing="0" border="0" cellpadding="0">
                      <tr>
                        <td>Tipo</td>
                        <td>
                          <select name="cmb_id_tp_detc_incendio">
                            <option value="">---------</option>
                            <option value="Com detec&ccedil;&atilde;o">Com detec&ccedil;&atilde;o</option>
                            <option value="Sem detec&ccedil;&atilde;o">Sem detec&ccedil;&atilde;o</option>
                          </select>
                        </td>
                      </tr>
                    </table>
                  </fieldset>
                  <fieldset>
                    <legend><label>
                      Ilumina&ccedil;&atilde;o de Emerg&ecirc;ncia</label>
                    </legend>
                      <table width="80%" cellspacing="0" border="0" cellpadding="0">
                        <tr>
                          <td>Tipo</td>
                          <td><select name="cmb_id_iluminacao_emergencia">
                                <option value="">------------</option>
                                <option value="Bloco aut&ocirc;nomo">Bloco aut&ocirc;nomo</option>
                                <option value="Central de baterias">Central de baterias</option>
                              </select></td>
                        </tr>
                      </table>
                  </fieldset>
                </td>
                <td valign="top" align="left">
                  <fieldset>
                    <legend><label>
                      G&aacute;s Canalizado</label>
                    </legend>
                    <table width="100%" cellspacing="0" border="0" cellpadding="2">
                      <tr>
                        <td>GLP(Recipiente)</td>
                        <td>
                          <select name="cmb_id_recipiente">
                            <option value="">------------</option>
                            <option value="Transport&aacute;vel">Transport&aacute;vel</option>
                            <option value="Recarreg&aacute;vel">Recarreg&aacute;vel</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>Tipo de Instala&ccedil;&atilde;o(G&aacute;s Natural)</td>
                        <td>
                          <select name="cmb_id_tp_instalacao">
                            <option value="">---------</option>
                            <option value="Predial">Predial</option>
                            <option value="Industrial">Industrial</option>
                            <option value="Veicular">Veicular</option>
                          </select>
                        </td>
                      </tr>
                    </table>
                    <br><br>
                  </fieldset>
                </td>
              </tr>
            </table>
            <table width="100%" cellspacing="0" border="0" cellpadding="2">
              <tr>
                <td width="150">
                  <fieldset>
                    <legend><label>Sistema de Prote&ccedil;&atilde;o Contra descarga Atmosf&eacute;rica</label></legend>
                    <table width="90%" cellspacing="0" border="0" cellpadding="0">
                      <tr>
                        <td>Metodo de Prote&ccedil;&atilde;o</td>
                        <td>
                          <select name="cmb_id_raio">
                            <option value="">------------</option>
                            <option value="Eletrogeom&eacute;trico">Eletrogeom&eacute;trico</option>
                            <option value="Franklin">Franklin</option>
                            <option value="Faraday">Faraday</option>
                          </select>
                        </td>
                      </tr>
                    </table>
                  </fieldset>
                </td>
                <td colspan="2">
                  <table width="100%" cellspacing="0" border="0" cellpadding="0">
                    <tr>
                      <td>
                        <label>Outros</label>
                        <input type="text" name="txt_outros" size="20" maxlength="100">
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
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


