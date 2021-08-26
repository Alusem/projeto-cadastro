<?php



if(isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['senha']) && !empty($_POST['senha'])){
	
	require '../PHP/conexao.php';
	require '../PHP/Usuario.class.php';

	$u = new Usuario();

	$login = addslashes($_POST['login']);
	$senha = addslashes($_POST['senha']);

	if ($u->logar($login, $senha) == true){
		if(isset($_SESSION['idUser'])){
			header("Location: ../View/home.php");	
		}else {
			header("Location: ../View/login.php");
        }

	}else {
		header("Location: ../View/login.php");
	}

}else{

	header("Location: ../View/login.php");
}

