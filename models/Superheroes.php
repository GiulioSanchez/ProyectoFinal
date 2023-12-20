<?php
require_once 'Conexion.php';

class Superheroes extends Conexion{

  private $pdo;

  public function __CONSTRUCT(){                
    $this->pdo = parent::getConexion();
  }
  

//Devuelve la vista completa
  public function getAll($data= []){
    try{
      $consulta = $this->pdo->prepare("CALL spu_listar_superheroes(?)");
      $consulta->execute(
        array(
            $data['publisher_id']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);

    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }
}