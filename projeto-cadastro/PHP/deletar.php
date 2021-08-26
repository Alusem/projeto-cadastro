<?php
    session_start();
	require '../PHP/conexao.php';
	global $pdo;
    
if (strlen($_POST['nome']) ==  0){
	$erros[] = utf8_encode('Preencha o campo nome.');
}

if (strlen($_POST['cpf']) == 0){
	$erros[] = utf8_encode('Preencha o campo CPF.');

	}else {
        
        $id = addslashes($_POST['idClientes']);
        $cpf = addslashes($_POST['cpf']);

        if (validaCPF($cpf) == true){
            
		    $sql = "SELECT * FROM clientes WHERE cpfClientes = :cpfClientes LIMIT 0,1";
		    $sql = $pdo->prepare($sql);
		    $sql->bindValue("cpfClientes", $cpf);
            $sql->execute();
            $retorno = $sql->fetch(PDO::FETCH_ASSOC);

		    if($sql->rowCount() > 0 && $id !== $retorno["idClientes"]){
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
}else {

		 $id = addslashes($_POST['idClientes']);
		 $email = addslashes($_POST['email']);

         $sql = "SELECT * FROM clientes WHERE emailClientes = :emailClientes";
		 $sql = $pdo->prepare($sql);
		 $sql->bindValue("emailClientes", $email);
         $sql->execute();
         $retorno = $sql->fetch(PDO::FETCH_ASSOC);

		 if($sql->rowCount() > 0 && $id !== $retorno["idClientes"]){
		      $erros[] = utf8_encode('email já cadastrado.');
		 }
	}
   
if (isset($erros) && count($erros) > 0) {

    $_SESSION['errosReportados'] = $erros;
   
    header("Location: ../View/listar-clientes.php");
     

}else {

	 try {
        
        $id = addslashes($_POST['idClientes']);

        $stmt = $pdo->prepare('DELETE FROM clientes WHERE idClientes = :id');
  
        $stmt->bindParam(':id', $id);
        
        if ($id > 0 ){
        $retorno  = $stmt->execute();
        }
  
  if (! $retorno){
      $erros[] = utf8_encode('Não foi possivel deletar o cadastro, Tente Novamente');
  }else {
       ?> <script>alert("Cliente deletado com sucesso!");</script> <?php
       ?> <script>window.location.href = "../View/listar-clientes.php";</script> <?php
  }

} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}

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