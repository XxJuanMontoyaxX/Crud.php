<?php
include("conexion.php");//Incluimos el archivo conexion y asi podemos usarlas variables creadas en ese documento
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        $nitocc="";
        $nombre="";
        $direccion="";
        $telefono="";
        $fechaingreso="";
        $cupocredito="";
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
                $fechaingreso=$resultadoconsulta[4];
                $cupocredito=$resultadoconsulta[5];
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
            <hr>
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
            <input type="date" name="fechaIngreso" id="" value="<?php echo $fechaingreso ?>">
            <br><br>
            <label for="">Grupo del credito:</label>
            <input type="number" name="cupoCredito" id="" placeholder="$ Valor en pesos" value="<?php echo $cupocredito ?>">
            <br><br>
            <label for="">Subir foto:</label>
            <input type="file" name="foto" id="">
            <br><br>
            <label for="">Foto:</label>
            <img src="<?php $foto ?>" alt="" width="80" height="80">
            <br><br>
            <input type="submit" value="Nuevo Cliente" name="guardar">
            <input type="submit" value="Listar todos los Cliente" name="listar">
            <input type="submit" value="Actualizar Cliente" name="actualizar">
            <input type="submit" value="Eliminar Cliente" name="eliminar">
        </form>
    </center>
        <?php
            if(isset($_POST['guardar']))
            {
                //Los datos de entrada almacenados en variables
                $nitocc=$_POST['nitocc'];
                $nombre=$_POST['nombre'];
                $direccion=$_POST['direccion'];
                $telefono=$_POST['telefono'];
                $fechaingreso=$_POST['fechaIngreso'];
                $cupocredito=$_POST['cupoCredito'];
                //Manejo de archivos:
                $nombre_foto=$_FILES['foto']['name'];//nombre de la foto
                $ruta=$_FILES['foto']['tmp_name'];//Ruta o path del archivo
                $foto='fotos/'.$nombre_foto;//Ruta y nombre del archivo
                copy($ruta,$foto);//Guarda el archivo en una ruta especifica

                //Verificar que no existan valores duplicados para el campo de nit o Cédula
                $sqlbuscar="SELECT nitocc FROM tblcliente WHERE nitocc='$nitocc' ORDER BY nitocc";
                if($resultado=mysqli_query($conexion,$sqlbuscar))
                {
                    $nroregistros=mysqli_num_rows($resultado);
                    if($nroregistros>0)
                    {
                        echo "<script>alert('Ese NIT o Cc ya existe !!');</script>";
                    }else
                    {
                        mysqli_query($conexion,"INSERT INTO tblcliente (nitocc,nombre,direccion,telefono,fechaIngreso,cupoCredito,foto)
                         VALUES ('$nitocc','$nombre','$direccion','$telefono','$fechaingreso','$cupocredito','$foto')");
                         echo "Datos Guardados Correctamente";
                    }
                }
            }
        ?>
</body>
</html>