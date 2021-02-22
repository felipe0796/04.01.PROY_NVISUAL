<h5 class="text-center py-2 mx-5 mb-4 bg-danger rounded">LISTADO DE PRODUCTOS ELIMINADOS</h5>

<?php

if (!isset($_SESSION["validarIngreso"])) {

    echo '<script>
    window.location = "index.php?pagina=inicio";
    </script>';
    return;
    
}else {

    if ($_SESSION["validarIngreso"] != "ok") {
        echo '<script>
        window.location = "index.php?pagina=inicio";
        </script>';
        return;
    }
    
}

$productos = ControladorFormularios::ctrSelecionarRegistros(null,null,null,null,1);

$eliminar = new ControladorFormularios();
$eliminar ->ctrEliminarRegistro(0);

?>

<div class="container">
    <table class="table">
        <thead class="thead-light bg-dark rounded">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($productos as $key => $value) : ?>
              <tr>
                  <th><?php echo ($key+1);?></th>
                  <td id="nombre"><?php echo $value["nombre"];?></td>
                  <td id="desc"><?php echo $value["descripcion"];?></td>
                  <td id="precio"><?php echo $value["precio"];?></td>
                  <td id="stock"><?php echo $value["stock"];?></td>
                  <td>
                      <div class="btn-group">

                          <form method="post">
                              <!-- BOTON PARA INGRESAR LOGUEARSE (abre un modal) -->
                              <input type="hidden" value="<?php echo $value["id"];?>" name="restaurarRegistro">
                              <button type="submit" class="btn btn-success"><i class="fas fa-trash-restore"></i></button>
                          </form>
                          
                      </div>
                  </td>
              </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

