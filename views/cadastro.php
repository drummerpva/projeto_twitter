<h2>Tela de Cadastro</h2>
<form method="POST">
    Nome:<br/>
    <input type="text" name="nome" required /><br/><br/>
    E-mail:<br/>
    <input type="email" name="email" required /><br/><br/>
    Senha:<br/>
    <input type="password" name="senha" required /><br/><br/>
    <input type="submit" value="Cadastrar" /><br/><br/>
    <?php echo $aviso ?? "";?>
</form>