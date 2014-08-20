<?
  include ('../../templates/head.htm');
  $erro="";
  require_once 'lib/loader.php';

  $arquivo="inc_pessoas.php";
  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
  if ($conn->get_status()==false) {
    die($conn->get_msg());
  }
  $sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";

  $res= $conn->query($sql);
  $rows_rotina=$conn->num_rows();
  if ($rows_rotina>0) {
    $rotina = $conn->fetch_row();
  }
  
  $global_obj_sessao->load(@$rotina["ID_ROTINA"]);
  $usuario		= $global_obj_sessao->is_logged_in();

  $global_inclusao = $_GET["global_inclusao"];
  $cpf 			= str_replace('.','',str_replace('-','',str_replace('/','',$_GET["cpf"])));
  $nome			= $_GET["nome"];
  @$id_cidade	= $_POST["cmb_id_cidade"];
  @$controle	= $_POST["hdn_controle"];

  if($controle=='1'){

     $cidade	= $_POST["hdn_cidade"];
     $insere	= "insert into ".TBL_PESSOA." (ID_CNPJ_CPF, ID_CIDADE,NM_PESSOA) values('$cpf','$cidade','$nome')";
     $res		= $conn->query($insere);
     $rows_ins	=$conn->num_rows();
     if ($rows_ins>0) $rotina	= $conn->fetch_row();

     if ($conn->get_status()==false) die ($conn->get_msg());

	?>
	<script language="javascript" type="text/javascript">//<!--
    	window.close();
  	//--></script>
	<?
  }
?>
<body onload="ajustaspan()">
<?
 include ('../../templates/cab.htm');
?>
    <form target="_self" enctype="multipart/form-data" method="post" name="frm_cidade" onreset="retorna(this)" onsubmit="return validaForm(this,'cmb_id_cidade,Cidade,n',)" >
      <table width="90%" border="0" cellpadding="0" align="center">
        <tr>
          <td width="100">Cidade</td>
          <td>
            <select name="cmb_id_cidade" class="campo_obr" title="Nome da cidade onde é prestado o serviço" 
            onchange="consultaReg(this,document.frm_cotacao.cmb_id_cidade,'cons_cidade_cotacao.php')">
              <option value="">-------</option>
              <?
                $sql = "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_USUARIO ='".$usuario."' ORDER BY NM_CIDADE";
                $res= $conn->query($sql);
                if ($conn->get_status()==false)  die($conn->get_msg());
                while ($tupula = $conn->fetch_row()) {
              		?><option value="<?=$tupula['ID_CIDADE']?>"><?=$tupula['NM_CIDADE']?></option><?
                }
              ?>
            </select>&nbsp;
            <input name="submit" type="submit" value="Inserir" class="botao" style="background-image : url('../../imagens/botao.gif');">
           </td>
        </tr>
        </table>
      </form>
            
          <form target="_self" enctype="multipart/form-data" method="post" name="frm_dados" onreset="retorna(this)" onsubmit="return validaForm(this,'cmb_id_cidade,Cidade,n')" >
		<input type="hidden" name="hdn_cidade" value="<?=$id_cidade?>">
            <table width="90%" cellspacing="5" border="0" cellpadding="0" align="center">
               <?
		 		 $dados="SELECT ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." WHERE ".TBL_CIDADE.".ID_CIDADE='".@$_POST["cmb_id_cidade"]."'";
                 $res= $conn->query($dados);
                 $tupula=$conn->fetch_row();
               ?>
               <tr>
                <td>Cidade</td>
                <td>
                	<input type="text" name="txt_cid" value="<?=$tupula['NM_CIDADE']?>" size="20" maxlength="20" class="campo_obr" title="Número da Agência" disabled>
                	<input type="hidden" name="txt_cidade" value="<?=$tupula['NM_CIDADE']?>">
				</td>
              </tr>
              <tr>
                <td>Nome</td>
                <td><input type="text" name="txt_nome" value="<?=$nome?>" size="20" maxlength="80" class="campo_obr"></td>
              </tr>
              <tr>
                <td>CPF/CNPJ</td>
                <td><input type="text" name="txt_cpf" value="<?=$_GET["cpf"]?>" size="20" maxlength="14" class="campo_obr"></td>
              </tr>
              <tr valign="top" align="center">
                <td align="center" colspan="4"><br>
                <table width="50%" cellspacing="0" border="0" cellpadding="0" align="center">
                    <tr align="center" valign="center">
                      <td>
<?
      if ($global_inclusao=="s") {
?>
                        <input type="hidden" name="hdn_controle" value="1">
                        <input type="submit" name="btn_incluir" value="Incluir" align="middle" title="Inclui o Registro" class="botao" style="background-image : url('../../imagens/botao.gif');">
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
<?
  include ('../../templates/footer.htm');
?>
