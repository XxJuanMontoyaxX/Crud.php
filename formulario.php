<?php
include("conexion.php");//Incluimos el archivo conexion y asi podemos usarlas variables creadas en ese documento
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Crud PHP</title>
    <?php
        $nitocc="";
        $nombre="";
        $direccion="";
        $telefono="";
        $fechaIngreso="";
        $cupoCredito="";
        $foto="";
        if(isset($_POST['buscar']))
        {
            $nitoccbuscar=$_POST['buscarnit'];//Valor que nos escriben en el input de buscar, que corresponde al nit o cc que se desea buscar
            $consulta=$conexion->query("select * from tblcliente where nitocc='$nitoccbuscar'");
            while($resultadoconsulta=$consulta->fetch_array())
            {
                $nitocc=$resultadoconsulta[0];
                $nombre=$resultadoconsulta[1];
                $direccion=$resultadoconsulta[2];
                $telefono=$resultadoconsulta[3];
                $fechaIngreso=$resultadoconsulta[4];
                $cupoCredito=$resultadoconsulta[5];
                $foto=$resultadoconsulta[6];
            }
        }
    ?>
</head>
<body>
    <center>
        <h2>Manipulacion de datos con PHP</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="">Buscar:</label>
            <input type="text" name="buscarnit" id="" placeholder="Buscar cliente">
            <input type="submit" value="buscar" name="buscar">
            <input type="submit" value="Listar todos los Cliente" name="listar">
        </form>
            <hr>
            <form action="consultas.php" method="post" enctype="multipart/form-data">
            <label for="">Nit o CC:</label>
            <input type="text" name="nitocc" id="" placeholder="Ingresa el nit o Cc del nuevo cliente" value="<?php echo $nitocc ?>">
            <br><br>
            <label for="">Nombres:</label>
            <input type="text" name="nombre" id="" placeholder="Ingresa el nombre completo" value="<?php echo $nombre ?>">
            <br><br>
            <label for="">Direccion:</label>
            <input type="text" name="direccion" id="" placeholder="ej: Cll 34 #12-20" value="<?php echo $direccion ?>">
            <br><br>
            <label for="">Telefono:</label>
            <input type="number" name="telefono" id="" placeholder="ej: 300-2345-6789" value="<?php echo $telefono ?>">
            <br><br>
            <label for="">Fecha de Ingreso:</label>
            <input type="date" name="fechaIngreso" id="" value="<?php echo $fechaIngreso ?>">
            <br><br>
            <label for="">Grupo del credito:</label>
            <input type="number" name="cupoCredito" id="" placeholder="$ Valor en pesos" value="<?php echo $cupoCredito ?>">
            <br><br>
            <label for="">Subir foto:</label>
            <input type="file" name="foto" id="">
            <br><br>
            <label for="">Foto:</label>
            <img src="<?php echo $foto ?>" alt="" width="80" height="80">
            <br><br>
            <input type="submit" value="Nuevo Cliente" name="guardar">
          
            <input type="submit" value="Actualizar Cliente" name="actualizar">
            <input type="submit" value="Eliminar Cliente" name="eliminar">
        </form>
    </center>
    <?php
if(isset($_POST['listar'])){
    echo "<center>
    <table border=3>
        <tr>  
         <th>Nit o Cc</th>  
         <th>Direccion</th>  
         <th>Telefono</th>  
         <th>fechaIngreso</th>  
         <th>cupoCredito</th>  
         <th>foto del cliente</th>  
      </tr>";
    $buscar=$conexion->query("select * from tblcliente");
    while($resultado=$buscar->fetch_array())
    {
        $nitocc=$resultado[0];
        $nombre=$resultado[1];
        $direccion=$resultado[2];
        $telefono=$resultado[3];
       date_default_timezone_set('America/Bogota');
       $fechaIngreso=date("d-m-Y",strtotime($resultado[4]));
       $cupoCredito=number_format($resultado[5]);
       $foto=$resultado[6];
   echo "<tr>
   <td>$nitocc</td> 
   <td>$nombre</td> 
   <td>$direccion</td> 
   <td>$telefono</td> 
   <td>$fechaIngreso</td> 
   <td>$cupoCredito</td> 
   <td>
        <img src='$foto' width='30%' height='30%'>
   </td> 
        </tr>";
} echo "</table> </center>";
}
    ?>
</body>
</html>