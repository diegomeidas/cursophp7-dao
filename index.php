<?php

require_once ("config.php");
/*
$selectSql = new Sql();

$usuarios = $selectSql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);
*/

$root = new Usuario();
$root->loadById(3);
echo $root;

?>