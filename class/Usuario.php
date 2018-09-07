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
            
            $row = $results[0];
            
            $this->setDeslogin($row['deslogin']);
            $this->setIdusuario($row['idusuario']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
        }
        
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