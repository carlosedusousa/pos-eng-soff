<?php

/**
 * Corpo de Bombeiros Militar de Santa Catarina
 *
 * Projeto Sigat Sistema de Gerenciamento de Atividades Tecnicas
 *
 * @categoria  Configuracoes
 * @pacote     BD
 * @autor      Edson Orivaldo Lessa Junior <edsonagem@cb.sc.gov.br>
 * @creditos   Agem Informatica
 * @versao     1.0
 * @data       13/07/2005 as 10:47:09
 * @atualiza   19/11/2005 as 22:11:55
 * @arquivo    lib/conf/conf_bd.php
 */

/**
 * Configuracoes do Banco de Dados
 * define ('BD_HOST'  ,'fns3') base de teste
 * define ('BD_HOST'  ,'fns4') base quente
 */
    //define ('BD_HOST'  ,'10.193.4.88');
    define ('BD_HOST'  ,'10.193.4.53');
    define ('BD_USER'  ,'scott');
    define ('BD_PASS'  ,'tiger');
    define ('BD_PORT'  , '5432');



/**
 *  Define o Schema (colocar o nome e depois o ponto ex: "fns.")
 */

   define ('SCHEMA' 	, '');

/**
 * Bases do Banco de Dados (9)
 */
    define ('BD_NOME'        ,'e193');

/**
 * Numa requisi��o em que o limite nao e definido,
 * qual deve ser o limite padrao?
 */
    define ('BD_SQL_LIMIT_MAX',1000);

/**
 * Acessos
 * Definindo as Constantes da Sess�o
 */
    define ('CONF_SESS_UID'                 ,'nm_login');
    define ('CONF_SESS_MTR'                 ,'id_matricula');
    define ('CONF_SESS_PER'                 ,'id_perfil');

/**
 * Configuracoes das Tabelas
 *
 * Nomes das Tabelas
 * Total = (63) TBL - organizacaoo de A -> Z
 */

   /**
    * Acessos
    * SubTotal = (11) TBL de A -> Z
    */

    define ('TBL_ARQ_SISTEMAS'              ,SCHEMA.'arq_sistemas');
    define ('TBL_CIDADES_GBM'               ,SCHEMA.'cidades_obms');
    define ('TBL_CIDADES_USR'               ,SCHEMA.'cidades_efetivo');
    define ('TBL_EFETIVO'                   ,SCHEMA.'efetivo');
    define ('TBL_EVENTOS'                   ,SCHEMA.'eventos');
    define ('TBL_MODULOS'                   ,SCHEMA.'modulos');
    define ('TBL_OBMS'                      ,SCHEMA.'obms');
    define ('TBL_PERFILAMENTO_ACESSO'       ,SCHEMA.'perfilamentos');
    //define ('TBL_PERFILAMENTO_ACESSO_USER'  ,'PERFILAMENTO_ACESSO_USER');
    define ('TBL_PERFIS'                    ,SCHEMA.'perfis');
    define ('TBL_POSTO_GRADUACAO'           ,SCHEMA.'posto_guarnicao');
    define ('TBL_ROTINAS'                   ,SCHEMA.'rotinas');

   /**
    * Cadastros
    * SubTotal = (10) TBL de A -> Z
    */
    define ('TBL_BAIRROS'                   ,SCHEMA.'bairros');
    define ('TBL_CIDADE'                    ,SCHEMA.'cidades');
    define ('TBL_COD_OCO'                   ,SCHEMA.'cod_ocorrencias');
    define ('TBL_DET_OCO'                   ,SCHEMA.'det_ocorrencia');
    define ('TBL_LOGRADOURO'                ,SCHEMA.'logradouros');
    define ('TBL_PESSOA'                    ,SCHEMA.'pessoas');
    define ('TBL_VIATURAS'                  ,SCHEMA.'viaturas');
    define ('TBL_TP_EMERGENCIA'             ,SCHEMA.'tp_emergencia');
    define ('TBL_TP_LOGRADOURO'             ,SCHEMA.'tp_logradouros');
   /**
    * Guarni��o
    * SubTotal = (2) TBL de A -> Z
    */
    define ('TBL_ESC_PLAN'                  ,SCHEMA.'escala_plantao');
    define ('TBL_VTR_GUARNICAO'             ,SCHEMA.'viaturas_guarnicao');


   /**
    * Ocorrencias
    * SubTotal = (4) TBL de A -> Z
    */
    define ('TBL_EMP_VTR'                   ,SCHEMA.'empenho_viaturas');
    define ('TBL_HISTORICO'                 ,SCHEMA.'historico_atendimento');
    define ('TBL_OCORRENCIAS'               ,SCHEMA.'ocorrencias');
    define ('TBL_PES_VIT'                   ,SCHEMA.'pes_atendidas');

    /**
     * Constraints
    * SubTotal = (2) TBL de A -> Z
    */
    define ('TBL_TP_ECL'                    ,SCHEMA.'ch_tp_escala_constraint_tables');
    define ('TBL_TP_FUNC'                   ,SCHEMA.'ch_tp_funcao_constraint_tables');


    define ('TBL_CH_SN'			    ,'ch_sn_constraint_table');
    define ('TBL_STS_ATI'		    ,'ch_status_atividade_constraint_table');
    define ('TBL_STS_BBM'		    ,'ch_status_bbm_constraint_table');
    define ('TBL_STS_ESC'		    ,'ch_status_escalado_constraint_table');
    define ('TBL_STS_OPE'		    ,'ch_status_operacional_constraint_table');
    define ('TBL_TP_EQUI'		    ,'ch_tp_equipamentos_constraint_table');
    define ('TBL_TP_PES'		    ,'ch_tp_pessao_contraint_table');

    /**
    * Tabelas de versao
    */
    define ('TBL_INF_CALL'		    ,'info_call');

    define ('TBL_VERSAO'		    ,'version');

    /**
    * Tabelas de Ocorrencia de Praia
    */

    define ('TBL_COD_OCO_PRAIA'		    ,'cod_ocorrencia_praias');
    define ('TBL_GRAU_OCO_PRAIA'	    ,'grau_ocorrencia_praia');
    
    define ('TBL_DD_PRAIA'		    ,'dados_praia');
    define ('TBL_DD_RESG'		    ,'dados_resgate');
    define ('TBL_DD_VIT'		    ,'dados_vitima');
    
    define ('TBL_DS_PRAIA'		    ,'ds_salvamento_praia');
    define ('TBL_DS_RESG'		    ,'ds_salvamento_resgate');
    define ('TBL_DS_VIT'		    ,'ds_salvamento_vitima');
    
    define ('TBL_DT_PRAIA'		    ,'dt_dados_praia');
    define ('TBL_DT_RESG'		    ,'dt_dados_resgate');
    define ('TBL_DT_VIT'		    ,'dt_dados_vitima');
    
    define ('TBL_EFE_PRAIA'		    ,'efetivo_salvamento_praia');

    define ('TBL_PRAIA'			    ,'praias');
    define ('TBL_SALV_PRAIA'		    ,'salvamento_praias');

    define ('TBL_VIT_PRAIA'		    ,'vitima_praia');
    
    define ('TBL_DIA_SEMANA'		    ,'dia_semana');


?>
