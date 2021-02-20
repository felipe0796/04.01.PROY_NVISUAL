<h5 class="text-center py-2 mx-5 mb-4 bg-warning rounded">ACTUALIZAR REGISTROS</h5>
<?php
    if (isset($_GET["id"])) {
        $id = "id";
        $valorGetId = $_GET["id"];
        $productoId = ControladorFormularios::ctrSelecionarRegistros(null, null, $id, $valorGetId);
        $tipo = ControladorFormularios::ctrSelecionarTipo();

        echo "<pre>";print_r($productoId);echo"</pre>";
    }
    $actuizar =new ControladorFormularios();
    $actuizar -> ctrActualizarRegistro();
   
?>


<!-- BLOQUE PARA ACTUALIZAR EL PRODUCTO -->
<div class="mx-5">
    <form class="p-5 bg-light rounded" method="post">

        <!-- form con íconos NOMBRE-->
        <div class="form-group">
            <label for="email">Nombre:</label>
            <!-- bloque del ícono -->
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-ad"></i></span>
                </div>
                <input type="text" value="<?php echo $productoId["nombre"];?>" class="form-control" placeholder="Ingrese un nombre" id="nombre" name="actualizaNombre">
            </div>
        </div>

        <!-- form con íconos TIPO-->
        <div class="form-group">
            <label for="email">Tipo:</label>
            <!-- bloque del ícono -->
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-ad"></i></span>
                </div>
                <select class="custom-select"  id="id_tipo_producto" name="actualizaIdTipo">
             
                    <?php foreach ($tipo as $value) : ?>
                        
                        <?php if ($productoId["id_tipo_producto"] == $value["id"]) : ?>
                        
                            <option selected value="<?php echo $value["id"]; ?>"><?php echo $value["descripcion"]; ?></option>
                        
                        <?php else : ?>

                            <option value="<?php echo $value["id"]; ?>"><?php echo $value["descripcion"]; ?></option>
                        
                        <?php endif ?>
                        
                    <?php endforeach ?>
                    
                </select>
            </div>
        </div>

        <!-- form con íconos PRECIO-->
        <div class="form-group">
            <label for="email">Precio:</label>
            <!-- bloque del ícono -->
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                </div>
                <input type="text" value="<?php echo $productoId["precio"];?>" class="form-control" placeholder="Ingresa el precio" id="precio" name="actualizaPrecio">
            </div>
        </div>

        <!-- form con íconos STOCK-->
        <div class="form-group">
            <label for="email">Stock:</label>
            <!-- bloque del ícono -->
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                </div>
                <input type="text" value="<?php echo $productoId["stock"];?>" class="form-control" placeholder="Ingresa el stock" id="stock" name="actualizaStock">
                <input type="hidden" name="idProducto" value="<?php echo $productoId["id"];?>">
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-dark py-1 px-5"><i class="far fa-edit"></i></button>
        </div>
    </form>
</div>

