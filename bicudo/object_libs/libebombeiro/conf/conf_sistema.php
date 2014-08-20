<?php

   /**
    *  Se desejar informar aos usuários que o sistema esta
    *  em manutencao, defina ** true ** na opcao abaixo.
    */
    define ('SISTEMA_EM_MANUTENCAO', false);

   /**
    * Informacao sobre a Aplicacao
    */
    define ('SISTEMA_NOME',   'E-193-WEB');
    define ('SISTEMA_VERSAO', '1.0');
    define ('SISTEMA_STATUS', 'CURRENT');

   /**
    * Endereco IP do servidor
    */
    define ('END_PADRAO', 'https://10.193.4.143/~edsonagem/e193/index.php');

   /**
    * Nome do servidor LDAP
    */
    define ('LDAP_SERVIDOR','ldap.cb.sc.gov.br');

   /**
    * Configuracao do BRA - Bug Report Alert(TM)
    */
    define ('BRA_ATIVADO', false);
    define ('BRA_DESTINO', 'sigatreport@cb.sc.gov.br');

   /**
    * Dados da sessao PHP Solicitacao
    */
    define ('CONF_SESSION_ID_USUARIO', 'RCSATID_ID_USUARIO');
    define ('CONF_SESS_CLIENTE_UID', 'CURRENT_CLIENTE_ID');

   /**
    * Mostrar o login do ultimo usuario na tela inicial?
    */
    define ('CONF_ULTIMO_LOGIN_MOSTRAR', true);
    define ('CONF_ULTIMO_LOGIN_COOKIE', 'LL');
    define ('CONF_ULTIMO_LOGIN_VALIDADE', time()+60*60*24*30); // Duração: 30 dias

   /**
    *  E obrigatorio usar SSL para acessar o sistema?
    */
    define ('CONF_REQUIRE_SSL', false);

   /**
    * O cookie de sessao deve ser usado apenas via SSL?
    */
    define ('CONF_SESS_WITH_SSL_ONLY', false);

   /**
    * Níveis de log do sistema
    */
    define ('EVENT_INFO',     0); // Informativo
    define ('EVENT_WARN',     1); // Alerta
    define ('EVENT_SECURITY', 2); // Seguranca
    define ('EVENT_CRIT',     3); // Critico
    define ('EVENT_DEFAULT_USER','SISTEMA'); // Usuario de eventos do sistema

   /**
    * Configuracoes Regionais
    */
    define ('MOEDA', 'R$');

   /**
    * Rotulo da Aplicacao
    */
    define ('LABEL_SYSNAME', 'CBMSC/DITI/E-193');

?>
