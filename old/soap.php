<?php
echo "pepe";
try {
$url = 'https://afip.gov.ar/ws';

    $response = new SoapClient('https://wswhomo.afip.gov.ar/wsfev1/service.asmx?WSDL');

    $variable = $response->FECAESolicitar();

echo $variable."lalalal";

echo "Termino";
}
catch (Exception $e) {
    $e->getMessage();

}
?>
