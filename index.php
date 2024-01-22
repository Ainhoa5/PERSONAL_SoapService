<?php
$client = new SoapClient("http://localhost/projects/PERSONAL_SoapService/InsertCategoria.php?wsdl");
$result = $client->GetAllUsuariosService();
$usuarios = json_decode($result, true); // Decoding JSON to PHP array
?> 
<!-- In /index.php -->
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>

<h2>Usuarios List</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Email</th>
        <!-- Add more headers if there are more fields -->
    </tr>
    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?php echo htmlspecialchars($usuario['usu_id']); ?></td>
            <td><?php echo htmlspecialchars($usuario['usu_nom']); ?></td>
            <td><?php echo htmlspecialchars($usuario['usu_ape']); ?></td>
            <td><?php echo htmlspecialchars($usuario['usu_correo']); ?></td>
            <!-- Add more data cells if there are more fields -->
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
