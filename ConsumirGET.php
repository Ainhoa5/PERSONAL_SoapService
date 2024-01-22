<?php 
/* 
    In /ConsumirGET.php
    consumir un servicio web SOAP. Utiliza cURL, 
    una biblioteca en PHP que permite realizar solicitudes HTTP, 
    para enviar una solicitud SOAP a un servicio web y recibir una respuesta
*/

// Especifica la URL del servicio web SOAP al que se enviará la solicitud
$location = "http://localhost/projects/PERSONAL_SoapService/InsertCategoria.php?wsdl";

// Contiene el cuerpo de la solicitud SOAP formateado como XML
$request = "
<soapenv:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:ins=\"InsertCategoriaSOAP\">
   <soapenv:Header/>
   <soapenv:Body>
      <ins:GetAllUsuariosService soapenv:encodingStyle=\"http://schemas.xmlsoap.org/soap/encoding/\">
      </ins:GetAllUsuariosService>
   </soapenv:Body>
</soapenv:Envelope>
";

// Se imprime la solicitud SOAP en formato legible para fines de depuración 
print("Request : <br>");
print("<pre>".htmlentities($request)."</pre>");

// Define la acción que se está realizando
$action = "GetAllUsuariosService";
// Un array que contiene varios encabezados HTTP necesarios para la solicitud
$headers = [
    'Method: POST',
    'Connection: Keep-Alive',
    'User-Agent: PHP-SOAP-CURL',
    'Content-Type: text/xml; charset=utf-8',
    'SOAPAction: "guardarSoapService"',
];

// Segun la documentacion
$ch = curl_init($location); // Se inicializa cURL con curl_init($location) apuntando a la URL del servicio SOAP
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // para devolver el resultado como string
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // para establecer los encabezados HTTP
curl_setopt($ch, CURLOPT_POST, true); // para enviar los datos de la solicitud
curl_setopt($ch, CURLOPT_POSTFIELDS, $request); // para enviar los datos de la solicitud
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); // para definir la versión HTTP

$response = curl_exec($ch); // Ejecuta la solicitud cURL y guarda la respuesta
$err_status = curl_errno($ch); // Verifica si hubo algún error durante la ejecución de cURL y almacena el estado en $err_status

// Se imprime la respuesta recibida del servidor SOAP para propósitos de depuración
print("Request : <br>");
print("<pre>".$response."</pre>");
