<? /*echo "<pre>"; print_r($_POST); echo "</pre>";*/
   
    require_once 'lib/loader.php';

    $erro="";
    $arquivo = "usuario.php";

    $conn = new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
    if ($conn->get_status() == false) die ($conn->get_msg());
    $sql = "SELECT ID_ROTINA, NM_ROTINA FROM ".TBL_ROTINAS." WHERE NM_ARQ_ROTINA ='".$arquivo."'";
    $conn->query($sql);
    $rows_rotina = $conn->num_rows();
    if ($conn->num_rows() > 0) $rotina = $conn->fetch_row(); else {
        $rotina['ID_ROTINA'] = '00';
        $rotina['NM_ROTINA'] = 'Rotina n&atilde;o Permitida!';
        //include ('../../templates/head01.htm');
        //include ('../../templates/footer1.htm');
        exit;
    }
    $global_obj_sessao->load($rotina["ID_ROTINA"]);
    $usuario = $global_obj_sessao->is_logged_in();

    if (
        (@$_POST["txt_id_usuario"]!="") && 
        (@$_POST["txt_nm_usuario"]!="") && 
        (@$_POST["cmb_id_batalhao"]!="") &&
        (@$_POST["cmb_id_compania"]!="") && 
        (@$_POST["cmb_id_pelotao"]!="") && 
        (@$_POST["cmb_id_grupamento"]!="") &&
        (@$_POST["cmb_id_cidade"])) {

        $ID_USUARIO     = formataCampo($_POST["txt_id_usuario"],"t","l");
        $PS_SENHA       = formataCampo(md5(@$_POST["psw_ps_senha"]),"t","l");
        $NM_USUARIO     = formataCampo(strtoupper($_POST["txt_nm_usuario"]));
        $ID_BATALHAO    = formataCampo($_POST["cmb_id_batalhao"],"N","D");
        $ID_COMPANIA    = formataCampo($_POST["cmb_id_compania"],"n","D");
        $ID_PELOTAO     = formataCampo($_POST["cmb_id_pelotao"],"n","D");
        $ID_PERFIL      = formataCampo($_POST["cmb_perfil"],"n","O");
        $ID_POSTO       = formataCampo($_POST["cmb_id_posto"],"n","O");
        $ID_GRUPAMENTO  = formataCampo($_POST["cmb_id_grupamento"],"n");
        $ID_CIDADE      = formataCampo($_POST["cmb_id_cidade"],"n");

        if ($ID_PERFIL != 2 and $ID_PERFIL != 7) {

            $perfil_negado = true;

        } elseif ($_POST["hdn_controle"] == 1) {
	      
            if ($global_inclusao == "S") {
                $sql = "insert into ".TBL_USUARIO." (".
                    TBL_USUARIO.".ID_USUARIO, ".
                    TBL_USUARIO.".PS_SENHA, ".
                    TBL_USUARIO.".NM_USUARIO, ".
                    TBL_USUARIO.".ID_BATALHAO, ".
                    TBL_USUARIO.".ID_COMPANIA, ".
                    TBL_USUARIO.".ID_PELOTAO, ".
                    TBL_USUARIO.".ID_PERFIL, ".
                    TBL_USUARIO.".ID_POSTO, ".
                    TBL_USUARIO.".ID_GRUPAMENTO, ".
                    TBL_USUARIO.".ID_CIDADE ".
                ") values ( ".
                    "$ID_USUARIO, ".
                    "$PS_SENHA, ".
                    "$NM_USUARIO, ".
                    "$ID_BATALHAO, ".
                    "$ID_COMPANIA, ".
                    "$ID_PELOTAO, ".
                    "$ID_PERFIL, ".
                    "$ID_POSTO, ".
                    "$ID_GRUPAMENTO, ".
                    "$ID_CIDADE ".
                ")";
            } else {
                $sql = "";
                $erro = MSG_ERR_INC;
            }

        } elseif ($_POST["hdn_controle"] == 2) {
           
            $sql = "select ID_PERFIL from ".TBL_USUARIO." WHERE ID_USUARIO = ".$ID_USUARIO;
            $conn->query($sql);
            if ($conn->get_status() == false) die ($conn->get_msg());

            if ($r = $conn->fetch_row()) $id_perfil = $r['ID_PERFIL'];

            if ($id_perfil != 2 and $id_perfil != 7) {

                $perfil_negado = true;

            } else {
                  
                if ($global_alteracao=="S") {
                  $sql = "UPDATE ".TBL_USUARIO."  set ".
                        TBL_USUARIO.".NM_USUARIO = $NM_USUARIO, ".
                        TBL_USUARIO.".ID_BATALHAO = $ID_BATALHAO, ".
                        TBL_USUARIO.".ID_COMPANIA = $ID_COMPANIA, ".
                        TBL_USUARIO.".ID_PELOTAO = $ID_PELOTAO, ".
                        TBL_USUARIO.".ID_PERFIL = $ID_PERFIL, ".
                        TBL_USUARIO.".ID_POSTO = $ID_POSTO, ".
                        TBL_USUARIO.".ID_GRUPAMENTO = $ID_GRUPAMENTO, ".
                        TBL_USUARIO.".ID_CIDADE = $ID_CIDADE ".
                    "WHERE ".
                        TBL_USUARIO.".ID_USUARIO = $ID_USUARIO;";
                } else {
                    $sql = "";
                    $erro = MSG_ERR_ALT;
                }

            }

        }

        $conn->query($sql);

        if ($conn->get_status() == false) {
    
            die ($conn->get_msg());
    
        } else {
    
            if ((
                $_POST["hdn_controle"] == 1 or 
                $_POST["hdn_controle"] == 2) and (
                $id_perfil == 2 or 
                $id_perfil == 7)) {
    
                // Excluir todas as associacoes das cidades do respectivo usuario
    
                $sql = "delete from ".TBL_CIDADES_USR." where ID_USUARIO = '$_POST[txt_id_usuario]'"; 
                $conn->query($sql);
                if ($conn->get_status() == false) die ($conn->get_msg());
    
                // Inserir todas as cidades associadas a este usuario
                
                $aux = explode('^',$_POST['hdn_cidades']);
                $sql = "insert into ".TBL_CIDADES_USR." (ID_CIDADE, ID_USUARIO) values ";
                foreach ($aux as $v) if (is_numeric($v)) $values .= "('$v', '$_POST[txt_id_usuario]'), ";
                $values = substr($values,0,-2);
                $sql .= $values ;
                if ($values) {
                    $conn->query($sql);
                    if ($conn->get_status() == false) die ($conn->get_msg());
                }
    
            }

            ?><script language="JavaScript" type="text/javascript"><?
                if ($perfil_negado) {
                    echo "alert(\"Permissão negada para este perfilamento\");\n";
                } elseif ($ID_USUARIO!="") {
                    if (($_POST["hdn_controle"]==1)&&($global_inclusao=="S")) {
                        echo "alert(\"Registro Inserido com o Usuário:".$ID_USUARIO."\");\n";
                    } else {
                        if ($global_alteracao=="S") {
                            echo "alert(\"Registro Alterado com o Usuário:".$ID_USUARIO."\");\n";
                        }
                    }
                }
            ?></script><?

        }

    } else {

        if (
            (isset($_POST["txt_id_usuario"])) && 
            (isset($_POST["txt_nm_usuario"])) &&
            (isset($_POST["cmb_id_posto"])) &&
            (isset($_POST["cmb_id_batalhao"])) &&
            (isset($_POST["cmb_id_compania"])) &&
            (isset($_POST["cmb_id_pelotao"])) &&
            (isset($_POST["cmb_id_grupamento"])) &&
            (isset($_POST["psw_ps_senha"])) &&
            (isset($_POST["psw_ps_senha_confirma"])) &&
            (isset($_POST["cmb_id_cidade"]))) {
    
            $erro = "echo '<tr><td align=\"center\" style=\"background-color : #f7ff05; color : #ff0000; font-weight : bold;\">OS CAMPOS ASSINALADOS SÃO OBRIGATÓRIOS</td></tr>'\n";
    
        }

    }

    //include ('../../templates/head.htm');

?>
<script language="JavaScript" type="text/javascript">

    function atualizar_cidades_hidden(frm) {
        var valores = "";
        for (var i=0; i<frm.sel_cidades.length;i++) {
            valores+=frm.sel_cidades[i].value+"^";
        }
        if (valores!="") {
            frm.hdn_cidades.value = valores;
            return true;
        } else {
            alert("Os seguinte ERROS encontrados:\nCidade GBM\nVERIFIQUE!!!");
            return false;
        }
    }

    function consultar_cidades(id_usuario) {
      if (id_usuario) {
        window.open("./modulos/gerencial/consultar_cidades.php?id_usuario="+id_usuario,"consultar_cidades","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }

    function move_item(from, to) {
        var f;
        var SI; /* selected Index */
        if(from.options.length>0) {
            for(i=0;i<from.length;i++) {
                if(from.options[i].selected) {
                SI=from.selectedIndex;
                f=from.options[SI].index;
                to.options[to.length]=new Option(from.options[SI].text,from.options[SI].value);
                from.options[f]=null;
                i--;
                }
            }
        }
    }

    function consultaSelc(formulario,cmb_campo,tabela,atrib,cond,obrigatorio,campo_atual,campos_limpos) {
      if ((campo_atual.value != "" )&&(campo_atual.value != 0)) {
        //alert("formulario="+cmb_campo.form.name+"&cmb_campo="+cmb_campo.name+"&tabela="+tabela+"&atrib="+atrib+"&cond="+cond+"&obrigatorio="+obrigatorio);
        window.open("./php/consultaSelc.php?formulario="+formulario+"&cmb_campo="+cmb_campo+"&tabela="+tabela+"&atrib="+atrib+"&cond="+cond+"&obrigatorio="+obrigatorio,"consulsec","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      } else {
        var cmp = campos_limpos.split(",");
        for (var i=0;i<cmp.length;i++) {
          window.document.frm_usuario[cmp[i]].options.length=0;
          sec_cmb=window.document.frm_usuario[cmp[i]].options.length++;
          window.document.frm_usuario[cmp[i]].options[sec_cmb].text=' - - - - - - - - - - - - - - - ';
          window.document.frm_usuario[cmp[i]].options[sec_cmb].value='0';
        }
      }
    }

    function confirmaSenha(campo_senha1,campo_senha2) {
      if (campo_senha1.value!=campo_senha2.value) {
        window.alert("Campo Senha diferente da Confirmação Verifique!!");
        campo_senha1.value="";
        campo_senha2.value="";
        campo_senha1.focus();
      }
    }

    function consultaReg(campo) {
      if (campo.value!="") {
        window.open("./modulos/acessos/cons_usuario.php?campo="+campo.value,"consulusr","top=5000,left=5000,screenY=5000,screenX=5000,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=1,height=1,innerwidth=1,innerheight=1");
      }
    }

    function retorna(frm) {
    <? if ($global_inclusao=="S") { ?>
        frm.btn_incluir.value="Incluir";
        frm.hdn_controle.value="1";
        frm.btn_incluir;
    <? } else { ?>
        frm.btn_incluir;
    <? } ?>
      frm.txt_id_usuario.readOnly=false;
    }

    function consulta(frm,frm_name,pre_campo,def) {
        var cons=window.prompt('Digite o Nome a ser pesquisado',def.toUpperCase());
        if (cons!="") {
            window.open('./php/cons_limit.php?form='+frm_name+'&pre_campo='+pre_campo+'&clausula='+cons.toUpperCase(),'consulta','top=0,left=0,screenY=0,screenX=0,toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=600,height=400,innerwidth=600,innerheight=400');
        }
    }
</script>
<body onload="ajustaspan()">

<? //include ('../../templates/cab.htm'); ?>

    <form name="frm_usuario"  enctype="multipart/form-data" method="post" 
onsubmit="atualizar_cidades_hidden(this); return validaForm(this,'txt_id_usuario,Login do Usuário,t','txt_nm_usuario,Nome do Usuário,t','cmb_id_batalhao,Batalhão,n','cmb_id_cidade,Cidade Lotação,n');" onreset="retorna(this)">
<!--target="_self"-->
  

<input type="hidden" name="op_menu" value="<?=$_POST['op_menu']?>">



  <table width="98%" cellspacing="8" cellpadding="0" align="center" border="0">

        <tr>

            <!-- Usuario -->

            <td align="right">Usuário&nbsp;</td>
            <td>
                <input type="text" name="txt_id_usuario" size="22" maxlength="20" class="campo_obr" onblur="consultaReg(this); consultar_cidades(this.value)" style="text-transform : none;">
             </td>

            <!-- Nome -->

            <td align="right">Nome&nbsp;</td>
            <td>
                <input type="text" name="txt_nm_usuario" size="30" maxlength="100" class="campo_obr" value="">
                <input type="hidden" name="hdn_usu_from" value="ACESSOS.USUARIO">
                <input type="hidden" name="hdn_usu_where" value="NM_USUARIO LIKE '%pesquisa%' ORDER BY NM_USUARIO ASC">
                <input type="hidden" name="hdn_usu_campo" value="ID_USUARIO,NM_USUARIO">
                <input type="hidden" name="hdn_usu_desc_campos" value="Código do Usuário, Nome do Usuário">
                <input type="hidden" name="hdn_usu_bd" value="<?=BD_NOME_ACESSOS?>">
                <input type="hidden" name="hdn_usu_arquivo" value="<?=$arquivo?>">
                <input type="hidden" name="hdn_usu_cp_asso" value="ID_USUARIO,NM_USUARIO">
                <input type="hidden" name="hdn_arq_envio" value="window.opener.document.frm_usuario.txt_id_usuario">
                <input type="hidden" name="hdn_chave" value="ID_USUARIO">
            </td>
        </tr>
        <tr>

            <!-- Cidade Lotacao -->

            <td align="right">Cidade Lotação&nbsp;</td>
            <td colspan="2">
                <select name="cmb_id_cidade" value="" class="campo_obr">
                <option value=""> - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</option>
                <?
                $sql = "SELECT ".TBL_CIDADE.".ID_CIDADE AS ID_CIDADE, ".TBL_CIDADE.".NM_CIDADE FROM ".TBL_CIDADE." LEFT JOIN ".TBL_CIDADES_USR." USING(ID_CIDADE) WHERE ID_UF IN ('SC') AND ".TBL_CIDADES_USR.".ID_USUARIO='$usuario' ORDER BY NM_CIDADE";
                $conn->query($sql);
                if ($conn->get_status()==false) die($conn->get_msg());
                while ($tupula = $conn->fetch_row()) {
                    ?><option value="<?=$tupula["ID_CIDADE"]?>"><?=$tupula["NM_CIDADE"]?></option><?
                }
                ?>
            </select>
            </td>
            <td>
                <input type="button" name="btn_cons_usu" value="Consulta Nome" onclick="consulta(this.form,this.form.name,'hdn_usu',document.frm_usuario.txt_nm_usuario.value)" class="botao" >
            </td>
        </tr>
        <tr>

            <!-- Perfil de Acesso -->

            <td align="right">Perfil de Acesso&nbsp;</td>
            <td>
                <select name="cmb_perfil" class="campo" title="Perfil do Grupo de Acesso">
                    <option value=""> - - - - - - - - - - - - - - - </option>
                    <option value="1">ADMINISTRADOR</option>
                    <option value="4">ANALISTA</option>
                    <option value="8">CONSULTA_GERAL</option>
                    <option value="9">GERENTE</option>
                    <option value="5">PROTOCOLISTA</option>
                    <option value="3">SOLICITACAO</option>
                    <option value="2">USUARIO</option>
                    <option value="7">USUARIO (- CAD TAXA)</option>
                    <option value="6">VISTORIADOR</option>
                </select>
            </td>
            <td align="right">Posto&nbsp;</td>
            <td>
            <select name="cmb_id_posto" class="campo" title="Posto/Graduação do Usuário">
                <option value=""> - - - - - - - - - - - - - - - </option>
                <?
                $sql = "SELECT ID_POSTO, NM_POSTO FROM POSTO_GRADUACAO ORDER BY NR_NIVEL ASC";
                $conn->query($sql);
                if ($conn->get_status()==false) die($conn->get_msg());
                while ($tupula = $conn->fetch_row()) {
                    echo "<option value=\"".$tupula['ID_POSTO']."\">";
                    echo $tupula['NM_POSTO'];
                    echo "</option>\n";
                }
                ?>
            </select>
            </td>
        </tr>
        <tr>

            <!-- Batalhao -->

            <td align="right">Batalhão&nbsp;</td>
            <td>
            <select name="cmb_id_batalhao" class="campo_obr" title="Batalhão do Usuário" onchange="consultaSelc(this.form.name,'cmb_id_compania','CADASTROS.COMPANIA','ID_COMPANIA,NM_COMPANIA','ID_BATALHAO='+this.value,'s',this,'cmb_id_compania,cmb_id_pelotao,cmb_id_grupamento')">
                <option value=""> - - - - - - - - - - - - - - - </option>
                <?
                $sql = "SELECT ID_BATALHAO, NM_BATALHAO FROM CADASTROS.BATALHAO ORDER BY ID_BATALHAO";
                $res = $conn->query($sql);
                if ($conn->get_status()==false) die($conn->get_msg());
                while ($tupula = $conn->fetch_row()) {
                    echo "\t\t\t\t\t\t\t\t\t\t<option value=\"".$tupula['ID_BATALHAO']."\">";
                    echo $tupula['NM_BATALHAO'];
                    echo "</option>\n";
                }
                ?>
            </select>
            </td>

            <!-- Compania -->

            <td align="right">Compania&nbsp;</td>
            <td>
                <select name="cmb_id_compania" class="campo_obr" title="Compania do Usuário" onchange="consultaSelc(this.form.name,'cmb_id_pelotao','CADASTROS.PELOTAO','ID_PELOTAO,NM_PELOTAO','ID_BATALHAO='+document.frm_usuario.cmb_id_batalhao.value+' AND ID_COMPANIA='+document.frm_usuario.cmb_id_compania.value,'s',this,'cmb_id_pelotao,cmb_id_grupamento')">
                <option value=""> - - - - - - - - - - - - - - - </option>
            </select>
            </td>
        </tr>
        <tr>

            <!-- Pelotao -->

            <td align="right">Pelotão&nbsp;</td>
            <td>
                <select name="cmb_id_pelotao" class="campo_obr" title="Pelotão do Usuário" onchange="consultaSelc(this.form.name,'cmb_id_grupamento','CADASTROS.GRUPAMENTO','ID_GRUPAMENTO,NM_GRUPAMENTO','ID_BATALHAO='+document.frm_usuario.cmb_id_batalhao.value+' AND ID_COMPANIA='+document.frm_usuario.cmb_id_compania.value+' AND ID_PELOTAO='+document.frm_usuario.cmb_id_pelotao.value,'s',this,'cmb_id_grupamento')">
                <option value="0"> - - - - - - - - - - - - - - - </option>
                </select>
            </td>

            <!-- Grupamento -->

            <td align="right">Grupamento&nbsp;</td>
            <td>
                <select name="cmb_id_grupamento" class="campo_obr" title="Grupamento do Usuário">
                <option value="0"> - - - - - - - - - - - - - - - </option>
                </select>
            </td>
        </tr>

        <tr><td colspan="4">&nbsp;</td></tr>

        <!-- Associacao -->

        <tr>
            <td colspan="4">

                <table align="center" border="0" width="95%">

                    <tr>
                        <td><b>Todas as cidades</b></td>
                        <td>&nbsp;</td>
                        <td><b>Cidades Associadas</b></td>
                    </tr>
                
                    <!-- Todas as Cidades -->
                
                    <tr>
                        <td width="100" align="left" style="background-color:<?=COR_BARRA01?>">
                            <select name="sel_cidade" size="10" multiple class="campo">
                                <option value=""> - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </option>
                                <? foreach($dados['sel_cidade'] as $cidade) { ?>
                                    <option value="<?=$cidade['ID_CIDADE']?>"><?=$cidade['NM_CIDADE']?></option>
                                <? } ?>
                            </select>
                        </td>
                
                        <!-- >>> e <<< -->
                
                        <td style="background-color:<?=COR_BARRA01?>" align="center">
                            <input type="button" value = '>>>' onClick="move_item(sel_cidade,sel_cidades)" class="botao"><br><br>
                            <input type="button" value = '<<<' onClick="move_item(sel_cidades,sel_cidade)" class="botao">
                        </td>
                
                        <!-- Cidades Associadas -->
                
                        <td width="100" align="right" style="background-color:<?=COR_BARRA01?>">
                            <input type="hidden" name="hdn_cidades" value="">
                            <select name="sel_cidades" size="10" multiple class="campo">
                                <option value=""> - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </option>
                                <? foreach($dados['sel_cidades'] as $cidade) { ?>
                                    <option value="<?=$cidade['ID_CIDADE']?>"><?=$cidade['NM_CIDADE']?></option>
                                <? } ?>
                            </select>
                        </td>
                    
</tr>

                     

                </table>
           


        </tr>

        <? include('./templates/btn_inc.htm'); ?>
        






    </table>

               
    </form>

<?
  mysql_close();
//include ('/var/www/sistemacbm/templates/footer1.htm'); 
?>