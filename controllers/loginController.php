<?php

class loginController extends controller {

    public function __construct() {
        $u = new Usuarios();
        if ($u->isLogged()) {
            header("Location: ./");
        }
    }

    public function index() {
        $dados = array();
        if(!empty($_POST['email'])){
            $email = addslashes($_POST['email']);
            $senha = md5($_POST['senha']);
            $u = new Usuarios();
            if($u->fazerLogin($email, $senha)){
                header("Location: ./");
            }
        }
        
        
        $this->loadView('login', $dados);
    }

    public function cadastro() {
        $dados = array("aviso" =>"");
        if(!empty($_POST['nome'])){
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = md5($_POST['senha']);
            if(!empty($nome) && !empty($email) && !empty($senha)){
                $u = new Usuarios();
                if(!$u->usuarioExiste($email)){
                    $_SESSION['twlg'] = $u->inserirUsuario($nome, $email, $senha);
                    header("Location: ../");
                }else{
                    $dados['aviso'] = "Usuário já existe!";
                }
            }else{
                $dados['aviso'] = "Preencha todos os campos";
            }
        }
        $this->loadView('cadastro', $dados);
    }
    public function sair(){
        unset($_SESSION['twlg']);
        header("Location: ../");
    }

}
