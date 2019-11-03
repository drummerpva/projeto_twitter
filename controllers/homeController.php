<?php

class homeController extends controller {

    public function __construct() {
        $u = new Usuarios();
        if (!$u->isLogged()) {
            header("Location: ./login");
        }
    }

    public function index() {
        $dados = array(
            "nome" => ""
        );
        $u = new Usuarios($_SESSION['twlg']);
        $dados['nome'] = $u->getNome();
        $dados['qtSeguidos'] = $u->countSeguidos();
        $dados['qtSeguidores'] = $u->countSeguidores();
        $dados['sugestao'] = $u->getUsuarios(5);
        $dados['amigos'] = $u->getAmigos(5);
        $p = new Posts();
        if(!empty($_POST['msg'])){
           $msg = addslashes($_POST['msg']);
           $p->inserirPost($msg);
           header("Location: ./");
        }
        $lista = $u->getSeguidos();
        $lista[] = $_SESSION['twlg'];
        $dados['feed'] = $p->getFeed($lista,10);

        $this->loadTemplate('home', $dados);
    }

    public function seguir($id) {
        if (!empty($id)) {
            $id = addslashes($id);
            $u = new Usuarios();
            $r = new Relacionamentos();
            if ($u->usExiste($id)) {
                $r->seguir($_SESSION['twlg'], $id);
                header("Location: ../../");
            } else {
                header("Location: ../../");
            }
        }
    }

    public function deseguir($id) {
        if (!empty($id)) {
            $id = addslashes($id);
            $r = new Relacionamentos();
            $r->desseguir($_SESSION['twlg'], $id);
            header("Location: ../../");
        }
    }

}
