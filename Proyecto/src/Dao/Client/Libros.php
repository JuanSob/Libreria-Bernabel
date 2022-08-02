<?php

namespace Dao\Client;

class Libros extends \Dao\Table
{
    public static function getProductosRecientes()
    {
        return self::obtenerRegistros("SELECT * FROM proyectolibreria.libros p INNER JOIN media m on p.LibrodId = m.LibrodId WHERE LibroStock > 0 AND LibroEst = 'ACT' GROUP BY p.LibrodId ORDER BY p.LibrodId DESC LIMIT 8;", array());
    }

    public static function getProductCount()
    {
        $sqlstr = "SELECT COUNT(LibrodId) as 'Total' FROM proyectolibreria.libros WHERE LibroStock > 0 AND LibroEst = 'ACT' ;";
        return self::obtenerUnRegistro($sqlstr, array());
    }

    public static function getProductosforPage($Inicio, $Limite)
    {
        $sqlstr = "SELECT * FROM proyectolibreria.libros p INNER JOIN media m on p.LibrodId = m.LibrodId WHERE LibroStock > 0 AND LibroEst = 'ACT' GROUP BY p.LibrodId LIMIT :Inicio, :Limite;"; 
        return self::obtenerRegistrosIntParams($sqlstr, array("Inicio"=>$Inicio, "Limite"=>$Limite));
    }

    public static function getOne($LibrodId)
    {
        $sqlstr = "SELECT * FROM proyectolibreria.libros p INNER JOIN media m on p.LibrodId = m.LibrodId WHERE p.LibrodId = :LibrodId AND LibroEst = 'ACT' GROUP BY p.LibrodId;";
        return self::obtenerUnRegistro($sqlstr, array("LibrodId"=>$LibrodId));
    }

    public static function getAllProductMedia($LibrodId)
    {
        $sqlstr = "SELECT * FROM media WHERE LibrodId=:LibrodId";
        return self::obtenerRegistros($sqlstr, array("LibrodId"=>$LibrodId));
    }

    static public function searchProductosCliente($UsuarioBusqueda, $Inicio, $Limite)
    {
        $sqlstr = "SELECT * FROM proyectolibreria.libros p INNER JOIN media m on p.LibrodId = m.LibrodId WHERE LibroEst = 'ACT' AND LibroStock > 0 AND (p.LibroNombre LIKE :UsuarioBusqueda) GROUP BY p.LibrodId LIMIT :Inicio, :Limite;";
        return self::obtenerRegistros($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%", "Inicio"=>intval($Inicio), "Limite"=>intval($Limite)));
    }

    static public function searchProductosClienteCount($UsuarioBusqueda)
    {
        $sqlstr = "SELECT COUNT(LibrodId) as 'Total' FROM proyectolibreria.libros WHERE LibroStock > 0 AND LibroEst = 'ACT' AND (LibroNombre LIKE :UsuarioBusqueda);";
        
        return self::obtenerUnRegistro($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%"));
    }
}
?>