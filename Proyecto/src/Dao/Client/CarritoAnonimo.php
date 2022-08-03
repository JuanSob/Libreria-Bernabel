<?php

namespace Dao\Client;

class CarritoAnonimo extends \Dao\Table
{
    public static function comprobarProductoEnCarritoAnonimo($ClienteAnonimoId, $LibrodId)
    {
        $sqlstr = "SELECT * FROM carritocompraclienteanonimo WHERE ClienteAnonimoId = :ClienteAnonimoId AND LibrodId = :LibrodId;";
        return self::obtenerUnRegistro($sqlstr, array("ClienteAnonimoId"=>$ClienteAnonimoId, "LibrodId"=>$LibrodId));
    }

    public static function insertarProductoCarritoAnonimo($ClienteAnonimoId, $LibrodId, $ProdCantidad, $ProdPrecioVenta)
    {
        $insstr = "INSERT INTO carritocompraclienteanonimo VALUES (:ClienteAnonimoId, :LibrodId, :ProdCantidad, :ProdPrecioVenta, NOW())";
        return self::executeNonQuery($insstr, array("ClienteAnonimoId"=>$ClienteAnonimoId, "LibrodId"=>$LibrodId, "ProdCantidad"=>$ProdCantidad, "ProdPrecioVenta"=>$ProdPrecioVenta));
    }

    public static function sumarProductoInventarioAnonimo($LibrodId, $ProdCantidad)
    {
        $updstr = "UPDATE libros SET LibroStock = LibroStock + :ProdCantidad WHERE LibrodId = :LibrodId";
        return self::executeNonQuery($updstr, array("LibrodId"=>intval($LibrodId), "ProdCantidad"=>$ProdCantidad));
    }

    public static function restarProductoInventarioAnonimo($LibrodId, $ProdCantidad)
    {
        $updstr = "UPDATE libros SET LibroStock = LibroStock - :ProdCantidad WHERE LibrodId = :LibrodId";
        return self::executeNonQuery($updstr, array("LibrodId"=>intval($LibrodId), "ProdCantidad"=>$ProdCantidad));
    }

    public static function deleteProductoCarritoAnonimo($ClienteAnonimoId, $LibrodId)
    {
        $delsql = "DELETE FROM carritocompraclienteanonimo WHERE ClienteAnonimoId = :ClienteAnonimoId AND LibrodId = :LibrodId;";
        return self::executeNonQuery(
            $delsql,
            array("ClienteAnonimoId" => $ClienteAnonimoId, "LibrodId"=>$LibrodId)
        );
    }

    public static function deleteAllCarritoAnonimo($ClienteAnonimoId)
    {
        $delsql = "DELETE FROM carritocompraclienteanonimo WHERE ClienteAnonimoId = :ClienteAnonimoId;";
        return self::executeNonQuery($delsql, array("ClienteAnonimoId" => $ClienteAnonimoId));
    }

    public static function getProductosCarritoAnonimo($ClienteAnonimoId)
    {
        $sqlstr = "SELECT ca.*, p.LibroNombre, (ca.ProdCantidad * ca.LibroPrecioVenta) as 'TotalProducto', m.MediaDoc, m.MediaPath FROM carritocompraclienteanonimo ca INNER JOIN libros p on ca.LibrodId = p.LibrodId INNER JOIN media m on m.LibrodId = p.LibrodId WHERE ClienteAnonimoId = :ClienteAnonimoId GROUP BY ca.LibrodId;"; 
        return self::obtenerRegistros($sqlstr, array("ClienteAnonimoId"=>strval($ClienteAnonimoId)));
    }

    public static function getTotalCarrito($ClienteAnonimoId)
    {
        $sqlstr = "SELECT SUM(ca.ProdCantidad * ca.LibroPrecioVenta) as 'Total' FROM carritocompraclienteanonimo ca INNER JOIN libros p on ca.LibrodId = p.LibrodId WHERE ClienteAnonimoId = :ClienteAnonimoId"; 
        return self::obtenerUnRegistro($sqlstr, array("ClienteAnonimoId"=>$ClienteAnonimoId));
    }
}
?>