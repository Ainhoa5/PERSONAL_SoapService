# SOAP Web Service

## Description

This document outlines the setup and consumption of a SOAP web service designed for inserting categories into a database. The service is built using PHP and the NuSOAP library, facilitating the creation of SOAP servers and clients. The service provides functionality to add new user categories and retrieve all existing users in the system.

# Table of Contents

- [Overview](#overview)
- [Server Configuration](#server-configuration)
  - [Files and Dependencies](#files-and-dependencies)
  - [CORS Configuration](#cors-configuration)
  - [SOAP Server Setup](#soap-server-setup)
- [Services](#services)
  - [InsertCategoriaService](#insertcategoriaservice)
  - [GetAllUsuariosService](#getallusuariosservice)
- [Client Consumption](#client-consumption)
  - [Consuming via GET](#consuming-via-get)
  - [Consuming via POST](#consuming-via-post)
- [Usage](#usage)
  - [Server](#server)
  - [Client](#client)
    - [GET Method](#get-method)
    - [POST Method](#post-method)
- [Debugging](#debugging)
- [Security Notes](#security-notes)
- [Conclusion](#conclusion)


## Server Configuration
### Files and Dependencies
- InsertCategoria.php: The main script that configures and handles the SOAP server operations, including setting up the server, defining available services, and processing SOAP requests.
- NuSOAP library: Ensure the NuSOAP library is included in your project. It can be installed via Composer using econea/nusoap.
- User model (Usuario.php): Represents the user entity and includes methods for interacting with the database.
- 
### CORS Configuration
Cross-Origin Resource Sharing (CORS) headers are set to allow requests from any origin, accommodating various clients that might consume the SOAP service.

### SOAP Server Setup
The server is configured with a target namespace and a WSDL file is generated for the InsertCategoria service. The service defines complex types for input (InsertCategoria) and output (response) to structure the data sent and received.

## Services

Two main operations are registered with the SOAP server:

    InsertCategoriaService: 
Inserts a new category into the database. It requires parameters such as user name (usu_nom), last name (usu_ape), and email (usu_correo).

    GetAllUsuariosService: 
Retrieves all users from the database, returning a JSON-encoded string of user data.

### Client Consumption
## Consuming via GET
    ConsumirGET.php: 
Demonstrates consuming the GetAllUsuariosService using a GET request with cURL. The URL includes the query string parameters necessary for the SOAP request.

## Consuming via POST
    ConsumirPOST.php: 
Shows how to consume the InsertCategoriaService using a POST request. The request is formatted as an XML SOAP message, specifying the necessary headers and action for the service.

### Usage
## Server
Deploy the PHP scripts on your server, ensuring the NuSOAP library is included via Composer.

Configure your web server to serve InsertCategoria.php as needed.
## Client
### GET Method
Execute ConsumirGET.php to perform a GET request to the SOAP service. This will retrieve all users.

### POST Method
Run ConsumirPOST.php to send a POST request. This script sends a SOAP message to insert a new category with specified user details.

## Debugging
Both consumption scripts print the request and response for debugging purposes, allowing you to inspect the XML sent and received.
Security Notes

Ensure your web server and PHP environment are securely configured.
    
Validate and sanitize all inputs to the SOAP services to prevent SQL injection and other security vulnerabilities.

Consider implementing authentication and authorization mechanisms to protect the SOAP service.

## Conclusion
This SOAP web service provides a simple yet powerful interface for managing user categories within a database. By following the configurations and examples provided, developers can integrate and extend the service according to their application's needs.
