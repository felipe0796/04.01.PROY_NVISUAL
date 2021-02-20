<h5 class="text-center py-2 mx-5 mb-4 bg-primary rounded">LISTADO DE PRODUCTOS</h5>

<?php

$productos = ControladorFormularios::ctrSelecionarRegistros(null,null,null,null);

$eliminar = new ControladorFormularios();
$eliminar ->ctrEliminarRegistro();

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
                            <div class="px-1">
                                <a href="index.php?pagina=actualizar_producto&id=<?php echo $value["id"];?>" 
                                class="btn btn-warning"><i class="fas fa-edit"></i></a>
                            </div>

                            <form method="post">
                                <!-- BOTON PARA INGRESAR LOGUEARSE (abre un modal) -->
                                <input type="hidden" value="<?php echo $value["id"];?>" name="eliminarRegistro">
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

