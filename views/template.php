<html>
    <head>
        <title>Twitter</title>
        <link href="<?php echo BASE_URL;?>assets/css/estilos.css" rel="stylesheet" />
    </head>
    <body>
        <div class="topo">
            <div class="topoInt">
                <div class="topoLeft">TWITTER</div>
                <div class="topoRight"><?php echo $viewData['nome'];?> - <a href="./login/sair">Sair</a></div>
                <div style="clear:both"></div>
            </div>
        </div>
        <div class="container">
            <?php $this->loadViewInTemplate($viewName,$viewData);?> 
        </div>
        
        <script src="<?php echo BASE_URL;?>assets/js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo BASE_URL;?>assets/js/script.js" type="text/javascript"></script>
    </body>
        
</html>