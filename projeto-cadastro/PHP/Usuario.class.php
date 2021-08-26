<?php

class Usuario{

	public function logar($login, $senha){
		
		global $pdo;

		$sql = "SELECT * FROM usuarios WHERE loginUsuarios = :loginUsuarios AND senhaUsuarios = :senhaUsuarios";
		$sql = $pdo->prepare($sql);
		$sql->bindValue("loginUsuarios", $login);
		$sql->bindValue("senhaUsuarios", $senha);
		$sql->execute();

		if($sql->rowCount() > 0){
			$dado = $sql->fetch();

			$_SESSION['idUser'] = $dado['idUsuarios'];

			return true;
		}else {
			return false;		
        }	
	}
}