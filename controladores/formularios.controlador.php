<?php

class ControladorFormularios{

    /**
     * REGISTRO (METODO ESTATICO)
     */
    static public function ctrRegistro(){

        if(isset($_POST["registroNombre"])){

            $tabla = "tb_productos";

            $datos = array( "nombre" => $_POST["registroNombre"],
                            "id_tipo_producto" => $_POST["registroIdTipo"],
                            "precio" => $_POST["registroPrecio"],
                            "stock" => $_POST["registroStock"]);
           

            /** PRUEBA (funciona)*/
            $controlAlerta = ControladorFormularios::ctrControlAlerta();
            echo $controlAlerta;
        
            $campos = array();

            if ($_POST["registroNombre"] == ""){
                array_push($campos, "El campo Nombre no debe estar vacío.");
            }if ($_POST["registroPrecio"] == "" || !preg_match("/^[0-9]{0,10}.[0-9]{0,5}+$/",$_POST["registroPrecio"]) || $_POST["registroPrecio"] <= 0) {
                array_push($campos, "El campo Precio no debe estar vacío y solo debe contener numeros en formato moneda ##.##.");
            }if ($_POST["registroStock"] == "" || !preg_match("/^[0-9]{0,3}+$/",$_POST["registroStock"]) || $_POST["registroStock"] <= 1) {
                array_push($campos, "El campo stock no debe estar vacío, solo se permiten números enteros.");
            }if (count($campos) > 0) {
                echo '<div class="alert-danger" id="alerta">';
                    for ($i=0; $i < count($campos); $i++) { 
                        echo "<li>".$campos[$i]."</li>";
                    }echo '</div>';
            }else{
                       
                $respuesta = ModeloFormularios::mdlRegistro($tabla, $datos);
                            
                echo '<div class="alert alert-success" id="alerta">'; echo "El producto N°: ".$respuesta["id"]." ha sido registrado</div>";
                ;   
                        
            } 
            
        }
    }

    /**
     * FUNCIONES DE MENSAJE ALERTA
     */
    static public function ctrControlAlerta(){
        /**Si el navegador tiene informacion en su historial se limpia */    
        echo '<script>
        if (window.history.replaceState){
            window.history.replaceState (null, null, window.location.href);
        }
        </script>';

        /**Desaparece el mensaje de alerta */    
        echo "<script type='text/javascript'>
        $(document).ready(function() {
            $('#alerta').delay(2000).slideUp(200, function() {
                $(this).alert('close');
            });
        });
        </script>";
    }

    /**
     * SELECCIONAR REGISTROS (listado)
     */
    static public function ctrSelecionarRegistros($email, $valorPostEmail, $id, $valorGetId, $valorEstado){

        $respuesta = ModeloFormularios::mdlSelecionarRegistros($email, $valorPostEmail, $id, $valorGetId, $valorEstado);

        return $respuesta;
    }

    /**
     * INGRESO-----(FALTA COMPLETAR PARA MI PROY)
     */
    public function ctrIngreso(){

        if (isset($_POST["ingresoEmail"])) {

            $email = "email";
            $id = "id";
            $valorPostEmail = $_POST["ingresoEmail"];

            $respuesta = ModeloFormularios::mdlSelecionarRegistros($email, $valorPostEmail, null, null);

            /**limpia los archivos que se guardan en memoria y desaparece el mensaje de alerta */
            $alerta = ControladorFormularios::ctrControlAlerta();
            echo $alerta;

            $campos = array();
        
            if ($_POST["ingresoEmail"] == "") {
                array_push($campos, "El campo Email no debe estar vacío.");
            }if ($_POST["ingresoPassword"] == "" || strlen($_POST["ingresoPassword"])>10) {
                array_push($campos, "El campo contraseña no debe estar vacío, ni debe tener más de 10 caracteres");
            }if (count($campos) > 0) {
            echo '<div class="alert-danger" id="alerta">';
                for ($i=0; $i < count($campos); $i++) { 
                    echo "<li>".$campos[$i]."</li>";
                }echo '</div>';
            }else{
                if ($respuesta["email"] == $_POST["ingresoEmail"] && $respuesta["pwd"] == $_POST["ingresoPassword"]) {
                    
                    /**variables de session */

                    $_SESSION ["validarIngreso"] = "ok";

                    /************************/
                    echo '<script>
                        window.location = "index.php?pagina=inicio";
                    </script>';
    
                }else {
                    
                    echo '<div class="alert alert-danger" id="alerta">Error al ingresar al sistema, el email o la contraseña no coinciden</div>';
                    
                }
            
            }
  
        }

    }

    /**
     * ACTUALIZAR REGISTRO
     */
    public function ctrActualizarRegistro(){

        if(isset($_POST["actualizaNombre"])){

            $tabla = "tb_producto";

            $datos = array("id" => $_POST["idProducto"],
                           "nombre" => $_POST["actualizaNombre"],
                           "id_tipo_producto" => $_POST["actualizaIdTipo"],
                           "precio" => $_POST["actualizaPrecio"],
                           "stock" => $_POST["actualizaStock"]);
           

            /** PRUEBA (funciona)*/
            $controlAlerta = ControladorFormularios::ctrControlAlerta();
            echo $controlAlerta;
        
            $campos = array();
        
            if ($_POST["actualizaNombre"] == ""){
                array_push($campos, "El campo Nombre no debe estar vacío.");
            }if ($_POST["actualizaPrecio"] == "" || preg_match("/^[0-9]{0,10}.[0-9]{0,5}+$/",$_POST["actualizaPrecio"])==false || $_POST["actualizaPrecio"] <= 0) {
                array_push($campos, "El campo Precio no debe estar vacío y solo debe contener numeros en formato moneda ##.##.");
            }if ($_POST["actualizaStock"] == "" || !preg_match("/^[0-9]{0,3}+$/",$_POST["actualizaStock"]) || $_POST["actualizaStock"] <= 0) {
                array_push($campos, "El campo stock no debe estar vacío, solo se permiten números enteros.");
            }if (count($campos) > 0) {
                echo '<div class="alert-danger" id="alerta">';
                    for ($i=0; $i < count($campos); $i++) { 
                        echo "<li>".$campos[$i]."</li>";
                    }echo '</div>';
            }else{
                       
                $respuesta = ModeloFormularios::mdlActualizarRegistro($tabla, $datos);
                            
                echo '<div class="alert alert-success" id="alerta">El Producto N° : '.$datos["id"].' ha sido actualizado</div>
                <script>
                    setTimeout(function(){
                        window.location = "index.php?pagina=listado_producto";
                    },3600);
                </script>'
                ;   
                        
            } 
            
        }


    }

    /**
     * ELIMINAR REGISTROS
     */

    public function ctrEliminarRegistro($valorEstado){


        if(isset($_POST["eliminarRegistro"]) ||  isset($_POST["restaurarRegistro"])){

            /** VALOR DE ESTADO PARA "ELIMINAR" - /listado_producto */
            if ($valorEstado == 1) {

                $valor = $_POST["eliminarRegistro"];

                $controlAlerta = ControladorFormularios::ctrControlAlerta();
                echo $controlAlerta;

                $respuesta = ModeloFormularios::mdlActualziarEstadoProducto($valor, $valorEstado);

                if ($respuesta == "ok") {
                    echo '<div class="alert alert-success mx-5 mb-3 p-2" id="alerta">El producto fue eliminado satisfactoriamente.</div>
                    <script>
                        setTimeout(function(){
                            window.location = "index.php?pagina=listado_producto";
                        },2800);
                    </script>';
                }
            /** VALOR DE ESTADO PARA RESTAURAR -/listado_producto_eliminado*/    
            }elseif ($valorEstado == 0) {

                $valor = $_POST["restaurarRegistro"];

                $controlAlerta = ControladorFormularios::ctrControlAlerta();
                echo $controlAlerta;

                $respuesta = ModeloFormularios::mdlActualziarEstadoProducto($valor, $valorEstado);

                if ($respuesta == "ok") {
                    echo '<div class="alert alert-success mx-5 mb-4 p-2" id="alerta">El producto fue restaurado satisfactoriamente.</div>
                    <script>
                        setTimeout(function(){
                            window.location = "index.php?pagina=listado_producto_eliminado";
                        },2700);
                    </script>';
                }
            }

            

        }


    }

    /**
     * SELECCIONAR TIPO (listado)
     */
    static public function ctrSelecionarTipo(){

        $respuesta = ModeloFormularios::mdlSelecionartipo();

        return $respuesta;
    }
    


    
}




