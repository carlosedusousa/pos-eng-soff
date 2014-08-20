<?

//  include ('../../templates/head.htm');

  $erro="";
  require_once 'lib/loader.php';

  $arquivo="dados_bancarios.php";
  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) {
    die($conn->get_msg());
  }
  $sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
  // executando a consulta
  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) {
    $rotina = $conn->fetch_row();
  }
  
  $global_obj_sessao->load($rotina["ID_ROTINA"]);
  $usuario=$global_obj_sessao->is_logged_in();
  //echo 'atualiza: '.@$_POST['atualiza'];
  if (@$_POST['atualiza']=="sim") {
    $sql= "UPDATE ".TBL_CIDADE." set id_banco='".$_POST['cbm_banco']."',AGENCIA='".$_POST['txt_agencia']."',CONTA='".$_POST['txt_conta']."', CONVENIO='".$_POST['txt_convenio']."', 
		    carteira='".$_POST['cbm_carteira']."', CONTRATO='".$_POST['txt_contrato']."',
                    INSTRUCAO='".$_POST['txt_instrucao']."', ENDERECO='".$_POST['txt_endereco']."', CEDENTE='".$_POST['txt_cedente']."' 
                    WHERE NM_CIDADE='".$_POST['txt_cidade']."'";
     $res= $conn->query($sql);
    if ($conn->get_status()==false) {
      die ($conn->get_msg());
    } else {
//       include ('../../templates/retorno.htm');
    }
  } else {
    if ((isset($_POST["cmb_id_cidade"]))&& (isset($_POST["txt_id_servico"])) && (isset($_POST["txt_nm_servico"])) && (isset($_POST["cmb_ch_boleto_ccbsc"])) && (isset($_POST["cmb_ch_operacao"]))) {
      $erro= MSG_ERR_OBR;
    }
  }    
?>  

<body onload="ajustaspan()">

    <form target="_self" enctype="multipart/form-data" method="post" name="frm_cidade" onreset="retorna(this)" onsubmit="return validaForm(this,'cmb_id_cidade,Cidade,n',)" >
    <input type="hidden" name="op_menu" value="<?=$_POST['op_menu']?>">
      <input type="hidden" name="atualiza" value="nao">
      <table width="90%" cellspacing="5" border="0" cellpadding="0" align="center">
        <tr>
          <td width="60">Cidade</td>
          <td width="10">
            <select name="cmb_id_cidade" class="campo_obr" title="Nome da Cidade onde É Prestado o Serviço" 
            onchange="consultaReg(this,document.frm_cotacao.cmb_id_cidade,'cons_cidade_cotacao.php')">
              <option value="">-------</option>
              <?
                $sql= "SELECT ".TBL_CIDADE.".AGENCIA, ".TBL_CIDADE.".id_banco, ".TBL_CIDADE.".CONTA, ".TBL_CIDADE.".CONVENIO, ".TBL_CIDADE.".carteira, ".TBL_CIDADE.".CONTRATO
  			                         , ".TBL_CIDADE.".INSTRUCAO, ".TBL_CIDADE.".ENDERECO, ".TBL_CIDADE.".CEDENTE
  			                         , ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." 
  			                 LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_USUARIO ='".$usuario."' ORDER BY NM_CIDADE";
                $res= $conn->query($sql);
                if ($conn->get_status()==false) {
                  die($conn->get_msg());
                }
                while ($tupula = $conn->fetch_row()) {
              ?>
              <option value="<?=$tupula['ID_CIDADE']?>"><?=$tupula['NM_CIDADE']?></option>
              <?
                }
              ?>
            </select>
          </td>
		    <td>&nbsp;</td>
		    <td>
		        <input name="submit" type="submit" value="Pesquisar" class="botao" 
       		        style="background-image : url('../../imagens/botao.gif');">
           </td>
        </tr>
        </table>
      </form>
            
          <form target="_self" enctype="multipart/form-data" method="post" name="frm_dados" onreset="retorna(this)" onsubmit="return validaForm(this,'cmb_id_cidade,Cidade,n','txt_agencia,Número da Agência,t','txt_conta,Número da Conta,t','txt_contrato,Número do Contrato,t','txt_instrucao, Instrução,t','txt_endereco, Endereço,t','txt_cedente,Cedente,t')" >
           <input type="hidden" name="atualiza" value="sim">            
            <table width="90%" cellspacing="5" border="0" cellpadding="0" align="center">
               <?
				     $dados="SELECT ".TBL_CIDADE.".NM_CIDADE, ".TBL_CIDADE.".id_banco, ".TBL_CIDADE.".AGENCIA, ".TBL_CIDADE.".CONTA, ".TBL_CIDADE.".CONVENIO, 
						  ".TBL_CIDADE.".carteira, ".TBL_CIDADE.".CONTRATO, ".TBL_CIDADE.".INSTRUCAO, ".TBL_CIDADE.".ENDERECO, ".TBL_CIDADE.".CEDENTE
				               FROM ".TBL_CIDADE." WHERE ".TBL_CIDADE.".ID_CIDADE='".@$_POST["cmb_id_cidade"]."'";
                 $res= $conn->query($dados);
                 $tupula   = $conn->fetch_row();
		 $banco    = $tupula['id_banco'];
		 
// 		 if ($banco == '1') $disabled = '';else $disabled = 'disabled="disabled"'; 
		 $carteira = $tupula['carteira']; //echo "<br>cidade: ".$dados;
		 if($banco=='27'){$nm_banco="BESC";}if($banco=='1'){$nm_banco="BANCO DO BRASIL";}if($banco=='237'){$nm_banco="BRADESCO";}if($banco=='104'){$nm_banco="CAIXA ECONOMICA";}if($banco=='756'){$nm_banco="SICOOB";}
               ?>
               <tr>
                <td>Cidade</td>
                <td><input type="text" name="txt_cidade" value="<?=$tupula['NM_CIDADE']?>" size="20" maxlength="20" class="campo_obr" title="Número da Agência"></td>
              </tr>
              <tr>
                <td>Banco</td>

                <td><select name="cbm_banco" onchange="libera_carteira(this, 'cbm_carteira')">
		  <option value="" selected="selected" > -----------------</option>
		  <option value="27"  <? if ($banco == '27')  echo 'selected="selected"';  ?> >BESC</option>
		  <option value="1"   <? if ($banco == '1')   echo 'selected="selected"';  ?> >BANCO DO BRASIL</option>
		  <option value="237" <? if ($banco == '237') echo 'selected="selected"';  ?> >BRADESCO</option>
		  <option value="104" <? if ($banco == '104') echo 'selected="selected"';  ?> >CAIXA ECONÔMICA</option>
		  <option value="756" <? if ($banco == '756') echo 'selected="selected"';  ?> >SICOOB</option>
		</select>
		</td>
              </tr>
              <tr>
                <td>Agência</td>
                <td><input type="text" name="txt_agencia" value="<?=$tupula['AGENCIA']?>" size="20" maxlength="4" class="campo_obr" title="Número da Agência">(sem dígito verificador)</td>
              </tr>
              <tr>
                <td>Conta</td>
                <td><input type="text" name="txt_conta" value="<?=$tupula['CONTA']?>"  size="20" maxlength="6" class="campo_obr" title="Número da Conta">(sem dígito verificador)</td>
              </tr>
              <tr>
                <td>Convênio</td>
                <td><input type="text" name="txt_convenio" value="<?=$tupula['CONVENIO']?>" size="20" maxlength="20" class="campo_obr" title="Número do Convênio" onblur="tamconvenio(this,'<?=$banco?>','cbm_carteira');" >
		    Carteira: <select name="cbm_carteira" onblur="carteira('cbm_carteira','cbm_banco','txt_convenio','btn_incluir')">
		    <option value="" selected="selected" > Sem Carteira </option>
		    <option value="11" <? if ($carteira == '11') echo 'selected="selected"';  ?> >11</option>
		    <option value="18" <? if ($carteira == '18') echo 'selected="selected"';  ?> >18</option>
		
	      </select>
	    
	      </td>
              </tr>
	        <tr>
                <td>Endereço</td>
                <td><input type="text" name="txt_endereco" value="<?=$tupula['ENDERECO']?>" size="50" maxlength="20" class="campo_obr" title="Endereço"></td>
              </tr>              
              <tr>
                <td>Cedente</td>
                <td><input type="text" name="txt_cedente" value="<?=$tupula['CEDENTE']?>" size="82" maxlength="82" class="campo_obr" title="Cedente"></td>
              </tr>              
              <tr>
                <td>Instrução</td>
                <td><textarea rows="5" cols="80" name="txt_instrucao"  class="campo_obr" title="Instrução"><?=$tupula['INSTRUCAO']?></textarea></td>
              </tr>              
              <tr>
                <td></td>
                <td><input type="hidden" name="txt_contrato" value="<?=$tupula['CONVENIO']?>" size="20" maxlength="20" class="campo_obr" title="Número do Contrato"></td>
              </tr>                 
              <tr valign="top" align="center">
                <td align="center" colspan="4"><br>
                <table width="50%" cellspacing="0" border="0" cellpadding="0" align="center">
                    <tr align="center" valign="center">
                      <td>
			<?
			      if ($global_inclusao=="S") {
			?>
			      <input type="hidden" name="hdn_controle" value="1">
			      <input type="submit" name="btn_incluir" onClick="carteira('cbm_carteira','cbm_banco','txt_convenio','this')" value="Incluir" align="middle" title="Inclui o Registro" class="botao" style="background-image : url('../../imagens/botao.gif');">
			<?
			      } else {
			?>
			      <input type="hidden" name="hdn_controle" value="2">
			      <input type="submit" name="btn_incluir" value="Alterar" align="middle" title="Altera o Registro" class="botao" disabled="true" style="background-image : url('../../imagens/botao2.gif');">
			<?
			      }
			?>
                      </td>
                      <td>
                        <input type="reset" name="btn_limpar" value="Limpar" align="middle" title="Limpa as Informações" class="botao"  style="background-image : url('../../imagens/botao.gif');">
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </form>
