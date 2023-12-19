<?php

require_once '../models/publisher.php';

if (isset($_GET['operacion'])){

  $publisher = new publisher();

  if ($_GET['operacion'] == 'listar') {
    $resultado = $publisher_name->getAll();
    echo json_encode($resultado);
  }
}