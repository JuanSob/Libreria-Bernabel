<?php

namespace Dao\Mnt;

class Media extends \Dao\Table
{
    public static function getAll($LibrodId)
    {
        $sqlstr = "Select * from media where LibrodId=:LibrodId;";
        return self::obtenerRegistros($sqlstr, array("LibrodId"=>$LibrodId));
    }

    public static function insert($MediaDoc, $MediaPath)
    {
        $LibrodId = self::obtenerRegistros("Select max(LibrodId) as LibrodId from libros;", array());

        foreach($LibrodId as $item){
            $LibrodId = $item["LibrodId"];
        }
        
        $insstr = "INSERT INTO media (MediaDoc, MediaPath, LibrodId) values (:MediaDoc, :MediaPath, :LibrodId);";
        return self::executeNonQuery(
            $insstr,
            array(
                "MediaDoc"=>$MediaDoc, 
                "MediaPath"=>$MediaPath, 
                "LibrodId"=>$LibrodId
            )
        );
    }

    public static function update($MediaDoc, $MediaPath, $LibrodId)
    {
        $updsql = "INSERT INTO media (MediaDoc, MediaPath, LibrodId) values (:MediaDoc, :MediaPath, :LibrodId);";
        return self::executeNonQuery(
            $updsql,
            array(
                "MediaDoc"=>$MediaDoc, 
                "MediaPath"=>$MediaPath,
                "LibrodId"=>$LibrodId,
            )
        );
    }

    public static function delete($LibrodId, $MediaId)
    {
        $delsql = "DELETE from media where LibrodId=:LibrodId and MediaId=:MediaId;";
        return self::executeNonQuery(
            $delsql,
            array( 
                "LibrodId" => $LibrodId,
                "MediaId" => $MediaId
            )
        );
    }

}

?>