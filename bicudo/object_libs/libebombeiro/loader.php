<?php

/**
 * Corpo de Bombeiros Militar de Santa Catarina
 * Projeto E-Bombeiro
 * @pacote      Loader
 * @autor       Marcelo Viana <marceloawk@cb.sc.gov.br>
 * @creditos    AWK Tecnologia
 * @versao      1.0
 * @data        04/03/2009 as 16:58:32
 * @arquivo     libebombeiro/loader.php
 */

// Configuracoes e Variaveis
require 'conf/conf_bd.php';
require 'conf/conf_msgs.php';
require 'conf/conf_paginas.php';
require 'conf/conf_sistema.php';

// Classes e Entidades
require 'class/class_pg.php';
require 'class/class_sessao_cobom.php';

// Classes Controladores
require 'class/class_ctrleventos.php';

// Miscelanea
require 'misc/funcoes_uteis.php';
require 'misc/bra.php';
require 'misc/bra_template.php';
require 'misc/e193.php';

// Instancia o Controlador de Sessao
$global_obj_sessao = new sessao();

// Instancia o Controlador Publico de Eventos
$global_obj_ctrl_eventos = new ctrl_eventos();

// Exibe os erros no codigo
error_reporting(E_ALL & E_NOTICE & E_WARNING);

// Define informacoes locais
setlocale(LC_COLLATE,  "pt_BR.ISO8859-1");
setlocale(LC_CTYPE,    "pt_BR.ISO8859-1");
setlocale(LC_TIME,     "pt_BR.ISO8859-1");
setlocale(LC_MONETARY, "pt_BR.ISO8859-1");
setlocale(LC_NUMERIC,  "en_US");

?>