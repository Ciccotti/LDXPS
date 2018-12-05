<?php

class vendedores{
  public $dsnome;
  public $cdtab;
  public $dtnasc;
}

function getVendedores($conn){
  $arrayVendedores = [];

  $SQL = "
  SELECT dsnome, cdtab, dtnasc
  FROM vendedores
  ";

  $result = $conn->query($SQL);
  if (! $result)
  throw new Exception('Ocorreu uma falha: ' . $conn->error);

  if ($result->num_rows > 0)
  {
    while ($row = $result->fetch_assoc())
    {
      $vendedores = new vendedores();

      $vendedores->dsnome   = $row["dsnome"];
      $vendedores->cdtab    = $row["cdtab"];
      $vendedores->dtnasc   = $row["dtnasc"];

      $arrayVendedores[] = $vendedores;
    }
  }

  return $arrayVendedores;
}

?>
