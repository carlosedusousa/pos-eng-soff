<?

     class seguranca {
 
         function validar_usuario() {
 
             $lg = $_COOKIE['lg'];
             $sh = $_COOKIE['sh'];
             $sql = "select * from EFETIVO where LOGIN = '$lg' and SENHA = '$sh'";
             $res = mysql_query($sql);
             if ($r = mysql_fetch_assoc($res)) return true; else return false;
 
         }
 
     }
 
     $seguranca = new seguranca;

?>