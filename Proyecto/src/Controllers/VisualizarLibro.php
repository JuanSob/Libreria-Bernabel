<?php
namespace Controllers;

use Dao\Dao;

class VisualizarLibro extends \Controllers\PublicController
{
    private $LibrodId = 0;
    private $LibroNombre = "";
    private $LibroDescripcion = "";
    private $LibroPrecioVenta = "";
    private $ProdCantidad = 1;
    private $LibroStock = "";
    private $PrimaryMediaDoc = "";
    private $PrimaryMediaPath = "";
    private $AllProductMedia = array(); 
    private $Error = "";

    private $mode_dsc = "";

    public function run() :void
    {
        $this->LibrodId = isset($_GET["LibrodId"])?$_GET["LibrodId"]:0;
        
        if($this->isPostBack()) 
        {
            $this->_loadPostData();
        }

        $layout = "layout.view.tpl";

        if(\Utilities\Security::isLogged())
        {
            $layout = "privatelayout.view.tpl";
            \Utilities\Nav::setNavContext();
        }

        $this->_load();
        $dataview = get_object_vars($this);

        \Views\Renderer::render("VisualizarLibro", $dataview, $layout);
    }

    private function _load()
    {
        $_data = \Dao\Client\Libros::getOne($this->LibrodId);
        $_productMedia = \Dao\Client\Libros::getAllProductMedia($this->LibrodId);

        if ($_data) 
        {
            $this->LibrodId = $_data["LibrodId"];
            $this->LibroNombre = $_data["LibroNombre"];
            $this->LibroDescripcion = $_data["LibroDescripcion"];
            $precioFinal = ($_data["LibroPrecioVenta"]) + ($_data["LibroPrecioVenta"] * 0.15); 
            $this->LibroPrecioVenta = number_format($precioFinal, 2);
            $this->LibroStock = $_data["LibroStock"];
            $this->PrimaryMediaDoc = $_data["MediaDoc"];
            $this->PrimaryMediaPath = $_data["MediaPath"];
        }

        if($_productMedia)
        {
            $this->AllProductMedia = $_productMedia;
        }
    }

    private function _loadPostData()
    {
        $this->LibroPrecioVenta = isset($_POST["LibroPrecioVenta"])?$_POST["LibroPrecioVenta"]:""; 
        $this->ProdCantidad = isset($_POST["ProdCantidad"])?$_POST["ProdCantidad"]:""; 
        $this->LibroPrecioVenta = floatval(str_replace(",","",$this->LibroPrecioVenta));
        $this->LibroStock = isset($_POST["LibroStock"]) ? $_POST["LibroStock"] : "";

        if(!\Utilities\Security::isLogged())
        {
            $this->addProductCarritoAnonimo();
        }
        else
        {
            $this->addProductCarritoUsuario();
        }
    }

    private function addProductCarritoAnonimo()
    {
        $_comprobar = \Dao\Client\CarritoAnonimo::comprobarProductoEnCarritoAnonimo(session_id(), $this->LibrodId);

        if(empty($_comprobar))
        {   
            if(!$this->validarCantidadDisponibleProducto())
            {
                $this->ingresarProductoCarritoAnonimo();
            }
        }
        else
        {
            if(!$this->validarCantidadDisponibleProducto())
            {
                $resultUpdate = \Dao\Client\CarritoAnonimo::sumarProductoInventarioAnonimo($this->LibrodId, $_comprobar["ProdCantidad"]);
                $resultDelete = \Dao\Client\CarritoAnonimo::deleteProductoCarritoAnonimo(session_id(), $this->LibrodId);

                if($resultDelete && $resultUpdate)
                {
                    $this->ingresarProductoCarritoAnonimo();
                }
            }
        }
    }

    private function addProductCarritoUsuario()
    {
        $UsuarioId = \Utilities\Security::getUserId();
        $_comprobar = \Dao\Client\CarritoUsuario::comprobarProductoEnCarritoUsuario($UsuarioId, $this->LibrodId);

        if(empty($_comprobar))
        {
            if(!$this->validarCantidadDisponibleProducto())
            {   
                $this->ingresarProductoCarritoUsuario($UsuarioId);
            }
        }
        else
        {
            if(!$this->validarCantidadDisponibleProducto())
            {
                $resultUpdate = \Dao\Client\CarritoUsuario::sumarProductoInventarioAnonimo($this->LibrodId, $_comprobar["ProdCantidad"]);
                $resultDelete = \Dao\Client\CarritoUsuario::deleteProductoCarritoUsuario($UsuarioId, $this->LibrodId);
                if($resultDelete && $resultUpdate)
                {
                    $this->ingresarProductoCarritoUsuario($UsuarioId);
                }
            }
        }
    }

    private function validarCantidadDisponibleProducto()
    {
        $error = false;
        if($this->ProdCantidad > $this->LibroStock)
        {
            $this->Error = "No se cuenta con las suficientes unidades en existencia, unidades actuales: ".$this->LibroStock;
            $error = true;
        }

        return $error;
    }

    private function ingresarProductoCarritoAnonimo()
    {
        $resultInsert = \Dao\Client\CarritoAnonimo::insertarProductoCarritoAnonimo(session_id(), $this->LibrodId, $this->ProdCantidad, $this->LibroPrecioVenta);
        $resultUpdate =  \Dao\Client\CarritoAnonimo::restarProductoInventarioAnonimo($this->LibrodId, $this->ProdCantidad);

        if($resultInsert && $resultUpdate)
        {
            \Utilities\Site::redirectToWithMsg("index.php?page=VisualizarLibro&LibrodId=".$this->LibrodId, "Producto Agregado al Carrito con Éxito");
        }
    }

    private function ingresarProductoCarritoUsuario($UsuarioId)
    {
        $resultInsert = \Dao\Client\CarritoUsuario::insertarProductoCarritoUsuario($UsuarioId, $this->LibrodId, $this->ProdCantidad, $this->LibroPrecioVenta);
        $resultUpdate = \Dao\Client\CarritoUsuario::restarProductoInventarioUsuario($this->LibrodId, $this->ProdCantidad);

        if($resultInsert && $resultUpdate)
        {
            \Utilities\Site::redirectToWithMsg("index.php?page=VisualizarLibro&LibrodId=".$this->LibrodId, "Producto Agregado al Carrito con Éxito");
        }
    }
}