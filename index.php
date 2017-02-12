<html>
<head>

    <meta charset="utf-8">
    <title>Leer XLS</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style type="text/css"></style>

</head>

    <body>

        <div class="table-responsive">
        <table class="table table-bordered">
<?php      

    # Conexión base de datos MySql
	$link = mysqli_connect("localhost","","","");
    if (mysqli_connect_errno()) {
                die("Error al conectar: ".mysqli_connect_error());
        }
        $tildes = $link->query("SET NAMES 'utf8'");

		if (($fichero = fopen("ClientesUT8.csv", "r")) !== FALSE) {
		    // Lee los nombres de los campos de la cabecera si nos hubiera en la primera fila
		    // $nombres_campos_cabecera = fgetcsv($fichero, 0, ",", "\"", "\"");

		    // Lee los registros
		    while (($datos = fgetcsv($fichero, 0, ",", "\"", "\"")) !== FALSE) {

			    $vcodcliente 	= $datos[0];
			    $vrazon 		= $datos[1];
			    $vdireccion 	= $datos[2];
				$vcodigopostal 	= $datos[3];		    
				$vpoblacion 	= $datos[4];  
				$vprovincia 	= $datos[5];
				$vtelefono 		= $datos[6];
				$vrotulo 		= $datos[7];
				$vnif 			= $datos[8];

				printf("<tr>
	            <td>%s</td>
	            <td>%s</td>
	            <td>%s</td>
	            <td>%s</td>
	            <td>%s</td>
	            <td>%s</td>
	            <td>%s</td>
	            <td>%s</td>
	            <td>%s</td>
	            <td>%s</td>
	            <td></td>
	           </tr>",
	            $fila, 
	            $vcodcliente, 
	            $vrazon,
	            $vdireccion,
	            $vcodigopostal, 
	            $vpoblacion, 
	            $vprovincia, 
	            $vtelefono,
	            $vrotulo,
	            $vnif);

		        # Enviamos toda la infomación a la base de datos
		        $sql="INSERT INTO Clientes (codcli, razon, direccion, codigopostal, poblacion, provincia, telefono, rotulo, nif, DtoFamilia01, DtoFamilia02, DtoFamilia03, DtoFamilia04, DtoFamilia05, DtoFamilia06, DtoFamilia07, DtoFamilia08, DtoFamilia09, DtoFamilia10)
		        VALUES ('$vcodcliente', '$vrazon', '$vdireccion', '$vcodigopostal', '$vpoblacion', '$vprovincia', '$vtelefono', '$vrotulo', '$vnif','0','0','0','0','0','0','0','0','0','0')";

		        # Escribimos el registro correspondiente al índice de $fila en la base de datos
		        $result = mysqli_query($link, $sql);

			}

		    fclose($fichero);
		 
}


    # Desconectamos Base de datos       
  	$close = mysqli_close($link) 
     or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
	
?>
        </table>
        </div>
    </body>
</html>