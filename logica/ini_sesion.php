<?PHP
session_start();
require('../datos/parse_str.php');
require('../datos/conex.php');
$conex = mysqli_connect($servidor, $usuario, $password) or die("No se Puede conectar al Servidor");
mysqli_select_db($conex, $basepaciente) or die("No se Puede conectar a la base de Datos");
$_SESSION['NAME'] = '';
$USER = addslashes($_POST['email']);
$CONTRASENA = addslashes($_POST['Contrasena']);

$sql = mysqli_query($conex, "SELECT `ID`,`NOMBRES`, `APELLIDOS`,`EMAIL`, `CONTRASENA`, `PROVEEDOR_ID` ,`ROL_ID`,`ESTADO_ID`,`ESTADO_APP` FROM `usuarios` WHERE `EMAIL` = '" . $USER . "' and `CONTRASENA` = MD5('" . $CONTRASENA . "') and `ESTADO_ID` != '0' ") or die("No se Puede hacer la cosulta 1");
$conusuario = mysqli_query($conex, "SELECT `EMAIL`,`ROL_ID`, `ESTADO_ID`,`ESTADO_APP` FROM `usuarios` WHERE `EMAIL` = '" . $USER . "' and `ESTADO_ID` != '0' ") or die("No se Puede hacer la cosulta 2");
echo mysqli_error($conex);
mysqli_num_rows($sql);
if (mysqli_num_rows($sql) > 0) {
	$linea = mysqli_fetch_array($sql);
	$id_usuario = $linea[0];
	$nombre = $linea[1];
	$apellido = $linea[2];
	$usua = $linea[3];
	$proveedor = $linea[5];
	$privilegios = $linea[6];
	$estado = $linea[7];
	$estado_app = $linea[8];
	$hoy = date("Y-m-d H:i:s");
	$_SESSION["usuarios"] = $usua;
	$_SESSION["nombre"] = $nombre;
	$_SESSION["apellido"] = $apellido;
	$_SESSION["proveedor"] = $proveedor;
	$_SESSION["privilegios"] = $privilegios;
	$_SESSION["id"] = $id_usuario;
	if ($estado != 1) {
?>
		<script>
			if (confirm('El usuario no esta activo, por favor comunicate con el administrador')) {
				window.onload = window.top.location.href = "../index.php";
			} else {
				window.onload = window.top.location.href = "../index.php";
			}
		</script>
	<?php
	} else {
		if ($estado_app == '1') {
			require("../presentacion/form_restablecer_clave.php");
		} elseif ($estado_app == '2') {
			require("../presentacion/form_politica.php");
		} else {
			require("../presentacion/inicio1.php");
		}
	}
} else {
	?>
	<script>
		if (confirm('Usuario o contraseña incorrectos, por favor vuelva a intentar')) {
			window.onload = window.top.location.href = "../index.php";
		} else {
			window.onload = window.top.location.href = "../index.php";
		}
	</script>
<?php
}
mysqli_close($conex);
?>