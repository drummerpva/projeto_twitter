<?php

class Usuarios extends model {

    private $id;

    public function __construct($id = null) {
        parent::__construct();
        if (!empty($id)) {
            $this->id = $id;
        }
    }
    
    public function getSeguidos(){
        $array = array();
        $sql = $this->db->prepare("SELECT id_seguido FROM relacionamentos WHERE id_seguidor = ?");
        $sql->execute(array($_SESSION['twlg']));
        if($sql->rowCount() > 0){
            foreach($sql->fetchAll() as $s){
                $array[] = $s['id_seguido'];
            }
        }
        return $array;
    }
    
    public function getNome() {
        $retorno = "";
        if (!empty($this->id)) {
            $sql = $this->db->prepare("SELECT nome FROM usuarios WHERE id = ?");
            $sql->execute(array($this->id));
            $sql = $sql->fetch();
            $retorno = $sql['nome'];
        }
        return $retorno;
    }

    public function countSeguidos() {
        $t = 0;
        $sql = $this->db->prepare("SELECT COUNT(1) as c FROM relacionamentos WHERE id_seguidor = ? ");
        $sql->execute(array($this->id));
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $t = $sql['c'];
        }
        return $t;
    }

    public function countSeguidores() {
        $t = 0;
        $sql = $this->db->prepare("SELECT COUNT(1) as c FROM relacionamentos WHERE id_seguido = ? ");
        $sql->execute(array($this->id));
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $t = $sql['c'];
        }
        return $t;
    }

    public function getUsuarios($qt = 10) {
        $array = array();
        $sql = "SELECT * FROM usuarios WHERE id NOT IN(SELECT id_seguido FROM relacionamentos WHERE id_seguidor = :id ) AND id != :id LIMIT :qt ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id",$_SESSION['twlg']);
        $sql->bindValue(":qt",$qt,PDO::PARAM_INT);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    public function getAmigos($qt = 10) {
        $array = array();
        $sql = "SELECT * FROM usuarios WHERE id IN(SELECT id_seguido FROM relacionamentos WHERE id_seguidor = :id ) AND id != :id LIMIT :qt ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id",$_SESSION['twlg']);
        $sql->bindValue(":qt",$qt,PDO::PARAM_INT);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    public function usExiste($email) {
        $sql = $this->db->prepare("SELECT id FROM usuarios WHERE id = ?");
        $sql->execute(array($email));
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function isLogged() {
        if (!empty($_SESSION['twlg'])) {
            return true;
        } else {
            return false;
        }
    }

    public function usuarioExiste($email) {
        $sql = $this->db->prepare("SELECT id FROM usuarios WHERE email = ?");
        $sql->execute(array($email));
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function inserirUsuario($nome, $email, $senha) {
        $sql = $this->db->prepare("INSERT INTO usuarios(nome,email,senha) VALUES(:nome, :email, :senha)");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function fazerLogin($email, $senha) {
        $sql = $this->db->prepare("SELECT id FROM usuarios WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $_SESSION['twlg'] = $sql['id'];
            return true;
        } else {
            return false;
        }
    }

}
