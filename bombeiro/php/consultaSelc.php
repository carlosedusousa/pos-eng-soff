<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<script language="JavaScript" type="text/javascript">
<?
  if ((@$_GET["formulario"]!="") && (@$_GET["cmb_campo"]!="") && (@$_GET["tabela"]!="") && (@$_GET["atrib"]!="")) {
    $tabela=explode(".",$_GET["tabela"]);
    $atributos=explode(",",$_GET["atrib"]);
    if (count($atributos)>2) {
      $atributos[1]=$atributos[1].",".$atributos[2];
    }
    $form=$_GET["formulario"];
    $combo=$_GET["cmb_campo"];
    if (@$_GET["obrigatorio"]!="") { $obr=true; }
    else { $obr=false; }
    if (@$_GET["novo"]!="") { $novo=true; }
    else { $novo=false; }
    require_once 'lib/loader.php';

    $bd= $tabela[0];

    $conn=  new BD (BD_HOST, BD_USER, BD_PASS, $bd);
    if ($conn->get_status()==false) {
      die($conn->get_msg());
    } else {
      if (@$_GET["cond"]!="") {
        $vwhere=" where ".$_GET["cond"];
      } else {
        $vwhere="";
      }
      if ($atributos[0]==$atributos[1]) {
        $sql=" SELECT ".$atributos[0]." FROM ".$tabela[1].$vwhere;
      } else {
        $sql=" SELECT ".$_GET["atrib"]." FROM ".$tabela[1].$vwhere;
      }
      echo "// aqui0:$sql\n";
      $res= $conn->query($sql);
      $rows=$conn->num_rows();
      if ($rows>0) {
        echo "window.opener.document.".$form.".".$combo.".options.length=0;\n";
        if ($obr==false) {
          echo "sec_".$tabela[1]."=window.opener.document.".$form.".".$combo.".options.length++;\n";
          echo "window.opener.document.".$form.".".$combo.".options[sec_".$tabela[1]."].text='________________';\n";
          echo "window.opener.document.".$form.".".$combo.".options[sec_".$tabela[1]."].value='';\n";
        }
        if ($novo==true) {
          echo "sec_".$tabela[1]."=window.opener.document.".$form.".".$combo.".options.length++;\n";
          echo "window.opener.document.".$form.".".$combo.".options[sec_".$tabela[1]."].text='NOVO';\n";
          echo "window.opener.document.".$form.".".$combo.".options[sec_".$tabela[1]."].value='0';\n";
        }
        echo "sec_".$tabela[1]."= '';\n";
        while ($tupula = $conn->fetch_row()) {
          echo "/*\n";
          echo var_dump($tupula);
          echo "*/\n";
          echo "sec_".$tabela[1]."=window.opener.document.".$form.".".$combo.".options.length++;\n";
          echo "window.opener.document.".$form.".".$combo.".options[sec_".$tabela[1]."].text='".$tupula[$atributos[1]]."';\n";
          echo "window.opener.document.".$form.".".$combo.".options[sec_".$tabela[1]."].value='".$tupula[$atributos[0]]."';\n";
        }
      } else {
        echo "window.opener.document.".$form.".".$combo.".options.length=0;\n";
        if ($novo==true) {
          echo "sec_".$tabela[1]."=window.opener.document.".$form.".".$combo.".options.length++;\n";
          echo "window.opener.document.".$form.".".$combo.".options[sec_".$tabela[1]."].text='NOVO';\n";
          echo "window.opener.document.".$form.".".$combo.".options[sec_".$tabela[1]."].value='0';\n";
        } else {
          echo "sec_".$tabela[1]."=window.opener.document.".$form.".".$combo.".options.length++;\n";
          echo "window.opener.document.".$form.".".$combo.".options[sec_".$tabela[1]."].text='________________';\n";
          echo "window.opener.document.".$form.".".$combo.".options[sec_".$tabela[1]."].value='';\n";
        }
      }
    }
  }
?>
</script>
<script language="JavaScript" type="text/javascript">
  window.close();
</script>
</body>
</html>