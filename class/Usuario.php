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
    
    /**
     * @return mixed
     */
    public function getDeslogin()
    {
        return $this->deslogin;
    }

    /**
     * @return mixed
     */
    public function getDessenha()
    {
        return $this->dessenha;
    }

    /**
     * @return mixed
     */
    public function getDtcadastro()
    {
        return $this->dtcadastro;
    }

    /**
     * @param mixed $deslogin
     */
    public function setDeslogin($deslogin)
    {
        $this->deslogin = $deslogin;
    }

    /**
     * @param mixed $dessenha
     */
    public function setDessenha($dessenha)
    {
        $this->dessenha = $dessenha;
    }

    /**
     * @param mixed $dtcadastro
     */
    public function setDtcadastro($dtcadastro)
    {
        $this->dtcadastro = $dtcadastro;
    }
    
    public function loadById($id){
        
        $sql = new Sql();
        
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));
        
        if(count($results)>0){
            
            $this->setData($results[0]);
        }
    }
    
    public static function getList(){
        $sql = new Sql();
        return $sql->select("Select * From tb_usuarios Order By deslogin");
    }
    
    public static function search($login){
        $sql = new Sql();
        $results = $sql->select("Select * From tb_usuarios Where deslogin LIKE :SEARCH ORDER BY deslogin",array(
          ':SEARCH'=>"%".$login."%"  
        ));
    }
    
    public function login($login,$password){
        $sql = new Sql();
        $results = $sql->select("Select * From tb_usuarios Where deslogin=:LOGIN And dessenha=:SENHA Order by deslogin",array(
            ':LOGIN'=>$login,
            ':SENHA'=>$password
        ));
        
        if(count($results) > 0){
            
            $this->setData($results[0]);
        }else{
            throw new Exception("Login e/ou senha inválidos!");
        }
    }
    
    public function setData($data){
               
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }
    
    public function insert(){
        
        $sql = new Sql();
        
        $results = $sql->select("Call sp_usuarios_insert(:LOGIN, :PASSWORD)", array(// execução/chamada storaged procedure
           ':LOGIN'=>$this->getDeslogin(),
           ':PASSWORD'=>$this->getDessenha()
        ));
        
        if(count($results) >0){
            $this->setData($results[0]);
        }
    }
    
    public function __construct($login="",$password=""){
        
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }
    
    public function update($login,$senha){
       
        $this->setDeslogin($login);
        $this->setDessenha($senha);
        
        $sql = new Sql();
        $sql->query("Update tb_usuarios Set deslogin = :LOGIN, dessenha = :SENHA Where idusuario = :ID",array(
            ':LOGIN'=>$this->getDeslogin(),
            ':SENHA'=>$this->getDessenha(),
            ':ID'=>$this->getIdusuario()
        ));
    }
    
    public function delete(){
        $sql = new Sql();
        $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
            ':ID'=>$this->getIdusuario()
        ));
        
        $this->setIdusuario(null);
        $this->setDeslogin(null);
        $this->setDessenha(null);
        $this->setDtcadastro(new DateTime());
    }
    
    public function __toString() {
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }

    
}

?>