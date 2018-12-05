<?php
class criaVendedores
{
    public $dsnome;
    public $cdtab;
    public $dtnasc;
}
function getcriaVendedores($connecting)
{
    $arraycriaVendedores = [];

    $SQL = "
        SELECT dsnome, cdtab, dtnasc
        FROM vendedores
        INNER JOIN clientes
        ON clientes.cdcl = vendedores.cdvend
        ORDER BY dsnome ASC
    ";
    $resultadoConsulta = $connecting->query($SQL);
    if (! $resultadoConsulta)
        throw new Exception ('Ocorreu uma falha ao gerar a busca: '. $connecting->error);
    if ($resultadoConsulta->num_rows > 0)
    {
        while ($row = $resultadoConsulta->fetch_assoc())
        {
            $criaVendedores = new criaVendedores();

            $criaVendedores->dsnome        =       $row["dsnome"];
            $criaVendedores->mcdtab        =       $row["cdtab" ];
            $criaVendedores->dtnasc        =       $row["dtnasc"];

            $arraycriaVendedores []  = $criaVendedores;
        }
    }
    return $arraycriaVendedores;
}

function cadastraVendedores ($dsnome, $cdtab, $dtnasc)
{
    try 
    {
        $connecting = conectaAoMySql();
        $cdvend = "";
        $aux = "";
        if (isset($_POST["dsnome"]))
            $cdvend = filtrarDados($_POST["dsnome"]);
            
        // Buscando no banco de dados o codigo dos vendedores
        $SQL="
            SELECT cdvend 
            FROM vendedores 
            WHERE dsnome='$cdvend'
        ";
            
        // Caso o resultado seja negativo, uma exceção será lançanda, senão, irá para o outro IF.
        if (! $result = $connecting->query($SQL))
            throw new Exception ('Ocorreu uma falha: '. $connecting->error);

            // $result for maior que zero, $row receberá todos os dados do $result.
         if ($result->num_rows > 0)
         {
            $row = $result->fetch_assoc();
            $aux = $row["cdvend"]; // $aux receberá os dados do vetor associativo $row.
        }

        $connecting->begin_transaction(); //Inicio da transação.

        $connecting->autocommit(FALSE); // Declarando o autocommit como FALSE, para que ocorra so quando eu ordenar.

        $dados=$connecting->query(" insert into clientes (cdvend) values ('$cdvend')"); // Inserção de dados na Tabela

        if (! $dados)
            throw new Exception ('Erro: ' . $connecting->error);
        
        
        $connecting->commit(); // commit para que insira os dados 
         
        $connecting->close();  // encerrando conexão
    }
    catch (Expection $e) 
    {
        $connecting->rollback();
    
        echo "Ocorreu um erro na transação: " . $e->getMessage();
    }
}
// function cadastraFuncionario($nomeFunc, $dataNasc, $sexoFunc, $estadoCivil, $cargo, $especialidade, $cpf, $rg, $outro, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $tipo, $uf)
// {
//     try
// 	{
//         $conn = conectaAoMySql();
// 		$conn->begin_transaction();

// 		$conn->autocommit(FALSE);

// 		$dados=$conn->query("insert into tblFuncionario (codFuncionario, NomeFuncionario, DataNascimento, Sexo, EstadoCivil, Cargo, EspecialidadeMedica, CPF, RG, Outro)
// 			values (null, '$nomeFunc', '$dataNasc', '$sexoFunc', '$estadoCivil', '$cargo', '$especialidade', '$cpf', '$rg', '$outro')");
            
//         if (! $dados)
//             throw new Exception ('Erro: ' . $conn->error);
// 		$dados2=$conn->query("insert into EnderecoFuncionario (CEP, Logradouro, Numero, Complemento, Bairro, Cidade, Tipo, UF, codId)
// 		values ('$cep', '$logradouro', '$numero', '$complemento', '$bairro', '$cidade', '$tipo', '$uf', LAST_INSERT_ID())");
//         if (! $dados2)
//             throw new Exception ('Erro: ' . $conn->error);
// 		$conn->commit();
// 		$conn->close();
// 	}

// 	catch (Exception $e)
// 	{
// 		$conn->rollback();

// 		echo "Erro na transacao: ". $e->getMessage();
// 	}
// }
?>