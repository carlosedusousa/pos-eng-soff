<? //echo "<pre>"; print_r($_POST); echo "</pre>"; exit;

  require_once 'lib/loader.php';
  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false)  die($conn->get_msg());

  $arquivo="excluir.php";
  $sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0)  $rotina = $conn->fetch_row();
  
  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario = $global_obj_sessao->is_logged_in();

  if (
  	(@$_POST["hdn_funcao"]=="excluir") && 
  	(@$_POST["cmb_id_cidade"]!="") && 
  	((@$_POST["hdn_id_solicitacao"]!="") or (@$_POST["hdn_id_edificacao"]!="")) && 
  	((@$_POST["hdn_id_protocolo"]!="") or (@$_POST["hdn_id_edificacao"]!="")) &&
  	(@$_POST["txa_mtv_exclusao"]!="") &&
  	(@$_POST["hdn_id_usuario"]!="")
  	){

	$ID_SOLICITACAO	= $_POST["hdn_id_solicitacao"];
	$ID_PROTOCOLO 	= $_POST["hdn_id_protocolo"];
	$ID_EDIFICACAO 	= $_POST["hdn_id_edificacao"];
	$ID_CIDADE 	= $_POST["cmb_id_cidade"];
	$DE_EXCLUIDO	= $_POST["txa_mtv_exclusao"];
	$TIPO		= $_POST["rbx_tipo"];
	$ID_USUARIO	= $_POST["hdn_id_usuario"];
	$MOTIVO		= $_POST["txa_mtv_exclusao"];

	$banco = false;

	switch($TIPO) {
	
		case 'funcionamento':
			// SOLIC_FUNCIONAMENTO
			$banco[] = 'SOLICITACAO';
			$tabela[] = 'SOLIC_FUNCIONAMENTO';
			$valor[] = "ID_SOLIC_FUNC='$ID_SOLICITACAO' and ID_CIDADE='$ID_CIDADE'"; 
			// PROT_FUNCIONAMENTO
			$banco[] = 'FUNCIONAMENTO';
			$tabela[] = 'PROT_FUNCIONAMENTO';
			$valor[] = "ID_PROT_FUNC='$ID_PROTOCOLO' and ID_CIDADE='$ID_CIDADE'"; 
			// VISTORIA_FUNCIONAMENTO
			$banco[] = 'FUNCIONAMENTO';
			$tabela[] = 'VISTORIA_FUNCIONAMENTO';
			$valor[] = "ID_PROT_FUNC='$ID_PROTOCOLO' and ID_CIDADE='$ID_CIDADE'";

		break;
		
		default: echo "Nenhuma op��o escolhida!";
		
	}

	if($banco) {

 		$sels = null;$dels = null;$res = null;
		foreach($banco as $index=>$BANCO){
                    $TABELA = $tabela[$index];
                    $VALOR = $valor[$index];
                    $cons_del = "DELETE FROM $BANCO.$TABELA WHERE $VALOR";
                    $cons_sel = "SELECT * FROM $BANCO.$TABELA WHERE $VALOR";
                    $cons_dels[$index] = $cons_del;
                    $dels .= $cons_del.";\n"; 
                    $sels .= $cons_sel.";\n";

                    $conn->query($cons_sel);
                    if ($conn->get_status()==false) die($conn->get_msg());
                    $res[$BANCO][$TABELA] = $conn->fetch_row();
		}
		    $res = null;
		    $conn->query('SET FOREIGN_KEY_CHECKS=0');
		    foreach($cons_dels as $consulta){ 
		    $conn->query($consulta);
			    if ($conn->get_status()==false) die($conn->get_msg());
			    $res[$BANCO][$TABELA] = $conn->fetch_row(); 	
		    }
		    $conn->query('SET FOREIGN_KEY_CHECKS=1');

		    $mesg = 'Registro excluido com sucesso!';
		}
	
	echo "<script>alert('$mesg');</script>";

 }

?>
<script language="javascript" type="text/javascript">//<!--

    function excluirRegistro(f) {
    	if (f.txa_mtv_exclusao.value == '' || f.txt_id_solicitacao.value == '') {
    		alert('Campo obrigat�rio n�o preenchido!');	
    	} else {
	    	if(confirm('Esta opera��o n�o poder� ser desfeita. Deseja continuar?')) {
		    	f.hdn_funcao.value="excluir";
		    	f.submit();	
	    	}
    	}
    }

    function consultaReg(campo1,campo2,campo3,arq) {
      cp3= campo3.value;
      if ((campo1.value!="")&&(campo2.value!="")) {
        window.open(arq+"?campo="+campo1.value+"&campo2="+campo2.value+"&campo3="+cp3,"consulanalise","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }
    function retorna(frm) {
      frm.btn_incluir.value="Incluir";
      frm.hdn_controle.value="1";
      frm.txt_id_protocolo.readOnly=false;
    }
    function verpend(campo) {
      if (campo.value!="") {
        document.frm_analise.txa_mtv_indeferimento.disabled=false;
        document.frm_analise.hdn_mtv_indeferimento.value=document.frm_analise.txa_mtv_indeferimento.value;
        document.frm_analise.txa_mtv_indeferimento.focus();
      } else {
        document.frm_analise.txa_mtv_indeferimento.disabled=true;
        document.frm_analise.hdn_mtv_indeferimento.value="";
      }
    }
    function verfica_textarea(campo) {
      document.frm_analise.hdn_mtv_indeferimento.value=campo.value;
    }
    function envia(edificacao) {
      var frm_ed = document.frm_analise;
      window.open("./modulos/edificacoes/edificacao_p.php?hdn_id_solicitacao="+frm_ed.hdn_id_solicitacao.value+"&hdn_id_cidade="+frm_ed.hdn_id_cidade.value+"&hdn_id_tipo_solicitacao="+frm_ed.hdn_id_tipo_solicitacao.value+"&hdn_id_edificacao="+edificacao+"&alt=1","cad_ed","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=500,innerwidth=780,innerheight=500")
    }
    function envia_cons_ed() {
      var frm_ed = document.frm_analise;
      window.open("./modulos/edificacoes/consulta_edificacao.php?hdn_id_cidade="+frm_ed.hdn_id_cidade.value,"cons_ed","top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=780,height=500,innerwidth=780,innerheight=500")
    }
    
//--></script>

<body onload="ajustaspan()">
<form target="_self" enctype="multipart/form-data" method="post" name="frm_analise" onreset="retorna(this)" onsubmit="return validaForm(this,'hdn_mtv_indeferimento,Motivo do Indeferimento,t','txt_id_edificacao,Nenhuma Edifica��o Selecionada,t','hdn_id_carac_edificacao,Nenhum Sistema de Seguran�a Selecionado,t')">
<input type="hidden" name="op_menu" value="<?=$_POST['op_menu']?>">
	  <input type="hidden" name="hdn_funcao" value="excluir" />
          <input type="hidden" name="hdn_id_protocolo" value="" />
          <input type="hidden" name="hdn_id_solicitacao" value="" />
          <input type="hidden" name="hdn_id_edificacao" value="" />

	  <fieldset>
	  <legend>Excluir Funcionamento Permanentemente</legend>

            <table width="100%" cellspacing="2" border="0" cellpadding="2" align="center">
              <tr>
                <td>
                     <fieldset>
                     <legend>Protocolo/Cidade</legend> 
            		<input type="hidden" name="rbx_tipo" value="funcionamento">
			Protocolo <input type="text" name="txt_id_solicitacao" class="campo_obr" size="15" maxlength="11" value="">

                        <select name="cmb_id_cidade" value="" class="campo_obr" onChange="acerta_hdn(this); consultaReg(document.frm_vist_manutencao.hdn_id_cidade,document.frm_vist_manutencao.txt_id_prot_manutencao);" onblur="consultaReg(this,document.frm_analise.txt_id_solicitacao,document.frm_analise.rbx_tipo,'./modulos/gerencial/cons_excluir.php')">
                                  <option value="">ESCOLHA A CIDADE</option>
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
                      </tr>
		    </fieldset>

                      <tr>
                        <td colspan="4">
                        <fieldset>
                          <legend>Solicitante</legend>
                          <table width="100%" cellspacing="0" border="0" cellpadding="2" align="center">
                            <tr>
                              <td align="right">CNPJ/CPF</td>
                              
                              <td>
                              <input type="text" name="txt_nr_cnpjcpf_solicitante" class="campoDesabilitado" disabled="disabled" title="CNPJ/CPF do Solicitante" size="30" value="" onblur="cpfcnpj(this)"></td>
                              <td align="right">Nome</td>
                              <td><input type="text" name="txt_nm_solicitante" class="campoDesabilitado" disabled="disabled" title="Nome do Solicitante do Projeto" size="67" value=""></td>
                            </tr>
                            <tr>
                              <td align="right">Fone</td>
                              <td><input type="text" name="txt_nr_fone_solicitante" class="campoDesabilitado" disabled="disabled" title="Fone do Solicitante" size="30" value=""></td>
                              <td align="right">E-mail</td>
                              <td><input type="text" name="txt_nm_email_solicitante" class="campoDesabilitado" disabled="disabled" title="E-mail do Solicitante do Projeto" size="67" value="" style="text-transform : none;"></td>
                            </tr>
                          </table>
                        </fieldset>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="4">
                        <fieldset>
                          <legend>Edifica��o</legend>
                          <table width="100%" cellspacing="0" border="0" cellpadding="2" align="center">
                            <tr>
                              <td align="right" nowrap="true">Registro da Edifica��o</td>
                              <td>
                                <input type="text" disabled="disabled" name="txt_id_edificacao" value="" class="campoDesabilitado" size="18" maxlength="10" align="right" readOnly="true">
                              </td>
                              <td align="right">Nome</td>
                              <td colspan="3"><input type="text" disabled="disabled" name="txt_nm_edificacao" size="65" class="campoDesabilitado" title="Nome da Edifica��o" value="" readOnly="true"></td>
                            </tr>
                            <tr>
                              <td align="right">�rea Construida</td>
                              <td>
                              <input type="text" align="right" disabled="disabled" name="txt_vl_area_construida" class="campoDesabilitado" size="18" title="Valor da �rea Total Construida da Edifica��o" onkeypress="return validaTecla(this, event, 'n')" onkeyup="FormatNumero(this)" onblur="decimal(this,2)" readOnly="true"><em>(m�)</em>
                              </td>
                              <td colspan="2">&nbsp;</td>
                            </tr>
                          </table>
                        </fieldset>
                        </td>
                      </tr>
   		    <tr>
		    <td>
		      <fieldset><legend>Dados da exclus�o</legend>
			<table width="100%" cellspacing="0" border="0" cellpadding="0" align="left">
			  <tr>
			  <td>Motivo</td>
			  </tr>
			  <tr>
			    <td><textarea name="txa_mtv_exclusao" cols="132" class="campo_obr" rows="2" class="campo" onblur="verfica_textarea(this)" style="text-transform : none;"></textarea></td>
			  </tr>
			</table>
		      </fieldset>
		    </td>
		    </tr>
		    <?
		      $query_usuario="SELECT NM_USUARIO FROM ".TBL_USUARIO." WHERE ID_USUARIO='$usuario'";
		      $conn->query($query_usuario);
		      $fetch_usuario=$conn->fetch_row();
		    ?>
		    <tr><td colspan="2">
		    <input type="hidden" name="hdn_id_usuario" value="<?=$usuario?>"> 
		    &nbsp;&nbsp;Vistoriador: <?=$fetch_usuario["NM_USUARIO"]?></td>
		    </tr>
		      <tr valign="top" align="center">
	                <td align="center" colspan="4"><br>
			  <table width="50%" cellspacing="0" border="0" cellpadding="0" align="center">
	                    <tr align="center" valign="center">
	                      <td>
	                        <input type="button" name="btn_excluir" value="Excluir" align="middle" title="Excluir" class="botao"  onClick="excluirRegistro(this.form);" >
	                      </td>
	                      <td>
	                        <input type="reset" name="btn_limpar" value="Limpar" align="middle" title="Limpa as Informa��es" class="botao" >
	                      </td>
	                    </tr>
	                  </table>
	                </td>
	              </tr>
                </table>
              </fieldset>
            </td>
          </tr>
      </form>