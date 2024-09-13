<?php
session_start();
$usua = $_SESSION["usuarios"];
$nombre = $_SESSION["nombre"];
$apellido = $_SESSION["apellido"];
$privilegios = $_SESSION["privilegios"];
$proveedor = $_SESSION['proveedor'];
$id_usu = $_SESSION["id"];