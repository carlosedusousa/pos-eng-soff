<?php

/**
 * Corpo de Bombeiros Militar de Santa Catarina
 *
 * Projeto Sigat Sistema de Gerenciamento de Atividades Tecnicas
 *
 * @categoria  Class
 * @pacote     BD
 * @autor      Edson Orivaldo Lessa Junior <edsonagem@cb.sc.gov.br>
 * @creditos   Agem Informatica  
 * @versao     1.0
 * @data       14/07/2005 as 11:17:44
 * @atualiza   19/11/2005 as 23:15:06
 * @arquivo    lib/class/class_mysql.php
 */

class BD {

   /**
    * Variaveis utilizadas:
    * $this->link          Link da conexão do MySQL
    * $this->status        Valor opcional do retorno da ultima operacao
    * $this->err_msg       Armazena a mensagem de um erro que encerrou um metodo
    * $this->row_count     Conta quandos registros ainda tem para serem lidos
    *                      e decrementado a cada $this ->fetch_row()
    */

    function BD ($host, $user, $pass, $db) {
        // Status inicial: falso
        $this->status = false;

        // Inicializa o contador de registros
        $this->row_count = 0;

        // Tenta conectar com o servidor MySQL
        $this->link = @mysql_connect ($host, $user, $pass);
        if (mysql_errno()) {
            $this->status = false;
            $this->err_msg = mysql_error();
            return false;
        }

        // Tenta selecionar a base solicitada
        @mysql_select_db($db);
        if (mysql_errno()) {
            $this->status = false;
            $this->err_msg = mysql_error();
            return false;
        }

        // Tudo correu bem, a conexao esta dispononivel
        $this->status = true;

    }

    function check_server () {
        return $this->status;
    }

    // Retorna a mensagem de erro de um metodo que tenha falhado
    function get_msg () {
        return $this->err_msg;
    }

    function get_status () {
        return $this->status;
    }

    // Executa uma query SQL
    function query ($sql) {        
        $select = (strtoupper(substr(trim($sql), 0, 6)) == 'SELECT');
        if ($select) {
             $this->resposta = mysql_query($sql, $this->link);
             if (mysql_errno()!=0) {
               $this->status = false;
             }
        }
        else {
             @mysql_query($sql, $this->link);
             if (mysql_errno()!=0) {
               $this->status = false;
             }
        }
        $this->err_msg = mysql_error() . ' (requisição original: '.$sql.')';

        if (!mysql_errno() && $select)
            $this->row_count = $this->num_rows();
        else
            $this->row_count = 0;

        return true;
    }

    function queryx ($sql) {        
        $select = (strtoupper(substr(trim($sql), 0, 6)) == 'SELECT');
        if ($select) {
             $respostax = mysql_query($sql, $this->link);
             if (mysql_errno()) {
               $this->status = false;
             }
        }
        else {
             $respostax= mysql_query($sql, $this->link);
             if (mysql_errno()) {
               $this->status = false;
             }
        }
        if ($this->status==false) {
          $this->err_msg = mysql_error() . ' (requisição original: '.$sql.')';
          echo "ERRO :".$this->err_msg."<br>\n";
        } else {
          $this->err_msg ="";
        }

        if (!mysql_errno() && $select)
            $this->row_countx = $this->num_rowsx($respostax);
        else
            $this->row_countx = 0;

        return $respostax;
    }
    // Recupera uma entrada da resposta do SQL
    function fetch_rowx ($result) {
        if ($result) {
           return mysql_fetch_assoc ($result);
        }
        return false;
    }

    // Recupera uma entrada da resposta do SQL
    function fetch_row () {
        if ($this->num_rows_left()) {
           $this->row_count--;
           return mysql_fetch_assoc ($this->resposta);
        }
        return false;
    }

    // Recupera o primeiro valor de um registro
    function fetch_first_field () {
        if ($this->num_rows_left()) {
           $this->row_count--;
           $t = mysql_fetch_row ($this->resposta);
           return $t[0]; // Retorna o primeiro campo
        }
        return false;
    }

    function insert_id () {
        return @mysql_insert_id ($this->link);
    }

    function num_rowsx ($result) {
        $valorx = 0;
        $valorx = mysql_num_rows($result);
        return $valorx;
    }

    function num_rows () {
        $valor = 0;
        $valor = @mysql_num_rows(@$this->resposta);
        return $valor;
    }

    function num_rows_left () {
        return $this->row_count;
    }

    function escape_string ($string) {
        return mysql_escape_string ($string);
    }

    function affected_rows () {
        return @mysql_affected_rows ($this->link);
    }

}

?>
