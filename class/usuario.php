<?php
class Usuario{
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;


    public function getIdusuario(){
        return $this->idusuario;
    }

    public function setIdusuario($idusuario){
        $this->idusuario = $idusuario;
    }

    public function getDeslogin(){
        return $this->deslogin;
    }

    public function setDeslogin($deslogin){
        $this->deslogin = $deslogin;
    }

    public function getDessenha(){
        return $this->dessenha;
    }

    public function setDessenha($dessenha){
        $this->dessenha = $dessenha;
    }

    public function getDtcadastro(){
        return $this->dtcadastro;
    }

    public function setDtcadastro($dtcadastro){
        $this->dtcadastro = $dtcadastro;
    }

    //metodo que retorna os dados do BD
    public function setData($data){
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }

    //1 - metodo para buscar um usuario
    public function loadById($id){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
           ":ID"=>$id
        ));
        //if(count($results) > 0)
        if(isset($results)){
            $this->setData($results[0]);
        }
    }

    //MATODO CONSTRUTOR
    // = "" : se não chamar o metodo recebe vazio e não causa erro
    public function __construct($login = "", $password = ""){
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }

    // metodo toString
    public function __toString(){
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")

        ));
    }

    // 2 - metodo para buscar uma lista de usuarios
    public static function getLista(){
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }



    // 3 - carrega uma lista de usuarios buscando pelo login
    public static function search($Login){
        $sql = new Sql();
        //retorna do banco o usuario que o login tiver as letras passadas
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ':SEARCH'=>"%".$Login."%"
        ));
    }

    // 4 - carrega um usuario usando login e senha
    public function login($login, $password){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :ID and dessenha = :PASS", array(
            ":ID"=>$login,
            ":PASS"=>$password
        ));
        //if(count($results) > 0)
        if(isset($results)){
            $this->setData($results[0]);
        }else{
            throw new Exception("Login e/ou senha inválidos");
        }
    }

    // 5 - inserir usuario usando uma procedure
    public function insert(){
        $sql = new Sql();
        //retorna um procedure do BD
        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
           ':LOGIN'=>$this->getDeslogin(),
           ':PASSWORD'=>$this->getDessenha()
        ));
        if(count($results) > 0){
            $this->setData($results[0]);
        }
    }

    // 6 - alterar elementos
    public function update($login, $password){

        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();
        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
           ':LOGIN'=>$this->getDeslogin(),
           ':PASSWORD'=>$this->getDessenha(),
           ':ID'=>$this->getIdusuario()
        ));
    }
}

?>

