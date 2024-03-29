<?php

namespace Controllers;

class Carrito extends \Controllers\PublicController
{
    private $Items = array();
    private $Total = 0.00;
    private $Subtotal = 0.00;

    public function run() :void
    {
        if(!$this->isPostBack()) 
        {
            if(!\Utilities\Security::isLogged())
            {
                $this->mostarProductosCarritoAnonimo();
            }
            else
            {
                $this->mostarProductosCarritoUsuario();
            }
        }
        else
        {   
            if(!\Utilities\Security::isLogged())
            {
                $this->eliminarProductoCarritoAnonimo();
            }
            else
            {
                $this->eliminarProductoCarritoUsuario();
            }
        }

        if(isset($_POST['btnEliminar']))
        {
            if(!\Utilities\Security::isLogged())
            {
                $this->eliminarProductoCarritoAnonimo();
            }
            else
            {
                $this->eliminarProductoCarritoUsuario();
            }
        }

        $layout = "layout.view.tpl";

        if(\Utilities\Security::isLogged())
        {
            $layout = "privatelayout.view.tpl";
            \Utilities\Nav::setNavContext();
        }

        $allViewData= get_object_vars($this);
        \Views\Renderer::render("carrito", $allViewData, $layout);
    }

    private function mostarProductosCarritoAnonimo()
    {
        $this->Items = \Dao\Client\CarritoAnonimo::getProductosCarritoAnonimo(session_id());

        //Reformatear valor desde la base con decimales
        foreach($this->Items as $key => $value)
        {
            $this->Items[$key]["LibroPrecioVenta"] = number_format($value["LibroPrecioVenta"], 2);
            $this->Items[$key]["TotalProducto"] = number_format($value["TotalProducto"], 2);

            $precioSinImpuesto = \Utilities\CalculoPrecios::CalcularPrecioSinImpuesto($value["LibroPrecioVenta"]);

            $this->Items[$key]["ProdPrecioSinImpuesto"] = number_format($precioSinImpuesto, 2);
            $this->Items[$key]["ProdImpuesto"] = number_format(($value["LibroPrecioVenta"] - $precioSinImpuesto), 2);
            $this->Subtotal += $precioSinImpuesto;
            $this->Total += $value["LibroPrecioVenta"];
        }

        $this->Subtotal = number_format($this->Subtotal, 2);
        $this->Total = number_format($this->Total, 2);
    }

    private function eliminarProductoCarritoAnonimo()
    {
        $LibrodId = isset($_POST["LibrodId"])?$_POST["LibrodId"]:"";
        $ProdCantidad = isset($_POST["ProdCantidad"])?$_POST["ProdCantidad"]:"";

        if(!empty($LibrodId) && !empty($ProdCantidad))
        {
            $resultDelete = \Dao\Client\CarritoAnonimo::deleteProductoCarritoAnonimo(session_id(), $LibrodId);
            $resultUpdate = \Dao\Client\CarritoAnonimo::sumarProductoInventarioAnonimo($LibrodId, $ProdCantidad);

            if($resultDelete && $resultUpdate)
            {
                \Utilities\Site::redirectToWithMsg("index.php?page=carrito", "Producto Eliminado con Éxito");
            }
        }
    }

    private function mostarProductosCarritoUsuario()
    {
        $UsuarioId = \Utilities\Security::getUserId();

        $this->Items = \Dao\Client\CarritoUsuario::getProductosCarritoUsuario($UsuarioId);

        foreach($this->Items as $key => $value)
        {
            $this->Items[$key]["LibroPrecioVenta"] = number_format($value["LibroPrecioVenta"], 2);
            $this->Items[$key]["TotalLibro"] = number_format($value["TotalLibro"], 2);

            $precioSinImpuesto = \Utilities\CalculoPrecios::CalcularPrecioSinImpuesto($value["LibroPrecioVenta"]);

            $this->Items[$key]["ProdPrecioSinImpuesto"] = number_format($precioSinImpuesto, 2);
            $this->Items[$key]["ProdImpuesto"] = number_format(($value["LibroPrecioVenta"] - $precioSinImpuesto), 2);
            $this->Subtotal += $precioSinImpuesto;
            $this->Total += $value["TotalLibro"];
        }

        $this->Subtotal = number_format($this->Subtotal, 2);
        $this->Total = number_format($this->Total, 2);
    }

    private function eliminarProductoCarritoUsuario()
    {
        $UsuarioId = \Utilities\Security::getUserId();
        $LibrodId = isset($_POST["LibrodId"])?$_POST["LibrodId"]:"";
        $ProdCantidad = isset($_POST["ProdCantidad"])?$_POST["ProdCantidad"]:"";

        if(!empty($LibrodId) && !empty($ProdCantidad))
        {   
            $resultDelete = \Dao\Client\CarritoUsuario::deleteProductoCarritoUsuario($UsuarioId, $LibrodId);
            $resultUpdate = \Dao\Client\CarritoUsuario::sumarProductoInventarioAnonimo($LibrodId, $ProdCantidad);

            if($resultDelete && $resultUpdate)
            {
                \Utilities\Site::redirectToWithMsg("index.php?page=carrito", "Producto Eliminado con Éxito");
            }
        }
    }
}