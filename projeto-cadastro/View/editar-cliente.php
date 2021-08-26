<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/editar-cliente.css">
        <title>Editar Cliente</title>
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

        <?php
            require '../PHP/conexao.php';
	        global $pdo;
            session_start();

            $id = $_GET['idClientes'];
           // print_r($_POST);
            $stringQuery ="SELECT idClientes, nomeClientes, cpfClientes, apelidoClientes, telefoneClientes, emailClientes FROM clientes WHERE idClientes = '".$id."';";
           // print_r($stringQuery);
            $sql = $pdo->query($stringQuery);
		    //$sql->bindValue("idClientes", $id);
            
            if($sql->rowCount() > 0){
                $dados = $sql->fetch();
		    }
            
        ?>

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

                    if (is_array($_SESSION) && isset($_SESSION['atualizacaoRealizada'])){
                        $sucesso = $_SESSION['atualizacaoRealizada'];
                        echo $sucesso;
                        session_unset();
                    }
                ?>
            </div>
            
    <div class=form-editar-cliente>

            <div><h1>Editar Cliente</h1></div>

        <form method="POST" action="../PHP/editar.php">
            
            <div>
                <input type="hidden" name="idClientes" value="<?php echo $_GET['idClientes'];?>">
            </div>

            <div>
                <label>Nome</label><br>
                <input class="input" minlength="3" maxlength="30" type="text" name="nome" id="inputNome" placeholder="Nome" required " value="<?php echo $dados[1]; ?>"><br/>
            </div>

            <div>
                <label>CPF</label><br>
                <input class="input" minlength="14" maxlength="14" pattern="^\d{3}.\d{3}.\d{3}-\d{2}$" type="text" name="cpf" id="inputCPF" placeholder="CPF xxx.xxx.xxx-xx" required value="<?php echo $dados[2]; ?>"><br>
            </div>

            <div>
                <label>Apelido</label><br>
                <input class="input" minlength="3" maxlength="30" type="text" name="apelido" id="inputApelido" placeholder="Apelido" required value="<?php echo $dados[3]; ?>"><br>
            </div>

            <div>
                <label>Telefone</label><br>
                <input class="input" minlength="3" maxlength="12" pattern="^\d{2}-\d{9}$" type="tel" name="telefone" id="inputTelefone" placeholder="Telefone xx-xxxxxxxxx" required" value="<?php echo $dados[4]; ?>"><br>
            </div>

            <div>
                <label>Email</label><br>
                <input class="input" minlength="6" maxlength="30" type="email" name="email" id="inputEmail" placeholder="Email" required value="<?php echo $dados[5]; ?>"><br>
            </div>

            <div class="btn2">
                <button class="input-botao" type="submit">Editar</button>
            </div>
        </form>
    </div>
    </body>
</html>

<?php
    