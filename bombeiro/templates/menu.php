<?  

$menu['Geral']['P&aacute;gina inicial'] = 'inicial';
$menu['Geral']['Sair'] = 'logout';
//lu__________________________________________________________________________
$menu['Processos']['Projeto']['Solicita&ccedil;&atilde;o'] = 'solic_projeto';
$menu['Processos']['Projeto']['An&aacute;lise Pendente'] = 'analise';
$menu['Processos']['Habite-se']['Solicita&ccedil;&atilde;o'] = 'solic_habitese';
$menu['Processos']['Habite-se']['Vistoria Pendente'] = 'vist_habitese';
//____________________________________________________________________________
$menu['Processos']['Funcionamento']['Solicitação']['Funcionamneto'] = 'vist_soli_anual'; 
$menu['Processos']['Funcionamento']['Protocolo']['Pendente'] = 'vist_func_pendent'; 
$menu['Processos']['Funcionamento']['Vistoria']['Funcionamento'] = 'vist_func_anual'; 
$menu['Processos']['Funcionamento']['Vistoria']['Alteração'] = 'vist_func_alt';
$menu['Gerencial']['Cadastros']['Efetivos'] = 'efetivo';
$menu['Gerencial']['Edificações'] = 'cad_edificacao';
$menu['Gerencial']['Exclusão'] = 'exclusao';

?>
<script language="javascript" type="text/javascript">
    function submeter(op) {
        if (op) {
            var frm = this.document.frm_menu;
            frm.op_menu.value = op;
            frm.submit();
        }
    }
</script>
<form name="frm_menu" method="post" action="index.php" >
    <input type="hidden" name="op_menu" value="">
</form>
<table align="center" width="100%" border="0" cellpading="0" cellspacing="0">
    <tr>
        <td>
                <? if (is_array($menu)) { ?>
                <ul class="menu2">
                    <? foreach ($menu as $rotulo1 => $link1) if (!is_array($link1)) { ?>
                                          
                        <li class="top">
                            <a onclick="submeter('<?=$link1?>')" class="top_link"><span><?=$rotulo1?></span></a>
                        </li>

                        <? } else { ?>
                            <li class="top">
                            <a class="top_link"><span class="down"><?=$rotulo1?></span></a>
                            <ul class="sub">
                                <? foreach ($link1 as $rotulo2 => $link2) if (!is_array($link2)) { ?>
                                    <li>
                                        <a onclick="submeter('<?=$link2?>')" style="cursor:pointer"><?=$rotulo2?></a>
                                    </li>
  
                                 <? } else { ?>
                                                             
                                       <li>
                                        <a class="fly"><?=$rotulo2?></a>
                                        <ul>
                                            <? foreach ($link2 as $rotulo3 => $link3) if (!is_array($link3)) { ?>
                                    
                                         <li>
                                         <a onclick="submeter('<?=$link3?>')" style="cursor:pointer"><?=$rotulo3?></a>
                                         </li>
                                        <? } else { ?>
                                                              
                                        <li>
                                        <a class="fly"><?=$rotulo3?></a>
                                        <ul>
                                            <? foreach ($link3 as $rotulo4 => $link4) if (!is_array($link4)) { ?>
                                                                       
                                                <li>
                                                <a onclick="submeter('<?=$link4?>')" style="cursor:pointer"><?=$rotulo4?></a>
                                                </li>
                       
                                        <? } else { ?>
                                                               
                                        <li>
                                        <a class="fly"><?=$rotulo4?></a>
                                        <ul>
                                            <? foreach ($link4 as $rotulo5 => $link5) if (!is_array($link5)) { ?>
                                                                       
                                                <li>
                                                <a onclick="submeter('<?=$link5?>')" style="cursor:pointer"><?=$rotulo5?></a>
                                                </li>
                                      
                                            <? } else { ?>
                                                             
                                          <li>
                                        <a class="fly"><?=$rotulo5?></a>
					    <ul>
						<? foreach ($link5 as $rotulo6 => $link6) ?>
								
						<li style="cursor:pointer">
						    <span><a onclick="submeter('<?=$link6?>')"><?=$rotulo6?></a></span>
						</li>
					  </ul>
			                </li>
		                        <? } ?>
		                      </ul>
		                      </li>
		                    <? } ?>
                                  </ul>
                                  </li>
                              <? } ?>
      
	                   </ul>
	                   </li>
                        <? } ?>

                       </ul>
                       </li>
                    <? } ?>
  
                 </ul>

                     <? 
			} else { ?>
                      <? $mesg['erro'][] = 'Nenhum menu selecionado'; ?>
                      <? } ?>
        </td>
    </tr>
</table>