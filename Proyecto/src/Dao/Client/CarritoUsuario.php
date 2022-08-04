<?php

namespace Dao\Client;

class CarritoUsuario extends \Dao\Table
{
    public static function comprobarProductoEnCarritoUsuario($UsuarioId, $LibrodId)
    {
        $sqlstr = "SELECT * FROM carritocompraclienteregistrado WHERE UsuarioId = :UsuarioId AND LibrodId = :LibrodId;";
        return self::obtenerUnRegistro($sqlstr, array("UsuarioId"=>intval($UsuarioId), "LibrodId"=>$LibrodId));
    }

    public static function insertarProductoCarritoUsuario($UsuarioId, $LibrodId, $ProdCantidad, $ProdPrecioVenta)
    {
        $insstr = "INSERT INTO carritocompraclienteregistrado VALUES (:UsuarioId, :LibrodId, :ProdCantidad, :ProdPrecioVenta, NOW())";
        return self::executeNonQuery($insstr, array("UsuarioId"=>intval($UsuarioId), "LibrodId"=>$LibrodId, "ProdCantidad"=>$ProdCantidad, "ProdPrecioVenta"=>$ProdPrecioVenta));
    }

    public static function sumarProductoInventarioAnonimo($LibrodId, $ProdCantidad)
    {
        $updstr = "UPDATE Libros SET LibroStock = LibroStock + :ProdCantidad WHERE LibrodId = :LibrodId";
        return self::executeNonQuery($updstr, array("LibrodId"=>intval($LibrodId), "ProdCantidad"=>$ProdCantidad));
    }

    public static function restarProductoInventarioUsuario($LibrodId, $ProdCantidad)
    {
        $updstr = "UPDATE Libros SET LibroStock = LibroStock - :ProdCantidad WHERE LibrodId = :LibrodId";
        return self::executeNonQuery($updstr, array("LibrodId"=>intval($LibrodId), "ProdCantidad"=>$ProdCantidad));
    }

    public static function deleteProductoCarritoUsuario($UsuarioId, $LibrodId)
    {
        $delsql = "DELETE FROM carritocompraclienteregistrado WHERE UsuarioId = :UsuarioId AND LibrodId = :LibrodId;";
        return self::executeNonQuery(
            $delsql,
            array("UsuarioId" => intval($UsuarioId), "LibrodId"=>intval($LibrodId))
        );
    }

    public static function getProductosCarritoUsuario($UsuarioId)
    {
        $sqlstr = "SELECT cr.*, p.LibroNombre, (cr.ProdCantidad * cr.LibroPrecioVenta) as 'TotalLibro',
            m.MediaDoc, m.MediaPath 
            FROM proyectolibreria.carritocompraclienteregistrado cr 
            INNER JOIN proyectolibreria.libros p on cr.LibrodId = p.LibrodId 
            INNER JOIN proyectolibreria.media m on m.LibrodId = p.LibrodId 
            WHERE UsuarioId = :UsuarioId
            GROUP BY cr.LibrodId;";
        $sqlParams=[
            "UsuarioId" => $UsuarioId
        ];
        return self::obtenerRegistros($sqlstr, $sqlParams);
    }

    public static function getTotalCarrito($UsuarioId)
    {
        $sqlstr = "SELECT SUM(cr.ProdCantidad * cr.LibroPrecioVenta) as 'Total' FROM carritocompraclienteregistrado cr INNER JOIN libros p on cr.LibrodId = p.LibrodId WHERE UsuarioId = :UsuarioId"; 
        return self::obtenerUnRegistro($sqlstr, array("UsuarioId"=>intval($UsuarioId)));
    }
}
?>