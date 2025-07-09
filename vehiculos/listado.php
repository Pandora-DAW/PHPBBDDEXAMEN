<?php   require_once('../plantillas/cabecera.php'); ?>

<article>
    <h2>Listado de vehiculos </h2>

    <table class="table table-striped table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Matrícula</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Tipo</th>
                <th>Color</th>
                <th>Fecha matriculación</th>
                <th>Cilindrada</th>
                <th>ITV pasada</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
       
       <?php
            if (isset($_POST['filtrar'])) {
                $matricula = $_POST['matricula'];
                $consulta="SELECT * FROM vehiculos WHERE matricula like '%".$matricula."%'";
            } else {
                $consulta ="SELECT * FROM vehiculos";
            }


            // Ejecuta la consulta y devuelve un array con todas las 
            // filas resultantes
            $filas = mysqli_query($conexion, $consulta);

            // iterar las filas de la tabla
            while(($fila = mysqli_fetch_array($filas))==true){
                echo "<tr>\n";
                echo "<td> ".$fila['matricula']." </td>\n";
                echo "<td> ".$fila['marca']." </td>\n";
                echo "<td> ".$fila['modelo']." </td>\n";
                echo "<td> ".$fila['tipo']." </td>\n";
                echo "<td> ".$fila['color']." </td>\n";
                echo "<td> ".$fila['fecha_matriculacion']. " </td>\n";
                echo "<td> ".$fila['cilindrada']. " </td>\n";
                echo "<td> ".$fila['itv_pasada']. "</td>\n";
                echo "<td><a href='editar.php?matricula=".$fila['matricula']."' class='btn btn-primary'>Editar</a></td>\n";
                echo "<td><a href='borrado.php?matricula=".$fila['matricula']."' class='btn btn-primary'>Eliminar</a></td>\n";
                echo "</tr>\n";
                
            }

        ?>     
        </tbody>
    </table>
    <div class="mensaje">
        <?php 
            if (isset($_SESSION['mensaje'])) {
                echo $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }
            ?>
    </div>

        <!-- Formulario para filtrar la informacion de la tabla
         Este foormulario enlaza con la propia página, de tal manera que si se llega desde el formulario -> queremos filtrar información, pero si no se llega por POST queremos mostrar todos los datos. -->
    <h2>Buscar:</h2>
    <form action="listado.php" method="post">
        <label for="fecha_matriculacion">Filtrar por fecha de matriculación </label>
        <input type="date" name="fecha_matriculacion" id="fecha_matriculacion">

        <input type="submit" name='filtrar' value="Filtrar">
        <a href="listado.php">Limpiar filtro</a>
    </form>
    


</article>

<?php   require_once('../plantillas/pie.php'); ?>