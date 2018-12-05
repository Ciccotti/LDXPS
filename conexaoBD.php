<?php

define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DATABASE", "ldxpc");

function conectaAoBD(){
  $conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
  if ($conn->connect_error)
  throw new Exception('Falha na conexão: ' . $conn->connect_error);
  return $conn;
}

?>
