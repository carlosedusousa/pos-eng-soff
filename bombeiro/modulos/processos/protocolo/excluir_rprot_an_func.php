<?

  if ((@$_GET["txt_id_protocolo"]!="") && (@$_GET["txt_id_cidade"]!="")) {
  //if (1==1) {
    require_once 'lib/loader.php';
    require_once 'lib/fpdf.php';
  // especificando o DSN (Data Source Name)
    //$dsn= "mysql://$user:$pass@$host/$bd";

  // Conectando ao BD BD ($host, $user, $pass, $db)
    $arquivo="prot_an_func.php";
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
/*
    $ID_PROT_ANALISE_FUNC=4;
    $ID_CIDADE=8045;
    */
    $ID_PROT_ANALISE_FUNC=@$_GET["txt_id_protocolo"];
    $ID_CIDADE=@$_GET["txt_id_cidade"];

//$ID_PROT_ANALISE_FUNC=5;
//    $query="SELECT ID_PROT_ANALISE_FUNC, DATE_FORMAT(DT_SOLICITACAO,'%d/%m/%Y') DT_SOLICITACAO, ".TBL_USUARIO.".NM_USUARIO, NM_SOLICITANTE, CNPJ_CPF_SOLICITANTE, NR_FONE_SOLICITANTE, DE_EMAIL_SOLICITANTE, NM_EDIFICACOES_LX, NM_TP_LOGRADOURO,NM_LOGRADOURO, NR_EDIFICACOES_LX, NR_CEP, NM_CIDADE, NM_BAIRRO, NM_COMPLEMENTO, VL_AREA_CONTRUIDA, ".TBL_USUARIO.".ID_USUARIO FROM ".TBL_PROTOCOLOS." LEFT JOIN ".TBL_SOLICITACAO." ON (".TBL_PROTOCOLOS.".ID_SOLICITACAO=".TBL_SOLICITACAO.".ID_SOLICITACAO) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_SOLICITACAO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) LEFT JOIN ".TBL_CIDADE." ON (".TBL_SOLICITACAO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_USUARIO." ON (".TBL_PROTOCOLOS.".ID_USUARIO=".TBL_USUARIO.".ID_USUARIO) WHERE ".TBL_PROTOCOLOS.".ID_CIDADE=".$ID_CIDADE." AND ".TBL_PROTOCOLOS.".ID_PROT_ANALISE_FUNC=".$ID_PROT_ANALISE_FUNC;
    $query="SELECT ID_PROT_ANALISE_FUNC, DATE_FORMAT(DT_SOLICITACAO,'%d/%m/%Y') DT_SOLICITACAO, ".TBL_USUARIO.".NM_USUARIO, NM_SOLICITANTE, CNPJ_CPF_SOLICITANTE, NR_FONE_SOLICITANTE, DE_EMAIL_SOLICITANTE, NM_EDIFICACOES_LX, NM_FANTASIA_EMPRESA, NM_TP_LOGRADOURO,NM_LOGRADOURO, NR_EDIFICACOES_LX, NR_CEP, NM_CIDADE, NM_BAIRRO, NM_COMPLEMENTO, VL_AREA_CONTRUIDA, ".TBL_USUARIO.".ID_USUARIO FROM ".TBL_PROT_AN_FUNC." LEFT JOIN ".TBL_SOLICITACAO." ON (".TBL_PROT_AN_FUNC.".ID_SOLICITACAO=".TBL_SOLICITACAO.".ID_SOLICITACAO AND ".TBL_PROT_AN_FUNC.".ID_TIPO_SOLICITACAO=".TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO AND ".TBL_PROT_AN_FUNC.".ID_CIDADE=".TBL_SOLICITACAO.".ID_CIDADE) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_SOLICITACAO.".ID_TP_LOGRADOURO=".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) LEFT JOIN ".TBL_CIDADE." ON (".TBL_SOLICITACAO.".ID_CIDADE=".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_USUARIO." ON (".TBL_PROT_AN_FUNC.".ID_USUARIO=".TBL_USUARIO.".ID_USUARIO) WHERE ".TBL_PROT_AN_FUNC.".ID_CIDADE=".$ID_CIDADE." AND ".TBL_PROT_AN_FUNC.".ID_PROT_ANALISE_FUNC=".$ID_PROT_ANALISE_FUNC;
    //echo "aqui ==>$query|\n";
    $res= $conn->query($query);
    $tupula=$conn->fetch_row();

    $pdf=new FPDF("P","mm","A4");
    $pdf->Open();

    $pdf->AddPage();
    $pdf->SetMargins(5,10,10);
    //$pdf->SetXY(1, 5);

    $ret1L=4;
    $ret1Largura=205;
    $ret1Altura=15;

    $ret2L=4;
    $ret2Largura=205;
    $ret2Altura=30;

    $ret3L=5;
    $ret3Largura=203;
    $ret3Altura=15;

    $ret4L=5;
    $ret4Largura=203;
    $ret4Altura=12;

  $pdf->SetFont('arial', 'B', 8);
  $pdf->SetX(20);
  $pdf->Cell(0,5,"SECRETARIA DE SEGURANÇA PÚBLICA E DEFESA DO CIDADÃO",0,0,'L',0);
  $pdf->ln();
  $pdf->SetX(20);
  $pdf->Cell(0,5,"CORPO DE BOMBEIROS MILITAR",0,0,'L',0);
  $pdf->ln();
  $pdf->SetX(20);
  $pdf->Cell(0,5,"DIRETORIA DE ATIVIDADES TÉCNICAS",0,0,'L',0);
  $pdf->ln();
  $pdf->SetX(20);
//   $pdf->Cell(0,5,"Rua Almirante Lamego, 381 Florianópolis - SC",0,0,'L',0);
  $pdf->ln();
  $pdf->SetX(20);
//   $pdf->Cell(0,5,"CEP 88.015-600 - Fone 48 - 251-9600",0,0,'L',0);
  $pdf->ln();
  $pdf->SetX(20);
  $pdf->Cell(0,5,"PROTOCOLO DE PROJETO DE FUNCIONAMENTO",0,0,'C',0);

$pdf->Image("../../imagens/brasaodocumento.jpg",5,10,15,15);

    /*
    $pdf->SetFont('arial', 'B', 8);
    $pdf->SetX(20);
    $pdf->Cell(0,5,"SECRETARIA DE SEGURANÇA PÚBLICA E DEFESA DO CIDADÃO",0,0,'L',0);
    $pdf->ln();
    $pdf->SetX(20);
    $pdf->Cell(0,5,"CORPO DE BOMBEIROS MILITAR",0,0,'L',0);
    $pdf->ln();
    $pdf->SetX(20);
    $pdf->Cell(0,5,"DIRETORIA DE ATIVIDADES TÉCNICAS",0,0,'L',0);
    $pdf->ln();
    $pdf->SetX(20);
    $pdf->Cell(0,5,"Rua Almirante Lamego, 381 Florianópolis - SC",0,0,'L',0);
    $pdf->ln();
    $pdf->SetX(20);
    $pdf->Cell(0,5,"CEP 88.015-600 - Fone 48 - 251-9600",0,0,'L',0);

    /*
    $pdf->ln();
    $pdf->SetFont('arial', '', 6);
    $pdf->MultiCell(0,3,"Prezado Sr. Através do presente, solicitamos a V.Sª. que seja efetuado o cadastro de\nProtocolo para Análise de Projeto conforme segue abaixo identificado.",0,'C',0);
    */
    $pdf->ln();
    $pdf->SetFillColor(255,255,255);
    $pdf->SetFont('arial', '', 8);
    $pdf->SetX(20);
    $pdf->Rect($ret1L,($pdf->GetY()+2),$ret1Largura,$ret4Altura);
    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(20,5,"Protocolo",0,0,'L',1);
    $pdf->ln();


    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(15,5,"Número",0,0,'L',0);
    $pdf->SetFont('arial', 'B', 8);
    $pdf->Cell(30,5,$tupula["ID_PROT_ANALISE_FUNC"],0,0,'L',0);
    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(30,5,"Data da Solicitação",0,0,'L',0);
    $pdf->SetFont('arial', 'B', 8);
    $pdf->Cell(30,5,$tupula["DT_SOLICITACAO"],0,0,'L',0);
    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(30,5,"Protocolista",0,0,'L',0);
    $pdf->SetFont('arial', 'B', 8);
    $pdf->Cell(50,5,$tupula["NM_USUARIO"],0,0,'L',0);
    $pdf->ln();

    $pdf->ln();
    $pdf->SetFillColor(255,255,255);
    $pdf->SetFont('arial', '', 8);
    $pdf->SetX(20);

    $pdf->Rect($ret1L,($pdf->GetY()+2),$ret1Largura,$ret1Altura);

    $pdf->Cell(30,5,"Empresa",0,0,'L',1);
    $pdf->ln();
    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(10,5,"Nome",0,0,'L',0);
    $pdf->SetFont('arial', 'B', 8);
    $pdf->Cell(100,5,$tupula["NM_SOLICITANTE"],0,0,'L',0);
    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(20,5,"CNPJ/CPF",0,0,'L',0);
    $pdf->SetFont('arial', 'B', 8);
    $pdf->Cell(30,5,formatCPFCNPJ($tupula["CNPJ_CPF_SOLICITANTE"]),0,0,'L',0);
    $pdf->ln();
    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(10,5,"Fone",0,0,'L',0);
    $pdf->SetFont('arial', 'B', 8);
    $pdf->Cell(20,5,$tupula["NR_FONE_SOLICITANTE"],0,0,'L',0);
    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(15,5,"Fantasia",0,0,'L',0);
    $pdf->SetFont('arial', 'B', 8);
    $pdf->Cell(105,5,$tupula["NM_FANTASIA_EMPRESA"],0,0,'L',0);
    $pdf->ln();
    $pdf->SetX(20);

    $pdf->ln();
    $pdf->SetX(20);

    $pdf->Rect($ret2L,($pdf->GetY()+2),$ret2Largura,$ret2Altura);

    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(30,5,"Edificação",0,0,'L',1);
    $pdf->ln();
    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(10,5,"Nome",0,0,'L',0);
    $pdf->SetFont('arial', 'B', 8);
    $pdf->Cell(90,5,$tupula["NM_EDIFICACOES_LX"],0,0,'L',0);

    $pdf->ln();
    $pdf->SetX(20);

    $pdf->Rect($ret3L,($pdf->GetY()+2),$ret3Largura,$ret3Altura);

    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(30,5,"Endereço",0,0,'L',1);
    $pdf->ln();
    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(20,5,"Logradouro",0,0,'L',0);
    $pdf->SetFont('arial', 'B', 8);
    $pdf->Cell(90,5,$tupula["NM_TP_LOGRADOURO"].": ".$tupula["NM_LOGRADOURO"],0,0,'L',0);
    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(5,5,"N°",0,0,'L',0);
    $pdf->SetFont('arial', 'B', 8);
    $pdf->Cell(10,5,$tupula["NR_EDIFICACOES_LX"],0,0,'R',0);

    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(10,5,"Cidade",0,0,'L',0);
    $pdf->SetFont('arial', 'B', 8);

    $pdf->Cell(20,5,$tupula["NM_CIDADE"],0,0,'L',0);
    $pdf->ln();


    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(10,5,"Bairro",0,0,'L',0);
    $pdf->SetFont('arial', 'B', 8);
    $pdf->Cell(40,5,$tupula["NM_BAIRRO"],0,0,'L',0);
    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(10,5,"CEP",0,0,'L',0);
    $pdf->SetFont('arial', 'B', 8);
    $pdf->Cell(20,5,formatCEP($tupula["NR_CEP"]),0,0,'L',0);
    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(20,5,"Complemento",0,0,'L',0);
    $pdf->SetFont('arial', 'B', 8);
    $pdf->Cell(50,5,$tupula["NM_COMPLEMENTO"],0,0,'L',0);

    $pdf->SetFont('arial', '', 8);
    $pdf->Cell(15,5,"Área Total",0,0,'L',0);
    $pdf->SetFont('arial', 'B', 8);
    $pdf->Cell(20,5,formatNumero($tupula["VL_AREA_CONTRUIDA"]),0,0,'R',0);
    $pdf->SetXY(20,250);
    $sql="SELECT ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_USUARIO." ON (".TBL_CIDADE.".ID_CIDADE=".TBL_USUARIO.".ID_CIDADE) WHERE ".TBL_USUARIO.".ID_USUARIO='".$tupula["ID_USUARIO"]."'";
    $res= $conn->query($sql);

// testando se houve algum erro
    if ($conn->get_status()==false) {
      die($conn->get_msg());
    }


    $pdf->Cell(50,5,"DATA DE EMISSÃO: ".date("d/m/Y",time()),0,'L',0);
    if ($conn->num_rows()>0) {
      $quartel = $conn->fetch_row();
      $pdf->Cell(100,5,"Quartel de ".$quartel["NM_CIDADE"],0,'L',0);
    }
    $pdf->ln();
    $pdf->ln();
    $pdf->ln();
    $pdf->ln();
    $pdf->Cell(50,5,"",0,0,'C',0);

    $pdf->Cell(100,5,$tupula["NM_USUARIO"],'T',0,'C',0);


    $arquivo="prot_an_func.pdf";
    $pdf->Output($arquivo);
    echo "<script language='JavaScript'><!--\n";
    echo "  var xw = screen.availWidth;\n";
    echo "  var xh = screen.availHeight;\n";
    echo "  objdown='".$arquivo."';\n";
    echo "  down=window.open(objdown,'down','top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,fullscreen=no,width='+xw+'px,height='+xh+'px,innerwidth='+xw+'px,innerheight='+xh+'px');\n";
    echo "  down.focus();\n";
    echo "-->\n</script>\n";
  } else {
  echo "<script language='JavaScript'><!--\n";
  echo "  alert('Variáveis de Requisição não Transmitidas, Contate o DITI!');\n";
  echo "-->\n</script>\n";
}
    echo "<script language='JavaScript'><!--\n";
    echo "  window.close();\n";
    echo "-->\n</script>\n";

?>