<?

	//echo "<pre>"; print_r($_POST); echo "</pre>";
	require 'lib/loader.php';

	$conn = new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
	if($conn->get_status()==false) die($conn->get_msg());

	$conn->query("SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA = '".end(explode('/',__FILE__))."'");
	if($conn->num_rows()>0) $rotina = $conn->fetch_row(); else {
		echo die('Rotina não permitida a este usuário!');
	}

	$global_obj_sessao->load($rotina["ID_ROTINA"]);
	$usuario = $global_obj_sessao->is_logged_in();

	include ('../../templates/head01.htm');
	
	// Variáveis

	$l_protocolo = @$_POST['txt_protocolo'];
	$l_cidade = @$_POST['txt_cidade'];
 	$l_ord = @$_POST['txt_ord'];
	$arq = end(explode('/',__FILE__));

	if ($l_cidade and $l_protocolo) $op = 'consultar'; 
	elseif ($l_cidade) $op = 'listar'; 
	else $op = 'pesquisar'; 

	switch($op) {

		case 'listar' :

			// Ordenação
			$seta = '<img src="../../imagens/seta1.gif" border="0">&nbsp;';
			switch(@$_POST['txt_ord']) {
			  	case 'prt' 	: $ord = 'ORDER BY ID_PROT_FUNC, NM_PESSOA ASC ';		break;
			  	case 'emp'	: $ord = 'ORDER BY NM_PESSOA, ID_PROT_FUNC ASC ';		break;
			  	case 'cid'	: $ord = 'ORDER BY NM_CIDADE, ID_PROT_FUNC ASC '; 		break;
			  	case 'ocr'	: $ord = 'ORDER BY OCORRENCIAS, ID_PROT_FUNC ASC '; 	break;
			  	default		: $ord = 'ORDER BY ID_CIDADE_VISTORIA, ID_PROT_FUNC';	break; 
			}

			// Busca e ordenação dos registros encontrados
			$sql = "select " .TBL_VIST_ESTAB.".ID_VISTORIA_FUNC, " .TBL_VIST_ESTAB.".ID_CIDADE_VISTORIA, " .TBL_VISTORIA_FUNC.".ID_PROT_FUNC, " .TBL_CIDADE.".ID_CIDADE, " .TBL_CIDADE.".NM_CIDADE, " .TBL_PESSOA.".NM_PESSOA, " ."count(".TBL_VIST_ESTAB.".ID_VISTORIA_FUNC) AS OCORRENCIAS " ."FROM " .TBL_VIST_ESTAB. " "."LEFT JOIN " .TBL_CIDADE." ON (" .TBL_CIDADE.".ID_CIDADE = " .TBL_VIST_ESTAB.".ID_CIDADE_VISTORIA) " ."LEFT JOIN ".TBL_VISTORIA_FUNC." ON (" .TBL_VISTORIA_FUNC.".ID_VISTORIA_FUNC = " .TBL_VIST_ESTAB.".ID_VISTORIA_FUNC AND " .TBL_VISTORIA_FUNC.".ID_CIDADE = " .TBL_VIST_ESTAB.".ID_CIDADE_VISTORIA) " ."LEFT JOIN ".TBL_PESSOA." ON (" .TBL_VISTORIA_FUNC.".ID_CNPJ_EMPRESA = " .TBL_PESSOA.".ID_CNPJ_CPF AND " .TBL_VISTORIA_FUNC.".ID_CIDADE = " .TBL_PESSOA.".ID_CIDADE) " ."WHERE " .TBL_CIDADE.".ID_CIDADE = $l_cidade " ."GROUP BY ".TBL_VIST_ESTAB.".ID_VISTORIA_FUNC " ."HAVING OCORRENCIAS > 1 $ord";
			$conn->query($sql);
			if($conn->num_rows()>0) {
				while($registro = $conn->fetch_row()) $registros[] = $registro;
			} 

		break;

		case 'consultar' :

			// 
			$sql = "select " .
				TBL_VIST_ESTAB.".ID_EDIFICACAO, " .
				TBL_VIST_ESTAB.".ID_ESTABELECIMENTO, " .
				TBL_VIST_ESTAB.".ID_VISTORIA_FUNC, " .
				TBL_VIST_ESTAB.".ID_CIDADE_VISTORIA, " .

				TBL_EDIFICACAO.".NM_EDIFICACAO, " .
				TBL_ESTABELECIMENTO.".NM_ESTABELECIMENTO, " .
				TBL_ESTABELECIMENTO.".NM_BLOCO, " .
				TBL_ESTABELECIMENTO.".VL_AREA, " .

				TBL_VISTORIA_FUNC.".ID_PROT_FUNC, " .
				TBL_CIDADE.".ID_CIDADE, " .
				TBL_CIDADE.".NM_CIDADE, " .
				TBL_PESSOA.".NM_PESSOA " .
			"FROM " .TBL_VIST_ESTAB. " ".
				"LEFT JOIN " .TBL_CIDADE." ON (" .
					TBL_CIDADE.".ID_CIDADE = " .TBL_VIST_ESTAB.".ID_CIDADE_VISTORIA) " .
				"LEFT JOIN ".TBL_VISTORIA_FUNC." ON (" .TBL_VISTORIA_FUNC.".ID_VISTORIA_FUNC = " .TBL_VIST_ESTAB.".ID_VISTORIA_FUNC AND " .TBL_VISTORIA_FUNC.".ID_CIDADE = " .TBL_VIST_ESTAB.".ID_CIDADE_VISTORIA) " .
				"LEFT JOIN ".TBL_EDIFICACAO." ON (" .
					TBL_EDIFICACAO.".ID_EDIFICACAO = " .TBL_VIST_ESTAB.".ID_EDIFICACAO AND " .
					TBL_EDIFICACAO.".ID_CIDADE = " .TBL_VIST_ESTAB.".ID_CIDADE_VISTORIA) " .
				"LEFT JOIN ".TBL_ESTABELECIMENTO." ON (" .
					TBL_ESTABELECIMENTO.".ID_ESTABELECIMENTO = " .TBL_VIST_ESTAB.".ID_ESTABELECIMENTO AND " .
					TBL_ESTABELECIMENTO.".ID_EDIFICACAO = " .TBL_VIST_ESTAB.".ID_EDIFICACAO AND " .
					TBL_ESTABELECIMENTO.".ID_CIDADE = " .TBL_VIST_ESTAB.".ID_CIDADE_VISTORIA) " .
				"LEFT JOIN ".TBL_PESSOA." ON (" .TBL_VISTORIA_FUNC.".ID_CNPJ_EMPRESA = " .TBL_PESSOA.".ID_CNPJ_CPF AND " .TBL_VISTORIA_FUNC.".ID_CIDADE = " .TBL_PESSOA.".ID_CIDADE) " .
			"WHERE " .
				TBL_CIDADE.".ID_CIDADE = $l_cidade and " .
				TBL_VISTORIA_FUNC.".ID_PROT_FUNC = $l_protocolo" .
			";";
			$conn->query($sql);
			if($conn->num_rows()>0) {
				while($registro = $conn->fetch_row()) $registros[] = $registro;

echo "<pre>"; print_r($registros); echo "</pre>";
/*
Array
(
    [0] => Array
        (
            [ID_VISTORIA_FUNC] => 4
            [ID_CIDADE_VISTORIA] => 8105
            [ID_PROT_FUNC] => 4
            [ID_CIDADE] => 8105
            [NM_CIDADE] => FLORIANOPOLIS
            [NM_PESSOA] => MARIA DA GRAÇA VIEIRA
        )

    [1] => Array
        (
            [ID_VISTORIA_FUNC] => 4
            [ID_CIDADE_VISTORIA] => 8105
            [ID_PROT_FUNC] => 4
            [ID_CIDADE] => 8105
            [NM_CIDADE] => FLORIANOPOLIS
            [NM_PESSOA] => MARIA DA GRAÇA VIEIRA
        )

)*/
				
			} 
			

		break;

	}
?>

<script language="javascript" type="text/javascript">//<!--
    function ordenar(frm,var1) {
		frm.txt_ord.value = var1;
		frm.submit();
    }
    function consultar(frm,var1) {
		frm.txt_protocolo.value = var1;
		frm.submit();
    }
//--></script>

<table border="0" cellpadding="0" width="98%" align="center"><tr><td>
	<fieldset>
	<legend>Consulta</legend>
		<table border="0" cellspacing="1" cellpadding="3" width="100%">

<!-- Consulta pela cidade e número do protocolo -->

		<? if($op == 'consultar' and @$registros) { ?>

			<!-- Empresa -->

				<tr><td colspan="2">Empresa</td></tr>
				<tr><td width="100"></td><td></td></tr>
				<tr><td></td><td></td></tr>
				<tr><td></td><td></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>

			<!-- Proprietário -->

				<tr><td colspan="2">Proprietário</td></tr>
				<tr><td align="right">Nome:&nbsp;</td><td><?=$registros[0]['NM_PESSOA']?></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>

			<!-- Edificações -->

				<tr><td colspan="2">Edificações</td></tr>
				<? foreach($registros as $registro) { ?>
					<tr><td align="right">Protocolo:&nbsp;</td><td><?=$registro['ID_PROT_FUNC']?></td></tr>
					<tr><td align="right">RE:&nbsp;</td><td></td></tr>
					<tr><td align="right">Nome:&nbsp;</td><td></td></tr>
					<tr><td align="right">Endereço:&nbsp;</td><td></td></tr>
					<tr><td align="right">Proprietário:&nbsp;</td><td></td></tr>
					<tr><td colspan="2">&nbsp;</td></tr>
				<? } ?>

			<!-- Botão voltar -->

			<tr>
				<th colspan="4"><input type="button" onClick="javascript:history.back()"  name="btn_voltar" value="Voltar" align="middle" class="botao" style="background-image : url('../../imagens/botao.gif');"></th>
			</tr>

<!-- Interface de pesquisa -->

		<? } elseif($op == 'pesquisar') { ?>

			<form target="_self" method="post" name="frm_pesquisar">
			<tr style="background-color :<?=COR_BARRA01?>">
				<td align="right">Cidade:&nbsp;</td>
				<td>
	                <select name="txt_cidade" value="" class="campo_obr">
	                  <option value="">--------</option>
	                  <?
	                    $sql = "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_UF IN ('SC') AND ".TBL_CIDADES_USR.".ID_USUARIO='$usuario' " ."ORDER BY NM_CIDADE";
	                    $res = $conn->query($sql);
	                    while ($tupla = $conn->fetch_row()) {
	                  		?><option value="<?=$tupla["ID_CIDADE"]?>"><?=$tupla["NM_CIDADE"]?></option><?
	                    }
	                  ?>
	                </select>
				</td>
			</tr>
			<tr style="background-color :<?=COR_BARRA01?>">
				<td align="right">Protocolo:&nbsp;</td>
				<td><input type="text" name="txt_protocolo" class="campo_obr"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="btn_pesquisar" value="Pesquisar" align="middle" class="botao" style="background-image : url('../../imagens/botao.gif');"></td>
			</tr>
			</form>

<!-- Listar registros da pesquisa -->

		<? } elseif($op = 'listar' and @$registros) { ?>

			<form target="_self" method="post" name="frm01">
	  			<input type="hidden" name="txt_ord" value="<?=$l_ord?>"/> 
	  			<input type="hidden" name="txt_cidade" value="<?=$l_cidade?>"/>
	  			<input type="hidden" name="txt_protocolo" value=""/> 
				<tr style="background-color:<?=COR_BARRA01?>; cursor:pointer;">
					<th nowrap onclick="ordenar(frm01,'prt')"><? if($l_ord=='prt' or @!$_POST['txt_ord']) echo $seta; ?>Protocolo</th>
					<th nowrap onclick="ordenar(frm01,'emp')"><? if($l_ord=='emp') echo $seta; ?>Empresa</th>
					<th nowrap onclick="ordenar(frm01,'cid')"><? if($l_ord=='cid') echo $seta; ?>Cidade</th>
					<th nowrap onclick="ordenar(frm01,'ocr')"><? if($l_ord=='ocr') echo $seta; ?>Ocorrências</th>
				</tr>
				<? foreach($registros as $registro) { ?>
					<? if(@$cor==COR_LINHA01) $cor = COR_LINHA02; else $cor = COR_LINHA01; ?>
					<tr style="background-color:<?=$cor?>; cursor:pointer" onclick="consultar(frm01,'<?=$registro['ID_PROT_FUNC']?>')"  align="center">
						<td><?=$registro['ID_PROT_FUNC']?></td>
						<td align="left"><?=$registro['NM_PESSOA']?></td>
						<td><?=$registro['NM_CIDADE']?></td>
						<td><?=$registro['OCORRENCIAS']?></td>
					</tr>
				<? } ?>
			</form>
			<tr>
				<th colspan="4"><input type="button" onClick="javascript:location.href='<?=$arq?>'"  name="btn_voltar" value="Voltar" align="middle" class="botao" style="background-image : url('../../imagens/botao.gif');"></th>
			</tr>

<!-- Caso não encontre registro algum -->

		<? } else { ?>

			<tr style="background-color : <?=COR_BARRA01?>">
				<th>Nenhum registro encontrado!</th>
			</tr>
			<tr>
				<th><input type="button" onClick="javascript:location.href='<?=$arq?>'"  name="btn_voltar" value="Voltar" align="middle" class="botao" style="background-image : url('../../imagens/botao.gif');"></th>
			</tr>

		<? } ?>

		</table>
	</fieldset>
</td></tr></table>

<? include ('../../templates/footer1.htm'); ?>