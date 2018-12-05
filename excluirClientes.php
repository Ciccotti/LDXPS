<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>LDXPS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
  <div class="container">

  <?php

  require "conexaoBD.php";

  function filtraEntrada($dado){
    $dado = trim($dado);
    $dado = stripslashes($dado);
    $dado = htmlspecialchars($dado);

    return $dado;
  }

  if (isset($_GET["cdcl"])){
    try
    {
      $conn = conectaAoBD();

      $id = filtraEntrada($_GET["cdcl"]);
      $sql = "
        DELETE
        FROM clientes
        WHERE cdcl = $cdcl
      ";

      if (! $conn->query($sql)){
        throw new Exception("Falha ao excluir o cliente!: " . $conn->error);
      } else {
        echo "<h3 class='text-success'>Cliente removido com sucesso!</h3>";
      }

    }
    catch (Exception $e){
      $msgErro = $e->getMessage();
    }
  }

  ?>
  <br>
  <a href="index.php"><button class="btn">Página Inicial</button></a>
</div>
</body>
</html>
