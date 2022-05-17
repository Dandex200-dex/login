<?php
include "config.php";
	
    //here is the function of update
   function Update_Password($id,$password)
    {
        $sql="update users set password = :password where id = :id";
        $db=config::getConnexion();

        try
        {
            $query=$db->prepare($sql);
            $query->execute([
                'id'=>$id,
                'password'=>$password,
              
            ]);
        }
        catch(Exception $e)
        {
            die('Erreur: '.$e->getMessage());
        }
    }
	
?>