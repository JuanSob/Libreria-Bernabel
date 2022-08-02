<?php
/**
 * PHP Version 7.2
 *
 * @category Public
 * @package  Controllers
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  MIT http://
 * @version  CVS:1.0.0
 * @link     http://
 */
namespace Controllers;

/**
 * Index Controller
 *
 * @category Public
 * @package  Controllers
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  MIT http://
 * @link     http://
 */
class Index extends PublicController
{
    /**
     * Index run method
     *
     * @return void
     */

    public function run() :void
    {
        $dataview["items"] = \Dao\Client\Libros::getProductosRecientes();

        $max_description_length = 50;
        
        foreach($dataview["items"] as $key => $value)
        {
            if(strlen($dataview["items"][$key]["LibroNombre"]) > $max_description_length)
            {
                $string = $value["LibroNombre"];
                $offset = ($max_description_length - 3) - strlen($string);
                $dataview["items"][$key]["LibroNombre"] = substr($string, 0, strrpos($string, ' ', $offset)) . '...';
            }

            $precioFinal = ($value["LibroPrecioVenta"]) + ($value["LibroPrecioVenta"] * 0.15); 
            $dataview["items"][$key]["LibroPrecioVenta"] = number_format($precioFinal, 2);
        }

        $layout = "layout.view.tpl";

        if(\Utilities\Security::isLogged())
        {
            $layout = "privatelayout.view.tpl";
            \Utilities\Nav::setNavContext();
        }

        \Views\Renderer::render("index", $dataview, $layout);
    }
}
?>
