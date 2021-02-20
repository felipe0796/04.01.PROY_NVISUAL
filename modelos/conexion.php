<?php

class Conexion{

    static public function conectar(){
    
        $link = new PDO("mysql:host=localhost;dbname=bd_tienda","root","mysql");

        $link->exec("set names utf8");

        return $link;
    }
}

