<?
  include ('../../templates/head.htm');

  $erro="";
  require_once 'lib/loader.php';

  $arquivo="excluir_funcionamento.php";
  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) {
    die($conn->get_msg());
  }
  $sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) {
    $rotina = $conn->fetch_row();
  } else {
    $rotina["ID_ROTINA"]=-1;
  }

  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();

  if (
  	(@$_POST["hdn_funcao"]=="excluir") && 
  	(@$_POST["cmb_id_cidade"]!="") && 
  	(@$_POST["txt_id_prot_funcionamento"]!="") && 
  	(@$_POST["txa_mtv_exclusao"]!="") && 
  	(@$_POST["hdn_id_sol_funcionamento"]!=""))
  	{
    
	$ID_PROTOCOLO 	= $_POST["txt_id_prot_funcionamento"];
 	$ID_CIDADE 		= $_POST["cmb_id_cidade"];
	$ID_SOLICITACAO = $_POST["hdn_id_sol_funcionamento"]; 
	$DE_EXCLUIDO	= $_POST["txa_mtv_exclusao"];


	// Marca como excluído a taxa
	if(@$_POST['cbx_taxa']) $query = "update ".TBL_COB_BOLETO." set CH_EXCLUIDO='S', DE_EXCLUIDO='$DE_EXCLUIDO' where ID_CIDADE=$ID_CIDADE and ID_PROT_FUNC=$ID_PROTOCOLO ";
		else $query = $query = "update ".TBL_COB_BOLETO." set CH_EXCLUIDO='N', DE_EXCLUIDO='' where ID_CIDADE=$ID_CIDADE and ID_PROT_FUNC=$ID_PROTOCOLO ";
	$conn->query($query);
	if ($conn->get_status( )==false) die ($res->get_msg());
	//else echo "<p>Executou a seguinte consulta : $query</p>";

 	// Macar como excluído O protocolo
	if(@$_POST['cbx_protocolo']) $query = "update ".TBL_PROT_FUNC." set CH_EXCLUIDO='S', DE_EXCLUIDO='$DE_EXCLUIDO' where ID_CIDADE=$ID_CIDADE and ID_PROT_FUNC=$ID_PROTOCOLO ";
		else $query = "update ".TBL_PROT_FUNC." set CH_EXCLUIDO='N', DE_EXCLUIDO='' where ID_CIDADE=$ID_CIDADE and ID_PROT_FUNC=$ID_PROTOCOLO ";
	$conn->query($query);
	if ($conn->get_status()==false) die ($res->get_msg());

	// Macar como excluído a vistoria
	if(@$_POST['cbx_vistoria']) $query = "update ".TBL_VISTORIA_FUNC." set CH_EXCLUIDO='S', DE_EXCLUIDO='$DE_EXCLUIDO' where ID_CIDADE=$ID_CIDADE and ID_PROT_FUNC=$ID_PROTOCOLO ";
		else $query = "update ".TBL_VISTORIA_FUNC." set CH_EXCLUIDO='N', DE_EXCLUIDO='' where ID_CIDADE=$ID_CIDADE and ID_PROT_FUNC=$ID_PROTOCOLO ";
	$conn->query($query);
	if ($conn->get_status()==false) die ($res->get_msg());

	// Macar como excluído a solicitacao
	if(@$_POST['cbx_solicitacao']) $query = "update ".TBL_SOL_FUNC." set CH_EXCLUIDO='S', DE_EXCLUIDO='$DE_EXCLUIDO' where ID_CIDADE=$ID_CIDADE and ID_SOLIC_FUNC=$ID_SOLICITACAO ";
		else $query = "update ".TBL_SOL_FUNC." set CH_EXCLUIDO='N', DE_EXCLUIDO='' where ID_CIDADE=$ID_CIDADE and ID_SOLIC_FUNC=$ID_SOLICITACAO ";
	$conn->query($query);
	if ($conn->get_status()==false) die ($res->get_msg());

	echo '<meta http-equiv="refresh" content="2; URL=excluir_funcionamento.php">';
	exit;
 } 
 
 
?>

<script language="javascript" type="text/javascript">//<!--

    function excluirReg(f) {
    	if (f.txa_mtv_exclusao.value == '' || f.txt_id_prot_funcionamento.value == '') {
    		alert('Campo obrigatório não preenchido!');	
    	} else {
	    	f.hdn_funcao.value="excluir";
	    	f.submit();
    	}
    }

    function consultaReg(campo1,campo2) {
      if ((campo1.value!="") && (campo2.value!="")) {
        window.open("cons_funcionamento.php?campo1="+campo1.value+"&campo2="+campo2.value,"consulrot","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }
    
    function resetForm(){
      document.frm_vist_funcionamento.reset();	
    }

	function testar_cbx(f) {
		if(f.cbx_solicitacao.checked){
			f.cbx_protocolo.checked = 'true';
			f.cbx_vistoria.checked = 'true';
			f.cbx_taxa.checked = 'true';
		}
		if(f.cbx_protocolo.checked){
			f.cbx_vistoria.checked = 'true';
			f.cbx_taxa.checked = 'true';
		}
	}
    
//--></script>
<body onload="ajustaspan();valida_sum_desc();">

<? include ('../../templates/cab.htm');?>

       <form target="_self" enctype="multipart/form-data" method="post" name="frm_vist_funcionamento" onreset="retorna(this)" onsubmit="return validaForm(this,<?=$campos_js?>)">

	     <input type="hidden" name="hdn_funcao" value="excluir" />

        <? if ((@$_POST["hdn_id_protocolo"]=="") && (@$_POST["hdn_id_cidade"]=="") )$alter=true; else $alter=false; ?>

            <table width="95%" cellspacing="0" border="0" cellpadding="5" align="center">
              <tr>
                <td>
                  <fieldset>
                    <legend>Excluir Funcionamento</legend>
                    <table width="100%" cellspacing="0" border="0" cellpadding="0" align="left">
                      <tr>
                        <td colspan="2">
                          <table width="100%" cellspacing="0" border="0" cellpadding="0" align="left">
                            <tr>

<!-- Cidade -->
				            <td>Cidade</td>
				            <td>
				                    <input type="hidden" name="hdn_id_cidade" value="">
				                    <select name="cmb_id_cidade" value="" class="campo" onChange="acerta_hdn(this); consultaReg(document.frm_vist_manutencao.hdn_id_cidade,document.frm_vist_manutencao.txt_id_prot_manutencao);">
				                      <option value=""></option>
									<?
										$sql= "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_USUARIO ='".$usuario."' ORDER BY NM_CIDADE";
										$res= $conn->query($sql);
										if ($conn->get_status()==false) die($conn->get_msg());
										while ($tupula = $conn->fetch_row()) {
									?>
				                       <option value="<?=$tupula["ID_CIDADE"]?>"><?=$tupula["NM_CIDADE"]?></option>
									<? } ?>
				                    </select>
				            </td>

<!-- Protocolo -->
                              <td width="83" align="center">Protocolo</td>
                                <td>
                                  <? if (!$alter) { ?>
                                    <input type="hidden" name="hdn_id_cidade" value="">
                                  <? } ?>
                                  <input type="hidden" name="hdn_id_sol_funcionamento" value="">
                                  <input type="hidden" name="hdn_id_tp_sol_funcionamento" value="">
                                  <input type="hidden" name="hdn_id_vist_func" value="">
                                  <input type="text" name="txt_id_prot_funcionamento" class="campo_obr" size="15" maxlength="11" value="" title="Número do Protocolo" 
                                  onblur="consultaReg(document.frm_vist_funcionamento.cmb_id_cidade,document.frm_vist_funcionamento.txt_id_prot_funcionamento)">
                                </td>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                        <fieldset>
                          <legend>Solicitante</legend>
                          <table width="100%" cellspacing="0" border="0" cellpadding="2" align="center">
                            <tr>
                              <td>CNPJ</td>
                              <td><input type="text" name="txt_nr_cnpj_empresa" class="campoDesabilitado" disabled="disabled" title="CNPJ/CPF do Solicitante" size="25" value="" onblur="cpfcnpj(this)"></td>
                              <td>Razão Social</td>
                              <td><input type="text" name="txt_nm_razao_social" class="campoDesabilitado" disabled="disabled" title="Nome do Solicitante do Projeto" size="35" value="" maxlength="100"></td>
                            </tr>
                            <tr>
                              <td>Fantasia do Solicitante</td>
                              <td>
                                <input type="text" name="txt_nm_fantasia_empresa" class="campoDesabilitado" disabled="disabled" size="25" maxlength="100" title="Nome Fantasia da Empresa Solicitante">
                              </td>
                              <td>Contato</td>
                              <td>
                                <input type="text" name="txt_nm_contato" class="campoDesabilitado" size="35" disabled="disabled" maxlength="100" title="Nome da Pessoa de Contato da Empresa Solcitante">
                              </td>
                            </tr>
                          </table>
                        </fieldset>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2">
                        <fieldset>
                          <legend>Edificação</legend>
                          <table width="100%" cellspacing="0" border="0" cellpadding="2" align="center">
                            <tr>
                              <td>RE</td>
                              <td><input type="text" name="txt_id_edificacao" size="5" class="campoDesabilitado" disabled="disabled" title="RE da Edificação" value="" maxlength="15" align="right" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,0)"></td>
                              <td>Nome</td>
                              <td><input type="text" name="txt_nm_edificacao" size="51" class="campoDesabilitado" disabled="disabled" title="Nome da Edificação" value="" readOnly="true"></td>
                            </tr>
                            <tr>
                              <td>Área Construida</td>
                              <td>
                              <input type="text" align="right" name="txt_vl_area_construida" class="campoDesabilitado" disabled="disabled" title="Valor da Área Total Construida da Edificação" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,2)" readOnly="true" value=""><em>(m²)</em>
                              </td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                          </table>
                        </fieldset>
                        </td>
                      </tr>

<!-- Excluir -->

        	<tr>
        	<td colspan="4">
        	<fieldset><legend>Excluir</legend>
        	<table width="100%" cellspacing="0" border="0" cellpadding="0" align="left">
        	<tr>
        		<td width="150" ><input type="checkbox" name="cbx_solicitacao" value="1" onchange="testar_cbx(this.form)" /> Solicitação</td>
        		<td>Motivo da exclusão</td>
        	</tr>
        	<tr>
        		<td width="150" ><input type="checkbox" name="cbx_protocolo" value="1" onchange="testar_cbx(this.form)" /> Protocolo</td>
        		<td rowspan="3"><textarea name="txa_mtv_exclusao" cols="67" class="campo_obr" rows="3" class="campo" onblur="verfica_textarea(this)" style="text-transform : none;"></textarea></td>
        	</tr>
        	<tr><td><input type="checkbox" name="cbx_taxa" value="1" onchange="testar_cbx(this.form)" /> Taxa</td></tr>
        	<tr><td><input type="checkbox" name="cbx_vistoria" value="1" onchange="testar_cbx(this.form)" />Vistoria</td></tr>
        	</table>
        	</fieldset>
        	</td>
        	</tr>
			<?
			  $query_usuario="SELECT NM_USUARIO FROM ".TBL_USUARIO." WHERE ID_USUARIO='$usuario'";
			  $conn->query($query_usuario);
			  $fetch_usuario=$conn->fetch_row();
			?>
			<tr><td colspan="2">&nbsp;&nbsp;<?=$fetch_usuario["NM_USUARIO"]?></td></tr>

<!-- botões -->

              <tr valign="top" align="center">
                <td align="center" colspan="4"><br>
                <table width="50%" cellspacing="0" border="0" cellpadding="0" align="center">
                    <tr align="center" valign="center">
                      <td>
                        <input type="button" name="btn_excluir" value="Excluir" align="middle" 
                        title="Excluir" class="botao" style="background-image : url('../../imagens/botao.gif');" 
                        onClick="excluirReg(this.form);" >
                      </td>
                      <td>
                        <input type="reset" name="btn_limpar" value="Limpar" align="middle" title="Limpa as Informações" class="botao"  style="background-image : url('../../imagens/botao.gif');">
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>


<!-- Botões -->

 <? // include('../../templates/btn_inc.htm'); ?>

                    </table>

                  </fieldset>
                </td>
              </tr>
            </table>


          </form>
<?
  include ('../../templates/footer.htm');
?>
