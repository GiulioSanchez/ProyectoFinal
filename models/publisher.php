<?php
require_once 'Conexion.php';

class publisher extends Conexion{

  private $pdo;

  public function __CONSTRUCT(){
    $this->pdo = parent::getConexion();
  }

//Devuelve la vista completa
  public function searchAll($data=[]){
    try{
      $consulta = $this->pdo->prepare("CALL spu_publisher_listar()");
      $consulta->execute();
      return $consulta->fetchAll((PDO::FETCH_ASSOC));

    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }
}