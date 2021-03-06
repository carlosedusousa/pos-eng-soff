<?php

/**
 * Corpo de Bombeiros Militar de Santa Catarina
 *
 * Projeto Sigat Sistema de Gerenciamento de Atividades Tecnicas
 *
 * @categoria  Configuracoes
 * @pacote     Loader
 * @autor      Edson Orivaldo Lessa Junior <edsonagem@cb.sc.gov.br>
 * @creditos   Agem Informatica
 * @versao     1.0
 * @data       14/07/2005 as 11:17:44
 * @atualiza   20/11/2005 as 17:14:06
 * @arquivo    libe193/loader.php
 */

/**
 * Constantes Magicas
 *
 * Total = (11) Arquivos - sendo carregados no login
 * organizacao logica.
 */

   /**
    * Configuracoes e Variaveis
    */
    require_once 'conf/conf_bd.php';
    require_once 'conf/conf_msgs.php';
    require_once 'conf/conf_paginas.php';
    require_once 'conf/conf_sistema.php';

   /**
    * Classes e Entidades
    */
    require_once 'class/class_pg.php';
    require_once 'class/class_sessao_cobom.php';

   /**
    * Classes Controladores
    */
    require_once 'class/class_ctrleventos.php';

   /**
    * Miscelanea
    */
    require_once 'misc/funcoes_uteis.php';
    require_once 'misc/bra.php';
    require_once 'misc/bra_template.php';
    require_once 'misc/e193.php';

    /**
     * jpgraph
     */
/*
    require_once ("jpgraph/src/jpgraph.php");
    require_once ("jpgraph/src/jpgraph_pie.php");
    require_once ("jpgraph/src/jpgraph_pie3d.php");*/



   /**
    * Instancia o Controlador de Sessao
    */
    $global_obj_sessao = new sessao();

   /**
    * Instancia o Controlador Publico de Eventos
    */
    $global_obj_ctrl_eventos = new ctrl_eventos();

   /**
    * Exibe os erros no codigo
    */
    error_reporting(E_ALL & E_NOTICE & E_WARNING);

   /**
    * Define informacoes locais
    */
    setlocale(LC_COLLATE,  "pt_BR.ISO8859-1");
    setlocale(LC_CTYPE,    "pt_BR.ISO8859-1");
    setlocale(LC_TIME,     "pt_BR.ISO8859-1");
    setlocale(LC_MONETARY, "pt_BR.ISO8859-1");
    setlocale(LC_NUMERIC,  "en_US");

?>
