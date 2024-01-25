<?php
/**
 * InsertCategoria.php
 * Configures and handles a SOAP server for inserting categories into a database.
 * This script sets up the SOAP server, registers available services,
 * and processes incoming SOAP requests.
 */

// Allow requests from any origin (CORS headers)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// Include the nusoap class and User model
require_once 'vendor/econea/nusoap/src/nusoap.php';
require_once 'models/Usuario.php';

/**
 * MySoapServer class extends the functionality of the nusoap's soap_server.
 * It is used to configure and handle the SOAP server operations for the application.
 */
class MySoapServer extends soap_server
{
    /**
     * @var string The target namespace for the WSDL schema.
     */
    public $schemaTargetNameSpace;

    /**
     * Constructor for MySoapServer.
     * Initializes the parent soap_server class.
     */
    public function __construct()
    {
        parent::__construct();
    }
}

// Service name for the SOAP server
$namespace = "InsertCategoriaSOAP";
$server = new MySoapServer();
// Initial configuration of the SOAP server using WSDL
$server->configureWSDL("InsertCategoria", $namespace);
$server->schemaTargetNameSpace = $namespace;


/**
 * Defines the data structure that the service will receive (usu_nom, usu_ape, usu_correo)
 * and the structure of the response (Result). These complex types are custom structures
 * for sending and receiving data.
 */
$server->wsdl->addComplexType(
    'InsertCategoria',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'usu_nom' => array('name' => 'usu_nom', 'type' => 'xsd:string'),
        'usu_ape' => array('name' => 'usu_ape', 'type' => 'xsd:string'),
        'usu_correo' => array('name' => 'usu_correo', 'type' => 'xsd:string'),
    )
);

// Estructura de la respuesta del servicio
$server->wsdl->addComplexType(
    'response',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'Resultado' => array('name' => 'Resultado', 'type' => 'xsd:boolean'),
    )
);


/**
 * Registers the InsertCategoriaService as a service available on the SOAP server.
 * Defines the input and output of the service, using the previously defined complex types.
 */
$server->register(
    "InsertCategoriaService",
    array("InsertCategoria" => "tns:InsertCategoria"), // entrada
    array("InsertCategoria" => "tns:response"), // salida
    $namespace,
    false,
    "rpc",
    "encoded",
    "Inserta una categoria"
);

/**
 * Function to handle the InsertCategoriaService SOAP operation.
 * It inserts a new user into the database using the provided request parameters.
 *
 * @param array $request The request parameters for the user to be added.
 * @return array An array containing the result of the operation.
 */
function InsertCategoriaService($request)
{
    require_once 'config/conexion.php';
    require_once 'models/Usuario.php';

    $usuario = new Usuario();
    $usuario->insert_usuario($request["usu_nom"], $request["usu_ape"], $request["usu_correo"]);
    return array(
        "Resultado" => true
    );
}

/**
 * Registers the GetAllUsuariosService as a new service on the SOAP server.
 * This service takes no input parameters and returns a string type as output.
 */
$server->register(
    "GetAllUsuariosService",
    array(), // Sin parámetros de entrada
    array('return' => 'xsd:string'), // Tipo de retorno como cadena (string)
    $namespace
);

/**
 * Handles the GetAllUsuariosService SOAP operation.
 * Retrieves all users from the database and returns them as a JSON string.
 *
 * @return string A JSON-encoded string representing all users.
 */
function GetAllUsuariosService()
{
    require_once 'config/conexion.php';
    require_once 'models/Usuario.php';

    $usuario = new Usuario();
    $resultados = $usuario->get_usuarios();
    return json_encode($resultados); // Convierte el resultado en JSON
}

/**
 * Handles incoming RAW data (sent to the server) and passes it to the SOAP server's
 * service function for processing the request.
 */
$POST_DATA = file_get_contents("php://input");
$server->service($POST_DATA);

exit();