<?php

class Relacionamentos extends model {

    public function seguir($idSeguidor, $idSeguido) {
        $sql = $this->db->prepare("INSERT INTO relacionamentos(id_seguidor, id_seguido) VALUES(?,?)");
        $sql->execute(array($idSeguidor, $idSeguido));
    }
    public function desseguir($idSeguidor, $idSeguido) {
        $sql = $this->db->prepare("DELETE FROM relacionamentos WHERE id_seguidor = ? AND id_seguido = ?");
        $sql->execute(array($idSeguidor, $idSeguido));
    }

}
