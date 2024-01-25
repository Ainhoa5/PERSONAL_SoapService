<?php
/**
 * /ConsumirGET.php
 * Consumes a SOAP web service using cURL, 
 * a PHP library that allows making HTTP requests, 
 * to send a SOAP request to a web service and receive a response.
 */

/**
 * Specifies the URL of the SOAP web service to which the request will be sent.
 */
$location = "http://localhost/projects/PERSONAL_SoapService/InsertCategoria.php?wsdl";


/**
 * Contains the parameters of the SOAP request.
 * For GET, these are typically query string parameters added to the URL.
 */
$queryString = http_build_query([
   // Aquí agregarías los parámetros necesarios para tu solicitud SOAP
   'action' => 'GetAllUsuariosService'
]);

$locationWithQuery = $location . '&' . $queryString;

/**
 * An array containing several HTTP headers necessary for the request.
 */
$headers = [
    'Method: GET',
    'Connection: Keep-Alive',
    'User-Agent: PHP-SOAP-CURL',
    'Content-Type: text/xml; charset=utf-8',
];

/**
 * Initializes cURL with curl_init($locationWithQuery) pointing to the SOAP service URL with the query string.
 * Sets various cURL options for sending the request.
 */
$ch = curl_init($locationWithQuery);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // To return the result as a string
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // To set the HTTP headers
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
