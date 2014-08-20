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
 */
    define ('BD_HOST',  'localhost');
    #define ('BD_HOST',  '10.193.4.4');
    define ('BD_USER'  ,'sigat');
    define ('BD_PASS'  ,'nhd063INforcgtgeo');

    define ('BD_HOST_REGIN',  '10.193.4.32');
    define ('BD_USER_REGIN'  ,'marceloawk');
    define ('BD_PASS_REGIN'  ,'oraculo');
    define ('BD_REGIN'  ,'scmunic');
	
/**
 * Bases do Banco de Dados (9) 
 */
    define ('BD_NOME_ACESSOS'        ,'ACESSOS');     
    define ('BD_NOME_CADASTROS'      ,'CADASTROS');
    define ('BD_NOME_COBRANCA'       ,'COBRANCA');
    define ('BD_NOME_EDIFICACAO'     ,'EDIFICACOES');
    define ('BD_NOME_FUNCIONAMENTO'  ,'FUNCIONAMENTO');
    define ('BD_NOME_HABITESE'       ,'HABITESE');    
    define ('BD_NOME_MANUTENCAO'     ,'MANUTENCAO');
    define ('BD_NOME_PROJETOS'       ,'PROJETO');
    define ('BD_NOME_SOLICITACAO'    ,'SOLICITACAO');

/**
 * Numa requisição em que o limite nao e definido,
 * qual deve ser o limite padrao?
 */
    define ('BD_SQL_LIMIT_MAX',1000);

/**
 * Acessos
 * Definindo as Constantes da Sessão
 */
    define ('CONF_SESS_UID'                 ,'ID_USUARIO');
    define ('CONF_SESS_PER'                 ,'ID_PERFIL');

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
    define ('TBL_ARQ_SISTEMAS'              ,BD_NOME_ACESSOS.'.ARQ_SISTEMAS');
    define ('TBL_CIDADES_GBM'               ,BD_NOME_ACESSOS.'.CIDADES_GBM');
    define ('TBL_CIDADES_USR'               ,BD_NOME_ACESSOS.'.CIDADES_USR');
    define ('TBL_EVENTOS'                   ,BD_NOME_ACESSOS.'.EVENTOS');
    define ('TBL_MODULOS'                   ,BD_NOME_ACESSOS.'.MODULOS');
    define ('TBL_PERFILAMENTO_ACESSO'       ,BD_NOME_ACESSOS.'.PERFILAMENTO_ACESSO');
    define ('TBL_PERFILAMENTO_ACESSO_USER'  ,BD_NOME_ACESSOS.'.PERFILAMENTO_ACESSO_USER');
    define ('TBL_PERFIS'                    ,BD_NOME_ACESSOS.'.PERFIS');
    define ('TBL_POSTO_GRADUACAO'           ,BD_NOME_ACESSOS.'.POSTO_GRADUACAO');
    define ('TBL_ROTINAS'                   ,BD_NOME_ACESSOS.'.ROTINAS');
    define ('TBL_USUARIO'                   ,BD_NOME_ACESSOS.'.USUARIO');
    define ('TBL_EFETIVO'                   ,BD_NOME_ACESSOS.'.EFETIVO');

   /**
    * Cadastros
    * SubTotal = (24) TBL de A -> Z
    */
    define ('TBL_BAIRROS'                   ,BD_NOME_CADASTROS.'.BAIRROS');
    define ('TBL_BATALHAO'                  ,BD_NOME_CADASTROS.'.BATALHAO');
    define ('TBL_CEP'                       ,BD_NOME_CADASTROS.'.CEP');
    define ('TBL_CIDADE'                    ,BD_NOME_CADASTROS.'.CIDADE');
    define ('TBL_CIDADE_SERVIDOR'           ,BD_NOME_CADASTROS.'.CIDADE_SERVIDOR');
    define ('TBL_COMPANIA'                  ,BD_NOME_CADASTROS.'.COMPANIA');
    define ('TBL_GRUPAMENTO'                ,BD_NOME_CADASTROS.'.GRUPAMENTO');
    define ('TBL_LOGRADOURO'                ,BD_NOME_CADASTROS.'.LOGRADOURO');
    define ('TBL_PELOTAO'                   ,BD_NOME_CADASTROS.'.PELOTAO');
    define ('TBL_PESSOA'                    ,BD_NOME_CADASTROS.'.PESSOA');
    define ('TBL_TP_ABANDONO'               ,BD_NOME_CADASTROS.'.TP_ABANDONO');
    define ('TBL_TP_ADUCAO'                 ,BD_NOME_CADASTROS.'.TP_ADUCAO');
    define ('TBL_TP_ALARME_INCENDIO'        ,BD_NOME_CADASTROS.'.TP_ALARME_INCENDIO');
    define ('TBL_TP_ATERRAMENTO'            ,BD_NOME_CADASTROS.'.TP_ATERRAMENTO');
    define ('TBL_TP_CAPTORES'               ,BD_NOME_CADASTROS.'.TP_CAPTORES');
    define ('TBL_TP_CONSTRUCAO'             ,BD_NOME_CADASTROS.'.TP_CONSTRUCAO');
    define ('TBL_TP_ILU_EMER'               ,BD_NOME_CADASTROS.'.TP_ILU_EMER');
    define ('TBL_TP_INSTALACAO'             ,BD_NOME_CADASTROS.'.TP_INSTALACAO');
    define ('TBL_TP_LOGRADOURO'             ,BD_NOME_CADASTROS.'.TP_LOGRADOURO');
    define ('TBL_TP_OCUPACAO'               ,BD_NOME_CADASTROS.'.TP_OCUPACAO');
    define ('TBL_TP_PARA_RAIO'              ,BD_NOME_CADASTROS.'.TP_PARA_RAIO');
    define ('TBL_TP_RECIPIENTE'             ,BD_NOME_CADASTROS.'.TP_RECIPIENTE');
    define ('TBL_TP_RISCO'                  ,BD_NOME_CADASTROS.'.TP_RISCO');
    define ('TBL_TP_SERVIDOR'               ,BD_NOME_CADASTROS.'.TP_SERVIDOR');
    define ('TBL_TP_SITUACAO'               ,BD_NOME_CADASTROS.'.TP_SITUACAO');
    define ('TBL_UF'                        ,BD_NOME_CADASTROS.'.UF');
    
   /**
    * Cobranca
    * SubTotal = (6) TBL de A -> Z
    */
    define ('TBL_COB_BOLETO'                ,BD_NOME_COBRANCA.'.COBRANCA_BOLETO');
    define ('TBL_COTACAO'                   ,BD_NOME_COBRANCA.'.COTACAO');
    define ('TBL_FORMULA'                   ,BD_NOME_COBRANCA.'.FORMULA');
    define ('TBL_INDICE'                    ,BD_NOME_COBRANCA.'.INDICE');    
    define ('TBL_SERVICO'                   ,BD_NOME_COBRANCA.'.SERVICO');
    define ('TBL_TP_SERVICO'                ,BD_NOME_COBRANCA.'.TP_SERVICO');    

   /**
    * Edificacoes
    * SubTotal = (5) TBL de A -> Z
    */
    define ('TBL_CARAC_ED'                  ,BD_NOME_EDIFICACAO.'.CARACTERISTICA_EDIFICACAO');
    define ('TBL_EDIFICACAO'                ,BD_NOME_EDIFICACAO.'.EDIFICACAO');
    define ('TBL_ENGENHEIRO'                ,BD_NOME_EDIFICACAO.'.ENGENHEIRO');
    define ('TBL_ENG_EDIFICACAO'            ,BD_NOME_EDIFICACAO.'.ENG_EDIFICACAO');
    define ('TBL_ESTABELECIMENTO'           ,BD_NOME_EDIFICACAO.'.ESTABELECIMENTO');

   /**
    * Manutenção
    * SubTotal=(2) TBL de A-> Z
    */
    define ('TBL_PROT_MANUT'             ,BD_NOME_MANUTENCAO.'.PROT_MANUTENCAO');
    define ('TBL_VISTORIA_MANUT'         ,BD_NOME_MANUTENCAO.'.VISTORIA_MANUTENCAO');

   /**
    * Funcionamento
    * SubTotal=(3) TBL de A-> Z
    */
    define ('TBL_PROT_FUNC'             ,BD_NOME_FUNCIONAMENTO.'.PROT_FUNCIONAMENTO');
    define ('TBL_VISTORIA_FUNC'         ,BD_NOME_FUNCIONAMENTO.'.VISTORIA_FUNCIONAMENTO');
    define ('TBL_VIST_ESTAB'            ,BD_NOME_FUNCIONAMENTO.'.VIST_ESTAB');

   /**
    * Habitese
    * SubTotal = (2) TBL de A -> Z
    */
    define ('TBL_PROT_HABITESE'             ,BD_NOME_HABITESE.'.PROT_HABITESE');
    define ('TBL_VISTORIA_HABITESE'         ,BD_NOME_HABITESE.'.VISTORIA_HABITESE');

   /** 
    * Projeto
    * SubTotal = (3) TBL de A -> Z
    */
    define ('TBL_ANALISE'                   ,BD_NOME_PROJETOS.'.ANALISE');
    define ('TBL_PROTOCOLOS'                ,BD_NOME_PROJETOS.'.PROTOCOLOS');
    define ('TBL_TMP_SEGURANCA'             ,BD_NOME_PROJETOS.'.TMP_SEGURANCA');
   
   /**
    * Solicitacao
    * SubTotal = (7) TBL de A -> Z
    */
    define ('TBL_COBRANCA_SOLICITACAO'      ,BD_NOME_SOLICITACAO.'.COBRANCA_SOLICITACAO');
    define ('TBL_DESC_FUNC'                 ,BD_NOME_SOLICITACAO.'.DESC_FUNCIONAMENTO');
    define ('TBL_DESC_VISTORIAS'            ,BD_NOME_SOLICITACAO.'.DESC_VISTORIAS');
    define ('TBL_SOLICITACAO'               ,BD_NOME_SOLICITACAO.'.SOLIC_PROJETO');    
//     define ('TBL_SOLICITACAO'               ,BD_NOME_SOLICITACAO.'.SOLICITACAO');   
    define ('TBL_SOL_FUNC'                  ,BD_NOME_SOLICITACAO.'.SOLIC_FUNCIONAMENTO');
    define ('TBL_SOL_HABITESE'              ,BD_NOME_SOLICITACAO.'.SOLIC_HABITESE');    
    define ('TBL_SOL_MANUT'                  ,BD_NOME_SOLICITACAO.'.SOLIC_MANUTENCAO');
    
?>
