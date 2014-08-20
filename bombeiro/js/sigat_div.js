function check(campo) {
  if (campo.checked==false) {
    campo.value="N";
  } else {
    campo.value="S";
  }
  return;
}
function check_ed(campo,valor) {
  if (valor=="S") {
    campo.checked=true;
    campo.value='S';
  } else {
    campo.checked=false;
    campo.value='N';
  }
}
function radio_ed(campo,valor) {
  for (var i=0; i<campo.length; i++) {
    if (campo[i].value==valor) {
      campo[i].checked=true;
      return;
    }
  }
}
function validaCPF(cpf,campo) {
//  cpf = document.validacao.cpfID.value;
  erro = new String;
  var aux="";
  while ((cpf.indexOf('.')>-1) || (cpf.indexOf('/')>-1) || (cpf.indexOf('-')>-1)) {
    if (cpf.indexOf('.')>-1) {
      aux=cpf.replace('.','');
      cpf=aux;
    }
    if (cpf.indexOf('/')>-1) {
      aux=cpf.replace('/','');
      cpf=aux;
    }
    if (cpf.indexOf('-')>-1) {
      aux=cpf.replace('-','');
      cpf=aux;
    }
  }
  if (cpf.length < 11) erro += "Sao necessarios 11 digitos para verificacao do CPF! ";
  var nonNumbers = /\D/;
  if (nonNumbers.test(cpf)) erro += "A verificacao de CPF suporta apenas numeros! ";
  if (cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999"){
    erro += "Numero de CPF invalido!"
  }
  var a = [];
  var b = new Number;
  var c = 11;
  for (i=0; i<11; i++){
    a[i] = cpf.charAt(i);
    if (i < 9) b += (a[i] * --c);
  }
  if ((x = b % 11) < 2) { a[9] = 0 }
  else { a[9] = 11-x }
  b = 0;
  c = 11;
  for (y=0; y<10; y++) b += (a[y] * c--);
  if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }
  if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10])){
    erro +="Digito verificador com problema!";
  }
  if (erro.length > 0){
    alert(erro);
    campo.value="";
    campo.focus();
    return false;
  }
  campo.value=cpf.substr(0,3)+"."+cpf.substr(3,3)+"."+cpf.substr(6,3)+"-"+cpf.substr(9,2);
  return true;
}
function validaCNPJ(CNPJ,campo) {
  erro = new String;
  if ((CNPJ.charAt(2) == ".") || (CNPJ.charAt(6) == ".") || (CNPJ.charAt(10) == "/") || (CNPJ.charAt(15) == "-")){
  //substituir os caracteres que não são números
    if(document.layers && parseInt(navigator.appVersion) == 4){
      x = CNPJ.substring(0,2);
      x += CNPJ. substring (3,6);
      x += CNPJ. substring (7,10);
      x += CNPJ. substring (11,15);
      x += CNPJ. substring (16,18);
      CNPJ = x;
    } else {
      CNPJ = CNPJ. replace (".","");
      CNPJ = CNPJ. replace (".","");
      CNPJ = CNPJ. replace ("-","");
      CNPJ = CNPJ. replace ("/","");
    }
    if (CNPJ.length != 14) { erro += "É necessário preencher corretamente o número do CNPJ! "; }
  }
  var nonNumbers = /\D/;
  if (nonNumbers.test(CNPJ)) {
    erro += "A verificação de CNPJ suporta apenas números! ";
  } else {
    var a = [];
    var b = new Number;
    var c = [6,5,4,3,2,9,8,7,6,5,4,3,2];
    for (i=0; i<12; i++){
      a[i] = CNPJ.charAt(i);
      b += a[i] * c[i+1];
    }
    if ((x = b % 11) < 2) { a[12] = 0 } else { a[12] = 11-x }
    b = 0;
    for (y=0; y<13; y++) {
      b += (a[y] * c[y]);
    }
    if ((x = b % 11) < 2) { a[13] = 0; }
    else { a[13] = 11-x; }
    if ((CNPJ.charAt(12) != a[12]) || (CNPJ.charAt(13) != a[13])){
      erro +="Dígito verificador com problema!";
    }
  }
  if (CNPJ=="00000000000000") { erro=""; }
  if (erro.length > 0){
    alert(erro);
    campo.value="";
    campo.focus();
    return false;
  }
  campo.value=CNPJ.substr(0,2)+"."+CNPJ.substr(2,3)+"."+CNPJ.substr(5,3)+"/"+CNPJ.substr(8,4)+"-"+CNPJ.substr(12,2)
  return true;
}
function cpfcnpj(campo) {
  if (campo.value.length>0) {
    var smascara= campo.value;
    if(document.layers && parseInt(navigator.appVersion) == 4){
      smascara = campo.value.substring(0,2);
      smascara += campo.value.substring (3,6);
      smascara += campo.value.substring (7,10);
      smascara += campo.value.substring (11,15);
      smascara += campo.value.substring (16,18);
    } else {
      smascara = campo.value.replace(".","");
      smascara = smascara.replace(".","");
      smascara = smascara.replace("-","");
      smascara = smascara.replace("/","");
    }
    if (smascara.length>11) {
      validaCNPJ(smascara,campo);
    } else {
      validaCPF(smascara,campo);
    }
  }
}
function isDigit(theDigit) {
  var digitArray = new Array('0','1','2','3','4','5','6','7','8','9'),j;
  for (j = 0; j < digitArray.length; j++) {
    if (theDigit == digitArray[j]) 
    return true 
  }
  return false
}
function isPositiveInteger(theString) { 
  var theData = new String(theString) 
  if (!isDigit(theData.charAt(0))) if (!(theData.charAt(0)== '+')) return false
  for (var i = 1; i < theData.length; i++) if (!isDigit(theData.charAt(i))) return false
  return true 
} 
function isDate(s,f) {
  var a1=s.split("/");
  var a2=s.split("-"); 
  var e=true; 
  if ((a1.length!=3) && (a2.length!=3)) {
    e=false; 
  } else {
    if (a1.length==3) { var na=a1; }
    if (a2.length==3) { var na=a2; }
    if (isPositiveInteger(na[0]) && isPositiveInteger(na[1]) && isPositiveInteger(na[2])) {
      if (f==1) {
        var d=na[1],m=na[0];
      } else {
        var d=na[0],m=na[1];
      }
      var y=na[2];
      if (((e) && (y<1000)||y.length>4)) { e=false; }
      if (e) {
        v=new Date(m+"/"+d+"/"+y);
        if (v.getMonth()!=m-1) { e=false; }
      }
    } else {
      e=false;
    }
  }
  return e
}


function checkDate(campo) {
  //v = this
  var datas=campo.value.replace("/","");
  datas = datas.replace("/","");
  campo.value=datas;
  if (campo.value.length==6) {
    campo.value=datas.substr(0,2)+"/"+datas.substr(2,2)+"/20"+datas.substr(4,2);
  } else {
    if (campo.value.length==8) {
      campo.value=datas.substr(0,2)+"/"+datas.substr(2,2)+"/"+datas.substr(4,4);
    }
  }
  datas=campo.value;
  if (isDate(datas,0)) {//dd/mm/yyyy format
    return true;
  } else {
    alert("Data Invalida");
    campo.value="";
    
    //faz uma chamada na função forcefocus para forçar o foco
	setTimeout(function() {	forcefocus(campo);}, 250);
		   
   }
   return false;
}


//função para forçar o foco utilizando comando timeout
function forcefocus(campo, timeout) {
	var timeout = (timeout == 250) ? 500 : timeout;
	campo.focus();
}

function validaForm(){
  if (validaForm.arguments.length>1) {
    var alerta="";
    d = validaForm.arguments[0];
    for (var i=1;i<validaForm.arguments.length;i++) {
      parametros=validaForm.arguments[i].split(",");
      campo=parametros[0];

//alert(validaForm.arguments.length+' | '+i+' | '+parametros[0]+' | '+parametros[1]+' | '+parametros[2]+' | '+d[campo].value);

      switch (parametros[2]) {
        case "e":
          //validar email(verificao de endereco eletrônico)
          parte1 = d[campo].value.indexOf("@");
          parte2 = d[campo].value.indexOf(".");
          parte3 = d[campo].value.length;
          if (!(parte1 >= 3 && parte2 >= 0 && parte3 >= 9)) {
            alerta+="O campo '" + parametros[1] + "' deve ser conter um endereco eletronico!\n";
          } else {
            //validar email
            if (d[campo].value == ""){
              alerta+="O campo " + parametros[1] + " deve ser preenchido!\n";
            }
          }
          break;
        case "n":
          if (d[campo].value == ""){
            alerta+="O campo '" + parametros[1] + "' deve ser preenchido!\n";
          } else {
            //validar telefone(verificacao se contem apenas numeros)
            if (isNaN(d[campo].value)){
              alerta+="O campo '" + parametros[1] + "' deve conter apenas números!\n";
            }
          }
          break;
        case "t":
          //validar nome
          if (d[campo].value == ""){
            alerta+="O campo '" + parametros[1] + "' deve ser preenchido!\n";
          }
          break;
        case "h":
          //validar nome
          //alert("aqui 0:"+campo+"==>"+document.frm_protocolo.rdo_guarda_logradouro.value);
          //alert("aqui 2:"+d[campo].checked+"==>"+d[campo][1].checked);
          var contr_hdn=false;
          for (var k=0;k<parametros[3];k++) {
            if (d[campo][k].checked == true){
              contr_hdn=true;
            }
          }
          if (contr_hdn==false) {
            alerta+="O campo '" + parametros[1] + "' deve ser preenchido!\n";
          }
          break;
      }

    }
    if (alerta!="") {
      alert("Os seguinte ERROS encontrados:\n"+alerta+"VERIFIQUE!!!");
      return false;
    } else {
      return true;
    }
  }
}

function controle_multiplo() {
  var controle=false;
  var frm_form=controle_multiplo.arguments[0];
  var campo = controle_multiplo.arguments[1];
  var i=2;
  if (campo.checked==true) {
    for (i=2;i<controle_multiplo.arguments.length;i++) {
      if (frm_form[controle_multiplo.arguments[i]].type=="checkbox") {
        controle=true;
      }
      if (controle==false) {
        frm_form[controle_multiplo.arguments[i]].disabled=false;
      } else {
        if (frm_form[controle_multiplo.arguments[i]].type!="select-one") {
          frm_form[controle_multiplo.arguments[i]].disabled=false;
        } else {campo.value="";
          continue;
        }
      }
    }
  } else {
    for (i=2;i<controle_multiplo.arguments.length;i++) {
      frm_form[controle_multiplo.arguments[i]].disabled=true;
    }
  }
}

function controle_multiplos() {
  var controle=false;
  var frm_form=controle_multiplos.arguments[0];
  var campo = controle_multiplos.arguments[1];
  var i=2;
  if (campo==1) {
    for (i=2;i<controle_multiplos.arguments.length;i++) {
      if (frm_form[controle_multiplos.arguments[i]].type=="checkbox") {
        controle=true;
      }
      if (controle==false) {
        frm_form[controle_multiplos.arguments[i]].disabled=false;
      } else {
        if (frm_form[controle_multiplos.arguments[i]].type!="select-one") {
          frm_form[controle_multiplos.arguments[i]].disabled=false;
        } else {
          continue;
        }
      }
    }
  } else {
    for (i=2;i<controle_multiplos.arguments.length;i++) {
      frm_form[controle_multiplos.arguments[i]].disabled=true;
    }
  }
}

function isNum(caractere) {
  var strValidos = '0123456789,.-';
  if ( strValidos.indexOf(caractere) == -1 ) {
    alert("Campo Numérico, caractere: '"+caractere+"' inválido!");
    return false;
  }
  else { return true; }
}
function isSimb(caractere) {
  var strValidos = ' -,.!@#$%¨=¬³²¹&>?<:;^~´`*()_+§"\'¢£ºª{}[]°/';
  if ( strValidos.indexOf(caractere) == -1 ) {
    alert("Campo somente Símbolos, caractere: '"+caractere+"' inválido!");
    return false;
  }
  else { return true; }
}
function isLestras(caractere) {
  var strValidos = ' qwertyuiopasdfghjklçzxcvbnmQWERTYUIOPASDFGHJKLÇZXCVBNMªº°ÂÊÎÔÛâêîôûáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙãõÃÕçÇäëïöüÄËÏÖÜ"';
  if ( strValidos.indexOf(caractere) == -1 ) {
    alert("Campo Alfabético, caractere: '"+caractere+"' inválido!");
    return false;
  }
  else { return true; }
}
function isAlfa(caractere) {
  var strValidos = ' -,.0123456789qwertyuiopasdfghjklçzxcvbnmQWERTYUIOPASDFGHJKLÇZXCVBNMªº°ÂÊÎÔÛâêîôûáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙãõÃÕçÇäëïöüÄËÏÖÜ"';
  if ( strValidos.indexOf(caractere) == -1 ) {
    alert("Campo Alfanumérico, caractere: '"+caractere+"' inválido!");
    return false;
  }
  else { return true; }
}
function validaTecla(campo, event, tipo) {
  var BACKSPACE= 8;
  var key;
  var tecla;
  CheckTAB=true;
  if(navigator.appName.indexOf('Netscape')!= -1) { tecla= event.which; }
  else { tecla= event.keyCode; }
  key = String.fromCharCode(tecla);
  if ( tecla != 13 ) {
    if ((tecla == BACKSPACE )||(tecla ==9) || (tecla==0)) { return true; }
    else {
      if (tipo=="l") { return (isLestras(key)); }
      else {
        if (tipo=="a") { return (isAlfa(key)); }
        else {
          if (tipo=="n") { return (isNum(key)); }
          else {
            if (tipo=="l"){ return (isSimb(key)); }
          }
        }
      }
    }
  }
}

function FormatNumero(campo) {
  if (campo.type=='text') {
    var textFormat = "";
    var t=0;
    var str=campo.value;
    var dec= new Array;
    for (var j = 0; j < campo.value.length ; j++) {
      if (campo.value.indexOf(",")>(-1)) {
        dec=campo.value.split(",");
        str=dec[0];
      }
    }
    for (var j = 0; j < str.length ; j++) {
      str=str.replace('.','');
    }
    if (str.length != 0) {
      for (var k = str.length-1; k>=0 ; k--) {
        t++;
        if (t % 3 == 0) {
          textFormat = "." + str.substr(k,1) + textFormat;
        } else {
          textFormat =  str.substr(k,1) + textFormat;
        }
      }
      if (textFormat.substr(0,1) == ".") {
        campo.value = textFormat.substr(1,textFormat.length-1);
      } else {
        campo.value = textFormat;
      }
    }
    if (dec.length>0) {
      campo.value+=","+dec[1];
    }
  }
}
function decimal(campo,precisao) {
  var dec=campo.value.split(",");
  var str=",";
  if (precisao==0) {
    campo.value=dec[0];
    return true;
  }
  if (dec.length>1) {
    for (var i=0;i<precisao;i++) {
      if (dec[1].substr(i,1)!="") {
        str+=dec[1].substr(i,1);
      } else {
        str+="0";
      }
    }
  } else {
    for (var i=0;i<precisao;i++) {
        str+="0";
    }
  }
  campo.value=dec[0]+str;
  return true;
}

function CEP(campo) {
  if (campo.value=="") { return; }
  var str=campo.value;
  for (var j = 0; j < str.length ; j++) {
    str=str.replace('.','');
    str=str.replace('-','');
  }
  if (str.length!=8) {
    alert("CEP ERRADO favor verificar!!");
    campo.value="";
    campo.focus();
    campo.select();
    return;
  }
  if (isNaN(str)) {
    alert("Caracter Inválido no CEP!!!");
    campo.value="";
    campo.focus();
    campo.select();
    return;
  }
  campo.value=str.substr(0,2)+"."+str.substr(2,3)+"-"+str.substr(5,3)
}
function valida_crea(crea) {
/*
  Numero = 6 posições
  DV = 1 posição
  CALCULAR TOTAL = (NRO(1) * 7) + (NRO(2) * 5) + (NRO(3) * 3) + (NRO(4) * 7) + (NRO(5) * 5) + (NRO(6) * 3)
  DIVIDE TOTAL POR 11
  SE RESTO FOR = 10
  DIGITO = 0
  SENÃO
  DIGITO = DIGITO
*/
  var nr_crea = crea.value.replace ("-","");
  crea.value = nr_crea;
  var tot=0;
  var val=0;
  var erro=false;
  if (nr_crea=="") { return;}
  if (nr_crea.length<7) {
    alert("CREA COM NÚMERO INFERIOR A 7 DIGITOS!!");
    crea.value="";
    crea.focus();
  } else {
    val= parseInt(nr_crea.substr(0,1)*7)+ parseInt(nr_crea.substr(1,1)*5)+ parseInt(nr_crea.substr(2,1)*3)+ parseInt(nr_crea.substr(3,1)*7)+ parseInt(nr_crea.substr(4,1)*5)+ parseInt(nr_crea.substr(5,1)*3);
    if (isNaN(val)) { 
      alert("Não é número");
      crea.value="";
      crea.focus();
    } else {
      tot=val%11;
      if (tot==10) {
        tot=0;
      }
      if (parseInt(nr_crea.substr(6,1))!=tot) { 
        if (parseInt(nr_crea)>0) {
          alert('CREA Invalido!!');
          crea.value="";
          crea.focus();
          erro=true;
        }
      }
      if (erro==false) {
        crea.value= crea.value.substr(0,6)+"-"+crea.value.substr(6);
      }
    }
  }
}
function limpa_num(valor,dec) {
  if (valor=="") {return}
  while (valor.indexOf("-")>-1) {
    valor=valor.replace("-","");
  }
  while (valor.indexOf(".")>-1) {
    valor=valor.replace(".","");
  }
  if (dec==true) {
    while (valor.indexOf(",")>-1) {
      valor=valor.replace(",",".");
    }
  } else {
    while (valor.indexOf(",")>-1) {
      valor=valor.replace(",","");
    }
  }
  return valor;
}
