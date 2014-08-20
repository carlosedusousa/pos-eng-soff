<? 
// echo "<pre>"; print_r($_POST); echo "</pre>"; echo "<pre>"; print_r($_GET); echo "</pre>"; exit; 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title>Consulta</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <script language="JavaScript" type="text/javascript" src="../../js/sigat_div.js"></script>
</head>
<body>

<?

	if ((@$_GET["campo"]!="")&&(@$_GET["campo2"]!="")&&(@$_GET["campo3"]!="")) {
		
 		$erro="";
		require_once 'lib/loader.php';
		
		$conn= new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
		if ($conn->get_status()==false) die($conn->get_msg());

		$arquivo="excluir.php";
		$sql= "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
		$res= $conn->query($sql);
		$rows_rotina=$conn->num_rows();
		if ($rows_rotina>0) $rotina = $conn->fetch_row();
		
		$global_obj_sessao->load($rotina["ID_ROTINA"]);
		$usuario=$global_obj_sessao->is_logged_in();
		$perfil=$global_obj_sessao->is_perfiled_in();
		
		// campo de seleção
		$ID_CIDADE		= $_GET["campo"];
		$ID_PROTOCOLO	= strtoupper($_GET["campo2"]);
		$TIPO			= $_GET["campo3"];
		
		switch($TIPO) {
		
			case 'funcionamento':

				$query = 
				" SELECT ".
					TBL_SOL_FUNC.".ID_SOLIC_FUNC as id_solicitacao, ".
					TBL_SOL_FUNC.".NR_CNPJ_EMPRESA as cnpj_cpf, ".
					TBL_SOL_FUNC.".NM_CONTATO as solicitante, ".
					TBL_SOL_FUNC.".NR_FONE_EMPRESA as fone, ".
					TBL_SOL_FUNC.".DE_EMAIL_EMPRESA as email, ".
					TBL_SOL_FUNC.".VL_AREA_CONSTRUIDA as area, ".
					TBL_SOL_FUNC.".NM_EDIFICACOES as edificacao, ".
					TBL_VIST_ESTAB.".ID_EDIFICACAO as id_edificacao, ".
					TBL_PROT_FUNC.".ID_PROT_FUNC as id_protocolo ".
				" FROM ".TBL_PROT_FUNC.
					" LEFT JOIN ".TBL_SOL_FUNC.			" ON (".TBL_SOL_FUNC.".ID_SOLIC_FUNC=".TBL_PROT_FUNC.".ID_SOLIC_FUNC AND ".TBL_SOL_FUNC.".ID_CIDADE=".TBL_PROT_FUNC.".ID_CIDADE) " .
					" LEFT JOIN ".TBL_VISTORIA_FUNC.	" ON (".TBL_VISTORIA_FUNC.".ID_PROT_FUNC=".TBL_PROT_FUNC.".ID_PROT_FUNC	 AND ".TBL_VISTORIA_FUNC.".ID_CIDADE=".TBL_PROT_FUNC.".ID_CIDADE) " .
					" LEFT JOIN ".TBL_VIST_ESTAB.		" ON (".TBL_VIST_ESTAB.".ID_VISTORIA_FUNC=".TBL_VISTORIA_FUNC.".ID_VISTORIA_FUNC AND ".TBL_VIST_ESTAB.".ID_CIDADE_VISTORIA=".TBL_VISTORIA_FUNC.".ID_CIDADE) " .
				" WHERE ".
				TBL_PROT_FUNC.".ID_PROT_FUNC = $ID_PROTOCOLO AND ".
				TBL_PROT_FUNC.".ID_CIDADE = $ID_CIDADE";
				$conn->query($query);
				if ($conn->get_status()==false) die($conn->get_msg());
				$tupla=$conn->fetch_row();

			break;	
			
			case 're':

                       
                            // Funcionamento
                            $sql = "SELECT ".
                                    TBL_PROT_FUNC.".ID_PROT_FUNC as protocolo, ".
                                    TBL_VISTORIA_FUNC.".CH_PARECER as parecer, ".
                                    TBL_VISTORIA_FUNC.".ID_VISTORIA_FUNC ".
                                "FROM ".TBL_VISTORIA_FUNC." " .
                                    "LEFT JOIN ".TBL_PROT_FUNC." ON (".
                                        TBL_VISTORIA_FUNC.".ID_PROT_FUNC = ".TBL_PROT_FUNC.".ID_PROT_FUNC AND ".
                                        TBL_VISTORIA_FUNC.".ID_CIDADE = ".TBL_PROT_FUNC.".ID_CIDADE) " .
                                    "LEFT JOIN ".TBL_VIST_ESTAB." ON (".
                                        TBL_VIST_ESTAB.".ID_CIDADE_VISTORIA = ".TBL_VISTORIA_FUNC.".ID_CIDADE AND ".
                                        TBL_VIST_ESTAB.".ID_VISTORIA_FUNC = ".TBL_VISTORIA_FUNC.".ID_VISTORIA_FUNC)
                                WHERE ".
                                    TBL_VISTORIA_FUNC.".ID_CIDADE = $ID_CIDADE AND ".
                                    TBL_VIST_ESTAB.".ID_EDIFICACAO = $ID_EDIFICACAO ".
                                "GROUP BY ".
                                    TBL_VISTORIA_FUNC.".ID_CIDADE, ".
                                    TBL_VISTORIA_FUNC.".ID_VISTORIA_FUNC ". 
                            ";";



                            $conn->query($sql);
                            while ($r = $conn->fetch_row()) $rs['funcionamento'][] = $r;
                        
			break;
			
			default: echo "Nenhuma opção escolhida!";
			
		}

                if ($TIPO == 're') {

                    if ($rs) {
                        $protocolos = null;
                        foreach ($rs as $i=>$r) {
                            switch ($i) {
                                case 'funcionamento': $protocolos .= 'Funcionamento: '; break;
                            }
                            foreach ($r as $v) {
                                switch ($v['parecer']) {
                                    case 'D': $parecer = 'deferido'; break;
                                    case 'I': $parecer = 'indeferido'; break;
                                    default: $parecer = $v['parecer'];
                                }
                                $protocolos .= "$v[protocolo]($parecer), ";
                            }
                            $protocolos = substr($protocolos,0,-2);
                            $protocolos .= '\n';
                        }
                        ?><script language="javascript" type="text/javascript">
                            window.opener.alert ("Não pode ser excluído pois existe protocolos associados: \n\n<?=$protocolos?>");
                        </script><?
                    } else {
                        ?><script language="javascript" type="text/javascript">
                            var afrm = window.opener.document.frm_analise;
                            if (window.opener.confirm("Registro encontrado!\n Deseja Carregar?")) {
				afrm.txt_id_edificacao.value = "<?=$ID_EDIFICACAO?>";
				afrm.hdn_id_edificacao.value = "<?=$ID_EDIFICACAO?>";
				afrm.txt_nm_edificacao.value = "<?=$edificacao[NM_EDIFICACAO]?>";
				afrm.txt_vl_area_construida.value = "<?=str_replace('.',',',$edificacao[VL_AREA_CONSTRUIDA])?>";
                            }
                        </script><? 
                    }

                } elseif ($tupla) {

			?>
			<script language="javascript" type="text/javascript">//<!--
			var afrm = window.opener.document.frm_analise;
	
			if (window.opener.confirm("Registro encontrado!\n Deseja Carregar?")) {

				afrm.hdn_id_protocolo.value			= "<?=$ID_PROTOCOLO?>";
				afrm.hdn_id_solicitacao.value			= "<?=$tupla["id_solicitacao"]?>";
				afrm.txt_id_edificacao.value			= "<?=$tupla["id_edificacao"]?>";
				afrm.txt_nr_cnpjcpf_solicitante.value 	        = "<?=$tupla["cnpj_cpf"]?>";
				afrm.txt_nm_solicitante.value			= "<?=$tupla["solicitante"]?>";
				afrm.txt_nr_fone_solicitante.value		= "<?=$tupla["fone"]?>";
				afrm.txt_nm_email_solicitante.value		= "<?=$tupla["email"]?>";
				afrm.txt_nm_edificacao.value			= "<?=$tupla["edificacao"]?>";
				afrm.txt_vl_area_construida.value		= "<?=str_replace(".",",",$tupla["area"])?>";
				window.opener.cpfcnpj(afrm.txt_nr_cnpjcpf_solicitante);
				FormatNumero(afrm.txt_vl_area_construida);
				decimal(afrm.txt_vl_area_construida,2);
			} else {
				afrm.reset();
				afrm.txt_id_protocolo.value="";
				afrm.txt_id_protocolo.focus();
			}
	
			// --></script>
			
		<? } else {  ?>

			<script language="javascript" type="text/javascript">//<!--
			var afrm = window.opener.document.frm_analise;
			window.opener.alert('Nenum registro encontrado!');
			afrm.reset();
			// --></script>
			
		<? }

	}

?>
<script>window.close();</script>
</body>
</html>
