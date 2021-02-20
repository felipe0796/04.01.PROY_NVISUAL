<?php

require_once "conexion.php";

class ModeloFormularios{

    /**
     * REGISTRO-----------------------------------------------------------------------------
     */ 
    static public function mdlRegistro($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("CALL sp_registra_producto (:nombre, :id_tipo_producto, :precio, :stock)");

        $stmt -> bindParam(":nombre", $datos["nombre"],PDO::PARAM_STR);/**param_str(para string)*/
        $stmt -> bindParam(":id_tipo_producto", $datos["id_tipo_producto"], PDO::PARAM_INT);
        $stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt -> bindParam(":stock", $datos["stock"], PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt -> fetch();

        $stmt -> close();

        $stmt = null;


    }

    /**
     * SELECCIONAR REGISTRO, INGRESO LOGIN Y MOSTRAR DATOS SEGUN EL ID ----------------------------
     */
    static public function mdlSelecionarRegistros($email, $valorPostEmail, $id, $valorGetId){

        if ($email == null && $valorPostEmail == null && $id == null && $valorGetId == null) {
            
            $stmt = Conexion::conectar()->prepare("call sp_listar_producto()");

            $stmt -> execute();

            return $stmt -> fetchAll();




        }elseif ($id == null && $valorGetId == null) {

            /** Ingreso mediante el email*/
            $stmt = conexion::conectar()->prepare("call sp_loginUsuario(:$email,null)");

            $stmt -> bindParam(":".$email, $valorPostEmail, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }elseif ($email == null && $valorPostEmail == null){

            /** Mostrará datos deacuerdo al id */
            $stmt = conexion::conectar()->prepare("call sp_listar_producto_id(:$id)");

            $stmt -> bindParam(":".$id, $valorGetId, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }

        $stmt -> close();

        $stmt = null;

    }

    /**
     * ACTUALIZAR REGISTRO-----------------------------------------------------------------------------
     */ 
    static public function mdlActualizarRegistro($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("CALL sp_actualiza_producto (:id, :nombre, :id_tipo_producto, :precio, :stock)");

        $stmt -> bindParam(":nombre", $datos["nombre"],PDO::PARAM_STR);/**param_str(para string)*/
        $stmt -> bindParam(":id_tipo_producto", $datos["id_tipo_producto"], PDO::PARAM_INT);
        $stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt -> bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt -> fetch();

        $stmt -> close();

        $stmt = null;


    }

    /**
     * ELIMINAR REGISTRO-----------------------------------------------------------------------------
     */ 
    static public function mdlEliminarRegistro($valor){

        $stmt = Conexion::conectar()->prepare("CALL sp_elimina_producto (:id)");

        $stmt -> bindParam(":id", $valor, PDO::PARAM_INT);

        if ($stmt ->execute()) {
            return "ok";
        }else{
            print_r (Conexion::conectar()->errorInfo());
        }
        $stmt -> close();

        $stmt = null;


    }

    /**
     * LISTA LOS TIPOS DE PRODUCTO (COMBOBOX) ----------------------------
     */
    static public function mdlSelecionartipo(){

        $stmt = Conexion::conectar()->prepare("call sp_lista_tipo_producto()");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt = null;

    }


}