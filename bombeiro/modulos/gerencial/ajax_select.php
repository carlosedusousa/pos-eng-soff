<?

	require_once 'lib/loader.php';
	
	$conn = new BD (BD_HOST, BD_USER, BD_PASS, BD_NOME_ACESSOS);
	if ($conn->get_status()==false) die($conn->get_msg());

    $sql = $_POST['sql'];
    $campo1 = $_POST['campo1'];
    $campo2 = $_POST['campo2'];

    $conn->query($sql);
    while ($r = $conn->fetch_row()) $rs[] = $r;

    $xml  = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";

    $xml .= "<registros>\n";
        foreach ($rs as $r) {
            $xml .= "<registro>\n";
                $xml .= "<$campo1>$r[$campo1]</$campo1>\n";
                $xml .= "<$campo2>$r[$campo2]</$campo2>\n";
            $xml .= "</registro>\n";
        }
    $xml.= "</registros>\n";

    Header("Content-type: application/xml; charset=iso-8859-1");

    echo $xml;

?>