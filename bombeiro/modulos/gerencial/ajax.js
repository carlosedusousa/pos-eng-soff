function ajax_select(select_origem, select_destino, sql, campo1, campo2) {

	//alert(select_origem+' '+select_destino+' '+sql+' '+campo1+' '+campo2);

	var chave = select_origem.value;
	sql = sql.replace("chave",chave);

    try {
        ajax = new ActiveXObject("Microsoft.XMLHTTP");
    } catch(e) {
        try {
            ajax = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(ex) {
            try {
                ajax = new XMLHttpRequest();
            } catch(exc) {
                alert("Esse browser não tem recursos para uso do Ajax");
                ajax = null;
            }
        }
    }

    if(ajax) {

        select_destino.options.length = 1;
        ajax.open("POST", "ajax_select.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.onreadystatechange = function() {
            if(ajax.readyState == 1) idOpcao.innerHTML = "Carregando...!";
            if(ajax.readyState == 4 && ajax.responseXML) processXML(ajax.responseXML,select_destino,campo1,campo2);
        }
        var params = "sql="+sql+"&campo1="+campo1+"&campo2="+campo2;
        ajax.send(params);
    }
}

function processXML(obj,select_destino,campo1,campo2) {

    var dataArray = obj.getElementsByTagName("registro");

    if(dataArray.length > 0) {
        for(var i = 0; i < dataArray.length; i++) {
            var item = dataArray[i];
            var codigo = item.getElementsByTagName(campo1)[0].firstChild.nodeValue;
            var descricao = item.getElementsByTagName(campo2)[0].firstChild.nodeValue;
            var novo = document.createElement("option");
            novo.value = codigo;
            novo.text  = descricao;
            select_destino.options.add(novo);
        }
    }

}