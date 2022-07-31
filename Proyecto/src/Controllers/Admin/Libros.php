<?php

    namespace Controllers\Admin;

    class Libros extends \Controllers\PrivateController
    {
        public function __construct()
        {
            
            $userInRole = \Utilities\Security::isInRol(
                \Utilities\Security::getUserId(),
                "ADMINISTRADOR"
            );
            
            parent::__construct();
        }
    
        private $ProductoBusqueda = "";
        
        public function run() :void
        {
            $dataview = array();

            if ($this->isPostBack()) 
            {   
                $this->ProductoBusqueda = isset($_POST["ProductoBusqueda"]) ? $_POST["ProductoBusqueda"] : "";

                if(!empty($this->ProductoBusqueda))
                {
                    $dataview["items"] = \Dao\Mnt\Libros::searchLibros($this->ProductoBusqueda);
                    \Utilities\Context::setContext("ProductoBusqueda", $this->ProductoBusqueda);
                }
                else
                {
                    $dataview["items"] = \Dao\Mnt\Libros::getAll();
                }
            } 
            else
            {   
                $dataview["items"] = \Dao\Mnt\Libros::getAll();
            }
            
            \Views\Renderer::render("admin/libros", $dataview);
        } 
    }
?>