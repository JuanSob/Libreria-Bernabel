<?php 

namespace Controllers\Admin;

class Libro extends \Controllers\PrivateController
{
    public function __construct()
    {
        
        $userInRole = \Utilities\Security::isInRol(
            \Utilities\Security::getUserId(),
            "ADMINISTRADOR"
        );
        
        parent::__construct();
    }

    private $LibrodId = 0;
    private $LibroNombre = "";
    private $LibroDescripcion = "";
    private $LibroPrecioVenta = 0;
    private $LibroPrecioCompra = 0;
    private $LibroEst = "";
    private $LibroStock = 0;
    private $LibroStock_ACT = "";
    private $LibroStock_INA = "";
    private $MediaId = 0;
    private $MediaPath = "public/imgs/libros/";
    private $Media = array();

    private $mode = "";
    private $mode_dsc = "";
    private $mode_adsc = array(
        "INS" => "Nuevo Libro",
        "UPD" => "<b>Editar</b> <br> Código: %s <br> Nombre: %s",
        "DEL" => "<b>Eliminar</b> <br> Código: %s <br> Nombre: %s",
        "DSP" => "<b>Visualizar</b> <br> Código: %s <br> Nombre: %s"
    );

    private $readonly = "";
    private $showaction= true;
    private $notDisplayIns= false;
    private $notDisplayDel= true;

    private $hasErrors = false;
    private $aErrors = array();

    public function run() :void
    {
        $this->mode = isset($_GET["mode"])?$_GET["mode"]:"";
        $this->LibrodId = isset($_GET["LibrodId"])?$_GET["LibrodId"]:"";

        if (!$this->isPostBack()) 
        {
            if ($this->mode !== "INS") 
            {
                $this->_load();
            } 
            else 
            {
                $this->mode_dsc = $this->mode_adsc[$this->mode];
            }
        } 
        else 
        {
            $this->_loadPostData();
            if (!$this->hasErrors) 
            {
                switch ($this->mode)
                {
                    case "INS":

                        $inserto = false;

                        if (\Dao\Mnt\Libros::insert($this->LibroNombre, $this->LibroDescripcion, $this->LibroPrecioVenta, $this->LibroPrecioCompra, $this->LibroEst, $this->LibroStock)) 
                        {
    
                            foreach ($this->Media['name'] as $item => $name)
                            {
                                
                                if ( !empty($this->Media['name'][$item]) )
                                {
                                    if (\Dao\Mnt\Media::insert($this->Media['name'][$item], $this->MediaPath.$this->Media['name'][$item]))
                                    {
                                        move_uploaded_file($this->Media['tmp_name'][$item],$this->MediaPath.$this->Media['name'][$item]);
                                        $inserto = true;
                                    }
                                }
                                else
                                {
                                    if (\Dao\Mnt\Media::insert("libro_default.jpg", "public/img/libro_default.jpg"))
                                    {
                                        
                                        \Utilities\Site::redirectToWithMsg(
                                            "index.php?page=admin_libros",
                                            "¡Libro Agregado Satisfactoriamente!"
                                        );
                                    }
                                }
                            }

                            if ($inserto)
                            {
                                \Utilities\Site::redirectToWithMsg(
                                    "index.php?page=admin_libros",
                                    "¡Libro Agregado Satisfactoriamente!"
                                );
                            }
                            
                        }
                    break;

                    case "UPD":

                        $actualizo = false;

                        if (\Dao\Mnt\Libros::update($this->LibroNombre, $this->LibroDescripcion, $this->LibroPrecioVenta, $this->LibroPrecioCompra, $this->LibroEst, $this->LibroStock, $this->LibrodId)) 
                        {

                            $_datosMedia = \Dao\Mnt\Media::getAll($this->LibrodId);

                            foreach ($this->Media['name'] as $item => $name)
                            {
                                
                                if (!empty($_FILES['imagenes']['name'][$item]))
                                {
                                    foreach ($_datosMedia as $_mediaDB)
                                    {   
                                        if ($_mediaDB['MediaPath'] == "public/img/libro_default.jpg")
                                        {
                                            \Dao\Mnt\Media::delete($this->LibrodId, $_mediaDB['MediaId']);
                                        }
                                        else
                                        {
                                            \Dao\Mnt\Media::delete($this->LibrodId, $_mediaDB['MediaId']);
                                            @unlink("public/imgs/libros/".$_mediaDB['MediaDoc']);
                                        }
                                    }

                                    if ( !empty($this->Media['name'][$item]) )
                                    {
                                        if (\Dao\Mnt\Media::update($this->Media['name'][$item], $this->MediaPath.$this->Media['name'][$item], $this->LibrodId))
                                        {  
                                            move_uploaded_file($this->Media['tmp_name'][$item],$this->MediaPath.$this->Media['name'][$item]);
                                            $actualizo = true;
                                        }

                                    }

                                }
                                else
                                {
                                    foreach ($_datosMedia as $_mediaDB)
                                    {   
                                        if (!empty($_mediaDB['MediaDoc']))
                                        {
                                            \Utilities\Site::redirectToWithMsg(
                                                "index.php?page=admin_libros",
                                                "¡Libro Actualizado Satisfactoriamente!"
                                            );
                                        }
                                        else
                                        {
                                            if (\Dao\Mnt\Media::update("libro_default.jpg", "public/img/libro_default.jpg", $this->LibrodId))
                                            {

                                                \Utilities\Site::redirectToWithMsg(
                                                    "index.php?page=admin_libros",
                                                    "¡Libro Actualizado Satisfactoriamente!"
                                                );
                                            }
                                        }
                                    }
                                    
                                }
                            }

                            if ($actualizo)
                            {
                                \Utilities\Site::redirectToWithMsg(
                                    "index.php?page=admin_libros",
                                    "¡Libro Actualizado Satisfactoriamente!"
                                );
                            }
                            
                        }                   
                    break;

                    case "DEL":

                        $elimino = false;
                        $_dataMedia = \Dao\Mnt\Media::getAll($this->LibrodId);
                                                
                        if (\DAO\Mnt\Libros::delete($this->LibrodId)) 
                        {
                            foreach ($_dataMedia as $_media)
                            {
                                if ($_media['MediaPath'] == "public/img/libro_default.jpg")
                                {
                                    \Dao\Mnt\Media::delete($this->LibrodId, $_media['MediaId']);
                                    $elimino = true;
                                }
                                else
                                {
                                    \Dao\Mnt\Media::delete($this->LibrodId, $_media['MediaId']);
                                    unlink("public/imgs/libros/".$_media['MediaDoc']);
                                    $elimino = true;
                                }
                            }
                            
                            if ($elimino)
                            {
                                \Utilities\Site::redirectToWithMsg(
                                    "index.php?page=admin_libros",
                                    "¡Libro Eliminado Satisfactoriamente!"
                                );
                            }
                        }
                    break;
                }
            }
        }

        $dataview = get_object_vars($this);
        \Views\Renderer::render("admin/libro", $dataview);
    }

    private function _load()
    {
        $_data = \Dao\Mnt\Libros::getOne($this->LibrodId);

        if ($_data) 
        {
            $this->LibrodId = $_data["LibrodId"];
            $this->LibroNombre = $_data["LibroNombre"];
            $this->LibroDescripcion = $_data["LibroDescripcion"];
            $this->LibroPrecioVenta = $_data["LibroPrecioVenta"];
            $this->LibroPrecioCompra = $_data["LibroPrecioCompra"];
            $this->LibroEst = $_data["LibroEst"];
            $this->LibroStock = $_data["LibroStock"];

            $_dataMedia = \Dao\Mnt\Media::getAll($this->LibrodId);
            if ($_dataMedia){
                $this->Media = $_dataMedia;
            }
            $this->_setViewData();
        }
    
    }

    private function _loadPostData()
    {
        $this->LibrodId = isset($_POST["LibrodId"]) ? $_POST["LibrodId"] : 0 ;
        $this->LibroNombre = isset($_POST["LibroNombre"]) ? $_POST["LibroNombre"] : "" ;
        $this->LibroDescripcion = isset($_POST["LibroDescripcion"]) ? $_POST["LibroDescripcion"] : "";
        $this->LibroPrecioVenta = isset($_POST["LibroPrecioVenta"]) ? $_POST["LibroPrecioVenta"] : 0;
        $this->LibroPrecioCompra = isset($_POST["LibroPrecioCompra"]) ? $_POST["LibroPrecioCompra"] : 0;
        $this->LibroEst = isset($_POST["LibroEst"]) ? $_POST["LibroEst"] : "";
        $this->LibroStock = isset($_POST["LibroStock"]) ? $_POST["LibroStock"] : 0;
        $this->MediaId = isset($_POST["MediaId"]) ? $_POST["MediaId"] : 0;
        
        if(!(is_null(['imagenes']) || is_null(['name'])))
        {
            if (($_FILES['imagenes']['name'] != null)) 
            {
                
                foreach ($_FILES['imagenes']['tmp_name'] as $key => $tmp_name) 
                {
                    if ( !empty($_FILES['imagenes']['name'][$key]) ) 
                    {
                        $this->Media['name'][$key] = $_FILES['imagenes']['name'][$key];
                        $this->Media['tmp_name'][$key] = $_FILES['imagenes']['tmp_name'][$key];
                        $this->Media['size'][$key] = $_FILES['imagenes']['size'][$key];
                    }
                    else
                    {
                        $this->Media['name'][$key] = "";
                        $this->Media['tmp_name'][$key] = "";
                    }
                }
            }
        }
        
        if (\Utilities\Validators::IsEmpty($this->LibroNombre)) 
        {
            $this->aErrors[] = "El nombre del libro no puede ir vacio";
        }

        if(\Utilities\Validators::IsEmpty($this->LibroDescripcion))
        {
            $this->aErrors[] = "La descripción del libro no puede ir vacia";
        }

        if(!(\Utilities\Validators::ValidarDinero($this->LibroPrecioVenta)) || $this->LibroPrecioVenta<=0)
        {
            $this->aErrors[] = "El precio de venta no es válido.";
        }

        if(!(\Utilities\Validators::ValidarDinero($this->LibroPrecioCompra)) || $this->LibroPrecioCompra<=0)
        {
            $this->aErrors[] = "El precio de compra no es válido.";
        }

        if(!(\Utilities\Validators::ValidarNumeros($this->LibroStock)) || $this->LibroPrecioCompra<=0)
        {
            $this->aErrors[] = "El stock no es válido.";
        }

        $this->hasErrors = (count($this->aErrors) > 0);
        $this->_setViewData();
    }

    private function _setViewData()
    {
        $this->LibroEst_ACT = ($this->LibroEst === "ACT") ? "selected" : "";
        $this->LibroEst_INA = ($this->LibroEst === "INA") ? "selected" : "";

        $this->mode_dsc = sprintf(
            $this->mode_adsc[$this->mode],
            $this->LibrodId,
            $this->LibroNombre
        );

        $this->notDisplayIns = ($this->mode=="INS") ? false : true;
        $this->notDisplayDel = ($this->mode=="DEL") ? false : true;
        $this->readonly = ($this->mode =="DEL" || $this->mode=="DSP") ? "readonly":"";
        $this->showaction = !($this->mode == "DSP");
    }
}

?>