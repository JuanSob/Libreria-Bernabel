<?php

namespace Dao\Client;

class Checkout extends \Dao\Table
{

    public static function insertarVenta($VentaLinkDevolucion, $VentaLinkOrden, $VentaCantidadTotal, $VentaComisionPaypal, $VentaCantidadNeta, $ClienteDireccion, $ClienteTelefono, $UsuarioId)
    {
        $insstr = "INSERT INTO ventas VALUES 
        (
            0, 
            NOW(), 
            0.15, 
            'PND', 
            :VentaLinkDevolucion, 
            :VentaLinkOrden, 
            :VentaCantidadTotal, 
            :VentaComisionPaypal, 
            :VentaCantidadNeta, 
            :ClienteDireccion, 
            :ClienteTelefono, 
            :UsuarioId
        );";

        return self::executeNonQuery
        (
            $insstr, 
            array(
                "VentaLinkDevolucion"=>$VentaLinkDevolucion, 
                "VentaLinkOrden"=>$VentaLinkOrden, 
                "VentaCantidadTotal"=>$VentaCantidadTotal, 
                "VentaComisionPaypal"=>$VentaComisionPaypal,
                "VentaCantidadNeta"=>$VentaCantidadNeta,
                "ClienteDireccion"=>$ClienteDireccion,
                "ClienteTelefono"=>$ClienteTelefono,
                "UsuarioId"=>intval($UsuarioId)
            )
        );
    }

    public static function insertarDetalleVenta($LibrodId, $VentasProdCantidad, $VentasProdPrecioVenta)
    {
        $VentaId = self::obtenerUnRegistro("Select max(VentaId) as VentaId from ventas;", array());
        $VentaId = $VentaId["VentaId"];
        $insstr = "INSERT INTO ventaslibros VALUES (:LibrodId, :VentaId, :VentasProdCantidad, :VentasProdPrecioVenta);";
        return self::executeNonQuery($insstr, array("LibrodId"=>intval($LibrodId), "VentaId"=>intval($VentaId), "VentasProdCantidad"=>intval($VentasProdCantidad), "VentasProdPrecioVenta"=>floatval($VentasProdPrecioVenta)));
    }

    public static function deleteAllCarritoUsuario($UsuarioId)
    {
        $delsql = "DELETE FROM carritocompraclienteregistrado WHERE UsuarioId = :UsuarioId;";
        return self::executeNonQuery($delsql, array("UsuarioId" => $UsuarioId));
    }

    public static function getProductosCarritoUsuario($UsuarioId)
    {
        $sqlstr = "SELECT cr.*, p.LibroNombre, (cr.ProdCantidad * cr.LibroPrecioVenta) as 'TotalProducto', m.MediaDoc, m.MediaPath FROM carritocompraclienteregistrado cr INNER JOIN libros p on cr.LibrodId = p.LibrodId INNER JOIN media m on m.LibrodId = p.LibrodId WHERE UsuarioId = :UsuarioId GROUP BY cr.LibrodId;"; 
        return self::obtenerRegistros($sqlstr, array("UsuarioId"=>intval($UsuarioId)));
    }
}
?>