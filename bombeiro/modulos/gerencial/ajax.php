<?  // echo "<pre>"; print_r($cidades); echo "</pre>";

    include 'conexao.php';

    $sql = "select ID_CIDADE, NM_CIDADE from CADASTROS.CIDADE order by NM_CIDADE limit 10";
    $res = mysql_query($sql);
    while ($r = mysql_fetch_assoc($res)) $cidades[] = $r;

    $html_title = 'Teste';

?>
 <script>

echo("entrei no ajax.php");


 </script>
<html>
<head>
    <title><?=$html_title?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <script src="ajax.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="../smvs/css/smvs.css" />
</head>
 <body>
  <form name="frm1">
<br>
<table align="center" width="600" border="0">
<tr><td>
    <fieldset>
        <table align="center" width="500" border="0">
            <? $colspan = '2'; ?>
            <tr>
                <th colspan="<?=$colspan?>"><?=$html_title?></th>
            </tr>

            <!-- Servidores -->

            <tr>
                <td valign="top" align="right">Cidade&nbsp;</td>
                <td>
                    <select name="sel_cidade" onChange="ajax_select(this,sel_bairro,'select ID_BAIRROS, NM_BAIRROS from CADASTROS.BAIRROS join CADASTROS.CIDADE using (ID_CIDADE) where CADASTROS.BAIRROS.ID_CIDADE = chave', 'ID_BAIRROS','NM_BAIRROS');">
                        <option value="0"> - - - selecione o servidor - - - </option>
                        <? foreach ($cidades as $r) { ?>
                            <option value="<?=$r['ID_CIDADE']?>"><?=$r['NM_CIDADE']?></option>
                        <? } ?>
                    </select>
                </td>
            </tr>

            <!-- Cidades -->

            <tr>
                <td valign="top" align="right">Bairros&nbsp;</td>
                <td>
                    <select name="sel_bairro" size="10">
                        <option value="0"> - - - - - - - - - - - - </option>
                    </select>
                </td>
            </tr>

        </table>
    </fieldset>
</td></tr>
</table>
  </form>
 </body>
</html>