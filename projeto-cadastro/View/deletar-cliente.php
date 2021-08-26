<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>Deletar Clientes</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/deletar-cliente.css"
    </head>
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

            $sql = $pdo->query("SELECT idClientes, nomeClientes, cpfClientes, apelidoClientes, telefoneClientes, emailClientes FROM clientes WHERE idClientes = ".$id.";");
		    //$sql->bindValue("idClientes", $id);
            
            if($sql->rowCount() > 0){
                $dados = $sql->fetch();
		    }
            session_unset();
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

                    if (is_array($_SESSION) && isset($_SESSION['remocaoRealizada'])){
                        $sucesso = $_SESSION['remocaoRealizada'];
                        echo $sucesso;
                        session_unset();
                    }
                ?>
            </div>

            <div class=form-deletar-cliente>

            <div><h1>Deletar Cliente</h1></div>

            <form method="POST" action="../PHP/deletar.php">

            <div>
                <input type="hidden" name="idClientes" value="<?php echo $_GET['idClientes'];?>">
            </div>

            <div>
                <label>Nome</label><br>
                <input class="input" minlength="3" maxlength="30" type="text" name="nome" id="inputNome" placeholder="Nome" readonly " value="<?php echo $dados[1]; ?>"><br>
            </div>

            <div>
                <label>CPF</label><br>
                <input class="input" minlength="14" maxlength="14" pattern="^\d{3}.\d{3}.\d{3}-\d{2}$" type="text" name="cpf" id="inputCPF" placeholder="CPF xxx.xxx.xxx-xx" readonly value="<?php echo $dados[2]; ?>"><br>
            </div>

            <div>
                <label>Apelido</label><br>
                <input class="input" minlength="3" maxlength="30" type="text" name="apelido" id="inputApelido" placeholder="Apelido" readonly value="<?php echo $dados[3]; ?>"><br>
            </div>

            <div>
                <label>Telefone</label><br>
                <input class="input" minlength="3" maxlength="12" pattern="^\d{2}-\d{9}$" type="tel" name="telefone" id="inputTelefone" placeholder="Telefone xx-xxxxxxxxx" readonly value="<?php echo $dados[4]; ?>"><br>
            </div>

            <div>
                <label>Email</label><br>
                <input class="input" minlength="6" maxlength="30" type="email" name="email" id="inputEmail" placeholder="Email" readonly value="<?php echo $dados[5]; ?>"><br>
            </div>

                <div class="btn1">
                    <button class="input-botao" type="submit" onclick="return confirm('Tem certeza que deseja deletar esse cliente?');">Deletar</button> 
                </div>
            </form>
            </div>
    </body>
</html>

<?php