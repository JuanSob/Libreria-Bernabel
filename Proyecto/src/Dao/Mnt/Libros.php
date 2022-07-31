<?php

namespace Dao\Mnt;

class Libros extends \Dao\Table
{
    public static function getAll()
    {
        return self::obtenerRegistros("SELECT * FROM proyectolibreria.libros", array());
    }

    public static function getOne($LibrodId)
    {
        $sqlstr = "SELECT a.LibrodId, a.LibroNombre, a.LibroDescripcion, a.LibroPrecioVenta, a.LibroPrecioCompra, a.LibroEst, a.LibroStock, b.MediaId, b.MediaDoc, b.MediaPath
        FROM proyectolibreria.libros a LEFT JOIN media b ON a.LibrodId = b.LibrodId
        WHERE a.LibrodId=:LibrodId;";
        return self::obtenerUnRegistro($sqlstr, array("LibrodId"=>$LibrodId));
    }

    public static function insert($LibroNombre, $LibroDescripcion, $LibroPrecioVenta, $LibroPrecioCompra, $LibroEst, $LibroStock)
    {
        $insstr = "INSERT INTO proyectolibreria.libros (LibroNombre, LibroDescripcion, LibroPrecioVenta, LibroPrecioCompra, LibroEst, LibroStock) values (:LibroNombre, :LibroDescripcion, :LibroPrecioVenta, :LibroPrecioCompra, :LibroEst, :LibroStock);";
        return self::executeNonQuery(
            $insstr,
            array(
                "LibroNombre"=>$LibroNombre, 
                "LibroDescripcion"=>$LibroDescripcion, 
                "LibroPrecioVenta"=>$LibroPrecioVenta,
                "LibroPrecioCompra"=>$LibroPrecioCompra,
                "LibroEst"=>$LibroEst,
                "LibroStock"=>$LibroStock
            )
        );
    }

    public static function update($LibroNombre, $LibroDescripcion, $LibroPrecioVenta, $LibroPrecioCompra, $LibroEst, $LibroStock, $LibrodId)
    {
        $updsql = "UPDATE libros SET LibroNombre=:LibroNombre, LibroDescripcion=:LibroDescripcion, LibroPrecioVenta=:LibroPrecioVenta, LibroPrecioCompra=:LibroPrecioCompra, LibroEst=:LibroEst, LibroStock=:LibroStock where LibrodId=:LibrodId;";
        return self::executeNonQuery(
            $updsql,
            array(
                "LibroNombre"=>$LibroNombre, 
                "LibroDescripcion"=>$LibroDescripcion,
                "LibroPrecioVenta"=>$LibroPrecioVenta,
                "LibroPrecioCompra"=>$LibroPrecioCompra,
                "LibroEst"=>$LibroEst,
                "LibroStock"=>$LibroStock,
                "LibrodId"=>$LibrodId
            )
        );
    }

    public static function delete( $LibrodId)
    {
        $delsql = "delete from libros where LibrodId=:LibrodId;";
        return self::executeNonQuery(
            $delsql,
            array( "LibrodId" => $LibrodId)
        );
    }

    static public function searchlibros($ProductoBusqueda)
    {
        $sqlstr = "SELECT * FROM libros WHERE LibroNombre LIKE :ProductoBusqueda
        OR LibroPrecioVenta LIKE :ProductoBusqueda OR LibroEst LIKE :ProductoBusqueda;";
        
        return self::obtenerRegistros($sqlstr, array("ProductoBusqueda"=>"%".$ProductoBusqueda."%"));
    }

}
?>