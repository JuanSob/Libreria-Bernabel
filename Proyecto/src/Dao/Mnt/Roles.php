<?php

namespace Dao\Mnt;

use Dao\Security\Estados;

class Roles extends \Dao\Table
{
    public static function getAll()
    {
        $sqlstr="SELECT * FROM proyectolibreria.roles;";
        return self::obtenerRegistros($sqlstr, array());
    }
    
    public static function getOne($RolId)
    {
        $sqlstr = "SELECT * FROM proyectolibreria.roles WHERE RolId=:RolId;";
        $sqlParams = array("RolId"=>$RolId);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }

    public static function insert($RolDsc)
    {
        $sqlstr = "INSERT INTO proyectolibreria.roles (RolId, RolDsc, RolEst) VALUES (:RolId, :RolDsc, :RolEst);";
        $sqlParams =[
                "RolId"=>strtoupper($RolDsc), 
                "RolDsc"=>ucfirst(strtolower($RolDsc)), 
                "RolEst"=>Estados::ACTIVO
        ];
        return self::executeNonQuery($sqlstr,$sqlParams);
    }

    public static function update($RolDsc, $RolEst, $RolId)
    {
        $sqlstr = "UPDATE proyectolibreria.roles SET RolDsc=:RolDsc, RolEst=:RolEst WHERE RolId=:RolId;";
        $sqlParams=[
                "RolId"=>$RolId, 
                "RolDsc"=>ucfirst(strtolower($RolDsc)), 
                "RolEst"=>$RolEst
        ];
        return self::executeNonQuery($sqlstr,$sqlParams);
    }

    public static function delete($RolId)
    {
        $sqlstr = "DELETE FROM proyectolibreria.roles WHERE RolId=:RolId;";
        $sqlParams = ["RolId" => $RolId];
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    public static function searchRoles($UsuarioBusqueda)
    {
        $sqlstr = "SELECT * FROM proyectolibreria.roles WHERE RolId LIKE :UsuarioBusqueda OR RolDsc LIKE :UsuarioBusqueda
        OR RolEst LIKE :UsuarioBusqueda;";
        return self::obtenerRegistros($sqlstr, array("UsuarioBusqueda"=>"%".$UsuarioBusqueda."%"));
    }
}
?>