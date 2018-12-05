<?php

require "conexaoBD.php";

function filtraEntrada($dado)
{
	$dado = trim($dado);
	$dado = stripslashes($dado);
	$dado = htmlspecialchars($dado);

	return $dado;
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$msgErro = "";

	$dsnome = $cdtab = $dtnasc = "";

	$dsnome     = filtraEntrada($_POST["dsnome"]);
	$cdtab      = filtraEntrada($_POST["cdtab"]);
	$dtnasc	    = $_POST["dtnasc"];

	try
	{
        $conn = conectaAoBD();
        
        $cdvend = md5(uniqid(rand(), true));

		$sql = "
		INSERT INTO vendedores (cdvend, dsnome, cdtab, dtnasc)
		VALUES ('$cdvend', '$dsnome', '$cdtab', '$dtnasc');
		";

		if (! $conn->query($sql))
		throw new Exception("Falha na inserção dos dados: " . $conn->error);

		$formProcSucesso = true;
	}
	catch (Exception $e)
	{
		$msgErro = $e->getMessage();
	}
}

?>

<!DOCTYPE html>
<html lang="br">

    <head>
        <meta charset="utf-8">
        <title>LDXPS</title>
        <link rel="icon" href="img/sw.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>

        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-light bg-light" id="navegabar">
            <a class="navbar-brand" href="index.php" id="txtnavegabar">
                <img src="img/sw.png" width="30" height="30" class="d-inline-block align-top" alt="">
                LDXPS
            </a>
        </nav>
        <!-- ============================================================== -->
        <!-- final navbar -->
        <!-- ============================================================== -->

        <div class="container" id="card-principal">
            <div class="row">
                <!-- ============================================================== -->
                <!-- vendedor -->
                <!-- ============================================================== -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-12 card-deck">
                    <div class="card" id="card-vendedor">
                        <h5 class="card-header" id="vendedor-header">VENDEDOR</h5>
                        <div class="card-body">
                            <!-- INICIO DO FORMULARIO -->
                            <form action="criarVendedor.php" method="POST">            
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="cdtab">Nome do vendedor</label>
                                        <input name="dsnome" type="text" class="form-control" id="dsnome" placeholder="Digite o nome do vendedor">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="cdtab">Código da tabela</label>
                                        <input name="cdtab" type="text" class="form-control" id="cdtab" placeholder="Digite o código da tabela de preços padrão" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="dtnasc">Data de nascimento</label>
                                        <input name="dtnasc" type="date" class="form-control" id="dtnasc" placeholder="Data">
                                    </div>                                    
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-success btn btn-block">Confirmar Criação</button>
                                    </div>
                                </div>
                            </form>                            
                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                                    if ($msgErro == "")
                                    echo "<h3 class='text-success'>Vendedor criado com sucesso!</h3>";
                                    else
                                    echo "<h3 class='text-danger'>Erro ao criar o vendedor!: $msgErro</h3>";
                                }
                            ?>
                            <!-- FIM DO FORMULARIO -->
                        </div>
                        <div class="card-footer text-center">
                            <a href="editarVendedor.php" class="btn btn-outline-primary btn-sm" role="button" aria-pressed="true">Editar Vendedor</a>
                        </div>
                   
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- final vendedor -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- cliente -->
                <!-- ============================================================== -->
                <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-12 card-deck">
                    <div class="card" id="card-cliente">
                        <h5 class="card-header" id="cliente-header">CLIENTE</h5>
                        <div class="card-body">                                
                            <!-- INICIO DO FORMULARIO -->
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="cdtab">Nome do cliente</label>
                                        <input type="text" class="form-control" id="cdtab" placeholder="Digite o nome do cliente" disabled>
                                    </div>
                                    <div class="form-group col-md-12">
                                            <label for="IDTIPO">Tipo de pessoa</label>
                                            <select class="form-control" id="IDTIPO" disabled>
                                                <option>PF</option>
                                                <option>Pj</option>
                                            </select>
                                        </div>
                                    <div class="form-group col-md-12">
                                        <label for="dtnasc">Vendedor</label>
                                        <input type="text" class="form-control" id="dtnasc" placeholder="Digite o nome do vendedor" disabled>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="dslim">Limite de crédito</label>
                                        <input type="number" class="form-control" id="dslim" placeholder="Digite o valor do limite de crédito" disabled>
                                    </div>
                                </div>
                            </form>
                            <!-- FIM DO FORMULARIO -->
                        </div>
                        <div class="card-footer text-center">
                            <a href="criarCliente.php" class="btn btn-outline-warning btn-sm" role="button" aria-pressed="true">Criar Cliente</a>
                            <a href="editarCliente.php" class="btn btn-outline-primary btn-sm" role="button" aria-pressed="true">Editar Cliente</a>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- final cliente -->
                <!-- ============================================================== -->
            </div>
        </div>


    </body>

</html>