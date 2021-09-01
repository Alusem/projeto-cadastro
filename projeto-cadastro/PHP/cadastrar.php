<?php
    session_start();
	require '../PHP/conexao.php';
	global $pdo;

    $nome = addslashes($_POST['nome']);
    $apelido = addslashes($_POST['apelido']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);

if (strlen($_POST['nome']) ==  0){
	$erros[] = utf8_encode('Preencha o campo nome.');
}

if (strlen($_POST['cpf']) == 0){
	$erros[] = utf8_encode('Preencha o campo CPF.');

	}else {

        $cpf = addslashes($_POST['cpf']);

        if (validaCPF($cpf) == true){
            
		    $sql = "SELECT * FROM clientes WHERE cpfClientes = :cpfClientes";
		    $sql = $pdo->prepare($sql);
		    $sql->bindValue("cpfClientes", $cpf);
            $sql->execute();

		    if($sql->rowCount() > 0){
			    $erros[] = utf8_encode('CPF já cadastrado.');
		    }

        }else {
            $erros[] = utf8_encode('CPF invalido.');
        }
	}

if (strlen($_POST['apelido']) == 0){
	$erros[] = utf8_encode('Preencha o campo apelido.');
}

if (strlen($_POST['telefone']) == 0){
	$erros[] = utf8_encode('Preencha o campo telefone.');
}

if (strlen($_POST['email']) == 0){
	$erros[] = utf8_encode('Preencha o campo email.');
}

if (isset($erros) && count($erros) > 0) {
    
    $_SESSION['camposForm'] = $_POST;
    $_SESSION['errosReportados'] = $erros;
    header("Location: ../View/cadastrar-cliente.php");

}else {

    $nome = addslashes($_POST['nome']);
    $apelido = addslashes($_POST['apelido']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);

	 $stmt = $pdo->prepare("INSERT INTO clientes (nomeClientes, cpfClientes, apelidoClientes, telefoneClientes, emailClientes) VALUES(:nomeClientes, :cpfClientes, :apelidoClientes, :telefoneClientes, :emailClientes)");
	 $stmt->execute(array(':nomeClientes' => $nome, ':cpfClientes' => $cpf, ':apelidoClientes' => $apelido, ':telefoneClientes' => $telefone,':emailClientes' => $email));

     ?> <script>alert("Cliente cadastrado com sucesso!");</script> <?php
     ?> <script>window.location.href = "../View/listar-clientes.php";</script> <?php
}


function validaCPF($cpf) {
 
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;

}