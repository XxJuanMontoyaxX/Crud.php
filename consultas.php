<?php
include("conexion.php");//Incluimos el archivo conexion y asi podemos usarlas variables creadas en ese documento
                     //Los datos de entrada almacenados en variables
                     $nitocc=$_POST['nitocc'];
                     $nombre=$_POST['nombre'];
                     $direccion=$_POST['direccion'];
                     $telefono=$_POST['telefono'];
                     $fechaIngreso=$_POST['fechaIngreso'];
                     $cupoCredito=$_POST['cupoCredito'];
                     //Manejo de archivos:
                     $nombre_foto=$_FILES['foto']['name'];//nombre de la foto
                     $ruta=$_FILES['foto']['tmp_name'];//Ruta o path del archivo
                     $foto='fotos/'.$nombre_foto;//Ruta y nombre del archivo

                     if(isset($_POST['guardar']))
                     {
                         //Verificar que no existan valores duplicados para el campo de nit o Cédula
                         $sqlbuscar="SELECT nitocc FROM tblcliente WHERE nitocc='$nitocc' ORDER BY nitocc";
                         if($resultado=mysqli_query($conexion,$sqlbuscar))
                         {
                             $nroregistros=mysqli_num_rows($resultado);
                             if($nroregistros>0)
                             {
                                 echo "<script>alert('Ese NIT o Cc ya existe !!');</script>";
                             }else
                             copy($ruta,$foto);//Guarda el archivo en una ruta especifica
                             {
                                 mysqli_query($conexion,"INSERT INTO tblcliente (nitocc,nombre,direccion,telefono,fechaIngreso,cupoCredito,foto)
                                  VALUES ('$nitocc','$nombre','$direccion','$telefono','$fechaIngreso','$cupoCredito','$foto')");
                                  echo "<script>alert('Datos guardados correctamente'); window.location.href='formulario.php'</script>";
                             }
                         }
                     }

                     if(isset($_POST['actualizar']))
                     {
                        mysqli_query($conexion,"UPDATE tblcliente SET nombre='$nombre',direccion='$direccion',telefono='$telefono',fechaIngreso='$fechaIngreso',cupoCredito='$cupoCredito',foto='$foto' WHERE nitocc='$nitocc'");
         
                        echo "<script>alert('Datos actualizados correctamente'); window.location.href='formulario.php'</script>";
                     }  
                     
                     if(isset($_POST['eliminar']))
                     {
                        mysqli_query($conexion,"DELETE FROM tblcliente WHERE nitocc='$nitocc'");
         
                        echo "<script>alert('Datos eliminados correctamente'); window.location.href='formulario.php'</script>";
                     }                     


?>