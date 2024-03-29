<?php
namespace Controllers\Sec;
class Login extends \Controllers\PublicController
{
    private $txtEmail = "";
    private $txtPswd = "";
    private $errorEmail = "";
    private $errorPswd = "";
    private $generalError = "";
    private $hasError = false;

    public function run() :void
    {
        if ($this->isPostBack()) {
            $this->txtEmail = $_POST["txtEmail"];
            $this->txtPswd = $_POST["txtPswd"];

            if (!\Utilities\Validators::IsValidEmail($this->txtEmail)) {
                $this->errorEmail = "¡Correo no tiene el formato adecuado!";
                $this->hasError = true;
            }
            if (\Utilities\Validators::IsEmpty($this->txtPswd)) {
                $this->errorPswd = "¡Debe ingresar la contraseña!";
                $this->hasError = true;
            }
            if (! $this->hasError) {
                if ($dbUser = \Dao\Security\Security::getUsuarioByEmail($this->txtEmail)) {
                    if ($dbUser["UsuarioEst"] != \Dao\Security\Estados::ACTIVO) {
                        $this->generalError = "¡Credenciales son incorrectas!";
                        $this->hasError = true;
                        error_log(
                            sprintf(
                                "ERROR: %d %s tiene cuenta con estado %s",
                                $dbUser["usercod"],
                                $dbUser["useremail"],
                                $dbUser["userest"]
                            )
                        );
                    }
                    if (!\Dao\Security\Security::verifyPassword($this->txtPswd, $dbUser["UsuarioPswd"])) {
                        $this->generalError = "¡Credenciales son incorrectas!";
                        $this->hasError = true;
                        error_log(
                            sprintf(
                                "ERROR: %d %s contraseña incorrecta",
                                $dbUser["usercod"],
                                $dbUser["useremail"]
                            )
                        );
                        // Aqui se debe establecer acciones segun la politica de la institucion.
                    }
                    if (! $this->hasError) {
                        \Utilities\Security::login(
                            $dbUser["UsuarioId"],
                            $dbUser["UsuarioNombre"],
                            $dbUser["UsuarioEmail"]
                        );
                        if (\Utilities\Context::getContextByKey("redirto") !== "") {
                            \Utilities\Site::redirectTo(
                                \Utilities\Context::getContextByKey("redirto")
                            );
                        } else {
                            $this->transferirArticulosCarritoAnonimo();
                            \Utilities\Site::redirectTo("index.php");
                        }
                    }
                } else {
                    error_log(
                        sprintf(
                            "ERROR: %s trato de ingresar",
                            $this->txtEmail
                        )
                    );
                    $this->generalError = "¡Credenciales son incorrectas!";
                }
            }
        }
        $dataView = get_object_vars($this);
        \Views\Renderer::render("security/login", $dataView);
    }

    private function transferirArticulosCarritoAnonimo() : void
    {
        $userId = \Utilities\Security::getUserId();

        $ArticulosCarritoAnonimo = \Dao\Client\CarritoAnonimo::getProductosCarritoAnonimo(session_id());

        if(!empty($ArticulosCarritoAnonimo))
        {
            foreach($ArticulosCarritoAnonimo as $articulo)
            {
                $_comprobar = \Dao\Client\CarritoUsuario::comprobarProductoEnCarritoUsuario($userId,$articulo["LibrodId"]);
                if(empty($_comprobar))
                {
                    \Dao\Client\CarritoUsuario::insertarProductoCarritoUsuario($userId,$articulo["LibrodId"],$articulo["ProdCantidad"],$articulo["LibroPrecioVenta"]);   
                }
                else
                {
                    \Dao\Client\CarritoUsuario::sumarProductoInventarioAnonimo($articulo["LibrodId"], $_comprobar["ProdCantidad"]);
                    \Dao\Client\CarritoUsuario::deleteProductoCarritoUsuario($userId, $articulo["LibrodId"]);
                    \Dao\Client\CarritoUsuario::insertarProductoCarritoUsuario($userId,$articulo["LibrodId"],$articulo["ProdCantidad"],$articulo["LibroPrecioVenta"]);
                }
            }

            \Dao\Client\CarritoAnonimo::deleteAllCarritoAnonimo(session_id());
            \Utilities\Site::redirectTo("index.php?page=carrito");
        }

    }
}
?>
