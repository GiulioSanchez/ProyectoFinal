<?php
require_once 'Conexion.php';

class Alignment extends Conexion{

  private $pdo;

  public function __CONSTRUCT(){                
    $this->pdo = parent::getConexion();
  }
  

//Devuelve la vista completa
  public function getAll($data= []){
    try{
      $consulta = $this->pdo->prepare("CALL spu_listar_bandos_por_publishers(?)");
      $consulta->execute(
        array(
            $data['id']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);

    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }
}