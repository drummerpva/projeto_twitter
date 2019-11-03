<div class="feed">
    <form method="POST">
        <textarea name="msg" required class="taPost"></textarea><br/>
        <input type="submit" value="Enviar"/>
    </form>
    <?php foreach ($feed as $f) {
        ?>
        <b><?php echo $f['nome'];?></b> - <?php echo date("d/m/Y H:i:s",strtotime($f['data_post']));?><br/>
        <?php echo $f['mensagem'];?>
        <hr/>
        <?php
    }
    ?>
</div>
<div class="rightSide">
    <h4>Relacionamentos</h4>
    <div class="rsMeio"><?php echo $qtSeguidores ?? "0"; ?><br/>Seguidores</div>
    <div class="rsMeio"><?php echo $qtSeguidos ?? "0"; ?><br/>Seguindo</div>
    <div style="clear:both"></div>

    <h4>Seguestões de amigos</h4>
    <table border="0" width="100%">
        <tr>
            <td width="80%"></td>
            <td></td>
        </tr>
        <?php foreach ($sugestao as $s) {
            ?>
            <tr>
                <td><?php echo $s['nome'] ?></td>
                <td>
                    <a href="./home/seguir/<?php echo $s['id'] ?>">Seguir</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <h4>Meus amigos</h4>
    <table border="0" width="100%">
        <tr>
            <td width="80%"></td>
            <td></td>
        </tr>
        <?php foreach ($amigos as $a) {
            ?>
            <tr>
                <td><?php echo $a['nome'] ?></td>
                <td>
                    <a href="./home/deseguir/<?php echo $a['id'] ?>">Deseguir</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>