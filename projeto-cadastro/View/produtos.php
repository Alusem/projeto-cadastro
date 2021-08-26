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
<link rel="stylesheet" href="/css/produtos.css">
<title>Clientes</title>
</head>
<body>
    <div class="header">
            <nav class="barra-home">
                <a class="header" href="home.php">Sistema Sam</a>
            </nav>
        

            <nav class="nav nav-pills nav-justified">
              <a class="nav-item nav-link" href="home.php">Home</a>
              <a class="nav-item nav-link active" href="produtos.php">Produtos</a>
              <a class="nav-item nav-link" href="listar-clientes.php">Clientes</a>
              <a class="nav-item nav-link" href="login.php">Sair</a>
            </nav>
        </div>

    <table id="tabela">
        <thead>
        <form method="post" action="produtos.php" >
            <tr>
                <th>Produtos</th>
                <th></th>                
            </tr>
            <tr>
                <th><input class="form-control" name="nomeP" id="nomeP" placeholder="Nome do produto" na  me="nomeP"></th>
                <th><button type="submit" class="btn btn-prima ry">Buscar</button></th>
            </tr>
        </form>

       </thead>
             <tbody>
                <?php
                    
                    if (isset(($_POST['nomeP']))){
                        $pesquisa = addslashes($_POST['nomeP']);
                        $_POST['nomeP'] = "";
                    }else{
                        $pesquisa = "";
                    }

                    $consulta = $pdo->query("SELECT nomeProdutos,precoProdutos FROM produtos WHERE nomeProdutos LIKE '%". $pesquisa ."%' ");
                
                    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>    
                            <td>
                                <?php echo $linha['nomeProdutos']; ?>
                            </td>
                            <td>
                                <?php echo "R$: " . $linha['precoProdutos'] . ",00"; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                        </tr>      
            </tbody>
    </table>
</body>
</html>

