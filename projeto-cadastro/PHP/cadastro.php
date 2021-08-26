<?php
	session_start();
	require '../PHP/conexao.php';
	global $pdo;

if (strlen($_POST['senha']) ==  0){
	$erros[] = utf8_encode('Preencha o campo senha.');
}

if (strlen($_POST['confirmarSenha']) ==  0){
	$erros[] = utf8_encode('Preencha o campo senha.');
	}

if (($_POST['confirmarSenha']) != ($_POST['senha'])) {
	$erros[] = utf8_encode('As senhas n�o coincidem.');
	}

if (strlen($_POST['email']) == 0){
	$erros[] = utf8_encode('Preencha o campo email.');
    
    }else {
		 
		 $email = addslashes($_POST['email']);

         $sql = "SELECT * FROM usuarios WHERE emailUsuarios = :emailUsuarios";
		 $sql = $pdo->prepare($sql);
		 $sql->bindValue("emailUsuarios", $email);
         $sql->execute();

		 if($sql->rowCount() > 0){
		      $erros[] = utf8_encode('email j� cadastrado.');
		 }
	}

if (strlen($_POST['login']) == 0){
	$erros[] = utf8_encode('Preencha o campo login.');

	}else {

		$login = addslashes($_POST['login']);
		
         $sql = "SELECT * FROM usuarios WHERE loginUsuarios = :loginUsuarios";
		 $sql = $pdo->prepare($sql);
		 $sql->bindValue("loginUsuarios", $login);
         $sql->execute();

		 if($sql->rowCount() > 0){
		      $erros[] = utf8_encode('login j� cadastrado.');
		 }
	}

if (isset($erros) && count($erros) > 0) {
    $_SESSION['errosReportados'] = $erros;
    header("Location: ../View/cadastro-view.php");

	}else {

		$login = addslashes($_POST['login']);
		$senha = addslashes($_POST['senha']);
		$email = addslashes($_POST['email']);
		
		$stmt = $pdo->prepare('INSERT INTO usuarios (loginUsuarios, senhaUsuarios, emailUsuarios) VALUES(:loginUsuarios, :senhaUsuarios, :emailUsuarios)');
		$stmt->execute(array(':loginUsuarios' => $login, ':senhaUsuarios' => $senha, ':emailUsuarios' => $email));

		$sucesso = utf8_encode('Usu�rio cadastrado com sucesso!');
		$_SESSION['cadastroRealizado'] = $sucesso;
		header("Location: ../View/cadastro-view.php");
	}