<?
if ((@$_GET["id_solicitacao"]!="") && (@$_GET["id_cidade"]!="") && (@$_GET["id_tipo_solicitacao"]!="")) {
  require_once 'lib/conf/conf_bd.php';
  require_once 'lib/conf/conf_msgs.php';
  require_once 'lib/conf/conf_paginas.php';
  require_once 'lib/conf/conf_sistema.php';
  require_once 'lib/misc/sigat.php';
  // incluindo a classe
  require_once 'lib/class/class_mysql.php';
  require_once 'lib/fpdf.php';

// Conectando ao BD
  $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_SOLICITACAO);
  if ($conn->get_status()==false) {
    die($conn->get_msg());
  }

$ID_SOLICITACAO= $_GET["id_solicitacao"];
$ID_CIDADE=$_GET["id_cidade"];
$ID_TIPO_SOLICITACAO=$_GET["id_tipo_solicitacao"];
/*
$ID_SOLICITACAO= 2;
$ID_CIDADE=8045;
$ID_TIPO_SOLICITACAO="'S'";
*/
if (strpos($ID_TIPO_SOLICITACAO,"'")===false) {
  $ID_TIPO_SOLICITACAO="'$ID_TIPO_SOLICITACAO'";
}

//echo "<br>aqui :".$ID_SOLICITACAO."<br>\n";
$pdf=new FPDF("P","mm","A4");
$pdf->Open();

$sql="SELECT CNPJ_CPF_SOLICITANTE , NM_SOLICITANTE , NR_FONE_SOLICITANTE , DE_EMAIL_SOLICITANTE , NM_FANTASIA_EMPRESA,  CNPJ_CPF_PROPRIETARIO , NM_PROPRIETARIO , NR_FONE_PROPRIETARIO , DE_EMAIL_PROPRIETARIO , NM_EDIFICACOES_LX , NM_FANTASIA , NM_LOGRADOURO , NR_EDIFICACOES_LX , NR_CEP , NM_BAIRRO , NM_COMPLEMENTO , VL_AREA_CONTRUIDA , VL_ALTURA , VL_AREA_TIPO , NR_PAVIMENTOS , NR_BLOCOS , CH_SIS_PREVENTIVO_EXTINTOR , NR_ESCADA_COMUM , NR_ESCADA_PROTEGIDA , NR_ESCADA_ENC , NR_ESCADA_PROVA_FUMACA , NR_ESCADA_PRESSU , NR_RAMPA , NR_ELEV_EMERGENCIA , NR_RESG_AEREO , NR_PASSARELA , NR_CREA_1 , NM_ENGENHEIRO_1 , NR_CREA_2 , NM_ENGENHEIRO_2 , NR_CREA_3 , NM_ENGENHEIRO_3 , CH_COMB_GN , CH_COMB_GLP , CH_ABANDONO , CH_FIXO_CO2 , CH_SPRINKLER , CH_ANCORA_CABO , CH_MULSYFIRE , NM_OUTROS , CADASTROS.TP_RISCO.NM_RISCO , CADASTROS.TP_SITUACAO.NM_SITUACAO , CADASTROS.TP_CONSTRUCAO.NM_TP_CONSTRUCAO , CADASTROS.TP_OCUPACAO.NM_OCUPACAO , CADASTROS.TP_ALARME_INCENDIO.NM_TP_ALARME_INCENDIO , CADASTROS.TP_ILU_EMER.NM_ILU_EMERG , CADASTROS.TP_PARA_RAIO.NM_TP_PARA_RAIO , CADASTROS.TP_RECIPIENTE.NM_TP_RECIPIENTE , CADASTROS.TP_INSTALACAO.NM_TP_INSTALACAO , CADASTROS.CIDADE.NM_CIDADE , ".TBL_CIDADE.".ID_CIDADE, CADASTROS.TP_ADUCAO.NM_ADUCAO, NM_TP_LOGRADOURO
FROM ".TBL_SOLICITACAO." LEFT JOIN ".TBL_TP_RISCO." ON (".TBL_SOLICITACAO.".ID_RISCO = ".TBL_TP_RISCO.".ID_RISCO) LEFT JOIN ".TBL_TP_ADUCAO." ON (".TBL_SOLICITACAO.".ID_ADUCAO = ".TBL_TP_ADUCAO.".ID_ADUCAO) LEFT JOIN ".TBL_TP_ALARME_INCENDIO." ON (".TBL_SOLICITACAO.".ID_TP_ALARME_INCENDIO = ".TBL_TP_ALARME_INCENDIO.".ID_TP_ALARME_INCENDIO) LEFT JOIN ".TBL_TP_CONSTRUCAO." ON (".TBL_SOLICITACAO.".ID_TP_CONSTRUCAO = ".TBL_TP_CONSTRUCAO.".ID_TP_CONSTRUCAO) LEFT JOIN ".TBL_TP_ILU_EMER." ON (".TBL_SOLICITACAO.".ID_ILU_EMERG = ".TBL_TP_ILU_EMER.".ID_ILU_EMERG) LEFT JOIN ".TBL_TP_INSTALACAO." ON (".TBL_SOLICITACAO.".ID_TP_INSTALACAO = ".TBL_TP_INSTALACAO.".ID_TP_INSTALACAO) LEFT JOIN ".TBL_TP_OCUPACAO." ON  (".TBL_SOLICITACAO.".ID_OCUPACAO = ".TBL_TP_OCUPACAO.".ID_OCUPACAO) LEFT JOIN ".TBL_TP_PARA_RAIO." ON (".TBL_SOLICITACAO.".ID_TP_PARA_RAIO = ".TBL_TP_PARA_RAIO.".ID_TP_PARA_RAIO) LEFT JOIN ".TBL_TP_RECIPIENTE." ON (".TBL_SOLICITACAO.".ID_TP_RECIPIENTE = ".TBL_TP_RECIPIENTE.".ID_TP_RECIPIENTE) LEFT JOIN ".TBL_CIDADE." ON (".TBL_SOLICITACAO.".ID_CIDADE = ".TBL_CIDADE.".ID_CIDADE) LEFT JOIN ".TBL_TP_SITUACAO." ON (".TBL_SOLICITACAO.".ID_SITUACAO = ".TBL_TP_SITUACAO.".ID_SITUACAO) LEFT JOIN ".TBL_TP_LOGRADOURO." ON (".TBL_SOLICITACAO.".ID_TP_LOGRADOURO = ".TBL_TP_LOGRADOURO.".ID_TP_LOGRADOURO) WHERE ".TBL_SOLICITACAO.".ID_SOLICITACAO =".$ID_SOLICITACAO." AND ".TBL_SOLICITACAO.".ID_CIDADE=".$ID_CIDADE." AND ".TBL_SOLICITACAO.".ID_TIPO_SOLICITACAO=".$ID_TIPO_SOLICITACAO;

//echo "aqui 2:".$sql."<br>\n";
$res= $conn->query($sql);

// testando se houve algum erro
if ($conn->get_status()==false) {
  die($conn->get_msg());
}

$tupula = $conn->fetch_row();



$pdf->AddPage();
$pdf->SetMargins(5,10,10);
//$pdf->SetXY(1, 5);

$ret1L=4;
$ret1Largura=205;
$ret1Altura=12;

$ret2L=4;
$ret2Largura=205;
$ret2Altura=200;

$ret3L=5;
$ret3Largura=203;
$ret3Altura=12;

$ret4L=5;
$ret4Largura=203;
$ret4Altura=22;

$ret5L=5;
$ret5Largura=203;
$ret5Altura=74;

$ret6L=6;
$ret6Largura=80;
$ret6Altura=7;

$ret7L=90;
$ret7Largura=117;
$ret7Altura=7;

$ret8L=6;
$ret8Largura=114;
$ret8Altura=32;

$ret9L=122;
$ret9Largura=85;
$ret9Altura=7;

$ret10L=122;
$ret10Largura=85;
$ret10Altura=12;

$ret11L=122;
$ret11Largura=85;
$ret11Altura=7;

$ret12L=6;
$ret12Largura=85;
$ret12Altura=7;

$ret13L=95;
$ret13Largura=60;
$ret13Altura=7;

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
// $pdf->Cell(0,5,"Rua Almirante Lamego, 381 Florianópolis - SC",0,0,'L',0);
$pdf->ln();
$pdf->SetX(20);
// $pdf->Cell(0,5,"CEP 88.015-600 - Fone 48 - 251-9600",0,0,'L',0);
$pdf->ln();
$pdf->SetX(20);
$pdf->Cell(0,5,"SOLICITACAO DE PROJETO DE FUNCIONAMENTO",0,0,'C',0);

$pdf->Image("./imagens/brasaodocumento.jpg",5,10,15,15);

$pdf->ln();
$pdf->SetFont('arial', '', 6);
$pdf->MultiCell(0,3,"Prezado Sr. Através do presente, solicitamos a V.Sª. que seja efetuado o cadastro de\nProtocolo para Análise de Projeto conforme segue abaixo identificado.",0,'C',0);
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

$pdf->Rect($ret1L,($pdf->GetY()+2),$ret1Largura,$ret1Altura);

$pdf->SetFont('arial', '', 8);
$pdf->Cell(30,5,"Proprietário Edificação",0,0,'L',1);
$pdf->ln();
$pdf->SetFont('arial', '', 8);
$pdf->Cell(10,5,"Nome",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(100,5,$tupula["NM_PROPRIETARIO"],0,0,'L',0);
$pdf->SetFont('arial', '', 8);
$pdf->Cell(20,5,"CNPJ/CPF",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(30,5,formatCPFCNPJ($tupula["CNPJ_CPF_PROPRIETARIO"]),0,0,'L',0);
$pdf->ln();
$pdf->SetFont('arial', '', 8);
$pdf->Cell(10,5,"Fone",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,$tupula["NR_FONE_PROPRIETARIO"],0,0,'L',0);
$pdf->SetFont('arial', '', 8);
$pdf->Cell(10,5,"E-mail",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(110,5,$tupula["DE_EMAIL_PROPRIETARIO"],0,0,'L',0);

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
$pdf->SetFont('arial', '', 8);
$pdf->Cell(30,5,"Nome Fantasia",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(50,5,$tupula["NM_FANTASIA"],0,0,'L',0);
$pdf->SetLeftMargin(10);
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

$pdf->ln();
$pdf->SetX(20);

$pdf->Rect($ret3L,($pdf->GetY()+2),$ret3Largura,$ret3Altura);

$pdf->SetFont('arial', '', 8);
$pdf->Cell(30,5,"Caracteristica",0,0,'L',1);
$pdf->ln();
$pdf->SetFont('arial', '', 8);
$pdf->Cell(15,5,"Área Total",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,formatNumero($tupula["VL_AREA_CONTRUIDA"]),0,0,'R',0);
$pdf->SetFont('arial', 'I', 8);
$pdf->Cell(10,5,"(m²)",0,0,'L',0);
$pdf->SetFont('arial', '', 8);
$pdf->Cell(10,5,"Altura",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,formatNumero($tupula["VL_ALTURA"]),0,0,'R',0);
$pdf->SetFont('arial', 'I', 8);
$pdf->Cell(10,5,"(m²)",0,0,'L',0);
$pdf->SetFont('arial', '', 8);
$pdf->Cell(30,5,"Área Pavimento",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,formatNumero($tupula["VL_AREA_TIPO"]),0,0,'R',0);
$pdf->SetFont('arial', 'I', 8);
$pdf->Cell(10,5,"(m²)",0,0,'L',0);

$pdf->SetFont('arial', '', 8);
$pdf->Cell(15,5,"Risco",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,$tupula['NM_RISCO'],0,0,'L',0);

$pdf->ln();
$pdf->SetFont('arial', '', 8);
$pdf->Cell(15,5,"Ocupação",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(60,5,$tupula['NM_OCUPACAO'],0,0,'L',0);


$pdf->SetFont('arial', '', 8);
$pdf->Cell(20,5,"Situação",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,$tupula['NM_SITUACAO'],0,0,'L',0);

$pdf->SetFont('arial', '', 8);
$pdf->Cell(10,5,"Tipo",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,$tupula["NM_TP_CONSTRUCAO"],0,0,'L',0);

$pdf->SetFont('arial', '', 8);
$pdf->Cell(10,5,"N° Pav.",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(10,5,$tupula["NR_PAVIMENTOS"],0,0,'R',0);
$pdf->SetFont('arial', '', 8);
$pdf->Cell(10,5,"N° Blocos",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(10,5,$tupula["NR_BLOCOS"],0,0,'R',0);
$pdf->ln();


// $pdf->SetX(20);
// $pdf->SetFont('arial', '', 8);
//
// $pdf->Rect($ret4L,($pdf->GetY()+2),$ret4Largura,$ret4Altura);
//
// $pdf->Cell(50,5,"Responsável Técnico Projeto",0,0,'C',1);
// $pdf->ln();
// $pdf->SetFont('arial', '', 8);
// $pdf->Cell(150,5,"Nome",0,0,'L',0);
// $pdf->SetFont('arial', '', 8);
// $pdf->Cell(50,5,"CREA",0,0,'L',0);
// $pdf->ln();
//
// $pdf->SetFont('arial', 'B', 8);
// $pdf->Cell(150,5,$tupula["NM_ENGENHEIRO_1"],0,0,'L',0);
// $pdf->Cell(50,5,formatCREA($tupula["NR_CREA_1"]),0,0,'L',0);
// $pdf->ln();
// $pdf->Cell(150,5,$tupula["NM_ENGENHEIRO_2"],0,0,'L',0);
// $pdf->Cell(50,5,formatCREA($tupula["NR_CREA_2"]),0,0,'L',0);
// $pdf->ln();
// $pdf->Cell(150,5,$tupula["NM_ENGENHEIRO_3"],0,0,'L',0);
// $pdf->Cell(50,5,formatCREA($tupula["NR_CREA_3"]),0,0,'L',0);
//
// $pdf->ln();
$pdf->SetX(20);
$pdf->SetFont('arial', '', 8);

$pdf->Rect($ret5L,($pdf->GetY()+2),$ret5Largura,$ret5Altura);

$pdf->Cell(60,5,"Sistema de Segurança Contra Incêndios",0,0,'C',1);
$pdf->ln();
$pdf->SetLeftMargin(7);
$pdf->SetX(25);

$pdf->Rect($ret6L,($pdf->GetY()+2),$ret6Largura,$ret6Altura);

$pdf->Cell(50,5,"Sistema Preventivo por Extintor",0,0,'C',1);
$pdf->SetX(100);

$pdf->Rect($ret7L,($pdf->GetY()+2),$ret7Largura,$ret7Altura);

$pdf->Cell(50,5,"Sistema Hidraulico Preventivo",0,0,'C',1);
$pdf->ln();
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(45,5,formatChar($tupula["CH_SIS_PREVENTIVO_EXTINTOR"]),0,0,'R',0);
$pdf->SetX(100);
$pdf->Cell(50,5,formatChar($tupula["NM_ADUCAO"])." Tipo de Adução ".$tupula["NM_ADUCAO"],0,0,'L',0);
$pdf->ln();

$pdf->SetX(25);
$pdf->SetFont('arial', '', 8);

$pdf->Rect($ret8L,($pdf->GetY()+2),$ret8Largura,$ret8Altura);

$pdf->Rect($ret9L,($pdf->GetY()+2),$ret9Largura,$ret9Altura);

$pdf->Cell(30,5,"Saída de Emergência",0,0,'C',1);
$sis_direita=125;

$pdf->SetX($sis_direita);
$pdf->SetFont('arial', '', 8);
$pdf->Cell(60,5,"Sistema de Alarme e Detecção de Incêndio",0,0,'C',1);
$pdf->ln();

$pdf->Cell(35,5,"Escadas",0,0,'L',0);
$pdf->Cell(20,5,"Quantidade",0,0,'C',0);
$pdf->Cell(30,5,"Dispositivos",0,0,'L',0);
$pdf->Cell(20,5,"Quantidade",0,0,'C',0);
$pdf->SetX($sis_direita);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(60,5,formatChar($tupula["NM_TP_ALARME_INCENDIO"])." Tipo ".$tupula["NM_TP_ALARME_INCENDIO"],0,0,'L',0);
$pdf->ln();
$pdf->SetFont('arial', '', 8);
$pdf->Cell(35,5,"Comum",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,$tupula["NR_ESCADA_COMUM"],0,0,'C',0);
$pdf->SetFont('arial', '', 8);
$pdf->Cell(30,5,"Rampa",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,$tupula["NR_RAMPA"],0,0,'C',0);
$pdf->SetX($sis_direita);
$pdf->SetFont('arial', '', 8);

$pdf->Rect($ret10L,($pdf->GetY()+2),$ret10Largura,$ret10Altura);

$pdf->Cell(30,5,"Gás Canalizado",0,0,'L',1);

$pdf->ln();
$pdf->SetFont('arial', '', 8);
$pdf->Cell(35,5,"Protegida",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,$tupula["NR_ESCADA_PROTEGIDA"],0,0,'C',0);
$pdf->SetFont('arial', '', 8);
$pdf->Cell(30,5,"Elev. Emergência",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,$tupula["NR_ELEV_EMERGENCIA"],0,0,'C',0);

$pdf->SetX($sis_direita);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(8,5,"GLP",0,0,'L',0);
$pdf->Cell(25,5,formatChar($tupula["CH_COMB_GLP"]),0,0,'L',0);
$pdf->SetFont('arial', '', 8);
$pdf->Cell(18,5,"Recipiente",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(30,5,$tupula["NM_TP_RECIPIENTE"],0,0,'L',0);

$pdf->ln();
$pdf->SetFont('arial', '', 8);
$pdf->Cell(35,5,"Enclausurada",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,$tupula["NR_ESCADA_ENC"],0,0,'C',0);
$pdf->SetFont('arial', '', 8);
$pdf->Cell(30,5,"Local Resgate Aéreo",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,$tupula["NR_RESG_AEREO"],0,0,'C',0);

$pdf->SetX($sis_direita);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(8,5,"GN",0,0,'L',0);
$pdf->Cell(25,5,formatChar($tupula["CH_COMB_GN"]),0,0,'L',0);
$pdf->SetFont('arial', '', 8);
$pdf->Cell(18,5,"Tipo",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(30,5,$tupula["NM_TP_INSTALACAO"],0,0,'L',0);


$pdf->ln();
$pdf->SetFont('arial', '', 8);
$pdf->Cell(35,5,"Encl. a Prova de Fumaça",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,$tupula["NR_ESCADA_PROVA_FUMACA"],0,0,'C',0);
$pdf->SetFont('arial', '', 8);
$pdf->Cell(30,5,"Passarela",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,$tupula["NR_PASSARELA"],0,0,'C',0);

$pdf->SetX($sis_direita);
$pdf->SetFont('arial', '', 8);

$pdf->Rect($ret11L,($pdf->GetY()+2),$ret11Largura,$ret11Altura);

$pdf->Cell(40,5,"Iluminação de Emergência",0,0,'L',1);

$pdf->ln();
$pdf->SetFont('arial', '', 8);
$pdf->Cell(35,5,"Pressurizada",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,$tupula["NR_ESCADA_PRESSU"],0,0,'C',0);

$pdf->SetX($sis_direita);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(50,5,formatChar($tupula["NM_ILU_EMERG"])." Tipo ".formatChar($tupula["NM_ILU_EMERG"]),0,0,'L',0);

$pdf->ln();
$pdf->SetFont('arial', '', 8);

$pdf->Rect($ret12L,($pdf->GetY()+2),$ret12Largura,$ret12Altura);

$pdf->Cell(60,5,"Proteção Contra Descarga Atmosférica",0,0,'L',1);
$pdf->SetX(100);

$pdf->Rect($ret13L,($pdf->GetY()+2),$ret13Largura,$ret13Altura);

$pdf->Cell(50,5,"Sinalização de Abandono de local",0,0,'L',1);
$pdf->ln();
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(80,5,formatChar($tupula["NM_TP_PARA_RAIO"])." Método de Proteção ".$tupula["NM_TP_PARA_RAIO"],0,0,'L',0);
$pdf->SetX(100);
$pdf->Cell(60,5,formatChar($tupula["CH_ABANDONO"]),0,0,'L',0);

$pdf->SetFont('arial', '', 8);
$pdf->Cell(20,5,"Mulsyfire",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(20,5,formatChar($tupula["CH_MULSYFIRE"]),0,0,'L',0);

$pdf->ln();
$pdf->SetFont('arial', '', 8);
$pdf->Cell(50,5,"Sistema Fixo de CO2",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(30,5,formatChar($tupula["CH_FIXO_CO2"]),0,0,'L',0);

$pdf->SetFont('arial', '', 8);
$pdf->Cell(15,5,"Sprinkler",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(30,5,formatChar($tupula["CH_SPRINKLER"]),0,0,'L',0);

$pdf->ln();
$pdf->SetFont('arial', '', 8);
$pdf->Cell(50,5,"Dispositivo de Ancoragem de Cabo",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(30,5,formatChar($tupula["CH_ANCORA_CABO"]),0,0,'L',0);

$pdf->SetFont('arial', '', 8);
$pdf->Cell(20,5,"Outros",0,0,'L',0);
$pdf->SetFont('arial', 'B', 8);
$pdf->Cell(50,5,$tupula["NM_OUTROS"],0,0,'L',0);


$pdf->SetXY(20,270);
$sql="SELECT ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_GRUPAMENTO." ON (".TBL_CIDADE.".ID_CIDADE=".TBL_GRUPAMENTO.".ID_CIDADE) LEFT JOIN ".TBL_CIDADES_GBM." ON (".TBL_GRUPAMENTO.".ID_BATALHAO=".TBL_CIDADES_GBM.".ID_BATALHAO AND ".TBL_GRUPAMENTO.".ID_COMPANIA=".TBL_CIDADES_GBM.".ID_COMPANIA AND ".TBL_GRUPAMENTO.".ID_PELOTAO=".TBL_CIDADES_GBM.".ID_PELOTAO AND ".TBL_GRUPAMENTO.".ID_GRUPAMENTO=".TBL_CIDADES_GBM.".ID_GRUPAMENTO) WHERE ".TBL_CIDADES_GBM.".ID_CIDADE='".$tupula["ID_CIDADE"]."'";
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

//formatChar(


$arquivo='solic_an_func.pdf';
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
  echo "  alert('Variáveis de Requisição não Transmitidas.\nContate o Corpo de Bombeiros da sua Região!');\n";
  echo "-->\n</script>\n";
}
echo "<script language='JavaScript'><!--\n";
echo "  window.close();\n";
echo "-->\n</script>\n";
?>
