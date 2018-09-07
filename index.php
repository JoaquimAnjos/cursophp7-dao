<?php

require_once("config.php");
/*$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);*/

/*Carrega um usuário
$usuario = new Usuario();
$usuario->loadById(3);
echo $usuario;*/

//Carrega um a lista de Usuarios
//$list = Usuario::getList();
//echo json_encode($list);

//Carrega uma lista de usuarios buscando pelo login
//$search = Usuario::search("us");
//echo json_encode($search);

$usuario = new Usuario();
$usuario->login('user', '12345');

echo $usuario;
?>