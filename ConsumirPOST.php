<?php
/**
 * /ConsumirPOST.php
 * Consumes a SOAP web service. It uses cURL, 
 * a PHP library for making HTTP requests, 
 * to send a SOAP request to a web service and receive a response.
 */


/**
 * Specifies the URL of the SOAP web service to which the request will be sent.
 */
$location = "http://localhost/projects/PERSONAL_SoapService/InsertCategoria.php?wsdl";

/**
 * Contains the body of the SOAP request formatted as XML.
 * This XML structure represents a SOAP request for the InsertCategoriaService.
 */
$request = "
<soapenv:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:ins=\"InsertCategoriaSOAP\">
   <soapenv:Header/>
   <soapenv:Body>
      <ins:InsertCategoriaService soapenv:encodingStyle=\"http://schemas.xmlsoap.org/soap/encoding/\">
         <InsertCategoria xsi:type=\"ins:InsertCategoria\">
            <!--You may enter the following 3 items in any order-->
            <usu_nom xsi:type=\"xsd:string\">Consumo Test</usu_nom>
            <usu_ape xsi:type=\"xsd:string\">Consumo Test</usu_ape>
            <usu_correo xsi:type=\"xsd:string\">Consumo_Test@ui.com</usu_correo>
         </InsertCategoria>
      </ins:InsertCategoriaService>
   </soapenv:Body>
</soapenv:Envelope>
";

// Print the SOAP request in a readable format for debugging purposes
print("Request : <br>");
print("<pre>" . htmlentities($request) . "</pre>");


/**
 * Defines the action being performed.
 */
$action = "InsertCategoriaService";

/**
 * An array containing several HTTP headers necessary for the request.
 */
$headers = [
   'Method: POST',
   'Connection: Keep-Alive',
   'User-Agent: PHP-SOAP-CURL',
   'Content-Type: text/xml; charset=utf-8',
   'SOAPAction: "guardarSoapService"',
];

/**
 * Initializes cURL with curl_init($location) pointing to the SOAP service URL.
 * Sets various cURL options for sending the request.
 */
$ch = curl_init($location);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // To return the result as a string
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // To set the HTTP headers
curl_setopt($ch, CURLOPT_POST, true); // To send the data of the request
curl_setopt($ch, CURLOPT_POSTFIELDS, $request); // To send the data of the request
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); // To define the HTTP version

/**
 * Executes the cURL request and saves the response.
 * Checks for any errors that occurred during the cURL execution and stores the status in $err_status.
 */
$response = curl_exec($ch);
$err_status = curl_errno($ch);

// Print the response received from the SOAP server for debugging purposes
print("Request : <br>");
print("<pre>" . $response . "</pre>");
