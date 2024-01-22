<?php

/* 
    In /InsertCategoria.php
    Configurar un servicio web usando SOAP para insertar categorias en una base de datos
*/

// Permitir solicitudes de cualquier origen
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');


// Ruta de la clase econea/nusoap
require_once 'vendor/econea/nusoap/src/nusoap.php';
require_once 'models/Usuario.php';

class MySoapServer extends soap_server
{
    public $schemaTargetNameSpace;

    public function __construct()
    {
        parent::__construct();
    }
}

// Configuración inicial del servidor SOAP
/* 
    Se crea un nuevo servidor SOAP y se configura con WSDL (Web Services Description Language), 
    que es un lenguaje basado en XML para describir servicios web. 
    InsertCategoria es el nombre del servicio, 
    y namespace proporciona un espacio de nombres único para identificar los elementos WSDL.
*/
// Nombre del servicio
$namespace = "InsertCategoriaSOAP";
$server = new MySoapServer();
$server->configureWSDL("InsertCategoria", $namespace);
$server->schemaTargetNameSpace = $namespace;


/* 
    Aquí se define la estructura de los datos que el servicio va a recibir 
    (usu_nom, usu_ape, usu_correo) 
    y la estructura de la respuesta (Resultado). 
    Estos tipos complejos son estructuras personalizadas para enviar y recibir datos.
*/
// Estructura del servicio
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


/* 
    Esta parte registra el método InsertCategoriaService como un servicio disponible en el servidor SOAP. 
    Define la entrada y salida del servicio, 
    usando los tipos complejos definidos anteriormente.
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

/* Aquí se crearia el insert a la database */
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

// Registra el nuevo servicio en el servidor SOAP
$server->register(
    "GetAllUsuariosService",
    array(), // Sin parámetros de entrada
    array('return' => 'xsd:string'), // Tipo de retorno como cadena (string)
    $namespace
);
function GetAllUsuariosService() {
    require_once 'config/conexion.php';
    require_once 'models/Usuario.php';

    $usuario = new Usuario();
    $resultados = $usuario->get_usuarios();
    return json_encode($resultados); // Convierte el resultado en JSON
}

// Manejo de Solicitudes
/* 
    Aquí se lee la entrada de datos RAW (datos enviados al servidor) 
    y se pasa a la función service del servidor SOAP para procesar la solicitud.
 */
$POST_DATA = file_get_contents("php://input");
$server->service($POST_DATA);

exit();