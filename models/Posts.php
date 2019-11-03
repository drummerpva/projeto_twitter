<?php
 class Posts extends model{
     public function inserirPost($msg){
         $sql = $this->db->prepare("INSERT INTO posts(id_usuario, data_post, mensagem) VALUES(:id, NOW(), :msg)");
         $sql->bindValue(":id",$_SESSION['twlg']);
         $sql->bindValue(":msg",$msg);
         $sql->execute();
     }
     public function getFeed($lista, $qt){
         $array = array();
         $sql = $this->db->prepare("SELECT p.*,(SELECT u.nome FROM usuarios u WHERE u.id = p.id_usuario ) as nome FROM posts p WHERE p.id_usuario IN(".implode(',',$lista).") ORDER BY p.data_post DESC LIMIT :l");
         $sql->bindValue(':l',$qt,PDO::PARAM_INT);
         $sql->execute();
         if($sql->rowCount()>0){
             $array = $sql->fetchAll(PDO::FETCH_ASSOC);
         }
         return $array;
     }
 }