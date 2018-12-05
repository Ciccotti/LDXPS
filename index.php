<?php

require "conexaoBD.php";

require "vendedores.php";
require "clientes.php";

$arrayVendedores = null;
$arrayClientes = null;
$msgErro = "";

try
{
	$conn = conectaAoBD();
    $arrayVendedores = getVendedores($conn);
    $arrayClientes = getClientes($conn);
}
catch (Exception $e)
{
    $msgErro = $e->getMessage();

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

                            <div class="form-group col-md-12">
                                    <h5 class="card-title">Selecione o vendedor:</h5>
                                    <select class="form-control" id="selecvend">
                                    <option>Todos</option>
                                    </select>
                                </div>
                            <br>
                            <!-- INICIO DO FORMULARIO -->
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="CDTAB">Código da tabela</label>
                                        <input class="form-control" type="text" id="CDTAB" placeholder="Código da tabela de preços padrão" readonly>
                                    </div>
                                    
                                    <div class="form-group col-md-12">  
                                    <label for="dtnasc">Data de nascimento</label>
                                    <input type="date" class="form-control" id="dtnasc" value="Data" readonly>                                          
     
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="inputClientes">Clientes</label>
                                        <select class="form-control" id="selecClientes">
                                            <option>#</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <!-- FIM DO FORMULARIO -->
                        </div>
                        <div class="card-footer text-center">
                            <a href="criarVendedor.php" class="btn btn-outline-success btn-sm" role="button" aria-pressed="true">Criar Vendedor</a>
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
                                        <label for="CDTAB">Nome do cliente</label>
                                        <input type="text" class="form-control" id="CDTAB" placeholder="Nome do cliente" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="IDTIPO">Tipo de pessoa</label>
                                        <input type="text" class="form-control" id="IDTIPO" placeholder="PF ou PJ" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="DTNASC">Vendedor</label>
                                        <input type="text" class="form-control" id="DTNASC" placeholder="Nome do vendedor" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="DTNASC">Limite de crédito</label>
                                        <input type="number" class="form-control" id="DTNASC" placeholder="Limite de crédito" readonly>
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