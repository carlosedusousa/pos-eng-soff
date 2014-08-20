<?php

// Caminho das base das paginas
define ('PAGINA_ROOT', '/ebombeiro/');

// Caminho dos Indexs
define ('PAGINA_INICIAL',       PAGINA_ROOT.'index.php');
define ('PAGINA_LOGIN',         PAGINA_ROOT.'index.php');
define ('PAGINA_LOGOUT',        PAGINA_ROOT.'logout.php');

   /**
    * Paginas de login
    */
    define ('PAGINA_SESS_EXPIROU',  PAGINA_ROOT.'./erro/sessao_login_expirou.php');
    define ('PAGINA_CONS',          PAGINA_ROOT.'index2.php?e=');

   /**
    * Paginas de alertas do sistema
    */
    define ('PAGINA_BD_NAO_DISPONIVEL',  PAGINA_ROOT.'./erro/indesp.php');
    define ('PAGINA_SSL_EXIGIDO',        PAGINA_ROOT.'./erro/ssl.php');
    define ('PAGINA_EM_MANUTENCAO',      PAGINA_ROOT.'./erro/manut.php');

?>
