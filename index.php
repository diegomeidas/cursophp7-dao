<?php

require_once ("config.php");
/*
    $selectSql = new Sql();
    $usuarios = $selectSql->select("SELECT * FROM tb_usuarios");
    echo json_encode($usuarios);
*/

/*
// 1 - carrega um usuario
    $root = new Usuario();
    $root->loadById(3);
    echo $root;
*/

/*
// 2 - carrega uma lista dos usuarios
    $lista = Usuario::getLista();   //por ser função estatica não precisa estanciar
    echo json_encode($lista);
*/

/*
// 3 - carrega uma lista de usuarios buscando pelo login
    $search = Usuario::search("jo");
    echo json_encode($search);
*/

/*
// 4 - carrega um usuario usando login e senha
    $usuario = new Usuario();
    $usuario->login("root", "!@#$%");
    echo $usuario;
*/

/*
// 5 - inserir usuario usando procedure
    //$aluno = new Usuario();
    //$aluno->setDeslogin("aluno");
    //$aluno->setDessenha("@lun0");

//utilizando o metodo construtor (economizo linhas de codigo)
    $aluno = new Usuario("aluno", "@lun0");
    $aluno->insert();

    echo $aluno;
*/

// 6 - alterar usuario
    $usuario = new Usuario();
    $usuario->loadById(6);
    $usuario->update("professor", "%$#@!");
    echo $usuario;






?>