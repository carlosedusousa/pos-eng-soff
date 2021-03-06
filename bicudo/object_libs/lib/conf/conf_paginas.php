<?php

/**
 * Corpo de Bombeiros Militar de Santa Catarina
 *
 * Projeto Sigat Sistema de Gerenciamento de Atividades Tecnicas
 *
 * @categoria  Configuracoes
 * @pacote     ConfPaginas
 * @autor      Edson Orivaldo Lessa Junior <edsonagem@cb.sc.gov.br>
 * @creditos   Agem Informatica
 * @versao     1.0
 * @data       27/06/2005 as 15:22:33
 * @atualiza   19/11/2005 as 22:11:55
 * @arquivo    lib/conf/conf_paginas.php
 */

   /**
    * Caminho das base das paginas 
    */
    define ('PAGINA_ROOT', '../../');

   /**
    * Caminho dos Indexs
    */
    define ('PAGINA_INICIAL',       PAGINA_ROOT.'index.php');
    define ('PAGINA_LOGIN',         PAGINA_ROOT.'index.php');
    define ('PAGINA_LOGOUT',        PAGINA_ROOT.'index.php?l=');

   /**
    * Paginas de login 
    */
    define ('PAGINA_SESS_EXPIROU',  PAGINA_ROOT.'modulos/erro/sessao_login_expirou.php');
    define ('PAGINA_CONS',          PAGINA_ROOT.'index2.php?e=');

   /**
    * Paginas de alertas do sistema 
    */
    define ('PAGINA_BD_NAO_DISPONIVEL',  PAGINA_ROOT.'./sigat/modulos/erro/indesp.php');         
    define ('PAGINA_SSL_EXIGIDO',        PAGINA_ROOT.'./sigat/modulos/erro/ssl.php');
    define ('PAGINA_EM_MANUTENCAO',      PAGINA_ROOT.'./sigat/modulos/erro/manut.php');
      
?>
