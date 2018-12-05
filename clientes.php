<?php

class clientes{
  public $dsnome;
  public $idtipo;
  public $cdvend;
  public $dslim;
}

function getClientes($conn){
  $arrayClientes = [];

  $SQL = "
  SELECT dsnome, idtipo, cdvend, dslim
  FROM clientes
  ";

  $result = $conn->query($SQL);
  if (! $result)
  throw new Exception('Ocorreu uma falha: ' . $conn->error);

  if ($result->num_rows > 0)
  {
    while ($row = $result->fetch_assoc())
    {
      $clientes = new clientes();

      $clientes->dsnome    = $row["dsnome"];
      $clientes->idtipo    = $row["idtipo"];
      $clientes->cdvend    = $row["cdvend"];
      $clientes->dslim     = $row["dslim" ];

      $arrayClientes[] = $clientes;
    }
  }

  return $arrayClientes;
}

?>
