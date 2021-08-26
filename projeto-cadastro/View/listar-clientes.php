<?php
    session_start();
    require '../PHP/conexao.php';
	global $pdo;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="/css/clientes.css">
<title>Clientes</title>
</head>
<body>

        <div class="header">
            <nav class="barra-home">
                <a class="header" href="home.php">Sistema Sam</a>
            </nav>
        

            <nav class="nav nav-pills nav-justified">
              <a class="nav-item nav-link" href="home.php">Home</a>
              <a class="nav-item nav-link" href="produtos.php">Produtos</a>
              <a class="nav-item nav-link active" href="listar-clientes.php">Clientes</a>
              <a class="nav-item nav-link" href="login.php">Sair</a>
            </nav>
        </div>

    <table id="tabela">
        <thead>
           <form method="post" action="listar-clientes.php" >
            <tr>
                <th>Clientes</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th><input class="form-control" name="nomeC" id="nomeC" placeholder="Nome do cliente" na  me="nomeC"></th>
                <th><button type="submit" class="btn btn-prima ry">Buscar</button></th>
            </tr>
        </form>
 
        </thead>
        <tbody>
            <?php

                if (isset(($_POST['nomeC']))){
                    $pesquisa = addslashes($_POST['nomeC']);
                    $_POST['nomeC'] = "";
                }else{
                    $pesquisa = "";
                }

                $consulta = $pdo->query("SELECT idClientes, nomeClientes, cpfClientes, apelidoClientes, telefoneClientes, emailClientes FROM clientes WHERE nomeClientes LIKE '%". $pesquisa ."%' ");

                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td>
                            <?php 
                                echo $linha['idClientes'];
                            ?>
                        </td>
                        <td>
                            <?php echo $linha['nomeClientes']; ?>
                        </td>
                        <td>
                            <form action="editar-cliente.php">
                                <input type="hidden" name="idClientes" value="<?php echo $linha['idClientes'];?>">
                                <div class="btn-editar-cliente">  
                                    <button class="input-botão">Editar Clientes</button>
                                </div>
                            </form>
                        </td>
                        <td>
                            <form action="deletar-cliente.php">
                                <input type="hidden" name="idClientes" value="<?php echo $linha['idClientes'];?>">
                                <div class="btn-deletar-cliente">
                                    <button class="input-botão">Deletar Clientes</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tr>
                
        </tbody>
    </table>

    <form action="cadastrar-cliente.php">
        <div class="btn-cadastrar-cliente">
            <button class="input-botão">Cadastrar Cliente</button>
        </div>
    </form>
</body>
</html>

