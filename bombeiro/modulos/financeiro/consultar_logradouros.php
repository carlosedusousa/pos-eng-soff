<? //echo "<pre>"; print_r($_GET); echo "</pre>";

    require "lib/loader.php";

    $conn = new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_PROJETOS);

    foreach ($_GET as $indice => $valor) $$indice = $valor;

    $sql = "select " .
            "count(".TBL_LOGRADOURO.".ID_LOGRADOURO) as ocorrencias, " .
            TBL_LOGRADOURO.".ID_LOGRADOURO, " .
            TBL_LOGRADOURO.".NM_LOGRADOURO, " .
            TBL_LOGRADOURO.".ID_TP_LOGRADOURO " .

        "from ".TBL_LOGRADOURO." " .
            /* * /
            "from ".TBL_PROT_FUNC." " .
                "left join ".TBL_COB_BOLETO." on (".
                    TBL_PROT_FUNC.".ID_PROT_FUNC = ".TBL_COB_BOLETO.".ID_PROT_FUNC and ". 
                    TBL_PROT_FUNC.".ID_CIDADE = ".TBL_COB_BOLETO.".ID_CIDADE) ". 
                "left join ".TBL_SOL_FUNC." on (".
                    TBL_PROT_FUNC.".ID_SOLIC_FUNC = ".TBL_SOL_FUNC.".ID_SOLIC_FUNC and ". 
                    TBL_PROT_FUNC.".ID_CIDADE = ".TBL_SOL_FUNC.".ID_CIDADE) ". 
                "left join ".TBL_LOGRADOURO." on (".
                    TBL_SOL_FUNC.".ID_LOGRADOURO = ".TBL_LOGRADOURO.".ID_LOGRADOURO) ". 
            /* */
        "where " .
            //TBL_COB_BOLETO.".DT_PAGAMENTO is null and " .
            //TBL_COB_BOLETO.".ID_COBRANCA_BOLETO is not null and ".
            TBL_LOGRADOURO.".ID_CIDADE = '$id_cidade' and " .
            TBL_LOGRADOURO.".ID_BAIRROS = '$id_bairro' " . 
        "group by ".TBL_LOGRADOURO.".ID_LOGRADOURO " .
        "order by ".TBL_LOGRADOURO.".NM_LOGRADOURO " .
    ";";
    //echo "sql: $sql";
    $conn->query($sql);
    while ($r = $conn->fetch_row()) $logradouros[] = $r;
    //echo "<pre>"; print_r($logradouros); echo "</pre>"; exit;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<script language="JavaScript" type="text/javascript">
<?
    if ($id_cidade and $id_bairro) {
        if ($logradouros) { ?>
            window.opener.document.frm_baixa_projeto.cmb_id_logradouro.options.length=0;
            sec_cmb_id_logradouro = window.opener.document.frm_baixa_projeto.cmb_id_logradouro.options.length++;
            window.opener.document.frm_baixa_projeto.cmb_id_logradouro.options[sec_cmb_id_logradouro].text=' Escolha o logradouro ';
            window.opener.document.frm_baixa_projeto.cmb_id_logradouro.options[sec_cmb_id_logradouro].value='';
            sec_cmb_id_logradouro= '';
            <? foreach ($logradouros as $r) { ?>
                sec_cmb_id_logradouro = window.opener.document.frm_baixa_projeto.cmb_id_logradouro.options.length++;
                window.opener.document.frm_baixa_projeto.cmb_id_logradouro.options[sec_cmb_id_logradouro].text="<?=$r["NM_LOGRADOURO"]?>";
                window.opener.document.frm_baixa_projeto.cmb_id_logradouro.options[sec_cmb_id_logradouro].value="<?=$r["ID_LOGRADOURO"]?>";
                <?
            }
         } else { ?>
            window.opener.document.frm_baixa_projeto.cmb_id_logradouro.options.length=0;\n";
            sec_cmb_id_logradouro=window.opener.document.frm_baixa_projeto.cmb_id_logradouro.options.length++;
            window.opener.document.frm_baixa_projeto.cmb_id_logradouro.options[sec_cmb_id_logradouro].text=' - - - - ';
            window.opener.document.frm_baixa_projeto.cmb_id_logradouro.options[sec_cmb_id_logradouro].value='';
            <?
        }
    }
?>
window.close();
</script>
</body>
</html>