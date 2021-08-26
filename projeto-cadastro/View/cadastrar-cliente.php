<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/cadastrar-cliente.css">
        <title>Cadastrar Cliente</title>
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

    <div class=form-cadastrar-cliente>
        <div><h1>Cadastrar Cliente</h1></div>
            <div>
                <?php
 
                    if(is_array($_SESSION) && isset($_SESSION['errosReportados'])){
                        $erros = $_SESSION['errosReportados'];
                        foreach ($erros as $erro) {
                            echo $erro;
                            echo "<br>";
                        }
                        session_unset();
                    }

                    if (is_array($_SESSION) && isset($_SESSION['cadastroRealizado'])){
                        $sucesso = $_SESSION['cadastroRealizado'];
                        echo $sucesso;
                        session_unset();
                    }
                ?>

                <?php
                
                ?>

            </div>
        <form method="POST" action="../PHP/cadastrar.php">
            <div>
                <label>Nome</label><br>
                <input class="input" minlength="3" type="text" name="nome" id="inputNome" placeholder="Nome" required><br>
            </div>

            <div>
                <label>CPF</label><br>
                <input class="input" minlength="14" maxlength="14" pattern="^\d{3}.\d{3}.\d{3}-\d{2}$" type="text" name="cpf" id="inputCPF" placeholder="CPF xxx.xxx.xxx-xx" required /><br>
            </div>

            <div>
                <label>Apelido</label><br>
                <input class="input" minlength="3" maxlength="50" type="text" name="apelido" id="inputApelido" placeholder="Apelido" required><br>
            </div>

            <div>
                <label>Telefone</label><br>
                <input class="input" minlength="3" maxlength="12" pattern="^\d{2}-\d{9}$" type="tel" name="telefone" id="inputTelefone" placeholder="Telefone xx-xxxxxxxxx" required><br>
            </div>

            <div>
                <label>Email</label><br>
                <input class="input" minlength="6" type="email" name="email" id="inputEmail" placeholder="Email" required><br>
            </div>

            <div class="btn1">
                <button class="input-botao" type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
    </body>
</html>