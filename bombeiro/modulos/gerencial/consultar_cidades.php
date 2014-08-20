<?

    if ( @$_GET["id_usuario"] != "") {

        $erro = null;
        require_once 'lib/loader.php';
        
        $conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
        if ($conn->get_status()==false) die($conn->get_msg());

        $arquivo = "usuario.php";
        $sql = "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
        $conn->query($sql);
        $rows_rotina = $conn->num_rows();
        if ($rows_rotina > 0) $rotina = $conn->fetch_row();
        
        $global_obj_sessao->load($rotina["ID_ROTINA"]);
        $usuario = $global_obj_sessao->is_logged_in();
        $perfil = $global_obj_sessao->is_perfiled_in();
        
        // Cidades do usuario consultado
        $conn->query("SELECT ".TBL_CIDADE.".ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADES_USR." JOIN ".TBL_CIDADE." USING (ID_CIDADE) WHERE ".TBL_CIDADES_USR.".ID_USUARIO = '$_GET[id_usuario]' ORDER BY ".TBL_CIDADE.".NM_CIDADE");
        if ($conn->get_status()==false) die($conn->get_msg());
        while ($r = $conn->fetch_row()) {
            $dados['sel_cidades'][] = $r;
            $dados['sel_id_cidades'][] = $r['ID_CIDADE'];
        }

        // Cidades deste usuario
        $conn->query("SELECT ".TBL_CIDADE.".ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADES_USR." JOIN ".TBL_CIDADE." USING (ID_CIDADE) WHERE ".TBL_CIDADES_USR.".ID_USUARIO = '$usuario' ORDER BY ".TBL_CIDADE.".NM_CIDADE");
        if ($conn->get_status()==false) die($conn->get_msg());
        while ($r = $conn->fetch_row()) {
            if (!in_array($r['ID_CIDADE'],$dados['sel_id_cidades'])) $dados['sel_cidade'][] = $r;
        }
    

    }

//     echo "<pre>"; print_r($dados); echo  "</pre>";exit;

?>
<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">-->
<html>
<head>
    <title>Consulta</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!--     <script language="JavaScript" type="text/javascript" src="../../js/sigat_div.js"></script> -->

    <script language="javascript" type="text/javascript">

        var frm = window.opener.document.frm_usuario;

        j = frm.sel_cidades.options.length;
        for(i=1;i<j;i++) frm.sel_cidades[1] = null;
        <? foreach ($dados['sel_cidades'] as $i => $r) { ?>
            frm.sel_cidades[<?=$i+1?>] = new Option('<?=$r[NM_CIDADE]?>','<?=$r[ID_CIDADE]?>');
        <? } ?>

        j = frm.sel_cidades.options.length;
        for(i=1;i<j;i++) frm.sel_cidade[1] = null;
        <? foreach ($dados['sel_cidade'] as $i => $r) { ?>
            frm.sel_cidade[<?=$i+1?>] = new Option('<?=$r[NM_CIDADE]?>','<?=$r[ID_CIDADE]?>');
        <? } ?>

        window.close();

    </script>

</head>
</html>