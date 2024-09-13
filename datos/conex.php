 <?php
  // $servidor = "host.docker.internal";
  // $usuario = "root";
  // $password = "root";
  // $basepaciente = "crm_encuestas";

  $servidor = "app-peoplemarketing.ckkjycussdkq.us-east-1.rds.amazonaws.com";
  $usuario = "apppeopl_bjimenez";
  $password = "90#2B@j*g7r9";
  $basepaciente = "crm_encuestas";

  $conex = mysqli_connect($servidor, $usuario, $password) or die("No se Puede conectar al Servidor");
  mysqli_select_db($conex, $basepaciente) or die("No se Puede conectar a la base de Datos");
  ?>