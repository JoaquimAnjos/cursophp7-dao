<?php

require_once("config.php");
/*$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);*/

/*Carrega um usuário
$usuario = new Usuario();
$usuario->loadById(3);
echo $usuario;*/

//Carrega uma lista de Usuarios
//$list = Usuario::getList();
//echo json_encode($list);

//Carrega uma lista de usuarios buscando pelo login
//$search = Usuario::search("us");
//echo json_encode($search);

//Carrega login
/*$usuario = new Usuario();
$usuario->login('user', '12345');
echo $usuario;*/

/*Cria Usuario
$usuario = new Usuario("aluno3","aluno31");
$usuario->insert();
echo $usuario;*/

/*Alterar Usuario
$usuario = new Usuario();
$usuario->loadById(8);
$usuario->update("Professor", "13245");
echo $usuario;*/
$usuario = new Usuario();
$usuario->loadById(9);
$usuario->delete();
echo $usuario;


?>