<?
 //include ('../../templates/head_cons.htm');
?>
<?
  $erro="";
  require_once 'lib/loader.php';
// especificando o DSN (Data Source Name)
  //$dsn= "mysql://$user:$pass@$host/$bd";

// Conectando ao BD BD ($host, $user, $pass, $db)
  $arquivo="edificacao.php";
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
  if ((@$_POST["hdn_carrega"]==1)&&(@$_POST["hdn_id_cidade"]!="")&&(@$_POST["hdn_id_edificacao"]!="")) {
    $query_ed="SELECT ".TBL_EDIFICACAO.".ID_EDIFICACAO, ".TBL_EDIFICACAO.".NM_EDIFICACAO, ".TBL_EDIFICACAO.".NR_EDIFICACAO, ".TBL_EDIFICACAO.".ID_CEP, ".TBL_EDIFICACAO.".NM_COMPLEMENTO, ".TBL_EDIFICACAO.".VL_AREA_CONSTRUIDA, ".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO, ".TBL_TP_LOGRADOURO.".NM_TP_LOGRADOURO, ".TBL_LOGRADOURO.".ID_LOGRADOURO ,".TBL_LOGRADOURO.".NM_LOGRADOURO, ".TBL_BAIRROS.".ID_BAIRROS, ".TBL_BAIRROS.".NM_BAIRROS, ".TBL_CIDADE.".ID_CIDADE ,".TBL_CIDADE.".NM_CIDADE, IFNULL(".TBL_CARAC_ED.".ID_CARC_EDIFICACAO,'') AS ID_CARC_EDIFICACAO, IFNULL(".TBL_CARAC_ED.".CH_ATIVO,'N') AS CH_ATIVO FROM ".TBL_EDIFICACAO." LEFT JOIN ".TBL_CIDADE." ON (".TBL_EDIFICACAO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_CARAC_ED." ON (".TBL_EDIFICACAO.".ID_EDIFICACAO=".TBL_CARAC_ED.".ID_EDIFICACAO AND ".TBL_EDIFICACAO.".ID_CIDADE=".TBL_CARAC_ED.".ID_CIDADE) LEFT JOIN ".TBL_CEP." ON (".TBL_EDIFICACAO.".ID_CEP=".TBL_CEP.".ID_CEP AND ".TBL_EDIFICACAO.".ID_CIDADE_CEP=".TBL_CEP.".ID_CIDADE AND ".TBL_EDIFICACAO.".ID_LOGRADOURO=".TBL_CEP.".ID_LOGRADOURO) LEFT JOIN ".TBL_LOGRADOURO." ON (".TBL_CEP.".ID_LOGRADOURO=".TBL_LOGRADOURO.".ID_LOGRADOURO AND ".TBL_CEP.".ID_CIDADE=".TBL_LOGRADOURO.".ID_CIDADE) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_LOGRADOURO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) LEFT JOIN ".TBL_BAIRROS." ON (".TBL_LOGRADOURO.".ID_BAIRROS=".TBL_BAIRROS.".ID_BAIRROS AND ".TBL_LOGRADOURO.".ID_CIDADE_BAIRROS=".TBL_BAIRROS.".ID_CIDADE) WHERE ".TBL_EDIFICACAO.".ID_CIDADE=".$_POST["hdn_id_cidade"]." AND ".TBL_EDIFICACAO.".ID_EDIFICACAO=".$_POST["hdn_id_edificacao"]." ORDER BY ".TBL_CARAC_ED.".CH_ATIVO DESC, ".TBL_CARAC_ED.".DT_CARC_EDIFICACAO DESC, ".TBL_CARAC_ED.".ID_CARC_EDIFICACAO DESC LIMIT 1";
    echo "<!--aqui:\n$query_ed\n-->\n";
    $res= $conn->query($query_ed);
    if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $edificacao=$conn->fetch_row();
?>
  <script language="javascript" type="text/javascript">//<!--
    window.opener.document.frm_analise.hdn_id_carac_edificacao.value="<?=trim($edificacao["ID_CARC_EDIFICACAO"])?>";
    window.opener.document.frm_analise.txt_nm_edificacao.value="<?=$edificacao["NM_EDIFICACAO"]?>";
    window.opener.document.frm_analise.txt_id_edificacao.value="<?=$edificacao["ID_EDIFICACAO"]?>";
    window.opener.document.frm_analise.hdn_id_tp_prefixo.value="<?=$edificacao["ID_TP_LOGRADOURO"]?>";
    window.opener.document.frm_analise.txt_nm_tp_prefixo.value="<?=$edificacao["NM_TP_LOGRADOURO"]?>";
    window.opener.document.frm_analise.txt_nm_logradouro.value="<?=$edificacao["NM_LOGRADOURO"]?>";
    window.opener.document.frm_analise.txt_nr_edificacao.value="<?=$edificacao["NR_EDIFICACAO"]?>";
    window.opener.document.frm_analise.txt_nm_bairro.value="<?=$edificacao["NM_BAIRROS"]?>";
    window.opener.document.frm_analise.txt_id_cep.value="<?=$edificacao["ID_CEP"]?>";
    CEP(window.opener.document.frm_analise.txt_id_cep);
    window.opener.document.frm_analise.hdn_id_cidade.value="<?=$edificacao["ID_CIDADE"]?>";
    window.opener.document.frm_analise.txt_nm_cidade.value="<?=$edificacao["NM_CIDADE"]?>";
    window.opener.document.frm_analise.txt_nm_complemento.value="<?=$edificacao["NM_COMPLEMENTO"]?>";
    window.opener.document.frm_analise.txt_vl_area_construida.value="<?=str_replace(".",",",$edificacao["VL_AREA_CONSTRUIDA"])?>";
    FormatNumero(window.opener.document.frm_analise.txt_vl_area_construida);
    decimal(window.opener.document.frm_analise.txt_vl_area_construida,2);
<?
  if ($edificacao["ID_CARC_EDIFICACAO"]=="") {
?>
      window.opener.alert("Edificação sem Sistema de Segurança!!");
<?
  }
?>
    window.close();
  //--></script>


<?
  }
?>
<script language="javascript" type="text/javascript">//<!--

    function ed_seta(edificacao,cidade) {
      document.frm_consulta_edifcacao.hdn_id_cidade.value=cidade;
      document.frm_consulta_edifcacao.hdn_id_edificacao.value=edificacao;
    }
    function novo_reg() {
      window.opener.envia(0);
      window.close();
    }
    function alterar_reg() {
      window.opener.envia(document.frm_consulta_edifcacao.hdn_id_edificacao.value);
      window.close();
    }
    function carregar_reg() {
      document.frm_consulta_edifcacao.hdn_carrega.value="1";
      document.frm_consulta_edifcacao.submit();
    }
    function ajustaspan1() {
      var obj=document.getElementById("corpo");
      var objln=document.getElementById("lncorpo");
      var objtb=document.getElementById("tbcorpo");
         obj.style.height="290px";
         objln.style.height="295px";
      /*
        obj.style.height="295px";
        objln.style.height="300px";
      */
//         objtb.style.marginLeft="0px";
    }
//--></script>
<body onload="ajustaspan()"> <!--onload="ajustaspan1()"-->
<?
// include ('../../templates/cab_cons.htm');
?>



          <form target="_self" enctype="multipart/form-data" method="post" name="frm_consulta_edifcacao" onreset="retorna(this)" onsubmit="return validaForm(this,'txt_pesq_edificacao,Nome da Pesquisa,t')">
	    <table width="95%" cellspacing="0" border="0" cellpadding="0" align="center">
<head>
           <link rel="stylesheet" type="text/css" href="./../../css/menu.css">
	<link type="text/css" rel="stylesheet" href="./../../css/calendario.css" />
	<link rel="stylesheet" type="text/css" href="./../../css/ebombeiro.css">
</head>
              <tr>
                <td>
                  <input type="hidden" name="hdn_id_cidade" value="">
                  <input type="hidden" name="hdn_id_edificacao" value="">
                  <input type="hidden" name="hdn_carrega" value="">
                  <font color="BLUE">Tipo de Pesquisa
                </td>
                <td>
                  <select name="cmb_campo"  >
                    <option value="ID_EDIFICACAO">RE</option>                   
                    <option value="NM_EDIFICACAO_FONETICA">Nome da Edificação</option>
                    <option value="NM_FANTASIA_FONETICA_1">Nome da Fantasia 1</option>
                  </select>
                </td>
                <td>
                <input type="text" name="txt_pesq_edificacao" value="" class="campo_obr" style="text-transform : none;">
                </td>
                <td>
                  <input type="submit" name="btn_pesquisa" value="Pesquisar" class="botao"  title="Pesquisa Edificação">
                </td>
              </tr>
              <tr>
                <td colspan=4>
                  <table width="100%" cellspacing="0" cellpadding="0" border="1">
                    <tr style="font-weight : bold;">
                      <td> Seleção</td>
               <td>RE</td>
                      <td>Nome Edificação</td>
                      <td>Nome Fantasia 1</td>
                    </tr>
<?

if ((@$_POST["cmb_campo"]!="")&&(@$_POST["txt_pesq_edificacao"]!="")&&(@$_POST["hdn_id_cidade"]!="")) {
    $pesquisa_fo=nr_txt_fonetica($_POST["txt_pesq_edificacao"]);
    if ($_POST["cmb_campo"]=="ID_EDIFICACAO") {
      $where=TBL_EDIFICACAO.".".$_POST["cmb_campo"]." = ".($_POST["txt_pesq_edificacao"]+0);
    } else {
      $where=TBL_EDIFICACAO.".".$_POST["cmb_campo"]." LIKE '%".$pesquisa_fo."%'";
    }
    $query="SELECT ".TBL_EDIFICACAO.".ID_EDIFICACAO,".TBL_EDIFICACAO.".ID_CIDADE, ".TBL_EDIFICACAO.".NM_EDIFICACAO, "
                    .TBL_EDIFICACAO.".NM_FANTASIA_1, ".TBL_EDIFICACAO.".ID_EDIFICACAO 
            FROM ".TBL_EDIFICACAO." 
            WHERE ".TBL_EDIFICACAO.".ID_CIDADE=".$_POST["hdn_id_cidade"]." 
            AND $where 
            ORDER BY ".TBL_EDIFICACAO.".NM_EDIFICACAO, ".TBL_EDIFICACAO.".".$_POST["cmb_campo"];
    echo "<!--aqui 0:$query-->\n";
    $conn->query($query);
     if ($conn->get_status()==false) {
      die($conn->get_msg());
    }
    $rows=$conn->num_rows();
    if ($rows>0) {
      $cont=1;
      while ($tupula = $conn->fetch_row()) {
        $resto=$cont%2;
        if ($resto!=0) {
?>
                    <tr style="background-color : #4ab;">         <!--  #9bd5ff;-->
<?
        } else {
?>
                    <tr style="background-color : #ffffff;">
<?
        }
        $cont++;
?>
                      <td><input type="radio" name="rdn_edificacoa" onChange="ed_seta('<?=$tupula["ID_EDIFICACAO"]?>','<?=$tupula["ID_CIDADE"]?>')"></td>
                      <td><?=$tupula["ID_EDIFICACAO"]?></td>
                      <td><?=$tupula["NM_EDIFICACAO"]?></td>
                      <td><?=$tupula["NM_FANTASIA_1"]?></td>
                    </tr>
<?
    }
  }
}
?>
                  </table>
                </td>
              </tr>
           </table>

<?

  include('/var/www/bombeiro/templates/btn_cons.htm');

?>
          </form>
          <script language="javascript" type="text/javascript">//<!--
<?
  if (@$_GET["hdn_id_cidade"]!="") {
?>
            document.frm_consulta_edifcacao.hdn_id_cidade.value="<?=$_GET["hdn_id_cidade"]?>";
<?
  } elseif (@$_POST["hdn_id_cidade"]!="") {
?>
            document.frm_consulta_edifcacao.hdn_id_cidade.value="<?=$_POST["hdn_id_cidade"]?>";
<?
  } else {
?>
            window.close();
<?
  }
?>
          //-->
          </script>
        </span>
      </td>
    </tr>
    <tr>
      <td align="center" style="font-size : 10px; font-weight : bold;">
       <font color="BLUE" ><b> Obs: Os campos sinalizados em Vermelho são Obrigatórios
      </td>
    </tr>
  </tbody>
</table>
</body>
</html>
